<?php
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");

    if (!$_GET["id"]) {
        http_response_code(400);
        echo json_encode(["erro" => "id da ação não fornecido"]);
        exit();
    }

    const URL_ACAO_SIGA = "https://portal.ufrj.br/Inscricao/extensao/acaoExtensao/acao?id=";

    $html = file_get_contents(URL_ACAO_SIGA . $_GET["id"]);
    preg_match('/([0-9])\d+/', $http_response_header[0], $codigoResosta);

    if (intval($codigoResosta[0]) != 200) {
        http_response_code(422);
        echo json_encode(["erro" => "ação não encontrada no SIGA"]);
        exit();
    }

    preg_match('/Centro<\/label><span class="gnosys-item-visualizacao ">([^<]*)<\/span>/', $html, $centro);
    preg_match('/Unidade<\/label><span class="gnosys-item-visualizacao ">([^<]*)<\/span>/', $html, $unidade);
    preg_match('/T&iacute;tulo<\/label><span class="gnosys-item-visualizacao ">([^<]*)<\/span>/', $html, $titulo);
    preg_match('/Coordenador da A&ccedil;&atilde;o de Extens&atilde;o<\/label><span class="gnosys-item-visualizacao ">([^<]*)<\/span>/', $html, $coordenador);
    preg_match('/Modalidade<\/label><span class="gnosys-item-visualizacao ">([^<]*)<\/span>/', $html, $modalidade);
    preg_match('/Resumo<\/label><span class="gnosys-item-visualizacao ">([^<]*)<\/span>/', $html, $resumo);
    preg_match('/Objetivos<\/label><span class="gnosys-item-visualizacao ">([^<]*)<\/span>/', $html, $objetivos);
    preg_match('/&Aacute;rea Tem&aacute;tica Principal<\/label><span class="gnosys-item-visualizacao ">([^<]*)<\/span>/', $html, $areaPrincipal);
    preg_match('/&Aacute;rea Tem&aacute;tica Secund&aacute;ria<\/label><span class="gnosys-item-visualizacao ">([^<]*)<\/span>/', $html, $areaSecundaria);
    preg_match('/Carga Hor&aacute;ria<\/label><span class="gnosys-item-visualizacao ">([^<]*)<\/span>/', $html, $cargaHoraria);

    $acao = (object) [
        'centro' => html_entity_decode($centro[1]),
        'unidade' => html_entity_decode(trim($unidade[1])),
        'coordenador' => html_entity_decode(trim($coordenador[1])),
        'titulo' => html_entity_decode($titulo[1]),
        'modalidade' => html_entity_decode($modalidade[1]),
        'resumo' => html_entity_decode($resumo[1]),
        'objetivos' => html_entity_decode($objetivos[1]),
        'areaPrincipal' => html_entity_decode($areaPrincipal[1]),
        'areaSecundaria' => ($areaSecundaria[1] == "-") ? null : html_entity_decode($areaSecundaria[1]),
        'cargaHoraria' => intval($cargaHoraria[1])
    ];

    echo json_encode($acao);
?>
