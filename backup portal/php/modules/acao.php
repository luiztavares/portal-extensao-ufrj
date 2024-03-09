<?php

require_once("env.php");

const URL_ACAO_SIGA = "https://portal.ufrj.br/Inscricao/extensao/acaoExtensao/acao?id=";

function acao_siga($id) {

    $html = file_get_contents(URL_ACAO_SIGA . $id);
    preg_match('/([0-9])\d+/', $http_response_header[0], $codigoResosta);

    if (intval($codigoResosta[0]) != 200) {
        http_response_code(422);
        echo json_encode(["erro" => "ação não encontrada no SIGA"]);
        exit();
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

?>