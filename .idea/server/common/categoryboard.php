<?php


$sql = $conn->prepare("select boardid,userid,category.id,title,description,img,writedate,profileimage,nickname,likedcount,commentcount from boardwrite left join category on boardwrite.id = category.id where category.id = $i");
$sql->execute();
$row = $sql->fetchall(PDO::FETCH_ASSOC);
$json = json_encode(array("boardwrite$i" => $row), JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE);



?>