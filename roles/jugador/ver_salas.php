<?php
session_start();
require_once("../../includes/ValidarSesion.php");
require_once('../../Database/database.php');
$conexion = new database;
$con = $conexion->conectar();

if(isset($_SESSION['id_user'])){

    $quitar_sala = $con->prepare("UPDATE usuario_sala SET id_sala = null WHERE id_usuario = :user");
    $quitar_sala->bindParam(":user", $_SESSION['id_user'],PDO::PARAM_INT);
    $quitar_sala->execute();
  
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SALAS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/ver_salas.css">
</head>
<body>

<div class="fondo">
    <div class="salida"> 
        <button onclick="window.location.href='lobby.php'"><i class="bi bi-caret-left-fill"></i> </button>
    </div>

    <div class="mostrar_salas" id="mostrar_sala"></div>
</div>

<script>

document.addEventListener("DOMContentLoaded", () => {

    function actualizarSalas() {
        fetch('AJAX/actualizar_salas.php')
        .then(response => response.json())
        .then(data => {
            let salasHtml = "";

            data.forEach(sala => {
                console.log(sala);
                salasHtml += `
                    <div class="sala">
                        <div class="imagen">
                            <h1>${sala.mapa}</h1>
                            <img src="img/${sala.foto_mapa}" alt="">
                        </div>
                        <div class="data">
                            <div class="timer">
                                Jugadores: ${sala.cantidad_jugadores}/5
                            </div>
                            <form action="unirse_sala.php" method="POST">

                                ${
                                    sala.cantidad_jugadores < 5  
                                    ? (sala.id_estado == 3

                                        ? `<button type='submit' class='unirse' name='id_sala' value='${sala.id_sala}'>UNIRSE</button>` 
                                        : `<button type='button' class='llena' disabled>En partida</button>`)

                                    : `<button type='button' class='llena' disabled>SALA LLENA</button>`}
                            </form>
                        </div>
                    </div>
                `;
            });
              
            document.getElementById('mostrar_sala').innerHTML = salasHtml;
        })
        .catch(error => console.error('Error al obtener las salas:', error));
    }

    setInterval(actualizarSalas, 2000); // Actualizar cada 2 segundos
    actualizarSalas(); // Cargar al inicio


    // AQUI CAMBIO EL ESTADO DE LA SALA
    
    function verificarSalasVacias() {

            fetch('AJAX/verificar_salas_vacias.php')
            .then(response => response.json())
            .then(data => {
                console.log("Salas verificadas:", data);
            })
            .catch(error => console.error("Error al verificar salas vacías:", error));
            }

    // Llamar cada 5 segundos
    setInterval(verificarSalasVacias, 5000);





    
});

actualizarSalas();
</script>
</body> 
</html>