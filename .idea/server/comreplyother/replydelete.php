<?php
basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));

$replylikeddelete = json_decode(file_get_contents("php://input"));

if(!$replylikeddelete->categoryid){
    sendResponse(400, [] , 'categoryid Required !');
}else{
    $conn=getConnection();
    if($conn==null){
        sendResponse(500, $conn, 'Server Connection Error !');
    }else{
        $sql1 = "delete from commentsliked where categoryid='".$replylikeddelete->categoryid."' AND userid='".$replylikeddelete->userid."' 
        AND inherentid='".$replylikeddelete->inherentid."' AND inherentcommentsid='".$replylikeddelete->inherentreplyid."'";
        $result1 = mysqli_query($conn,$sql1);

        $sql2 = "update reply set likedcount = likedcount - 1 where replyid = '".$replylikeddelete->inherentreplyid."'";
        $result2 = mysqli_query($conn, $sql2);

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