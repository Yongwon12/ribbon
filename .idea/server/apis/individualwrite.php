<?php
basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));


basename(require_once('../common/curlfunc.php'));

$_POST = json_decode(file_get_contents("php://input"));

if(!$_POST->id){
    sendResponse(400, [] , 'id Required !');
}else if(!$_POST->userid){
    sendResponse(400, [] , 'Email Required !');
}else if(!$_POST->local){
    sendResponse(400, [] , 'password Required !');

}else{
    //method doEncrypt() of encipher.php which convert plain text to encrypted text.

    if($conn==null){
        sendResponse(500, $conn, 'Server Connection Error !');
    }else{

        $sql = $conn->prepare("INSERT INTO individualwrite(id,local,date,title,description,
                 gender,userimage,userid,writedate,maxage,minage,nickname)
         VALUES (:id,:local,:date,:title,:description,:gender,:userimage,:userid,:writedate,
                 :maxage,:minage,:nickname)");
        $sql->bindValue(':id', $_POST->id);
        $sql->bindValue(':local', $_POST->local);
        $sql->bindValue(':date', $_POST->date);
        $sql->bindValue(':title', $_POST->title);
        $sql->bindValue(':description', $_POST->description);
        $sql->bindValue(':gender', $_POST->gender);
        $sql->bindValue(':userimage', $_POST->userimage);
        $sql->bindValue(':userid', $_POST->userid);
        $sql->bindValue(':writedate', $_POST->writedate);
        $sql->bindValue(':maxage', $_POST->maxage);
        $sql->bindValue(':minage', $_POST->minage);
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