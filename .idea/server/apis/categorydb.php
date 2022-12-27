<?php


basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));

$conn=getConnection();

//method file_get_contents() get all data send via API call.
//json_decode() decodes data as json and assign to variable $user.
$user = json_encode(file_get_contents("php://input"));
//validation whether user data is having name or not. similarly email, password etc.
$sql = "SELECT * FROM category";

$result = mysqli_query($conn,$sql);
$data = array();
if ($result)
{
    while ($row = mysqli_fetch_array($result))
    {
        array_push($data, array('id'=>$row[0],'board'=>$row[1]));

    }
    $json = htmlspecialchars(json_encode(array("category" => $data), JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE));
    echo $json;
}
else
{
    echo "sql 처리중 에러";
    echo mysqli_error($conn);
}
mysqli_close($conn);
?>