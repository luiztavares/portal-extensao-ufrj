<?php
require_once("env.php");

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$mysqli->set_charset(DB_CHARSET);

$form_id = isset( $_GET['ufid'] ) ? (int) $_GET['ufid'] : 0;

$result = $mysqli->query("SELECT form_value FROM wp_db7_forms WHERE form_id = $form_id LIMIT 1");

// Seu objeto serializado
$serializedObject = $result->fetch_row()[0];

// Deserializar o objeto
$phpArray = unserialize($serializedObject);

// Exibir o array resultante
print_r($phpArray);

// Acessar valores específicos
echo "Status: " . $phpArray['cfdb7_status'] . PHP_EOL;
echo "Nome: " . $phpArray['nome_curto'] . PHP_EOL;
echo "Email: " . $phpArray['email'] . PHP_EOL;
echo "db: " . DB_NAME . PHP_EOL;

?>