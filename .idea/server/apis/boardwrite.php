<?php
basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));

basename(require_once('../common/curlfunc.php'));

$_POST = json_decode(file_get_contents("php://input"));

//validation whether user data is having name or not. similarly email, password etc.
if(!$_POST->id){
    sendResponse(400, [] , 'id Required !');
}else if(!$_POST->userid){
    sendResponse(400, [] , 'userid Required !');
}else if(!$_POST->title){
    sendResponse(400, [] , 'title Required !');

}else{
    //method doEncrypt() of encipher.php which convert plain text to encrypted text.

    if($conn==null){
        sendResponse(500, $conn, 'Server Connection Error !');
    }else{
        $sql = $conn->prepare("INSERT INTO boardwrite(id, userid,title,description,
                 img,writedate,profileimage,nickname)
         VALUES (:id,:userid,:title,:description,:img,:writedate,:profileimage,:nickname)");
        $sql->bindValue(':id', $_POST->id);
        $sql->bindValue(':userid', $_POST->userid);
        $sql->bindValue(':title', $_POST->title);
        $sql->bindValue(':description', $_POST->description);
        $sql->bindValue(':img', $_POST->img);
        $sql->bindValue(':writedate', $_POST->writedate);
        $sql->bindValue(':profileimage', $_POST->profileimage);
        $sql->bindValue(':nickname', $_POST->nickname);
        $result = $sql->execute();
        if ($result) {
            sendResponse(200, $result , 'User Registration Successful.');
        } else {
            sendResponse(404, [] ,'User not Registered');
        }
    }
}
?>