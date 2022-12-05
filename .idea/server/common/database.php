<?php
function getConnection()
{
    $host = '172.30.1.24';
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