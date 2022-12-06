<?php

include_once('../common/header.php');
include_once('../common/response.php');
include_once('../common/encipher.php');
$conn = mysqli_connect("172.30.1.24", "yongwon2", "Dyddnjs3401!", 'ribbonProject');

//method file_get_contents() get all data send via API call.
//json_decode() decodes data as json and assign to variable $user.
$user = json_encode(file_get_contents("php://input"));
//validation whether user data is having name or not. similarly email, password etc.
$sql = "SELECT * FROM user where id=3";

$result = mysqli_query($conn,$sql);
$data = array();
if ($result)
{
    while ($row = mysqli_fetch_array($result))
    {
        // or select*from 테이블 where id = 3 and userid = 3 이런식으로 불러오기 + 배열형식
        array_push($data, array('id' => $row[0], 'username' => $row[1],
            'password'=>$row[2],'email'=>$row[3],'nickname'=>$row[4],'mobile'=>$row[5],
            'create_date'=>$row[6], 'modify_date'=>$row[7],'birth'=>$row[8],
            'image'=>$row[9],'gender'=>$row[10]));

    }
    $json = json_encode(array("user" => $data), JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE);
        echo $json;
    }
else
    {
    echo "sql 처리중 에러";
    echo mysqli_error($conn);
    }
mysqli_close($conn);
?>