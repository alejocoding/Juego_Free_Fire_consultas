<?php
session_start();

require_once('../../Database/database.php');
$conexion = new database;
$con = $conexion->conectar();

$sql = $con->prepare("SELECT *  FROM armas INNER JOIN categoria on categoria.id_categoria = armas.id_categoria WHERE categoria.id_categoria = 1");
$sql ->execute();

$armas = $sql->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Armas</title>
    <link rel="stylesheet" href="css/armas.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

<div class="fondo">

    <div class="salida"> 
        <button onclick="window.location.href='lobby.php'"><i class="bi bi-caret-left-fill"></i> ARMAS</button>
    </div>

    <!-- LOS ID QUE TENGO ACA SON LAS CATEgorias -->
    <nav class="categorias">
        <a href="#" class="data" data-id="1">PUÑO</a>
        <a href="#" class="data" data-id="2">PISTOLA</a>
        <a href="#" class="data" data-id="3">FRANCOTIRADOR</a>
        <a href="#" class="data" data-id="4">AMETRALLADORA</a>
    </nav>

    <div class="Mostrar_armas" id="armas">

    <?php  foreach ($armas as $arma) {?>

        <div class="cart_arma">
            <?php echo $arma['nombre'] ?>:
            <img src="img/<?php echo $arma['imagen']?>" alt="imagen del arma" class="arma_cart">
            <div class="info_arma">
                Cantidad de usos: <?php echo $arma['intentos'] ?>
            </div>
            <?php echo ($arma['nivel_requerido'] > $_SESSION['nivel_usuario']) ? '<div class="bloqueado"><i class="bi bi-lock-fill"></i></div>' : ''?>
        </div>
        
    <?php }?>
    

    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function () {
    $(".data").click(function (e) {
        e.preventDefault(); // Evita el comportamiento por defecto de los enlaces

        let id_categoria = $(this).data("id");

        $.ajax({
            url: "AJAX/ajax_obtener_armas.php", // Archivo que obtiene las armas según la categoría
            type: "GET",
            data: { id_categoria: id_categoria },
            success: function (data) {
                $("#armas").html(data); // Reemplaza el contenido del div con las armas nuevas
            },
            error: function () {
                console.error("Error al obtener las armas.");
            }
        });
    });
});
</script>
</body>
</html>