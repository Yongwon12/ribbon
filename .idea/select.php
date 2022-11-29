<?php
/* 현재 버전에서는 mysqli_report_all이 초기값이라 if문이 작동안함
따라서 바꾸어주기 아래 설정으로*/
mysqli_report(MYSQLI_REPORT_OFF);
$conn = mysqli_connect('127.0.0.1',
    'yongwon2',
    'Dyddnjs3401!',
    'ribbonProject'
);
$sql = "SELECT * FROM ribbon_Member_Info WHERE mem_idx = 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
echo $row['mem_email'];
echo $row['mem_username'];
?>
