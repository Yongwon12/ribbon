<?php
basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));
basename(require_once('../common/curlfunc.php'));

$_POST = json_decode(file_get_contents("php://input"));

if(!$_POST->inherentid){
    sendResponse(400, [] , 'inherentid Required !');
}else {

    if ($conn == null) {
        sendResponse(500, $conn, 'Server Connection Error !');
    } elseif ($_POST->inherentid) {
        if ($_POST->inherentid) {
            $sql4 = $conn->prepare("update groupwrite set commentcount = commentcount + 1 where groupid = :inherentid");
            $sql4->bindValue(':inherentid',$_POST->inherentid);
            $sql4->execute();
        }

        $sql1 = $conn->prepare("INSERT INTO groupcomments(description,userid,nickname,inherentid,
                     writedate,profileimage)
         VALUES (:description,:userid,:nickname,:inherentid,:writedate,:profileimage)");
        $sql1->bindValue(':description', $_POST->description);
        $sql1->bindValue(':userid', $_POST->userid);
        $sql1->bindValue(':nickname', $_POST->nickname);
        $sql1->bindValue(':inherentid', $_POST->inherentid);
        $sql1->bindValue(':writedate', $_POST->writedate);
        $sql1->bindValue(':profileimage', $_POST->profileimage);
        $sql1->execute();



        $sql2 =$conn->prepare("select commentcount,groupcommentsid from 
        groupwrite left join groupcomments on groupwrite.groupid =
        groupcomments.inherentid where groupid = :inherentid order by groupcommentsid desc limit 1;");
        $sql2->bindValue(':inherentid',$_POST->inherentid);
        $sql2->execute();

        #$sql3 = $conn->prepare("select commentsid from comments  order by commentsid desc limit 1");
        #$sql3->execute();
        #$row3 = $sql3->fetch(PDO::FETCH_ASSOC);
        $row2 = $sql2->fetch(PDO::FETCH_ASSOC);
        $json2 = json_encode(array('commentcount'=>$row2), JSON_UNESCAPED_UNICODE, JSON_PRETTY_PRINT);
        print_r($json2);
        # print_r(',');
        # $json3 = json_encode(array('commentsid'=>$row3), JSON_UNESCAPED_UNICODE, JSON_PRETTY_PRINT);
        # print_r($json3);

    }if(!$sql3) {
        sendResponse(404, [], 'failed');
    }



}
?>