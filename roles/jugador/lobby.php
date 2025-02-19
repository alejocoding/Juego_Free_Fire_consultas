<?php
session_start();

require_once('../../Database/database.php');
$conexion = new database;
$con = $conexion->conectar();

$sql = $con->prepare("SELECT * FROM usuario INNER JOIN personajes ON personajes.id_personaje = usuario.id_personaje WHERE id_usuario = :usuario ");
$sql->bindParam(":usuario", $_SESSION['id_user'],PDO::PARAM_INT);
$sql->execute();

$data = $sql->fetch(PDO::FETCH_ASSOC);

$sql2 =$con->prepare("SELECT * FROM mapas");
$sql2->execute();

$mapa = $sql2->fetchAll(PDO::FETCH_ASSOC);

// COLOCO DATOS DEL PERSONAJE
$_SESSION['id_personaje'] = $data['id_personaje'];
$_SESSION['nivel_usuario'] = $data['nivel'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lobby</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/lobby.css">
  
</head>
<body>

<main class="lobby">


    <div class="scroll">
        
    </div>
    <section class="user_data">
        <img src="../../assets/img/<?php echo $data['foto_personaje'] ?>" alt="">
        <div class="data">
            Username: <?php echo $data['username'] ?>
            <br>
            Nivel - <?php echo $data['nivel'] ?>
        </div>
    </section>


    <section class="opciones">

        <button type="button" class="personajes" onclick="window.location.href='personajes.php'"> <img src="img/personajes.png" alt=""> <p>Personajes</p></button>
        <button type="button" class="armas" onclick="window.location.href='Armas.php'"><img src="img/pistolas.png" alt=""> <p>Armas</p></button>
    </section>


    <button class="Salir" onclick="window.location.href='../../includes/Sesion_destroy.php'"><img src="img/salir.png" alt=""> <p>CERRAR SESION</p></button>
   

    <section class="mapas">
        <div class="imagen">
            <img src="img/<?php echo $mapa[0]['foto_mapa'] ?>" alt="">
            <div class="info_mapa">
            <?php echo $mapa[0]['mapa']; ?>
            <i class="bi bi-bootstrap-reboot"></i>
            </div>
            
        </div>
       
        <div class="puntos">
            Puntos: <br>
            <?php echo $data['puntos']?>
        </div>
    </section>

    <button class="Buscar_sala" onclick="window.location.href='ver_salas.php'"> <h1>BUSCAR SALA</h1></button>


    <section class="personaje_central"> 

        <h1><?php echo $data['nombre'] ?></h1>

        <img src="img/<?php echo $data['foto_personaje'] ?>" alt="">

    </section>


    <div class="aviso_horizontal">
        Rota la pantalla de tu celular para poder jugar
    </div>


</main>
    
</body>
</html>