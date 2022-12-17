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
        array_push($data, array('id'=>$row[0],'local'=>$row[1],'title'=>$row[2],
            'description'=>$row[3],'usedimage1'=>$row[4],'price'=>$row[5],'userid'=>$row[6],
            'writedate'=>$row[7],'nickname'=>$row[8],'usedid'=>$row[9],'usedimage2'=>$row[10],
            'usedimage3'=>$row[11],'usedimage4'=>$row[12],'usedimage5'=>$row[13]));

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
