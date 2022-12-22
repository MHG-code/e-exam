<?php
include('../Config.php');
$config = new Config();

$sql = "SELECT * FROM question";
$data=  $config->pdo->query($sql)->fetchAll();

echo json_encode (array_slice($data,0,1));

?>