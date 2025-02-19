<?php

require_once('../../../Database/database.php');
$conexion = new database;
$con = $conexion->conectar();


$sala = isset($_GET['id_sala']);

$sala = 3;
$jugadores = $con->prepare("SELECT username FROM usuario_sala INNER JOIN usuario ON usuario.id_usuario = usuario_sala.id_usuario WHERE id_sala = ?");
$jugadores->execute([$sala]);

$jugador = $jugadores->fetchAll(PDO::FETCH_ASSOC);

foreach ($jugador as $player) {
    echo $player['username'];
}







?>