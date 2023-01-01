<?php

basename(include_once('../common/header.php'));
basename(include_once('../common/response.php'));
basename(include_once('../common/encipher.php'));

require_once('../common/databasetest.php');
$_POST = json_decode(file_get_contents("php://input"));

$sql = $conn->prepare("select username from user where id = :id");
$sql->bindValue(':id',$_POST->id);
$sql->execute();
$result = $sql->fetch(PDO::FETCH_ASSOC);
$data = json_encode($result);
print_r($data);


?>트