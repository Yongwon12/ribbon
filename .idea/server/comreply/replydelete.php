<?php
basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));

$replydelete = json_decode(file_get_contents("php://input"));

if(!$replydelete->commentsid){
    sendResponse(400, [] , 'categoryid Required !');
}else{
    $conn=getConnection();
    if($conn==null){
        sendResponse(500, $conn, 'Server Connection Error !');
    }else{
        $sql1 = "delete from reply where replyid='".$replydelete->replyid."'";
        $result1 = mysqli_query($conn,$sql1);

    }

    if ($result1) {
        sendResponse(200, $result1 , 'User Registration Successful.');
    } elseif($result2) {
        sendResponse(200, $result2 , 'User Registration Successful.');
    }

    else{
        sendResponse(404, [] ,'User not Registered');
    }

    $conn->close();

}
?>