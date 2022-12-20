<?php
basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));

$commentslikeddelete = json_decode(file_get_contents("php://input"));

if(!$commentslikeddelete->categoryid){
    sendResponse(400, [] , 'categoryid Required !');
}else{
    $conn=getConnection();
    if($conn==null){
        sendResponse(500, $conn, 'Server Connection Error !');
    }else{
        $sql1 = "delete from commentsliked where categoryid='".$commentslikeddelete->categoryid."' AND userid='".$commentslikeddelete->userid."' 
        AND inherentid='".$commentslikeddelete->inherentid."' AND inherentcommentsid='".$commentslikeddelete->inherentcommentsid."'";
        $result1 = mysqli_query($conn,$sql1);

        $sql2 = "update comments set likedcount = likedcount - 1 where commentsid = '".$commentslikeddelete->inherentcommentsid."'";
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