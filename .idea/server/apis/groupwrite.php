<?php
basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));

//method file_get_contents() get all data send via API call.
//json_decode() decodes data as json and assign to variable $user.
$group = json_decode(file_get_contents("php://input"));

//validation whether user data is having name or not. similarly email, password etc.
if(!$group->id){
    sendResponse(400, [] , 'id Required !');
}else if(!$group->userid){
    sendResponse(400, [] , 'userid Required !');
}
else{
    //method doEncrypt() of encipher.php which convert plain text to encrypted text.
    $conn=getConnection();
    if($conn==null){
        sendResponse(500, $conn, 'Server Connection Error !');
    }else{
        $sql = "INSERT INTO groupwrite(id,local,title,line,description,
                 peoplenum,gender,minage,titleimage,userid,maxage,writedate,peoplenownum,nickname,once)
         VALUES ('" . $group->id . "','" . $group->local . "','"
            . $group->title . "','" . $group->line . "','" . $group->description . "','"
            . $group->peoplenum . "','" . $group->gender . "','" . $group->minage . "','"
            . $group->titleimage . "','" . $group->userid . "','" . $group->maxage . "','"
            . $group->writedate . "','" . $group->peoplenownum . "','" . $group->nickname . "','" . $group->once . "')";


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