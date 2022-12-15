<?php

basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));
$conn=getConnection();

for ($i = 1; $i < 11; $i++) {
    require('../common/categoryboard.php');
    if ($i == 9 && "boardwrite$i" == "boardwrite9") {
        echo $json;
    }
}
mysqli_close($conn);
?>