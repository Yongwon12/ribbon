<?php

basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));


for ($i = 1; $i < 11; $i++) {
    basename(require('../common/categoryboard.php'));
    if ($i == 4 && "boardwrite$i" == "boardwrite4") {
        print_r($json);
    }
}

?>