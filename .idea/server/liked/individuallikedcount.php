<?php

basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));
$conn=getConnection();
$liked = json_decode(file_get_contents("php://input"));

$sql = "select categoryid,inherentid,likedcount from individualliked left join individualwrite on liked.inherentid=individualwrite.individualid";
$result = mysqli_query($conn, $sql);
$data = array();
if ($result) {
    while ($row = mysqli_fetch_array($result)) {
        array_push($data, array('categoryid' => $row[0],'inherentid' => $row[1],'likedcount' => $row[2]));
    }

    $json = json_encode(array("individuallikedinfo" => $data), JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE);
    echo $json;


} else {
    echo "sql 처리중 에러";
    echo mysqli_error($conn);

}
mysqli_close($conn);
?>