<?php
$sql->bindValue(':id',$_POST->id);
$sql->execute();
$row = $sql->fetch(PDO::FETCH_ASSOC);
$json = json_encode(array("userinfo" => $row), JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE);
print_r($json);
if (!$sql) {
    sendResponse(404, [], 'failed');
}
?>