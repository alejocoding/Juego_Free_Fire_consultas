<?php
session_start();
require_once("../../includes/ValidarSesion.php");
require_once('../../Database/database.php');
$conexion = new database;
$con = $conexion->conectar();


if(isset($_POST['id_sala'])){

    $cupo = $con->prepare("SELECT cantidad_jugadores FROM salas where id_sala = :sala");
    $cupo->bindParam(":sala",$_POST['id_sala'],PDO::PARAM_INT);
    $cupo->execute();
    $cantidad= $cupo->fetchColumn();
   
    if($cantidad >= 0 && $cantidad <5 ){
        
        $update = $con->prepare("UPDATE salas SET cantidad_jugadores = cantidad_jugadores + 1 WHERE id_sala = :sala ");
        $update->bindParam(":sala",$_POST['id_sala'], PDO::PARAM_INT);
        $update->execute();

        $actualizar = $con->prepare("INSERT INTO usuario_sala (id_usuario, id_sala) 
            VALUES (:user, :sala)
            ON DUPLICATE KEY UPDATE  id_sala = VALUES(id_sala)");
        $actualizar->bindParam(":user", $_SESSION['id_user'], PDO::PARAM_INT);
        $actualizar->bindParam(":sala", $_POST['id_sala'], PDO::PARAM_INT);
        $actualizar->execute(); 
        
        header("location: sala.php?id_sala=" .$_POST['id_sala']);   
        exit();
      
    }else{
        
        header("location: ver_salas.php");
        exit();
    }
   

}


?>


