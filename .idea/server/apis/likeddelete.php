<?php
basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));

$likeddelete = json_decode(file_get_contents("php://input"));

if(!$likeddelete->likedid){
    sendResponse(400, [] , 'postid Required !');
}else{
    $conn=getConnection();
    if($conn==null){
        sendResponse(500, $conn, 'Server Connection Error !');
    }else{
        $sql = "delete from liked where likedid=$likeddelete->likedid";

        $result = $conn->query($sql); //$result = true/false on success or error respectively.
        if ($result) {
            sendResponse(200, $result , 'User Registration Successful.');
        } else {
            sendResponse(404, [] ,'User not Registered');
        }

        $conn->close();
    }
}
?>