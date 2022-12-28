<?php
basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));
$conn=getConnection();

$result = mysqli_query($conn,$sql);
$data = array();
if ($result)
{
while ($row = mysqli_fetch_array($result))
{
array_push($data, array('id' => $row[0], 'local' => $row[1],
'title'=>$row[2],'line'=>$row[3],'description'=>$row[4],'peoplenum'=>$row[5],
'gender'=>$row[6],'minage'=>$row[7],'titleimage'=>$row[8],'userid'=>$row[9],
'maxage'=>$row[10],'writedate'=>$row[11],'peoplenownum'=>$row[12],'nickname'=>$row[13],'groupid'=>$row[14],'once'=>$row[15]));

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