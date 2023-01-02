<?php
basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));


$_POST = json_decode(file_get_contents("php://input"));


if(!$_POST->id){
    sendResponse(400, [] , 'id Required !');
}else if(!$_POST->userid){
    sendResponse(400, [] , 'userid Required !');
}
else{
    if($conn==null){
        sendResponse(500, $conn, 'Server Connection Error !');
    }else{
        $sql = $conn->prepare("INSERT INTO groupwrite(id,local,title,line,description,
            peoplenum,gender,minage,titleimage,userid,maxage,writedate,peoplenownum,nickname,once)
         VALUES (:id,:local,:title,:line,:description,:peoplenum,:gender,:minage,:titleimage,
                 :userid,:maxage,:writedate,:peoplenownum,:nickname,:once)");
        $sql->bindValue(':id', $_POST->id);
        $sql->bindValue(':local', $_POST->local);
        $sql->bindValue(':title', $_POST->title);
        $sql->bindValue(':line', $_POST->line);
        $sql->bindValue(':description', $_POST->description);
        $sql->bindValue(':peoplenum', $_POST->peoplenum);
        $sql->bindValue(':gender', $_POST->gender);
        $sql->bindValue(':minage', $_POST->minage);
        $sql->bindValue(':titleimage', $_POST->titleimage);
        $sql->bindValue(':userid', $_POST->userid);
        $sql->bindValue(':maxage', $_POST->maxage);
        $sql->bindValue(':writedate', $_POST->writedate);
        $sql->bindValue(':peoplenownum', $_POST->peoplenownum);
        $sql->bindValue(':nickname', $_POST->nickname);
        $sql->bindValue(':once', $_POST->once);
        $result = $sql->execute();
        if ($result) {
            sendResponse(200, $result , 'User Registration Successful.');
        } else {
            sendResponse(404, [] ,'User not Registered');
        }

    }
}
?>