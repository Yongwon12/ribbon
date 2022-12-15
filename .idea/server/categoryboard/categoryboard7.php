<?php

basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));
$conn=getConnection();

for ($i = 1; $i < 11; $i++) {
    basename(require('../common/categoryboard.php'));
    if ($i == 7 && "boardwrite$i" == "boardwrite7") {
        echo $json;
    }
}
mysqli_close($conn);
?>