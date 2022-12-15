<?php

basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));
$conn=getConnection();

for ($i = 1; $i < 11; $i++) {
    require('../common/categoryboard.php');
    if ($i == 8 && "boardwrite$i" == "boardwrite8") {
        echo $json;
    }
}
mysqli_close($conn);
?>