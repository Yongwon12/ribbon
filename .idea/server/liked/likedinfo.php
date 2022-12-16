<?php

basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));
$conn=getConnection();
$android = json_decode(file_get_contents("php://input"));
$sql = "select * from liked";
$result = mysqli_query($conn, $sql);
$data = array();

if ($result) {
    while($row = mysqli_fetch_array($result)) {
        array_push($data, array('categoryid' => $row[0],
            'nickname' => $row[1], 'userid' => $row[2], 'likedid' => $row[3]));
    }
    $json = json_encode(array("likedinfo" => $data), JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE);
    echo $json;
}
else {
    echo "sql 처리중 에러";
    echo mysqli_error($conn);

}


mysqli_close($conn);
?>