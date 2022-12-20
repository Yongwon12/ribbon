<?php
basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));
$replyinfo = json_decode(file_get_contents("php://input"));
$conn = getConnection();
$sql = "select *from reply";
$result = mysqli_query($conn, $sql);
$data = array();
if ($result)
{
    while ($row = mysqli_fetch_array($result))
    {
        array_push($data, array('description' => $row[0], 'userid' => $row[1],
            'nickname'=>$row[2],'categoryid'=>$row[3],'inherentid'=>$row[4],'writedate'=>$row[5],
            'profileimage'=>$row[6],'likedcount'=>$row[7],'replyid'=>$row[8]));
    }

    $json = json_encode(array("replyinfo" => $data), JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE);
    echo $json;
}
?>