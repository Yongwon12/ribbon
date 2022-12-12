<?php

include_once('../common/header.php');
include_once('../common/response.php');
include_once('../common/encipher.php');


$sql = "SELECT * FROM boardwrite where id = 1";

require_once('../common/databaseboard.php');
?>