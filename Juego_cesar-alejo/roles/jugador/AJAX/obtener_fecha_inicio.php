<?php

require_once('../../../Database/database.php');
$conexion = new database;
$con = $conexion->conectar();

if(isset($_GET['id_sala'])){
    $id_sala = $_GET['id_sala'];

    $consulta = $con->prepare("SELECT fecha_inicio FROM salas WHERE id_sala = :id_sala");
    $consulta->bindParam(":id_sala", $id_sala, PDO::PARAM_INT);
    $consulta->execute();
    $resultado = $consulta->fetch(PDO::FETCH_ASSOC);

    if($resultado) {
        echo json_encode(["fecha_inicio" => $resultado['fecha_inicio']]);
    } else {
        echo json_encode(["error" => "No se encontró la fecha de inicio"]);
    }
}
?>
