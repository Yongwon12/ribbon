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
            'date'=>$row[2],'title'=>$row[3],'description'=>$row[4],'gender'=>$row[5],
            'userimage'=>$row[6],'userid'=>$row[7],'writedate'=>$row[8],'maxage'=>$row[9],
            'minage'=>$row[10],'nickname'=>$row[11],'individualid'=>$row[12],'likedcount'=>$row[13]));

    }
    $json = json_encode(array("individualwrite" => $data), JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE);
    echo $json;
}
else
{
    echo "sql 처리중 에러";
    echo mysqli_error($conn);
}
mysqli_close($conn);
?>