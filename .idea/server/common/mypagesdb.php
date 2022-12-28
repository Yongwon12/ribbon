<?php
basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));
$user = json_decode(file_get_contents("php://input"));
$conn=getConnection();
$result = mysqli_query($conn,$sql);
$data = array();
if ($result)
{
    while ($row = mysqli_fetch_array($result))
    {

        array_push($data, array('username' => $row[0], 'email' => $row[1],
            'nickname'=>$row[2],'mobile'=>$row[3],'create_date'=>$row[4],'modify_date'=>$row[5],
            'birth'=>$row[6],'userimage'=>$row[7], 'gender' => $row[8]));
    }


    $json = json_encode(array("boardwrite" => $data), JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE);
    echo $json;
}
else
{
    echo "sql 처리중 에러";
    echo mysqli_error($conn);
}
mysqli_close($conn);
?>