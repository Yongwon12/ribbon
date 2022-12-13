<?php
basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));

//method file_get_contents() get all data send via API call.
//json_decode() decodes data as json and assign to variable $user.
$user = json_decode(file_get_contents("php://input"));

//validation whether user data is having name or not. similarly email, password etc.
if(!$user->sns_id){
    sendResponse(400, [] , 'ID Required !');
}else if(!$user->sns_name){
    sendResponse(400, [] , 'Name Required !');

}else{
    //method doEncrypt() of encipher.php which convert plain text to encrypted text.
    $conn=getConnection();
    if($conn==null){
        sendResponse(500, $conn, 'Server Connection Error !');
    }else{
        $sql="INSERT INTO naverinfo(sns_id, sns_type,sns_name,sns_profile,sns_connect_date)
        VALUES ('".$user->sns_id."','".$user->sns_type."','"
        .$user->sns_name."','".$user->sns_profile."','"
            .$user -> sns_connect_date."')";


        $result = $conn->query($sql); //$result = true/false on success or error respectively.
        if ($result) {
            sendResponse(200, $result , 'User Registration Successful.');
        } else {
            sendResponse(404, [] ,'User not Registered');
        }
        //close connection
        $conn->close();
    }
}
?>