<?php
include('../Config.php');
$config = new Config();

$given_num = 0;
$sql = "SELECT * FROM attempts";
$attempts =  $config->pdo->query($sql)->fetchAll();

if($attempts){

    foreach ($attempts as $key => $attempt) {
            if($attempt['status'] == 1){
                $given_num++;
            }
    }
}
$data['given_num'] = $given_num;
$data['total'] = sizeof($attempts);
echo json_encode($data);

?>