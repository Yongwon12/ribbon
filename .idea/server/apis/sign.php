<?php
basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));
basename(require_once('../common/curlfunc.php'));

$_POST = json_decode(file_get_contents("php://input"));

if(!$_POST->username){
    sendResponse(400, [] , 'Name Required !');
}else if(!$_POST->email){
    sendResponse(400, [] , 'Email Required !');
}else {
    if ($conn == null) {
        sendResponse(500, $conn, 'Server Connection Error !');
    } elseif ($conn) {

        $sql = $conn->prepare("INSERT INTO user(username,password,email,nickname,
                 mobile,create_date,modify_date,birth,userimage,gender,bestcategory,shortinfo)
         VALUES (:username,:password,:email,:nickname,:mobile,:create_date,:modify_date,:birth,:userimage,
                 :gender,:bestcategory,:shortinfo)");
        $sql->bindValue(':username', $_POST->username);
        $sql->bindValue(':password', $_POST->password);
        $sql->bindValue(':email', $_POST->email);
        $sql->bindValue(':nickname', $_POST->nickname);
        $sql->bindValue(':mobile', $_POST->mobile);
        $sql->bindValue(':create_date', $_POST->create_date);
        $sql->bindValue(':modify_date', $_POST->modify_date);
        $sql->bindValue(':birth', $_POST->birth);
        $sql->bindValue(':userimage', $_POST->userimage);
        $sql->bindValue(':gender', $_POST->gender);
        $sql->bindValue(':bestcategory', $_POST->bestcategory);
        $sql->bindValue(':shortinfo', $_POST->shortinfo);
        $result = $sql->execute();
        $sql->connection = null;

        $sql1 = $conn->prepare("SELECT id FROM user ORDER BY id DESC LIMIT 1");
        $sql1->execute();
        $row = $sql1->fetchall(PDO::FETCH_ASSOC);
        $json = json_encode(array('userid'=>$row),JSON_PRETTY_PRINT,JSON_UNESCAPED_UNICODE);
        print_r($json);


    }
}
?>