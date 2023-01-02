<?php
basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));

$_POST = json_decode(file_get_contents("php://input"));

if(!$_POST->inherentid){
    sendResponse(400, [] , 'inherentid Required !');
}else {

    if ($conn == null) {
        sendResponse(500, $conn, 'Server Connection Error !');
    } elseif ($_POST->inherentid) {
        if ($_POST->inherentid) {
            $sql4 = $conn->prepare("update boardwrite set commentcount = commentcount + 1 where boardid = :inherentid");
            $sql4->bindValue(':inherentid',$_POST->inherentid);
            $sql4->execute();
        }

        $sql1 = $conn->prepare("INSERT INTO reply(description,profileimage,writedate,userid,nickname,
                     categoryid,inherentid,inherentcommentsid)
         VALUES (:description,:profileimage,:writedate,:userid,:nickname,:categoryid,:inherentid,:inherentcommentsid)");
        $sql1->bindValue(':description', $_POST->description);
        $sql1->bindValue(':profileimage', $_POST->profileimage);
        $sql1->bindValue(':writedate', $_POST->writedate);
        $sql1->bindValue(':userid', $_POST->userid);
        $sql1->bindValue(':nickname', $_POST->nickname);
        $sql1->bindValue(':categoryid', $_POST->categoryid);
        $sql1->bindValue(':inherentid', $_POST->inherentid);
        $sql1->bindValue(':inherentcommentsid', $_POST->inherentcommentsid);
        $sql1->execute();



        $sql2 =$conn->prepare("select commentcount from boardwrite where boardid = :inherentid");
        $sql2->bindValue(':inherentid',$_POST->inherentid);
        $sql2->execute();

        $sql3 = $conn->prepare("select replyid from reply  order by replyid desc limit 1");
        $sql3->execute();
        $row3 = $sql3->fetch(PDO::FETCH_ASSOC);
        $row2 = $sql2->fetch(PDO::FETCH_ASSOC);
        $data = array();

        $json2 = json_encode(array('replycount'=>$row2), JSON_UNESCAPED_UNICODE, JSON_PRETTY_PRINT);
        print_r($json2);
        print_r(',');
        $json3 = json_encode(array('replyid'=>$row3), JSON_UNESCAPED_UNICODE, JSON_PRETTY_PRINT);
        print_r($json3);

    }if(!$sql3) {
        sendResponse(404, [], 'User not Registered');
    }



}
?>