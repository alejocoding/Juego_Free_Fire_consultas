<?php
session_start();

require_once('../../Database/database.php');
$conexion = new database;
$con = $conexion->conectar();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SALA</title>
    <link rel="stylesheet" href="css/Sala_iniciar.css">
</head>
<body>


<div class="fondo">

    <div class="mostrar_personajes" id="users">

    </div>
    
</div>
    


<script>

$(document).ready(function(){

    $.ajax({
        url:'AJAX/mostrar_jugadores.php',
        type:'GET',
        dataType:'json',
        success: function(data){

            $("#users").html(data);

        }
    });

});
</script>
</body>
</html>