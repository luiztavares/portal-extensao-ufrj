<?php
    header("Content-Type: application/json");
    header('Access-Control-Allow-Origin: *');

    header('Access-Control-Allow-Methods: GET, POST');
    
    header("Access-Control-Allow-Headers: X-Requested-With");
    if (!$_GET["url"]) {
        http_response_code(400);
        echo json_encode(["erro" => "noUrl"]);
        exit();
    }
    $json = file_get_contents($_GET["url"]);

    echo $json;
?>