<?php
session_start();
require_once('../../../Database/database.php');
header("Content-Type: application/json"); // Indicar que devolveremos JSON

$conexion = new database;
$con = $conexion->conectar();

$usuario = $_SESSION['id_user'];

// Leer el JSON recibido
$data = json_decode(file_get_contents("php://input"), true);

// Verificar si se recibió el id_sala
if (isset($data['id_sala'])) {
    $sala = $data['id_sala']; // Asignamos el id_sala recibido correctamente
    
    // Consulta para obtener los jugadores de la sala
    $jugadores = $con->prepare("SELECT * 
    FROM usuario_sala 
    INNER JOIN usuario usu ON usu.id_usuario = usuario_sala.id_usuario 
    INNER JOIN personajes pe ON pe.id_personaje = usu.id_personaje 
    WHERE id_sala = ?");
    $jugadores->execute([$sala]);

    // Obtener los jugadores y enviarlos en formato JSON
    $jugador = $jugadores->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($jugador);
} else {
    echo json_encode(["error" => "No se recibió id_sala"]);
}
?>


