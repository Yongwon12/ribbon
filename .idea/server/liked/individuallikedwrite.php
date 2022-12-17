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
        $sql1 = "INSERT INTO individualliked(inherentid,userid,categoryid)
         VALUES ('" . $liked->inherentid . "','" . $liked->userid . "','" . $liked->categoryid . "')";
        $result1 = mysqli_query($conn, $sql1);

        $sql2 = "update individualwrite set likedcount = likedcount + 1 where individualid = '" . $liked->inherentid . "'";
        $result2 = mysqli_query($conn, $sql2);

        $sql3 = "select *from individualliked";
        $result3 = mysqli_query($conn, $sql3);
        $data = array();
        while ($row = mysqli_fetch_array($result3)) {
            array_push($data, array('inherentid' => $row[0], 'userid' => $row[1], 'categoryid' => $row[2]));

        }
        $json = json_encode(array("likedinfo" => $data), JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE);
        echo $json;
    }


        if ($result1) {
            sendResponse(200, $result1 , 'User Registration Successful.');
        } elseif($result2) {
            sendResponse(200, $result2 , 'User Registration Successful.');
        }elseif($result3) {
            sendResponse(200, $result3 , 'User Registration Successful.');
        }

        //close connection
        $conn->close();



}
?>