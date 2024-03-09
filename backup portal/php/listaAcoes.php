<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once("env.php");

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$mysqli->set_charset(DB_CHARSET);

$result = $mysqli->query("SELECT * FROM anuncio_acao");

$acoes = array();

while ($acao = $result->fetch_object()) {
    $acoes[] = $acao;
}

echo json_encode($acoes);
?>