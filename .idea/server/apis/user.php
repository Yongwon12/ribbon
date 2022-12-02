<?php
include_once('../common/include.php');
//get connection from database.php
$conn=getConnection();

if($conn==null){
    //send response if connection error occurred.
    sendResponse(500,$conn,'Server Connection Error');
}else{
    $sql = "SELECT id, name, email,nickname,gender,birth FROM user";
    $result = $conn->query($sql);

    //check if user list available
    if ($result->num_rows > 0) {
        $users=array();
        while($row = $result->fetch_assoc()) {
            $user=array(
                "id" =>  $row["id"],
                "name" => $row["name"],
                "email" => $row["email"],
                "nickname" => $row["nickname"],
                "gender" => $row["gender"],
                "birth" => $row["birth"],
            );
            array_push($users,$user);
        }
        sendResponse(200,$users,'User List');
    } else {
        sendResponse(404,[],'User not available');
    }
    //closing connection
    $conn->close();
}
?>