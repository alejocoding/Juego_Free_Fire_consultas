<?php
require_once('../../../Database/database.php');
$conexion = new database;
$con = $conexion->conectar();

if (!isset($_GET['id_sala'])) {
    echo json_encode(["error" => "ID de sala no proporcionado"]);
    exit;
}

$id_sala = $_GET['id_sala'];

 // Obtener al jugador con más vida
 $query = $con->prepare("SELECT id_usuario, username, vida FROM usuario WHERE id_usuario IN (SELECT id_usuario FROM usuario_sala WHERE id_sala = :id_sala) ORDER BY vida DESC, RAND() LIMIT 1");
$query->bindParam(":id_sala", $id_sala, PDO::PARAM_INT);
$query->execute();
$ganador = $query->fetch(PDO::FETCH_ASSOC);


if ($ganador) {
    echo json_encode([
        "status" => "success",  // ✅ Agregar el estado correcto
        "ganador" => $ganador['username'],
        "id_ganador" => $ganador['id_usuario']
    ]);
} else {
    echo json_encode(["status" => "error", "message" => "No se encontró ningún jugador en la sala."]);
}

?>