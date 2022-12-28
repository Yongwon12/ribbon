<?php
basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));
$groupcommentsinfo = json_decode(file_get_contents("php://input"));
$conn = getConnection();
$sql = "select * from groupcomments where inherentid = '".$groupcommentsinfo->inherentid."'";
$result = mysqli_query($conn, $sql);
$sql2 = "select commentcount from groupwrite where groupid = 
         '".$groupcommentsinfo->inherentid."'";
$result2= mysqli_query($conn,$sql2);
$row2 = mysqli_fetch_array($result2);

$data = array();
if ($result)
{
    while ($row = mysqli_fetch_array($result))
    {
        array_push($data, array('description' => $row[0], 'userid' => $row[1],
            'nickname'=>$row[2],'inherentid'=>$row[3],'writedate'=>$row[4],
            'profileimage'=>$row[5],'likedcount'=>$row[6],'groupcommentsid'=>$row[7],'isrecomment'=>$row[8],'commentcount'=>$row2[0]));
    }

    $json = json_encode(array("comment" => $data), JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE);
    echo $json;
}


?>