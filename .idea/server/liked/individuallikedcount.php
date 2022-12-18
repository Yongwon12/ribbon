<?php

basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));
$conn=getConnection();
$liked = json_decode(file_get_contents("php://input"));

$sql3 = "select likedcount from individualliked left join individualwrite on individualliked.inherentid=individualwrite.individualid where categoryid = '" . $liked->categoryid . "' AND inherentid = '" . $liked->inherentid . "'";
$result3 = mysqli_query($conn, $sql3);
$data = array();
$row = mysqli_fetch_array($result3);
if ($result3) {
    array_push($data, print_r('
    {
    "likedcount" : 
        {
            "likedcount":"' . $row[0] . '"
        }
    }'));

}


else {
    echo "sql 처리중 에러";
    echo mysqli_error($conn);

}
mysqli_close($conn);
?>