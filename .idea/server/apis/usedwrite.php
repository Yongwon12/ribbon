<?php
basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));

$_POST = json_decode(file_get_contents("php://input"));

if(!$_POST->id){
    sendResponse(400, [] , 'id Required !');
}else if(!$_POST->userid){
    sendResponse(400, [] , 'userid Required !');

}else{

    if($conn==null){
        sendResponse(500, $conn, 'Server Connection Error !');
    }else{
        $sql = $conn->prepare("INSERT INTO usedwrite(id,local,title,description,usedimage1,
                      price,userid,writedate,nickname,usedimage2,
                      usedimage3,usedimage4,usedimage5)
         VALUES (:id,:local,:title,:description,:usedimage1,:price,:userid,:writedate,:nickname,
                 :usedimage2,:usedimage3,:usedimage4,:usedimage5)");
        $sql->bindValue(':id', $_POST->id);
        $sql->bindValue(':local', $_POST->local);
        $sql->bindValue(':title', $_POST->title);
        $sql->bindValue(':description', $_POST->description);
        $sql->bindValue(':usedimage1', $_POST->usedimage1);
        $sql->bindValue(':price', $_POST->price);
        $sql->bindValue(':userid', $_POST->userid);
        $sql->bindValue(':writedate', $_POST->writedate);
        $sql->bindValue(':usedimage2', $_POST->usedimage2);
        $sql->bindValue(':usedimage3', $_POST->usedimage3);
        $sql->bindValue(':usedimage4', $_POST->usedimage4);
        $sql->bindValue(':usedimage5', $_POST->usedimage5);
        $result = $sql->execute();
        if ($result) {
            sendResponse(200, $result , 'User Registration Successful.');
        } else {
            sendResponse(404, [] ,'User not Registered');
        }

    }
}
?>