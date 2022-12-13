<?php

basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));
$conn=getConnection();


//method file_get_contents() get all data send via API call.
//json_decode() decodes data as json and assign to variable $user.
$user = json_encode(file_get_contents("php://input"));
//validation whether user data is having name or not. similarly email, password etc.

$result = mysqli_query($conn,$sql);
$data = array();
if ($result)
{
    while ($row = mysqli_fetch_array($result))
    {
        // or select*from 테이블 where id = 3 and userid = 3 이런식으로 불러오기 + 배열형식
        array_push($data, array('id' => $row[0], 'userid' => $row[1],
            'title'=>$row[2],'description'=>$row[3],'img'=>$row[4],'writedate'=>$row[5],'profileimage'=>$row[6],'nickname'=>$row[7]));

    }
    $json = json_encode(array("boardwrite6" => $data), JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE);
    echo $json;
}
else
{
    echo "sql 처리중 에러";
    echo mysqli_error($conn);
}
mysqli_close($conn);
?>