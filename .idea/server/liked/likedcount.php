<?php

basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));
$conn=getConnection();
$liked = json_decode(file_get_contents("php://input"));

    $sql1 = "INSERT INTO boardtrash(categoryid,inherentid)
         VALUES ('" . $liked->categoryid . "','" . $liked->inherentid . "')";
    $result1 = mysqli_query($conn, $sql1);


    $sql2 = "select likedcount from liked left join boardwrite on liked.inherentid=boardwrite.boardid where categoryid = '".$liked->categoryid."' AND inherentid = '".$liked->inherentid."'";
    $result2 = mysqli_query($conn, $sql2);
    $data = array();
    if ($result2) {
        while ($row = mysqli_fetch_array($result2)) {
            array_push($data, array('likedcount' => $row[0]));
        }

        $json = json_encode($data, JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE);
        echo $json;


    } else {
        echo "sql 처리중 에러";
        echo mysqli_error($conn);

}
mysqli_close($conn);
?>