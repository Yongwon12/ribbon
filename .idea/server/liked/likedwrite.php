<?php
basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));

$liked = json_decode(file_get_contents("php://input"));

if(!$liked->inherentid){
    sendResponse(400, [] , 'inherentid Required !');
}else{

    $conn=getConnection();
    if($conn==null){
        sendResponse(500, $conn, 'Server Connection Error !');
    }elseif ($conn) {
        $sql1 = "INSERT INTO liked(categoryid,userid,inherentid)
         VALUES ('" . $liked->categoryid . "','" . $liked->userid . "','" . $liked->inherentid . "')";
        $result1 = mysqli_query($conn, $sql1);

        $sql2 = "update boardwrite set likedcount = likedcount + 1 where boardid = '" . $liked->inherentid . "'";
        $result2 = mysqli_query($conn, $sql2);

        $sql3 = "select likedcount from liked left join boardwrite on liked.inherentid=boardwrite.boardid where categoryid = '" . $liked->categoryid . "' AND inherentid = '" . $liked->inherentid . "'";
        $result3 = mysqli_query($conn, $sql3);$data = array();
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