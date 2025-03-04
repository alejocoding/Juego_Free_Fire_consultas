<?php
session_start();
header("Content-Type: application/json"); // Especificamos que la respuesta será JSON

require_once('../../../Database/database.php');
$conexion = new database;
$con = $conexion->conectar();

$id_categoria = isset($_GET['id_categoria']) ? (int) $_GET['id_categoria'] : 1;

$sql = $con->prepare("SELECT * FROM armas INNER JOIN categoria ON categoria.id_categoria = armas.id_categoria WHERE categoria.id_categoria = ?");
$sql->execute([$id_categoria]);
$armas = $sql->fetchAll(PDO::FETCH_ASSOC);

// Agregamos el nivel del usuario en la sesión
foreach ($armas as &$arma) {
    $arma['nivel_usuario'] = $_SESSION['nivel_usuario'] ?? 0; // Si no hay sesión, asumimos nivel 0
}

echo json_encode($armas);
exit;