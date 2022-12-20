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
                     categoryid,inherentid)
         VALUES ('" . $replywrite->description . "','" . $replywrite->profileimage . "','"
            . $replywrite->writedate . "','" . $replywrite->userid . "','"
            . $replywrite->nickname . "','" . $replywrite->categoryid . "','" . $replywrite->inherentid . "')";

        $result1 = mysqli_query($conn, $sql1);

        $sql2 = "select count(*) from reply where categoryid = 
         '".$replywrite->categoryid."'  AND inherentid = '".$replywrite->inherentid."'";

        $result2 = mysqli_query($conn,$sql2);
        $data = array();
        if ($result2) {
            while ($row = mysqli_fetch_array($result2)) {
                // or select*from 테이블 where id = 3 and userid = 3 이런식으로 불러오기 + 배열형식
                array_push($data, print_r('
    {
    "replycount" : 
        {
            "replycount":"' . $row[0] . '"
        }
    }'));
            }
        }
        if ($result1) {
            sendResponse(200, $result1, 'User Registration Successful.');
        } else {
            sendResponse(404, [], 'User not Registered');
        }
        //close connection
        $conn->close();
    }
}
?>