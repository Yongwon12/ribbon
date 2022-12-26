<?php
basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));

$groupreplywrite = json_decode(file_get_contents("php://input"));
if(!$groupreplywrite->inherentid){
    sendResponse(400, [] , 'inherentid Required !');
}else {

    $conn = getConnection();
    if ($conn == null) {
        sendResponse(500, $conn, 'Server Connection Error !');
    } elseif ($groupreplywrite->inherentid) {
        if ($groupreplywrite->inherentid) {
            $sql4 = "update groupwrite set commentcount = commentcount + 1 where groupid = '" . $groupreplywrite->inherentid . "'";
            mysqli_query($conn, $sql4);
        }

        $sql1 = "INSERT INTO groupreply(description,profileimage,writedate,userid,nickname,
                     inherentid,inherentcommentsid)
         VALUES ('" . $groupreplywrite->description . "','" . $groupreplywrite->profileimage . "','"
            . $groupreplywrite->writedate . "','" . $groupreplywrite->userid . "','"
            . $groupreplywrite->nickname . "','" . $groupreplywrite->categoryid . "','" . $groupreplywrite->inherentid . "','" . $groupreplywrite->inherentcommentsid . "')";
        $result1 = mysqli_query($conn, $sql1);




        $sql2 = "select commentcount from groupwrite where groupid = 
         '" . $groupreplywrite->inherentid . "'";

        $result2 = mysqli_query($conn, $sql2);
        $sql3 = "select groupreplyid from groupreply  order by groupreplyid desc limit 1";
        $result3 = mysqli_query($conn, $sql3);
        $row2 = mysqli_fetch_array($result3);


        if ($result2) {
            while ($row1 = mysqli_fetch_array($result2)) {
                print_r('
    {
    "replycount" : 
        {
            "replycount":"' . $row1[0] . '",
        "replyid":"' . $row2[0] . '"
        }
    }');
            }
        }



        if ($result1) {
            sendResponse(200, $result1, 'User Registration Successful.');
        }
        elseif ($result2) {
            sendResponse(200, $result2, 'User Registration Successful.');
        }elseif ($result3) {
            sendResponse(200, $result3, 'User Registration Successful.');
        }else {
            sendResponse(404, [], 'User not Registered');
        }
        //close connection
        $conn->close();
    }




}
?>