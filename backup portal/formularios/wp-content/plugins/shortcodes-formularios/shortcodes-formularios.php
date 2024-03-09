<?php
/**
 * Plugin Name:     Shortcodes - formulários
 * Description:     Coleção de shortcodes usados nos formulários do portal de Extensão da UFRJ.
 * Author:          Portal de Extensão da UFRJ
 * Author URI:      https://portal.extensao.ufrj.br
 * Version:         1.0
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/formularios/wp-includes/shortcodes.php';
require_once WPCF7_PLUGIN_DIR . '/includes/form-tags-manager.php';

const ID_POST_DIVULGACAO_ACAO = 39;
const ID_POST_DIVULGACAO_ATIVIDADES = 42;
const ID_POST_DIVULGACAO_VAGAS = 26;

const URL_ACAO_SIGA = "https://portal.ufrj.br/Inscricao/extensao/acaoExtensao/acao?id=";

const PREFIXO_DATA_INICIAL = "data_inicio_";
const PREFIXO_DATA_FINAL = "data_termino_";

add_shortcode('radio_conditional_display', 'radio_conditional_display_func');
function radio_conditional_display_func($atts, $content = null) {
    $default = array(
        'radio_name' => '',
        'hide_value' => '',
    );
    $a = shortcode_atts($default, $atts);
    $content = do_shortcode($content);
    $inner_class = 'conditional-display-' . rand();
    $js = file_get_contents(__DIR__.'/js/conditional_display.js');
    $js = str_replace('__RADIO_NAME__', $a['radio_name'], $js);
    $js = str_replace('__HIDE_VALUE__', $a['hide_value'], $js);
    $js = str_replace('__DISPLAY_CLASS__', $inner_class, $js);
    return '<div class="'.$inner_class.'" style="display: none">'.$content.'</div>'.'<script>'.$js.'</script>';
}

add_shortcode('week_time_select', 'week_time_select_func');
function week_time_select_func($atts) {
    $name = $atts[0];
    if (empty($name)) {
        return "<b>Error:</b> No tag name ";
    }
    $html = file_get_contents(__DIR__.'/html/week_time_select.html');
    return str_replace("__NAME__", $name, $html);
}

add_shortcode('time_select', 'time_select_func');
function time_select_func($atts) {
    $name = $atts[0];
    if (empty($name)) {
        return "<b>Error:</b> No tag name ";
    }
    $html = file_get_contents(__DIR__.'/html/time_select.html');
    return str_replace("__NAME__", $name, $html);
}

add_filter( 'wpcf7_validate_url*', 'validate_modalidade_acao_siga', 5, 2 );
function validate_modalidade_acao_siga( $result, $tag ) {
    if ( 'url_acao_SIGA' == $tag->name) {
        try {
            $id_acao = get_id_from_url_siga($_POST['url_acao_SIGA']);
            $acao = acao_siga($id_acao);
            if (in_array("class:curso_ou_evento", $tag->options)) {
                if (!in_array($acao->modalidade, array('Evento', 'Curso'))) {
                    $result->invalidate($tag, "Este formulário é dedicado apenas para ações cuja modalidade é \"Curso\" ou \"Evento\".");
                }

            }
        } catch(Exception $e) {
            $result->invalidate($tag, "Ação não encontrada.");
        }
    }
    return $result;
}

add_filter( 'wpcf7_validate_date', 'validate_periodo', 5, 2 );
add_filter( 'wpcf7_validate_date*', 'validate_periodo', 5, 2 );
function validate_periodo( $result, $tag ) {
    if(str_starts_with($tag->name, PREFIXO_DATA_FINAL)) {
        $tag_data_final = $tag->name;
        $tag_data_inicial = PREFIXO_DATA_INICIAL . substr($tag_data_final, strlen(PREFIXO_DATA_FINAL));

        if (!isset($_POST[$tag_data_inicial]) && !isset($_POST[$tag_data_final])) {
            return $result;
        }

        $data_inicial = DateTime::createFromFormat("Y-m-d", $_POST[$tag_data_inicial]);
        $data_final = DateTime::createFromFormat("Y-m-d", $_POST[$tag_data_final]);

        if (!$data_inicial || !$data_final) {
            $result->invalidate($tag, "Período inválido.");
        } else if ($data_final < $data_inicial) {
            $result->invalidate($tag, "A data final não pode ser antes da data inicial.");
        }
    }

    return $result;
}

add_filter( 'wpcf7_form_elements', 'do_custom_shortcodes_wpcf7_form' );
function do_custom_shortcodes_wpcf7_form( $form ) {
    $form = do_shortcode( $form );
    return $form;
}

add_action( 'cfdb7_after_save_data', 'add_form_to_acao');
function add_form_to_acao( $insert_id ) {
    global $wpdb;
    $forms_table_name = $wpdb->prefix.'db7_forms';
    $results = $wpdb->get_results("SELECT form_post_id, form_value FROM $forms_table_name WHERE form_id = $insert_id LIMIT 1", OBJECT );
    $form_data = unserialize($results[0]->form_value);
    $form_post_id = intval($results[0]->form_post_id);

    if ($form_post_id === ID_POST_DIVULGACAO_ACAO) {
        $id_acao = get_id_from_url_siga($form_data['url_acao_SIGA']);
        $acao = acao_siga($id_acao);

        $anuncio_acao = array(
            'email'=> $form_data['email'],
            'titulo_curto'=> html_entity_decode($form_data['nome_curto']),
            'descricao'=> html_entity_decode($form_data['descricao']),
            'contato_responsavel'=> html_entity_decode($form_data['contato_responsavel']),
            'telefone_atendimento'=> $form_data['telefone_atendimento'],
            'email_atendimento'=> $form_data['email_atendimento'],
            'publico'=> html_entity_decode($form_data['publico']),
            'faixa_etaria_publico'=> serialize($form_data['faixa_etaria_publico']),
            'data_inicio_inscricoes'=> $form_data['data_inicio_inscricoes'],
            'data_termino_inscricoes'=> $form_data['data_termino_inscricoes'],
            'como_inscrever'=> html_entity_decode($form_data['como_inscrever']),
            'link_inscricoes'=> html_entity_decode($form_data['link_inscricoes']),
            'horarios' => serialize(estrutura_horarios($form_data)),
            'observacoes_horarios_realizacao' => html_entity_decode($form_data['observacoes_horarios_realizacao']),
            'link_instagram' => html_entity_decode($form_data['link_instagram']),
            'link_facebook' => html_entity_decode($form_data['link_facebook']),
            'link_twitter' => html_entity_decode($form_data['link_twitter']),
            'link_youtube' => html_entity_decode($form_data['link_youtube']),
            'link_site_acao' => NULL, // MUDAR
            'link_transmissao' => html_entity_decode($form_data['link_transmissao']),
            'endereco_completo' => html_entity_decode($form_data['endereco_completo']),
            'observacoes' => html_entity_decode($form_data['observacoes']),
            'imagem_divulgacao' => $form_data['imagem_divulgacaocfdb7_file'],
            'material_referencia' => $form_data['material_referenciacfdb7_file'],
            'id_acao'=> $id_acao,
            'centro'=> $acao->centro,
            'unidade'=> $acao->unidade,
            'coordenador'=> $acao->coordenador,
            'titulo'=> $acao->titulo,
            'modalidade'=> $acao->modalidade,
            'resumo'=> $acao->resumo,
            'contato'=> $acao->contato,
            'data_inicio'=> $form_data['data_inicio_realizacao'],
            'data_termino'=> $form_data['data_termino_realizacao'],
            'objetivos'=> $acao->objetivos,
            'area_principal'=> $acao->areaPrincipal,
            'area_secundaria'=> $acao->areaSecundaria,
            'carga_horaria'=> $acao->cargaHoraria,
            'formato_realizacao'=> $form_data['formato_realizacao'][0],
        );

        $result_set = $wpdb->insert('anuncio_acao', $anuncio_acao);

    } else if ($form_post_id === ID_POST_DIVULGACAO_VAGAS) {
        $id_acao = get_id_from_url_siga($form_data['url_acao_SIGA']);
        insert_acao_if_not_exists($id_acao);
        atualizar_cache_siga($id_acao);
        
        $results = $wpdb->get_results("SELECT IFNULL(max(indice)+1, 0) as proximo_indice FROM anuncio_vaga WHERE id_acao = '$id_acao' LIMIT 1", OBJECT);
        $proximo_indice = $results[0]->proximo_indice;
        $wpdb->insert( 'anuncio_vaga',
            array(
                'id_acao' => $id_acao,
                'indice' => $proximo_indice,
                'form_id' => $insert_id,
            )
        );
    } else if ($form_post_id === ID_POST_DIVULGACAO_ATIVIDADES) {
        $id_acao = get_id_from_url_siga($form_data['url_acao_SIGA']);
        insert_acao_if_not_exists($id_acao);
        atualizar_cache_siga($id_acao);
        
        $results = $wpdb->get_results("SELECT IFNULL(max(indice)+1, 0) as proximo_indice FROM atividade WHERE id_acao = '$id_acao' LIMIT 1", OBJECT);
        $proximo_indice = $results[0]->proximo_indice;
        $wpdb->insert( 'atividade',
            array(
                'id_acao' => $id_acao,
                'indice' => $proximo_indice,
                'form_id' => $insert_id,
            )
        );
    }
}

function insert_acao_if_not_exists($id_acao) {
    global $wpdb;

    $acao = $wpdb->get_results("SELECT * FROM acao_extensao WHERE id = '$id_acao' LIMIT 1", OBJECT);
    if (empty($acao)) {
        $wpdb->insert( 'acao_extensao', 
            array(
                'id' => $id_acao,
                'form_id' => $insert_id
            )
        );
    }
}

function converter_data($data) {
    // Divide a data em dia, mês e ano
    $partes = explode('/', $data);
    
    // Reorganiza as partes da data no formato "ano-mes-dia"
    $data_formatada = $partes[2] . '-' . $partes[1] . '-' . $partes[0];
    
    return $data_formatada;
}

function get_id_from_url_siga($url) {
    $id_index = strpos($url, "id=") + 3;
    return substr($url, $id_index, 36);
}

function atualizar_cache_siga($id) {
    global $wpdb;

    $cache = $wpdb->get_results("SELECT * FROM cache_SIGA WHERE id_acao = '$id' LIMIT 1", OBJECT );
    $acao = acao_siga($id);

    if (empty($cache)) {
        $wpdb->insert( 'cache_SIGA',
            array(
                'id_acao' => $id,
                'centro' => $acao->centro,
                'unidade' => $acao->unidade,
                'coordenador' => $acao->coordenador,
                'titulo' => $acao->titulo,
                'modalidade' => $acao->modalidade,
                'resumo' => $acao->resumo,
                'objetivos' => $acao->objetivos,
                'area_principal' => $acao->areaPrincipal,
                'area_secundaria' => $acao->areaSecundaria,
                'carga_horaria' => $acao->cargaHoraria
            )
        );
    } else {
        $wpdb->update('cache_SIGA',
            array(
                'centro' => $acao->centro,
                'unidade' => $acao->unidade,
                'coordenador' => $acao->coordenador,
                'titulo' => $acao->titulo,
                'modalidade' => $acao->modalidade,
                'resumo' => $acao->resumo,
                'objetivos' => $acao->objetivos,
                'area_principal' => $acao->areaPrincipal,
                'area_secundaria' => $acao->areaSecundaria,
                'carga_horaria' => $acao->cargaHoraria
            ),
            array(
                'id_acao' => $id
            )
        );
    }
}

function acao_siga($id) {

    $html = file_get_contents(URL_ACAO_SIGA . $id);
    preg_match('/([0-9])\d+/', $http_response_header[0], $codigoResosta);

    if (intval($codigoResosta[0]) != 200) {
        throw new ErrorException("ação não encontrada no SIGA");
    }

    preg_match('/Centro<\/label><span class="gnosys-item-visualizacao ">(.*?)<\/span>/s', $html, $centro);
    preg_match('/Unidade<\/label><span class="gnosys-item-visualizacao ">(.*?)<\/span>/s', $html, $unidade);
    preg_match('/T&iacute;tulo<\/label><span class="gnosys-item-visualizacao ">(.*?)<\/span>/s', $html, $titulo);
    preg_match('/Coordenador da A&ccedil;&atilde;o de Extens&atilde;o<\/label><span class="gnosys-item-visualizacao ">(.*?)<\/span>/s', $html, $coordenador);
    preg_match('/Modalidade<\/label><span class="gnosys-item-visualizacao ">(.*?)<\/span>/s', $html, $modalidade);
    preg_match('/Resumo<\/label><span class="gnosys-item-visualizacao ">(.*?)<\/span>/s', $html, $resumo);
    preg_match('/Contato<\/label><span class="gnosys-item-visualizacao ">(.*?)<\/span>/s', $html, $contato);
    preg_match('/Data de In&iacute;cio<\/label><span class="gnosys-item-visualizacao ">(.*?)<\/span>/s', $html, $dataInicio);
    preg_match('/Data de T&eacute;rmino<\/label><span class="gnosys-item-visualizacao ">(.*?)<\/span>/s', $html, $dataTermino);
    preg_match('/Objetivos<\/label><span class="gnosys-item-visualizacao ">(.*?)<\/span>/s', $html, $objetivos);
    preg_match('/&Aacute;rea Tem&aacute;tica Principal<\/label><span class="gnosys-item-visualizacao ">(.*?)<\/span>/s', $html, $areaPrincipal);
    preg_match('/&Aacute;rea Tem&aacute;tica Secund&aacute;ria<\/label><span class="gnosys-item-visualizacao ">(.*?)<\/span>/s', $html, $areaSecundaria);
    preg_match('/Carga Hor&aacute;ria<\/label><span class="gnosys-item-visualizacao ">(.*?)<\/span>/s', $html, $cargaHoraria);
    preg_match('/Links para Redes Sociais e Sites<\/label><span class="gnosys-item-visualizacao ">(.*?)<\/span>/s', $html, $linkRedesSociaisSites);
    preg_match('/Endere&ccedil;o<\/label><span class="gnosys-item-visualizacao ">(.*?)<\/span>/s', $html, $endereco);
    preg_match('/P&uacute;blico da A&ccedil;&atilde;o<\/label><span class="gnosys-item-visualizacao ">(.*?)<\/span>/s', $html, $publico);

    $acao = (object) [
        'id' => $id,
        'centro' => html_entity_decode($centro[1]),
        'unidade' => html_entity_decode(trim($unidade[1])),
        'coordenador' => html_entity_decode(trim($coordenador[1])),
        'titulo' => html_entity_decode($titulo[1]),
        'modalidade' => html_entity_decode($modalidade[1]),
        'resumo' => html_entity_decode($resumo[1]),
        'contato' => html_entity_decode($contato[1]),
        'dataInicio' => html_entity_decode($dataInicio[1]),
        'dataTermino' => html_entity_decode($dataTermino[1]),
        'objetivos' => html_entity_decode($objetivos[1]),
        'areaPrincipal' => html_entity_decode($areaPrincipal[1]),
        'areaSecundaria' => ($areaSecundaria[1] == "-") ? null : html_entity_decode($areaSecundaria[1]),
        'cargaHoraria' => intval($cargaHoraria[1]),
        'linkRedesSociaisSites' => html_entity_decode($linkRedesSociaisSites[1]),
        'endereco' => html_entity_decode($endereco[1]),
        'publico' => html_entity_decode($publico[1])
    ];

	if ($modalidade[1] === 'Curso') {
		preg_match('/Modalidade do Curso<\/label><span class="gnosys-item-visualizacao ">(.*?)<\/span>/', $html, $modalidadeCurso);
		$acao->modalidadeCurso = html_entity_decode($modalidadeCurso[1]);
	}

    return $acao;
}

function estrutura_horarios($form_data) {
    return array(
        "segunda" => array(
            "inicio" => $form_data['horario_inicio_horarios-Monday'],
            "fim" => $form_data['horario_fim_horarios-Monday']
        ),
        "terca" => array(
            "inicio" => $form_data['horario_inicio_horarios-Tuesday'],
            "fim" => $form_data['horario_fim_horarios-Tuesday']
        ),
        "quarta" => array(
            "inicio" => $form_data['horario_inicio_horarios-Wednesday'],
            "fim" => $form_data['horario_fim_horarios-Wednesday']
        ),
        "quinta" => array(
            "inicio" => $form_data['horario_inicio_horarios-Thursday'],
            "fim" => $form_data['horario_fim_horarios-Thursday']
        ),
        "sexta" => array(
            "inicio" => $form_data['horario_inicio_horarios-Friday'],
            "fim" => $form_data['horario_fim_horarios-Friday']
        ),
        "sabado" => array(
            "inicio" => $form_data['horario_inicio_horarios-Saturday'],
            "fim" => $form_data['horario_fim_horarios-Saturday']
        ),
        "domingo" => array(
            "inicio" => $form_data['horario_inicio_horarios-Sunday'],
            "fim" => $form_data['horario_fim_horarios-Sunday']
        )
    );
}