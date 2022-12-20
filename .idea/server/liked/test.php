<?php

basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));
$conn=getConnection();
$liked = json_decode(file_get_contents("php://input"));

$sql3 = "select likedcount from liked left join boardwrite on liked.inherentid=boardwrite.boardid where categoryid = '" . $liked->categoryid . "' AND inherentid = '" . $liked->inherentid . "'";
$result3 = mysqli_query($conn, $sql3);
$data = array();

if ($result3) {
    while ($row = mysqli_fetch_array($result3)) {
        array_push($data,array('likedcount'=>$row[0]));
    }
    echo $data;

}


else {
    echo "sql 처리중 에러";
    echo mysqli_error($conn);

}
mysqli_close($conn);
?>