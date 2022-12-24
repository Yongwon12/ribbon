<?php
basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));

$groupcommentswrite = json_decode(file_get_contents("php://input"));

if(!$groupcommentswrite->inherentid){
    sendResponse(400, [] , 'inherentid Required !');
}else {

    $conn = getConnection();
    if ($conn == null) {
        sendResponse(500, $conn, 'Server Connection Error !');
    } elseif ($groupcommentswrite->inherentid) {
        if ($groupcommentswrite->inherentid) {
            $sql4 = "update groupwrite set commentcount = commentcount + 1 where groupid = '" . $groupcommentswrite->inherentid . "'";
            mysqli_query($conn, $sql4);
        }
        $sql1 = "INSERT INTO groupcomments(description,userid,nickname,inherentid,
                     writedate,profileimage)
         VALUES ('" . $groupcommentswrite->description . "','" . $groupcommentswrite->userid . "','"
            . $groupcommentswrite->nickname . "','" . $groupcommentswrite->inherentid . "','"
            . $groupcommentswrite->writedate . "','" . $groupcommentswrite->profileimage . "')";

        $result1 = mysqli_query($conn, $sql1);




        $sql2 = "select commentcount from groupwrite where groupid = 
         '".$groupcommentswrite->inherentid."'";

        $result2 = mysqli_query($conn,$sql2);
        $sql3 = "select groupcommentsid from groupcomments  order by groupcommentsid desc limit 1";
        $result3 = mysqli_query($conn, $sql3);
        $row2 = mysqli_fetch_array($result3);


        if ($result2) {
            while ($row1 = mysqli_fetch_array($result2)) {
                print_r('
    {
    "groupcommentcount" : 
        {
            "groupcommentcount":"' . $row1[0] . '",
        "groupcommentid":"' . $row2[0] . '"
        }
    }');
            }
        }




        if ($result1) {
            sendResponse(200, $result1, 'User Registration Successful.');
        }
        elseif ($result2) {
            sendResponse(200, $result2, 'User Registration Successful.');
        }
        elseif ($result3) {
            sendResponse(200, $result3, 'User Registration Successful.');
        }else {
            sendResponse(404, [], 'User not Registered');
        }
        //close connection
        $conn->close();
    }





}
?>