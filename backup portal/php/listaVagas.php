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

$result = $mysqli->query("SELECT av.id_acao, f.form_value FROM anuncio_vaga av LEFT JOIN wp_db7_forms f ON av.form_id = f.form_id;");

$vagas = array();

while ($obj = $result->fetch_object()) {
    $vaga = (object) array_merge((array) $obj, (array) unserialize($obj->form_value));
    unset($vaga->form_value);
    $vagas[] = $vaga;
}

echo json_encode($vagas);
?>