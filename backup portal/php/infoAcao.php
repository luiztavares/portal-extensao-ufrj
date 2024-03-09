<?php
    require_once('modules/acao.php');

    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");

    if (!$_GET["id"]) {
        http_response_code(400);
        echo json_encode(["erro" => "id da ação não fornecido"]);
        exit();
    }
    if (substr($_GET["id"], 0, 3) === "pr5") {
        echo json_encode((object) []);
	    exit();
	}

    echo json_encode(acao_siga($_GET["id"]));
?>
