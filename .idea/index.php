<?php
$conn = mysqli_connect(
    '127.0.0.1', 'yongwon',
    'D08yw14k.', 'ribbonProject'
);

$sql = "SELECT * FROM ribbon_Member_info";
$result = mysqli_query($conn, $sql);




?>
<html>
<head>
    <meta charset="UTF-8">
    <title>맺음</title>
</head>
<body>
<h1><a href="index.php ">WEB</a></h1>
<h2>맺음에서 확인</h2>
<h2><?=$sql?></h2>
</body>
</html>
