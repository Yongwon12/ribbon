<?php
basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));

$sql = $conn->prepare("SELECT * FROM individualwrite");

basename(require_once('../common/databaseindividual.php'));
?>