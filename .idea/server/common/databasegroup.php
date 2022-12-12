<?php
$conn = mysqli_connect("192.168.0.3", "yongwon2", "Dyddnjs3401!", 'ribbonProject');

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
array_push($data, array('id' => $row[0], 'local' => $row[1],
'title'=>$row[2],'line'=>$row[3],'description'=>$row[4],'peoplenum'=>$row[5],
'gender'=>$row[6],'minage'=>$row[7],'titleimage'=>$row[8],'userid'=>$row[9],
'maxage'=>$row[10],'writedate'=>$row[11],'peoplenownum'=>$row[12],'nickname'=>$row[13]));

}
$json = json_encode(array("groupwrite" => $data), JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE);
echo $json;
}
else
{
echo "sql 처리중 에러";
echo mysqli_error($conn);
}
mysqli_close($conn);
?>