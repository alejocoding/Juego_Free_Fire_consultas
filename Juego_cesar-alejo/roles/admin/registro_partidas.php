<?php
session_start();
require_once("../../Database/database.php");
$conexion = new database;
$con = $conexion->conectar();
$registro_partidas = $con->prepare("SELECT * FROM batalla
INNER JOIN usuario 
ON batalla.id_ganador = usuario.id_usuario 
OR batalla.id_perdedor = usuario.id_usuario;");
$registro_partidas->execute();

$registro = $registro_partidas->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administrador</title>
    <link rel="icon" href="img/admin.png">
    <link rel="stylesheet" href="css/registro_partidas.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

   
    <div class="sidebar">
        <h2>Administrador</h2>
        <ul>
            <li><a href="index.php"><i class="bi bi-house-door"></i>inicio</a></li>
            <li><a href="jugadores.php"><i class="bi bi-people"></i>Jugadores</a></li>
            <li><a href="registro_partidas.php"><i class="bi bi-file-text"></i>Registro partidas</a></li>
            <li><a href="#reportes"><i class="bi bi-gear"></i>Modificar Usuarios</a></li>
            <li><a href="../../includes/Sesion_destroy.php"><i class="bi bi-box-arrow-left"></i>Cerrar Sesion</a></li>
        </ul>
    </div>

    <div class="content">
        <h1>Seccion de registro partidas</h1>
        
        <div class="barra_busqueda">

        <input type="text" placeholder="Buscar Usuario por username">

        </div>

        <div class="tabla">

       
            <table>
                <thead>
                    <tr>
                        <td>id_usuario</td>
                        <td>username</td>
                        <td>Sala</td>
                        <td>Estado</td>
                        <td>Fecha</td>
                    </tr>
                    
                </thead>
                <tbody>
                        <?php
                        foreach ($registro as $batalla) { 
                        ?>
                            <tr>
                                <td><?php echo $batalla['id_usuario']; ?></td>
                                <td><?php echo $batalla['username']; ?></td>
                                <td><?php echo $batalla['id_sala']; ?></td>
                                <td><?php echo ($batalla['id_ganador'] == $batalla['id_usuario']) ? "Ganador" : "Perdedor"; ?></td>
                                <td><?php echo date('Y-m-d', strtotime($batalla['fecha'])); ?></td>
                            </tr>
                        <?php
                        } 
                ?>
            </tbody>
            </table>
        </div>
    </div>



</body>
</html>