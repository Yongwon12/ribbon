<?php
basename(include_once('../common/encipher.php'));
basename(include_once('../common/include.php'));
$_POST = json_decode(file_get_contents("php://input"));
if (!$_POST->id) {
    sendResponse(400, [], 'not id');
} elseif($_POST->id) {
    $sql = $conn->prepare("update user set nickname = :nickname,userimage = :userimage,modify_date = :modify_date,bestcategory = :bestcategory,shortinfo = :shortinfo where id = :id");
    $sql->bindValue(':nickname',$_POST->nickname);
    $sql->bindValue(':userimage',$_POST->userimage);
    $sql->bindValue(':modify_date',$_POST->modify_date);
    $sql->bindValue(':bestcategory',$_POST->bestcategory);
    $sql->bindValue(':shortinfo',$_POST->shortinfo);
    $sql->bindValue(':id',$_POST->id);
    $sql->execute();
}
if (!$sql) {
    sendResponse(404, [], 'failed');
}

?>