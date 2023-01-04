<?php

basename(include_once('../common/include.php'));
basename(include_once('../common/encipher.php'));
basename(require_once('../common/curlfunc.php'));

$_POST = json_decode(file_get_contents("php://input"));

$sql = $conn->prepare("SELECT * FROM boardwrite where id = :id");
$sql->bindValue(':id', $_POST->id);
basename(require_once('../common/databaseboard.php'));
print_r(',');
$sql = $conn->prepare("SELECT * FROM groupwrite where id = :id");
$sql->bindValue(':id', $_POST->id);
basename(require_once('../common/databasegroup.php'));
print_r(',');
$sql = $conn->prepare("SELECT * FROM individualwrite where id = :id");
$sql->bindValue(':id', $_POST->id);
basename(require_once('../common/databaseindividual.php'));
print_r(',');
$sql = $conn->prepare("SELECT * FROM usedwrite where id = :id");
$sql->bindValue(':id', $_POST->id);
basename(require_once('../common/databaseused.php'));


?>