<?php
$conn = mysqli_connect("127.0.0.1", "yongwon", "D08yw14k.",
    "ribbonProject");
$sql = "INSERT INTO ribbon_Member_Info(
                               mem_idx,
                  mem_userid,
                  mem_email,
                  mem_password,
                               mem_username,
                               mem_regtime,
                             mem_gender,
                             mem_birth,
                              mem_img)
        values(
               2,
               'dyddnjs3401',
               'dyddnjs3401@naver.com',
               'tjaaj159',
               '김영연',
               NOW(),
               'M',
            NOW(),
               NULL
               )";
echo $sql;
$result = mysqli_query($conn, $sql);
if ($result === false) {
    echo (error_log($conn));
}

?>