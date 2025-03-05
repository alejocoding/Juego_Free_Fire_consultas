<?php
require_once('../../../Database/database.php');
$conexion = new database;
$con = $conexion->conectar();

// Seleccionar todas las salas activas
$sql = $con->prepare("SELECT id_sala FROM salas WHERE id_estado != 3 ");
$sql->execute();
$salas = $sql->fetchAll(PDO::FETCH_ASSOC);

foreach ($salas as $sala) {
    $id_sala = $sala['id_sala'];

    // Contar los jugadores en la sala
    $consulta = $con->prepare("SELECT COUNT(*) as total FROM usuario_sala WHERE id_sala = ?");
    $consulta->execute([$id_sala]);
    $resultado = $consulta->fetch(PDO::FETCH_ASSOC);

    if ($resultado['total'] == 0 || $resultado['total'] == null) {
        // Si la sala no tiene jugadores, cambiar id_estado a 3
        $update = $con->prepare("UPDATE salas SET id_estado = 3, cantidad_jugadores = 0 WHERE id_sala = ?");
        $update->execute([$id_sala]);
    }
}


echo json_encode(["status" => "ok"]);
?>