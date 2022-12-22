<?php
basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));
$replyinfo = json_decode(file_get_contents("php://input"));
$conn = getConnection();
$sql = "select * from reply";
$result = mysqli_query($conn, $sql);
$data = array();
if ($result)
{
    while ($row = mysqli_fetch_array($result))
    {
        array_push($data, array('description' => $row[0], 'profileimage' => $row[1],
            'writedate'=>$row[2],'userid'=>$row[3],'nickname'=>$row[4],'categoryid'=>$row[5],
            'inherentid'=>$row[6],'likedcount'=>$row[7],'replyid'=>$row[8],'inherentcommentsid'=>$row[9],'isrecomment'=>$row[10]));
    }

    $json = json_encode(array("reply" => $data), JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE);
    echo $json;
}
?>