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

$result = $mysqli->query("SELECT a.id_acao, f.form_value FROM atividade a LEFT JOIN wp_db7_forms f ON a.form_id = f.form_id;");

$atividades = array();

while ($obj = $result->fetch_object()) {
    $atividade = (object) array_merge((array) $obj, (array) unserialize($obj->form_value));
    unset($atividade->form_value);
    $atividades[] = $atividade;
}

echo json_encode($atividades);
?>