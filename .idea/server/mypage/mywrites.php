<?php


$sql1 = "SELECT * FROM boardwrite where id = '".$user->id."'";
basename(require_once('../common/databaseboard.php'));
$sql2 = "SELECT * FROM groupwrite where id = '".$user->id."'";
basename(require_once('../common/databasegroup.php'));
$sql3 = "SELECT * FROM individualwrite where id = '".$user->id."'";
basename(require_once('../common/databaseindividual.php'));
$sql4 = "SELECT * FROM usedwrite where id = '".$user->id."'";
basename(require_once('../common/databaseused.php'));

?>