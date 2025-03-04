<?php

session_start();
require_once("../../includes/ValidarSesion.php");
require_once('../../Database/database.php');
$conexion = new database;
$con = $conexion->conectar();

$partidas = $con->prepare("SELECT * FROM batalla INNER JOIN salas  USING(id_sala) INNER JOIN mapas USING(id_mapa) WHERE id_ganador = :user or id_perdedor = :user2;");
$partidas->bindParam(":user",$_SESSION['id_user'],PDO::PARAM_INT);
$partidas->bindParam(":user2",$_SESSION['id_user'],PDO::PARAM_INT);
$partidas->execute();

$partidas = $partidas->fetchAll(PDO::FETCH_ASSOC);

$ganadas = $con->prepare("SELECT COUNT(*) FROM batalla  WHERE id_ganador = :user ");
$ganadas->bindParam(":user",$_SESSION['id_user'],PDO::PARAM_INT);
$ganadas->execute();

$ganadas = $ganadas->fetchColumn();



$perdidas = $con->prepare("SELECT COUNT(*) FROM batalla  WHERE id_perdedor = :user ");
$perdidas->bindParam(":user",$_SESSION['id_user'],PDO::PARAM_INT);
$perdidas->execute();

$perdidas = $perdidas->fetchColumn();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partidas</title>
    <link rel="stylesheet" href="css/registro_partidas.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

<div class="fondo">

    <div class="salida"> 
            <button onclick="window.location.href='lobby.php'"><i class="bi bi-caret-left-fill"></i> SALIR</button>
    </div>


    <div class="tabla">
        <table>
            <thead>
                <tr>
                    <th>Mapa</th>
                    <th>Sala</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>

            <?php
            
            foreach ($partidas as $partida) { 
                
            ?>

                    <tr>
                        <td><?php echo $partida['mapa']?></td>
                        <td><?php echo $partida['id_sala']; ?></td>
                        <td><?php echo ($partida['id_ganador'] == null) ? "Perdedor"  : "Ganador" ?></td>
                        <td><?php echo date('Y-m-d', strtotime($partida['fecha'])); ?></td>
                    </tr>

            <?php
            
            } ?>


            </tbody>

        </table>
    </div>

    <div class="total">
        <table>
            <tr>
                <th>Ganadas</th>
                <th>Perdidas</th>
            </tr>

            <tr>
                <td><?php echo $ganadas?></td>
                <td><?php echo $perdidas?></td>
            </tr>
        </table>
    </div>
    

</div>
</body>
</html>