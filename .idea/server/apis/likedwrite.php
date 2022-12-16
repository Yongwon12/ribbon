<?php
basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));

$liked = json_decode(file_get_contents("php://input"));

if(!$liked->postid){
    sendResponse(400, [] , 'postid Required !');
}else{

    $conn=getConnection();
    if($conn==null){
        sendResponse(500, $conn, 'Server Connection Error !');
    }else{
        $sql="INSERT INTO liked(categoryid,nickname,userid,inherentid)
         VALUES ('".$liked->categoryid."','".$liked->nickname."','".$liked->userid."','".$liked->inherentid."')";

        $result = $conn->query($sql); //$result = true/false on success or error respectively.
        if ($result) {
            sendResponse(200, $result , 'User Registration Successful.');
        } else {
            sendResponse(404, [] ,'User not Registered');
        }
        //close connection
        $conn->close();
    }
}
?>