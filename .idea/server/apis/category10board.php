<?php

include_once('../common/header.php');
include_once('../common/response.php');
include_once('../common/encipher.php');


$sql = "SELECT * FROM boardwrite where id = 10";

require_once('../common/databaseboard.php');
?>