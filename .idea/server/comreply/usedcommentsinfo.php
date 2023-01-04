<?php
basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));
basename(require_once('../common/curlfunc.php'));

$_POST = json_decode(file_get_contents("php://input"));

$sql = $conn-> prepare("select usedcomments.description,usedcomments.userid,usedcomments.nickname,categoryid,inherentid,
       usedcomments.writedate,usedcomments.profileimage,usedcomments.likedcount,usedcommentsid,isrecomment,commentcount from 
usedwrite left join usedcomments on usedcomments.inherentid = usedwrite.usedid where usedid = :inherentid");
$sql->bindValue(':inherentid',$_POST->inherentid);
$sql->execute();

#$sql2 = $conn->prepare("select commentcount from boardwrite where boardid = :inherentid");
#$sql2->bindValue(':inherentid',$_POST->inherentid);
#$result2= $sql2->execute();

#$row2 = $sql2->fetch(PDO::FETCH_ASSOC);
$row = $sql->fetchall(PDO::FETCH_ASSOC);
#   $json1 = json_encode(array("commentcount" => $row2), JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE);
#  print_r($json1);
$json2 = json_encode(array("comment" => $row), JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE);
print_r($json2)
?>