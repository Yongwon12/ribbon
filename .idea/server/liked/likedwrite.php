<?php
basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));

$_POST = json_decode(file_get_contents("php://input"));

if(!$_POST->inherentid){
    sendResponse(400, [] , 'inherentid Required !');
}else{

    if($conn==null){
        sendResponse(500, $conn, 'Server Connection Error !');
    }elseif ($conn) {
        $sql1 = $conn->prepare("INSERT INTO liked(categoryid,userid,inherentid)
         VALUES (:categoryid,:userid,:inherentid)");
        $sql1->bindValue(':categoryid', $_POST->categoryid);
        $sql1->bindValue(':userid', $_POST->userid);
        $sql1->bindValue(':inherentid', $_POST->inherentid);
        $sql1->execute();

        $sql2 = $conn->prepare("update boardwrite set likedcount = likedcount + 1 where boardid = :inherentid");
        $sql2->bindValue(':inherentid',$_POST->inherentid);
        $sql2->execute();

    }
    $sql3 = $conn->prepare("select likedcount from liked left join boardwrite on liked.inherentid=boardwrite.boardid where categoryid =:categoryid AND inherentid = :inherentid");
    $sql3->bindValue(':categoryid',$_POST->categoryid);
    $sql3->bindValue(':inherentid',$_POST->inherentid);
    $sql3->execute();

    $row3 = $sql3->fetch(PDO::FETCH_ASSOC);
    $json1 = json_encode(array("likedcount" => $row3), JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE);
    print_r($json1);
}
?>