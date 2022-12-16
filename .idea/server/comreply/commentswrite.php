<?php
basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));

$commentswrite = json_decode(file_get_contents("php://input"));

if(!$commentswrite->description){
    sendResponse(400, [] , 'description Required !');
}else{

    $conn=getConnection();
    if($conn==null){
        sendResponse(500, $conn, 'Server Connection Error !');
    }elseif(!$commentswrite->commentsid){
        $sql1="INSERT INTO comments(description,userid,nickname,categoryid,inherentid)
         VALUES ('".$commentswrite->description."','".$commentswrite->userid."','"
            .$commentswrite->nickname."','".$commentswrite->categoryid."','"
            .$commentswrite->inherentid."')";

        $result1 = mysqli_query($conn, $sql1);
        if ($result1) {
            sendResponse(200, $result1 , 'User Registration Successful.');
        } else {
            sendResponse(404, [] ,'User not Registered');
        }
        //close connection
        $conn->close();
    } elseif ($commentswrite->commentsid) {

        $sql2 = "update comments set description='".$commentswrite->description."' where commentsid='".$commentswrite->commentsid."'";
        $result2 = mysqli_query($conn, $sql2);
        if ($result2) {
            sendResponse(200, $result2 , 'User Registration Successful.');
        } else {
            sendResponse(404, [] ,'User not Registered');
        }
    }
}
?>