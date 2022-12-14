<?php

basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));
$conn=getConnection();
for ($i = 1; $i < 11; $i++) {
    $sql = "select boardid,userid,category.board,title,description,img,writedate,profileimage,nickname from boardwrite left join category on boardwrite.id = category.id where category.id = $i";


//method file_get_contents() get all data send via API call.
//json_decode() decodes data as json and assign to variable $user.
    $user = json_encode(file_get_contents("php://input"));
//validation whether user data is having name or not. similarly email, password etc.

    $result = mysqli_query($conn, $sql);

    $data = array();
    if ($result) {
        $row = 0;
        while ($row = mysqli_fetch_array($result)) {
            // or select*from 테이블 where id = 3 and userid = 3 이런식으로 불러오기 + 배열형식
            array_push($data, array('boardid' => $row[0], 'category' => $row[1],
                'userid' => $row[2], 'title' => $row[3], 'description' => $row[4], 'img' => $row[5],
                'writedate' => $row[6], 'profileimage' => $row[7], 'nickname' => $row[8]));

        }

        $json = json_encode(array("boardwrite$i" => $data), JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE);
        echo $json;




        #$json = json_encode(array("boardwrite" => $data), JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE);

    } else {
        echo "sql 처리중 에러";
        echo mysqli_error($conn);
    }
}
mysqli_close($conn);
?>