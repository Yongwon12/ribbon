<?php
basename(include_once('../common/encipher.php'));
basename(include_once('../common/include.php'));
$conn = getConnection();
$_POST = json_decode(file_get_contents("php://input"));
if (!$_POST->id) {
    echo '껄껄껄껄';
} elseif($_POST->id) {
    $sql = "update user set nickname = '" . $_POST->nickname . "',userimage = '" . $_POST->userimage . "',modify_date = '" . $_POST->modify_date . "',bestcategory = '" . $_POST->bestcategory . "',shortinfo = '" . $_POST->shortinfo . "' where id = '" . $_POST->id . "'";
    $result = mysqli_query($conn,$sql);
    $conn->close();
}

?>