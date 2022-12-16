<?php

basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));
$conn=getConnection();
$liked = json_decode(file_get_contents("php://input"));

    $sql3 = "select * from boardwrite where boardid = '".$liked->inherentid."'";
    $result3 = mysqli_query($conn, $sql3);
    $data = array();
    if ($row = mysqli_fetch_array($result3)) {
        array_push($data, array('likedcount' => $row[0]));
        $json = json_encode(array("likedcount" => $data), JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE);
        echo $json;
    } else {
        echo "sql 처리중 에러";
        echo mysqli_error($conn);

}
mysqli_close($conn);
?>