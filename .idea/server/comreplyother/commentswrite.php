<?php
basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));

$commentswrite = json_decode(file_get_contents("php://input"));

if(!$commentswrite->inherentid){
    sendResponse(400, [] , 'inherentid Required !');
}else {

    $conn = getConnection();
    if ($conn == null) {
        sendResponse(500, $conn, 'Server Connection Error !');
    } elseif ($commentswrite->inherentid) {
        if ($commentswrite->inherentid) {
            $sql4 = "update boardwrite set commentcount = commentcount + 1 where boardid = '" . $commentswrite->inherentid . "'";
            mysqli_query($conn, $sql4);
        }
        $sql1 = "INSERT INTO comments(description,userid,nickname,categoryid,inherentid,
                     writedate,profileimage)
         VALUES ('" . $commentswrite->description . "','" . $commentswrite->userid . "','"
            . $commentswrite->nickname . "','" . $commentswrite->categoryid . "','"
            . $commentswrite->inherentid . "','" . $commentswrite->writedate . "','" . $commentswrite->profileimage . "')";

        $result1 = mysqli_query($conn, $sql1);




        $sql2 = "select count(*) from comments where categoryid = 
         '".$commentswrite->categoryid."'  AND inherentid = '".$commentswrite->inherentid."'";

        $result2 = mysqli_query($conn,$sql2);
        $sql3 = "select commentsid from comments  order by commentsid desc limit 1";
        $result3 = mysqli_query($conn, $sql3);
        $row2 = mysqli_fetch_array($result3);


        if ($result2) {
            while ($row1 = mysqli_fetch_array($result2)) {
                print_r('
    {
    "commentcount" : 
        {
            "commentcount":"' . $row1[0] . '",
        "commentsid":"' . $row2[0] . '"
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