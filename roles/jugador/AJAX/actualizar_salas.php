<?php

session_start();

require_once('../../../Database/database.php');
$conexion = new database;
$con = $conexion->conectar();

$sql = $con->prepare("SELECT *  FROM salas INNER JOIN mapas ON mapas.id_mapa = salas.id_mapa WHERE mapas.nivel_requerido = :nivel_user");
$sql->bindParam("nivel_user",$_SESSION['nivel_usuario'],PDO::PARAM_INT);
$sql ->execute();


$salas = $sql->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($salas);


?>