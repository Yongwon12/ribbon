<?php

basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));

$_POST = json_decode(file_get_contents("php://input"));

$sql3 = $conn->prepare("select likedcount from usedliked left join usedwrite on usedliked.inherentid=usedwrite.usedid where categoryid = :categoryid AND inherentid = :inherentid");
$sql3->bindValue(':categoryid',$_POST->categoryid);
$sql3->bindValue(':inherentid',$_POST->inherentid);
$sql3->execute();
$row3 = $sql3->fetch(PDO::FETCH_ASSOC);
$json1 = json_encode(array("likedcount" => $row3), JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE);
print_r($json1);

?>