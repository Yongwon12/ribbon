<?php

basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));
$conn=getConnection();
$android = json_decode(file_get_contents("php://input"));
$sql = "select * from liked";
$result = mysqli_query($conn, $sql);
$data = array();
if ($count = mysqli_num_rows($result)) {

    print_r('{
    "likedcount": [
        {
            "likedcount": "' . $count . '"
        }
    ]
}');
}
else {
    echo "sql 처리중 에러";
    echo mysqli_error($conn);

}


mysqli_close($conn);
?>