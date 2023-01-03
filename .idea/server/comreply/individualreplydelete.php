<?php
basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));

$_POST = json_decode(file_get_contents("php://input"));

if(!$_POST->individualreplyid){
    sendResponse(400, [] , 'individualreplyid Required !');
}else{

    if($conn==null){
        sendResponse(500, $conn, 'Server Connection Error !');
    }else{
        $sql1 = $conn->prepare("delete from individualreply where individualreplyid=:individualreplyid");
        $sql1->bindValue(':individualreplyid',$_POST->individualreplyid);
        $result1 = $sql1->execute();
        $sql4 = $conn->prepare("update individualwrite set commentcount = commentcount - 1 where individualid = :inherentid");
        $sql4->bindValue(':inherentid',$_POST->inherentid);
        $sql4->execute();
    }

    if ($result1) {
        sendResponse(200, $result1 , 'User Registration Successful.');
    } elseif($result2) {
        sendResponse(200, $result2 , 'User Registration Successful.');
    }

    else{
        sendResponse(404, [], 'failed');
    }


}
?>