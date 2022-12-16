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
        array_push($data, array('usedwrite.id'=>$row[0],'userimage'=>$row[1],'local'=>$row[2],
            'title'=>$row[3],'description'=>$row[4],'usedimage1'=>$row[5],'price'=>$row[6],
            'userid'=>$row[7],'writedate'=>$row[8],'user.nickname'=>$row[9],'usedid'=>$row[10],
            'usedimage2'=>$row[11],'usedimage3'=>$row[12],'usedimage4'=>$row[13],'usedimage5'=>$row[14]));

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
