<?php
basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));

//method file_get_contents() get all data send via API call.
//json_decode() decodes data as json and assign to variable $user.
$user = json_decode(file_get_contents("php://input"));

//validation whether user data is having name or not. similarly email, password etc.
if(!$user->username){
    sendResponse(400, [] , 'Name Required !');
}else if(!$user->email){
    sendResponse(400, [] , 'Email Required !');
}else if(!$user->password){
    sendResponse(400, [] , 'password Required !');

}else{
    //method doEncrypt() of encipher.php which convert plain text to encrypted text.
    $password = doEncrypt($user->password);
    $conn=getConnection();
    if($conn==null){
        sendResponse(500, $conn, 'Server Connection Error !');
    }else{
        #$sql="INSERT INTO user(username, password,email,nickname,
                 mobile,create_date,modify_date,birth,userimage,gender)
         VALUES ('".$user->username."','".$user->password."','"
        .$user->email."','".$user->nickname."','" .$user -> mobile."','"
             .$user->create_date."','".$user->modify_date."','"
        .$user -> birth."','".$user->userimage."','".$user->gender."')";


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