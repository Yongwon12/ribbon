<?php
basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));

//method file_get_contents() get all data send via API call.
//json_decode() decodes data as json and assign to variable $user.
$individual = json_decode(file_get_contents("php://input"));

//validation whether user data is having name or not. similarly email, password etc.
if(!$individual->id){
    sendResponse(400, [] , 'id Required !');
}else if(!$individual->userid){
    sendResponse(400, [] , 'Email Required !');
}else if(!$individual->local){
    sendResponse(400, [] , 'password Required !');

}else{
    //method doEncrypt() of encipher.php which convert plain text to encrypted text.

    $conn=getConnection();
    if($conn==null){
        sendResponse(500, $conn, 'Server Connection Error !');
    }else{
        $sql = "INSERT INTO individualwrite(id,local,date,title,description,
                 gender,userimage,userid,writedate,maxage,minage,nickname)
         VALUES ('" . $individual->id . "','" . $individual->local . "','"
            . $individual->date . "','" . $individual->title . "','" . $individual->description . "','"
            . $individual->gender . "','" . $individual->userimage . "','" . $individual->userid . "','"
            . $individual->writedate . "','" . $individual->maxage . "','" . $individual->minage . "','" . $individual->nickname . "')";

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