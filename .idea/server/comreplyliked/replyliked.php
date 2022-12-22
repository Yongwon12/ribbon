<?php
basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));

$replyliked = json_decode(file_get_contents("php://input"));

if(!$replyliked->inherentreplyid){
    sendResponse(400, [] , 'inherentreplyid Required !');
}else{

    $conn=getConnection();
    if($conn==null){
        sendResponse(500, $conn, 'Server Connection Error !');
    }elseif ($conn) {
        $sql1 = "INSERT INTO replyliked(categoryid,userid,inherentid,inherentreplyid)
         VALUES ('" . $replyliked->categoryid . "','" . $replyliked->userid . "','" . $replyliked->inherentid . "','" . $replyliked->inherentreplyid . "')";
        $result1 = mysqli_query($conn, $sql1);

        $sql2 = "update reply set likedcount = likedcount + 1 where replyid = '" . $replyliked->inherentreplyid . "'";
        $result2 = mysqli_query($conn, $sql2);

        $sql3 = "select likedcount from replyliked left join reply on replyliked.inherentreplyid=reply.replyid where inherentreplyid = '".$replyliked->inherentreplyid."'";
        $result3 = mysqli_query($conn, $sql3);

        $row = mysqli_fetch_array($result3);
        if ($result3) {
             print_r('
    {
    "likedcount" : 
        {
            "likedcount":"' . $row[0] . '"
        }
    }');

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