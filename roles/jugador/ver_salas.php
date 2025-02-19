<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SALAS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/ver_salas.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="fondo">

        <div class="salida"> 
            <button onclick="window.location.href='lobby.php'"><i class="bi bi-caret-left-fill"></i></button>
        </div>
    
        <div class="mostrar_salas" id="mostrar_sala">

    
        </div>
</div>

<script>

$(document).ready(function() {

    function actualizarSalas(){

        $.ajax({
            url: 'AJAX/actualizar_salas.php',
            type: 'GET',
            dataType: 'json',
            success: function(data){

                let SalasHtml ="";

                data.forEach(sala => {

                    SalasHtml +=`
                    
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
                                    ${sala.cantidad_jugadores < 5 
                                        ? `<button type='submit' class='unirse' name='id_sala' value='${sala.id_sala}'>UNIRSE</button>` 
                                        : `<button type='button' class='llena' disabled>SALA LLENA</button>`}
                                </form>
                            </div>
                        </div>
                     `;
                    
                });

                $('#mostrar_sala').html(SalasHtml); // CON EL .HTML LO QUE HAGO ES INSERTAR O REEMPLAZAR INFORMACION
            }

        });
    }

    setInterval(actualizarSalas, 5000); // Actualizar cada 5 segundos
    actualizarSalas(); // Cargar al inicio
});


</script>
</body>
</html>