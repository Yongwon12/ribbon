<?php


$sql = "select boardid,userid,category.id,title,description,img,writedate,profileimage,nickname,likedcount,commentcount from boardwrite left join category on boardwrite.id = category.id where category.id = $i";


    $result = mysqli_query($conn, $sql);

    $data = array();


        while ($row = mysqli_fetch_array($result)) {
            // or select*from 테이블 where id = 3 and userid = 3 이런식으로 불러오기 + 배열형식
            array_push($data, array('boardid' => $row[0], 'userid' => $row[1],
                'categoryid' => $row[2], 'title' => $row[3], 'description' => $row[4], 'img' => $row[5],
                'writedate' => $row[6], 'profileimage' => $row[7], 'nickname' => $row[8], 'likedcount' => $row[9],
             'commentcount' => $row[10]));

        }

            $json = htmlspecialchars(json_encode(array("boardwrite$i" => $data), JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE));



?>