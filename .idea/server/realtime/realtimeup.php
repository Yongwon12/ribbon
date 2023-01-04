<?php
basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));
$sql = $conn->prepare("select * from boardwrite where likedcount = (select max(likedcount) from boardwrite) order by boardid desc limit 1");
$sql->execute();
$row = $sql->fetchall(PDO::FETCH_ASSOC);
$json = json_encode(array("bestwrite" => $row), JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE);
echo $json;
if(!$sql){
    sendResponse(404, [], 'error!');
}
?>