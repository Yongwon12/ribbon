<?php
basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));

$usedreplywrite = json_decode(file_get_contents("php://input"));
if(!$usedreplywrite->inherentid){
    sendResponse(400, [] , 'inherentid Required !');
}else {

    $conn = getConnection();
    if ($conn == null) {
        sendResponse(500, $conn, 'Server Connection Error !');
    } elseif ($usedreplywrite->inherentid) {
        if ($usedreplywrite->inherentid) {
            $sql4 = "update usedwrite set commentcount = commentcount + 1 where usedid = '" . $usedreplywrite->inherentid . "'";
            mysqli_query($conn, $sql4);
        }

        $sql1 = "INSERT INTO usedreply(description,profileimage,writedate,userid,nickname,
                     inherentid,inherentcommentsid)
         VALUES ('" . $usedreplywrite->description . "','" . $usedreplywrite->profileimage . "','"
            . $usedreplywrite->writedate . "','" . $usedreplywrite->userid . "','"
            . $usedreplywrite->nickname . "','" . $usedreplywrite->categoryid . "','" . $usedreplywrite->inherentid . "','" . $usedreplywrite->inherentcommentsid . "')";
        $result1 = mysqli_query($conn, $sql1);




        $sql2 = "select commentcount from usedwrite where usedid = 
         '" . $usedreplywrite->inherentid . "'";

        $result2 = mysqli_query($conn, $sql2);
        $sql3 = "select usedreplyid from usedreply  order by usedreplyid desc limit 1";
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