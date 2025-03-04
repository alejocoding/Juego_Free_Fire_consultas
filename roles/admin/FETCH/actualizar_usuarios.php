<?php
require_once("../../../Database/database.php");
$conexion = new database;
$con = $conexion->conectar();

// Recibir los datos en JSON
$data = json_decode(file_get_contents("php://input"), true);
$usuarios = $data["usuarios"];

try {
    $con->beginTransaction(); // Iniciar transacción

    foreach ($usuarios as $user) {
        $sql = "UPDATE usuario SET 
                    correo = ?, 
                    vida = ?, 
                    nivel = ?, 
                    puntos = ?, 
                    id_rol = ?, 
                    id_personaje = ?, 
                    id_estado = ? 
                WHERE id_usuario = ?";
        $stmt = $con->prepare($sql);
        $stmt->execute([
            $user["correo"],
            $user["vida"],
            $user["nivel"],
            $user["puntos"],
            $user["id_rol"],
            $user["id_personaje"],
            $user["id_estado"],
            $user["id_usuario"]
        ]);
    }

    $con->commit(); // Confirmar cambios
    echo json_encode(["status" => "success", "message" => "Usuarios actualizados correctamente."]);
} catch (Exception $e) {
    $con->rollBack(); // Revertir cambios si hay error
    echo json_encode(["status" => "error", "message" => "Error al actualizar usuarios.", "error" => $e->getMessage()]);
}
?>