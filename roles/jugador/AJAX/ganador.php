<?php

session_start();
require_once('../../../Database/database.php');
$conexion = new database;
$con = $conexion->conectar();

$usuario = $_SESSION['id_user'];

$id_sala = $_GET['id_sala'] ?? null;



$batalla = $con->prepare("INSERT INTO batalla (id_sala,id_ganador) VALUES (:sala,:user)");
$batalla->bindParam("sala",$id_sala,PDO::PARAM_INT);
$batalla->bindParam("user",$usuario,PDO::PARAM_INT);
$batalla->execute();


$ganador = $con->prepare("INSERT INTO reporte_usuario (id_usuario, partidas_jugadas, partidas_ganadas)
            VALUES (:user, 1, 1)
            ON DUPLICATE KEY UPDATE  
            partidas_jugadas = partidas_jugadas + 1, 
            partidas_ganadas = partidas_ganadas + 1");
$ganador->bindParam("user",$usuario,PDO::PARAM_INT);
$ganador->execute();


$retiro = $con->prepare("UPDATE usuario_sala SET id_sala = null, fecha_ingreso = null WHERE id_usuario = :user");
$retiro->bindParam(":user", $usuario, PDO::PARAM_INT);
$retiro->execute();

// Restaurar la vida del jugador
$restauracion = $con->prepare("UPDATE usuario SET vida = 100 WHERE id_usuario = :user");
$restauracion->bindParam(":user", $usuario, PDO::PARAM_INT);
$restauracion->execute();



    if ($id_sala) {
         $actualizacion = $con->prepare("UPDATE salas SET cantidad_jugadores = 0 , id_estado = 3 WHERE id_sala = :sala");
         $actualizacion->bindParam(":sala", $id_sala, PDO::PARAM_INT);
         $actualizacion->execute();
    }else{
        echo "error con la sala";
    }
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GANASTE</title>
</head>
<body>

    <div class="alerta">
        <img src="../img/ganador.png" alt="Perdedor" class="icono">
        <h2>¡BOOYAH!</h2>
        <p>Tu personaje ha ganado la partida.</p>
        <p>Serás redirigido al lobby en <span id="contador">5</span> segundos...</p>
    </div>

    <script>
        let tiempo = 5;
        const contador = document.getElementById("contador");

        setInterval(() => {
            tiempo--;
            contador.innerText = tiempo;
            if (tiempo <= 0) {
                window.location.href = "../lobby.php"; 
            }
        }, 1000);
    </script>

<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1a1a1a;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* Alerta de derrota */
        .alerta {
            background-color:rgb(54, 158, 76);
            text-align: center;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(255, 77, 77, 0.5);
            width: 90%;
            max-width: 400px;
            animation: fadeIn 1s ease-in-out;
        }

        /* Icono de derrota */
        .alerta .icono {
            width: 80px;
            height: 80px;
            margin-bottom: 10px;
        }

        /* Texto */
        h2 {
            font-size: 24px;
            margin: 10px 0;
        }

        p {
            font-size: 16px;
            margin: 5px 0;
        }

        /* Animación de aparición */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.8);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>

    
</body>
</html>
