<?php
basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));
$_POST = json_decode(file_get_contents("php://input"));

$sql = $conn->prepare("SELECT username,email,nickname,mobile,create_date,modify_date,birth,userimage,gender FROM user where id =:id");

basename(require_once('../common/mypagesdb.php'));
?>