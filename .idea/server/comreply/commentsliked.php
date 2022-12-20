<?php
basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));

$commentsliked = json_decode(file_get_contents("php://input"));

if(!$commentsliked->inherentcommentsid){
    sendResponse(400, [] , 'inherentcommentsid Required !');
}else{

    $conn=getConnection();
    if($conn==null){
        sendResponse(500, $conn, 'Server Connection Error !');
    }elseif ($conn) {
        $sql1 = "INSERT INTO commentsliked(categoryid,userid,inherentid,inherentcommentsid)
         VALUES ('" . $commentsliked->categoryid . "','" . $commentsliked->userid . "','" . $commentsliked->inherentid . "','" . $commentsliked->inherentcommentsid . "')";
        $result1 = mysqli_query($conn, $sql1);

        $sql2 = "update comments set likedcount = likedcount + 1 where commentsid = '" . $commentsliked->inherentcommentsid . "'";
        $result2 = mysqli_query($conn, $sql2);

        $sql3 = "select likedcount from commentsliked left join comments on commentsliked.inherentcommentsid=comments.commentsid where inherentcommentsid = '".$commentsliked->inherentcommentsid."'";
        $result3 = mysqli_query($conn, $sql3);
        $data = array();
        $row = mysqli_fetch_array($result3);
        if ($result3) {
            array_push($data, print_r('
    {
    "likedcount" : 
        {
            "likedcount":"' . $row[0] . '"
        }
    }'));

        }


        if ($result1) {
            sendResponse(200, $result1, 'User Registration Successful.');
        } elseif ($result2) {
            sendResponse(200, $result2, 'User Registration Successful.');
        } elseif ($result3) {
            sendResponse(200, $result3, 'User Registration Successful.');
        }

    }
}
?>