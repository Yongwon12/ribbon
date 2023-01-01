<?php
function getConnection()
{
    $host = '192.168.219.161';
    $db_name = 'ribbonProject';
    $username = 'yongwon2';
    $password = 'Dyddnjs3401!';
    $conn= new mysqli($host, $username, $password, $db_name);
    if ($conn->connect_error) {
        $conn= null;
    }
    return $conn;
}
?>