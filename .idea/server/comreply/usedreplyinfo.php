<?php
basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));
$usedreplyinfo = json_decode(file_get_contents("php://input"));
$conn = getConnection();
$sql = "select * from usedreply where inherentid='".$usedreplyinfo->inherentid."'";
$result = mysqli_query($conn, $sql);

$sql2 = "select commentcount from usedwrite where usedid = 
         '".$usedreplyinfo->inherentid."'";
$result2= mysqli_query($conn,$sql2);
$row2 = mysqli_fetch_array($result2);
$data = array();
if ($result)
{
    while ($row = mysqli_fetch_array($result))
    {
        array_push($data, array('description' => $row[0], 'profileimage' => $row[1],
            'writedate'=>$row[2],'userid'=>$row[3],'nickname'=>$row[4], 'inherentid'=>$row[5],
            'likedcount'=>$row[6],'usedreplyid'=>$row[7],'inherentcommentsid'=>$row[8],'isrecomment'=>$row[9],'commentcount'=>$row2[0]));
    }

    $json = json_encode(array("reply" => $data), JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE);
    echo $json;
}
?>