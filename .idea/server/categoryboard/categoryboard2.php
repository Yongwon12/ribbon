<?php

basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));
$conn=getConnection();

for ($i = 1; $i < 11; $i++) {
    require('../common/categoryboard.php');
    if ($i == 2 && "boardwrite$i" == "boardwrite2") {
        echo $json;
    }
}
mysqli_close($conn);
?>