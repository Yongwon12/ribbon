<?php
basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));

$_POST = json_decode(file_get_contents("php://input"));

if(!$_POST->categoryid){
    sendResponse(400, [] , 'categoryid Required !');
}else{
    if($conn==null){
        sendResponse(500, $conn, 'Server Connection Error !');
    }else{
        $sql1 = $conn->prepare("delete from usedliked where inherentid=:inherentid AND userid=:userid AND categoryid=:categoryid");
        $sql1->bindValue(':inherentid',$_POST->inherentid);
        $sql1->bindValue(':userid',$_POST->userid);
        $sql1->bindValue(':categoryid',$_POST->categoryid);
        $sql1->execute();

        $sql2 = $conn->prepare("update usedwrite set likedcount = likedcount - 1 where usedid = :usedid");
        $sql2->bindValue(':inherentid',$_POST->inherentid);
        $sql2->execute();

    }

}
?>