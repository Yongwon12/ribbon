<?php
basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));

$commentswrite = json_decode(file_get_contents("php://input"));

if(!$commentswrite->description){
    sendResponse(400, [] , 'description Required !');
}else {

    $conn = getConnection();
    if ($conn == null) {
        sendResponse(500, $conn, 'Server Connection Error !');
    } elseif ($commentswrite->categoryid) {
        $sql1 = "INSERT INTO comments(description,userid,nickname,categoryid,inherentid,
                     writedate,profileimage)
         VALUES ('" . $commentswrite->description . "','" . $commentswrite->userid . "','"
            . $commentswrite->nickname . "','" . $commentswrite->categoryid . "','"
            . $commentswrite->inherentid . "','" . $commentswrite->writedate . "','" . $commentswrite->profileimage . "')";

        $result1 = mysqli_query($conn, $sql1);

        $sql2 = "select count(*) from comments where categoryid = 
         '".$commentswrite->categoryid."'  AND inherentid = '".$commentswrite->inherentid."'";

        $result2 = mysqli_query($conn,$sql2);
        $data = array();
        if ($result2) {
            while ($row = mysqli_fetch_array($result2)) {
                // or select*from 테이블 where id = 3 and userid = 3 이런식으로 불러오기 + 배열형식
                array_push($data, print_r('
    {
    "commentcount" : 
        {
            "commentcount":"' . $row[0] . '"
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