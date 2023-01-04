<?php

$db_host = '192.168.0.8';
$db_name = 'ribbonProject';
$db_username = 'yongwon2';
$db_password = 'Dyddnjs3401!';
try {
    $conn= new PDO("mysql:host={$db_host};dbname={$db_name}", $db_username, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $exception){
    echo "서버와 연결 실패:".$exception->getMessage()."";
}

?>