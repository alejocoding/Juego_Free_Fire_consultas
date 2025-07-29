<?php
require_once("../../../Database/database.php");
$conexion = new database;
$con = $conexion->conectar();


$users = $con->prepare("SELECT * FROM usuario where id_rol = 2");
$users->execute();

$users = $users->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($users);

?>