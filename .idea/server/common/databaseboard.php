<?php

$sql->execute();
if ($sql)
{
    $row = $sql->fetchall(PDO::FETCH_ASSOC);
    $json = json_encode(array("boardwrite" => $row), JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE);
    print_r($json);
}
else
{
    sendResponse(404, [], 'failed');
}
?>