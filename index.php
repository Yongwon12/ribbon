<?php
function getConnection()
{
    $host = 'yongwon12.github.io';
    $db_name = 'ribbonProject';
    $username = 'yongwon2';
    $password = 'Dyddnjs3401!';
    $conn= new mysqli($host, $username, $password, $db_name);
    if ($conn->connect_error) {
        $conn= null;
    }
    return $conn;
}
function doEncrypt($plain_text){
    //Note : This algorithm and function is for demo you can use by your own logic, salt and algorithm.
    return hash('sha256', $plain_text);
}
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
function sendResponse($resp_code,$data,$message){
    echo json_encode(array('code'=>$resp_code,'message'=>$message,'data'=>$data));
}

$liked = json_decode(file_get_contents("php://input"));

if(!$liked->postid){
    sendResponse(400, [] , 'postid Required !');
}else{

    $conn=getConnection();
    if($conn==null){
        sendResponse(500, $conn, 'Server Connection Error !');
    }else{
        $sql="INSERT INTO liked(postid,nickname,userid)
         VALUES ('".$liked->postid."','".$liked->nickname."','".$liked->userid."')";

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