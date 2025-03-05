<?php
session_start();
require_once('../../../Database/database.php');
$conexion = new database;
$con = $conexion->conectar();


$usuario = $_SESSION['id_user'] ?? null;
if (!$usuario) {
    echo json_encode(["status" => "error", "mensaje" => "Usuario no autenticado"]);
    exit();
}

// Obtener la vida del usuario
$query = $con->prepare("SELECT vida FROM usuario WHERE id_usuario = :user");
$query->bindParam(":user", $usuario, PDO::PARAM_INT);
$query->execute();
$vida = $query->fetchColumn();



if ($vida<=0) {
    // Eliminar al usuario de la sala
    $retiro = $con->prepare("UPDATE usuario_sala SET id_sala = null, fecha_ingreso = null WHERE id_usuario = :user");
    $retiro->bindParam(":user", $usuario, PDO::PARAM_INT);
    $retiro->execute();

    // Restar cantidad de jugadores en la sala
    
    $id_sala = $_GET['id_sala'] ?? null;
    if ($id_sala) {
         $actualizacion = $con->prepare("UPDATE salas SET cantidad_jugadores = GREATEST(0, cantidad_jugadores - 1) WHERE id_sala = :sala");
         $actualizacion->bindParam(":sala", $id_sala, PDO::PARAM_INT);
         $actualizacion->execute();
     }

    // Restaurar la vida del jugador
    $restauracion = $con->prepare("UPDATE usuario SET vida = 100 WHERE id_usuario = :user");
    $restauracion->bindParam(":user", $usuario, PDO::PARAM_INT);
    $restauracion->execute();

    echo json_encode(["status" => "dead", "mensaje" => "Has muerto, serás enviado al lobby"]);


} else {
    echo json_encode(["status" => "alive", "vida" => $vida]);
}
exit();

