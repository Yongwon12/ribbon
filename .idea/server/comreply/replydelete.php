<?php
basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));

$_POST = json_decode(file_get_contents("php://input"));

if(!$_POST->replyid){
    sendResponse(400, [] , 'replyid Required !');
}else{

    if($conn==null){
        sendResponse(500, $conn, 'Server Connection Error !');
    }else{
        $sql1 = $conn->prepare("delete from reply where replyid=:replyid");
        $sql1->bindValue(':replyid',$_POST->replyid);
        $result1 = $sql1->execute();
        $sql4 = $conn->prepare("update boardwrite set commentcount = commentcount - 1 where boardid = :inherentid");
        $sql4->bindValue(':inherentid',$_POST->inherentid);
        $sql4->execute();
    }

    if ($result1) {
        sendResponse(200, $result1 , 'User Registration Successful.');
    } elseif($result2) {
        sendResponse(200, $result2 , 'User Registration Successful.');
    }

    else{
        sendResponse(404, [] ,'User not Registered');
    }


}
?>