<?php

basename(include_once('../common/header.php'));
basename(include_once('../common/response.php'));
basename(include_once('../common/encipher.php'));

require_once('../common/databasetest.php');
$_POST = json_decode(file_get_contents("php://input"));

$sql = $conn->prepare("insert into test(description,id)
values(:description,:id)");
$sql->bindValue(':description:id',$_POST->description,$_POST->id);
$sql->execute();
#$result = $sql->fetch(PDO::FETCH_ASSOC);
#$data = json_encode($result);
#print_r($data);


?>