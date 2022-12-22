<?php
include('../Config.php');
$config = new Config();
extract($_POST);

$sql = "SELECT ans FROM question WHERE q_id  = $q_id ";
$data=  $config->pdo->query($sql)->fetch();

$sql = "SELECT attempt_id FROM attempts WHERE question_id  = $q_id ";
$attempt=  $config->pdo->query($sql)->fetch();

if(!$attempt){

    if($data['ans'] == $ans){
        $status = 1;
    }
    else{
        $status = 0;
    }
    $sql = "INSERT INTO attempts(question_id, status) VALUES($q_id, $status) ";
    $config->pdo->query($sql)->fetch();
}
echo 'done';

?>