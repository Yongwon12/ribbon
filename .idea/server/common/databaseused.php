<?php
basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));
$conn=getConnection();
//method file_get_contents() get all data send via API call.
//json_decode() decodes data as json and assign to variable $user.
$user = json_encode(file_get_contents("php://output"));
//validation whether user data is having name or not. similarly email, password etc.

$result = mysqli_query($conn,$sql);
$data = array();
if ($result)
{
    while ($row = mysqli_fetch_array($result))
    {
        array_push($data, array('id'=>$row[0],'local'=>$row[1],
            'title'=>$row[2],'description'=>$row[3],'usedimage'=>$row[4],'price'=>$row[5],
            'userid'=>$row[6],'writedate'=>$row[7],'nickname'=>$row[8]));

    }
    $json = json_encode(array("usedwrite" => $data), JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE);
    echo $json;
}
else
{
    echo "sql 처리중 에러";
    echo mysqli_error($conn);
}
mysqli_close($conn);
?>
