<?php
basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));

$individualcommentswrite = json_decode(file_get_contents("php://input"));

if(!$individualcommentswrite->inherentid){
    sendResponse(400, [] , 'inherentid Required !');
}else {

    $conn = getConnection();
    if ($conn == null) {
        sendResponse(500, $conn, 'Server Connection Error !');
    } elseif ($individualcommentswrite->inherentid) {
        if ($individualcommentswrite->inherentid) {
            $sql4 = "update individualwrite set commentcount = commentcount + 1 where individualid = '" . $individualcommentswrite->inherentid . "'";
            mysqli_query($conn, $sql4);
        }
        $sql1 = "INSERT INTO individualcomments(description,userid,nickname,inherentid,
                     writedate,profileimage)
         VALUES ('" . $individualcommentswrite->description . "','" . $individualcommentswrite->userid . "','"
            . $individualcommentswrite->nickname . "','". $individualcommentswrite->inherentid . "','" . $individualcommentswrite->writedate . "','" . $individualcommentswrite->profileimage . "')";

        $result1 = mysqli_query($conn, $sql1);




        $sql2 = "select commentcount from individualwrite where individualid = 
         '".$individualcommentswrite->inherentid."'";

        $result2 = mysqli_query($conn,$sql2);
        $sql3 = "select individualcommentsid from individualcomments  order by individualcommentsid desc limit 1";
        $result3 = mysqli_query($conn, $sql3);
        $row2 = mysqli_fetch_array($result3);


        if ($result2) {
            while ($row1 = mysqli_fetch_array($result2)) {
                print_r('
    {
    "individualcommentcount" : 
        {
            "individualcommentcount":"' . $row1[0] . '",
        "individualcommentid":"' . $row2[0] . '"
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