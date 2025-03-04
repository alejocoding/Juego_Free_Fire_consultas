<?php
session_start();
header("Content-Type: application/json");
require_once('../../../Database/database.php');
$conexion = new database;
$con = $conexion->conectar();

if (isset($_GET['id_arma'])) {
    $id_arma = $_GET['id_arma'];

    $stmt = $con->prepare("SELECT * FROM armas INNER JOIN categoria c ON c.id_categoria = armas.id_categoria WHERE id_arma = :id_arma");
    $stmt->bindParam(':id_arma', $id_arma, PDO::PARAM_INT);
    $stmt->execute();

    $arma = $stmt->fetch(PDO::FETCH_ASSOC);

    echo json_encode($arma);
} else {
    echo json_encode(["error" => "No se recibió id_arma"]);
}
?>
