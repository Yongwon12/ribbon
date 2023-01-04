<?php
basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));

$sql = $conn->prepare("SELECT * FROM groupwrite");

basename(require_once('../common/databasegroup.php'));
?>