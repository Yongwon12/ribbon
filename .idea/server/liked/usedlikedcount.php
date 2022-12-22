<?php

basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));
$conn=getConnection();
$liked = json_decode(file_get_contents("php://input"));

$sql3 = "select likedcount from usedliked left join usedwrite on usedliked.inherentid=usedwrite.usedid where categoryid = '" . $liked->categoryid . "' AND inherentid = '" . $liked->inherentid . "'";
$result3 = mysqli_query($conn, $sql3);

$row = mysqli_fetch_array($result3);
if ($result3) {
     print_r('
    {
    "likedcount" : 
        {
            "likedcount":"' . $row[0] . '"
        }
    }');

}


else {
    echo "sql 처리중 에러";
    echo mysqli_error($conn);

}
mysqli_close($conn);
?>