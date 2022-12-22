<?php
basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));

$replywrite = json_decode(file_get_contents("php://input"));

if(!$replywrite->description){
    sendResponse(400, [] , 'description Required !');
}else {

    $conn = getConnection();
    if ($conn == null) {
        sendResponse(500, $conn, 'Server Connection Error !');
    } elseif ($replywrite->categoryid) {
        $sql1 = "INSERT INTO reply(description,profileimage,writedate,userid,nickname,
                     categoryid,inherentid,inherentcommentsid)
         VALUES ('" . $replywrite->description . "','" . $replywrite->profileimage . "','"
            . $replywrite->writedate . "','" . $replywrite->userid . "','"
            . $replywrite->nickname . "','" . $replywrite->categoryid . "','" . $replywrite->inherentid . "','" . $replywrite->inherentcommentsid . "')";

        $result1 = mysqli_query($conn, $sql1);

        $sql2 = "select count(*) from reply where categoryid = 
         '" . $replywrite->categoryid . "'  AND inherentid = '" . $replywrite->inherentid . "'";

        $result2 = mysqli_query($conn, $sql2);
        $sql3 = "select replyid from reply  order by replyid desc limit 1";
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
        if ($result2) {
            sendResponse(200, $result2, 'User Registration Successful.');
        } elseif ($result3) {
            sendResponse(200, $result3, 'User Registration Successful.');
        } else {
            sendResponse(404, [], 'User not Registered');
        }
        //close connection
        $conn->close();
    }
}
?>