<?php

$sql = "select usedwrite.id,userimage,local,title,description,usedimage1,price,userid,writedate,user.nickname,usedid,usedimage2,usedimage3,usedimage4,usedimage5 from user left join usedwrite on user.id = usedwrite.userid";
require_once('../common/databaseused.php');

?>