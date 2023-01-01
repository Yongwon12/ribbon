<?php
basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));

$_POST = json_decode(file_get_contents("php://input"));
if(!$_POST->username){
    sendResponse(400, [] , 'Name Required !');
}else if(!$_POST->email){
    sendResponse(400, [] , 'Email Required !');
}else if(!$_POST->password){
    sendResponse(400, [] , 'password Required !');
}else {
    $password = doEncrypt($_POST->password);
    $conn = getConnection();
    if ($conn == null) {
        sendResponse(500, $conn, 'Server Connection Error !');
    } elseif ($conn) {
         $sql = "INSERT INTO user(username,password,email,nickname,
                 mobile,create_date,modify_date,birth,userimage,gender,bestcategory,shortinfo)
         VALUES ('".$_POST->username."','" .$_POST->password . "','"
        . $_POST->email . "','" . $_POST->nickname . "','" . $_POST->mobile . "','"
        . $_POST->create_date . "','" . $_POST->modify_date . "','"
        . $_POST->birth . "','" . $_POST->userimage . "','" . $_POST->gender . "','"
        . $_POST->bestcategory . "','" . $_POST->shortinfo . "')";

        $result = $conn->query($sql);

        $sql1 = "SELECT id FROM user ORDER BY id DESC LIMIT 1";
        $result1 = $conn->query($sql1);
        $data = array();
        while ($row = mysqli_fetch_array($result1)) {
            array_push($data, array('id' => $row[0]));
        }
        $json = json_encode(array("userid" => $data), JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE);
        echo $json;

    if ($result) {
        sendResponse(200, $result, 'User Registration Successful.');
    } elseif ($result1) {
        sendResponse(200, $result1, 'User Registration Successful.');
    } else {
        sendResponse(404, [], 'User not Registered');
    }
    //close connection
    $conn->close();
    }
}
?>