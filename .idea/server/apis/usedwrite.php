<?php
basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));


//method file_get_contents() get all data send via API call.
//json_decode() decodes data as json and assign to variable $user.
$used = json_decode(file_get_contents("php://input"));

//validation whether user data is having name or not. similarly email, password etc.
if(!$used->id){
    sendResponse(400, [] , 'id Required !');
}else if(!$used->userid){
    sendResponse(400, [] , 'userid Required !');

}else{
    //method doEncrypt() of encipher.php which convert plain text to encrypted text.
    $conn=getConnection();
    if($conn==null){
        sendResponse(500, $conn, 'Server Connection Error !');
    }else{
        $sql="INSERT INTO usedwrite(id,local,title,description,usedimage,price,userid,writedate,nickname)
         VALUES ('".$used->id."','".$used->local."','".$used->title."','"
            .$used->description."','" .$used -> usedimage."','"
            .$used->price."','".$used->userid."','"
            .$used -> writedate."','" .$used -> nickname."')";


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