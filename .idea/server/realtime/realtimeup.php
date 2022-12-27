<?php
basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));
$conn = getConnection();
$sql = "select * from boardwrite where likedcount = (select max(likedcount) from boardwrite) order by boardid desc limit 1";

$result = mysqli_query($conn, $sql);
$data = array();
if ($result) {
    while ($row = mysqli_fetch_array($result))  {
        array_push($data, array('id' => $row[0], 'userid' => $row[1],
            'title'=>$row[2],'description'=>$row[3],'img'=>$row[4],'writedate'=>$row[5],
            'profileimage'=>$row[6],'nickname'=>$row[7],'boardid'=>$row[8],'likedcount'=>$row[9]));

    }

    $json = htmlspecialchars(json_encode(array("bestwrite" => $data), JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE));
    echo $json;
} else {
    echo "sql 처리중 에러";
    echo mysqli_error($conn);
}
mysqli_close($conn);

?>