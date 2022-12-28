<?php

$sql = "SELECT username,email,nickname,mobile,create_date,modify_date,birth,userimage,gender FROM user where id = '".$user->id."'";

basename(require_once('../common/mypagesdb.php'));
?>