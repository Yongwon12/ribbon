<?php
basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));

$likeddelete = json_decode(file_get_contents("php://input"));

if(!$likeddelete->categoryid){
    sendResponse(400, [] , 'categoryid Required !');
}else{
    $conn=getConnection();
    if($conn==null){
        sendResponse(500, $conn, 'Server Connection Error !');
    }else{
        $sql1 = "delete from liked where categoryid='".$likeddelete->categoryid."' AND userid='".$likeddelete->userid."' AND inherentid='".$likeddelete->inherentid."'";
        $result1 = mysqli_query($conn,$sql1);

        $sql2 = "update boardwrite set likedcount = likedcount - 1 where boardid = '".$likeddelete->inherentid."'";
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