<?php
session_start();
require_once('../../../Database/database.php');

$conexion = new database;
$con = $conexion->conectar();

$id_categoria = isset($_GET['id_categoria']) ? $_GET['id_categoria'] : 1; // Por defecto, mostrar "PUÑO"

$sql = $con->prepare("SELECT * FROM armas INNER JOIN categoria ON categoria.id_categoria = armas.id_categoria WHERE categoria.id_categoria = ?");
$sql->execute([$id_categoria]);
$armas = $sql->fetchAll(PDO::FETCH_ASSOC);

foreach ($armas as $arma) { ?>
    <div class="cart_arma">
        <?php echo $arma['nombre'] ?>:
        <img src="img/<?php echo $arma['imagen'] ?>" alt="imagen del arma" class="arma_cart">
        <div class="info_arma">
            Cantidad de usos: <?php echo $arma['intentos'] ?>
        </div>
        <?php echo ($arma['nivel_requerido'] > $_SESSION['nivel_usuario']) ? '<div class="bloqueado"><i class="bi bi-lock-fill"></i></div>' : '' ?>
    </div>
<?php } ?>