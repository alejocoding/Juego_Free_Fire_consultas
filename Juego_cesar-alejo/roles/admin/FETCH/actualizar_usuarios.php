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

    // Verificar si algún usuario cambió su estado a 1 (activo)
    $sql_check = "SELECT correo FROM usuario WHERE id_estado = 1";
    $stmt_check = $con->query($sql_check);
    $usuarios_activados = $stmt_check->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($usuarios_activados)) {
        // Redirigir a correo_desbloqueando.php para enviar correos
        header("Location: envio_correo.php");
        exit();
    } else {
        echo json_encode(["status" => "success", "message" => "Usuarios actualizados correctamente, pero sin cambios en activación."]);
    }

} catch (Exception $e) {
    $con->rollBack(); // Revertir cambios si hay error
    echo json_encode(["status" => "error", "message" => "Error al actualizar usuarios.", "error" => $e->getMessage()]);
}
?>
