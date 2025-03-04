<?php
session_start();
header("Content-Type: application/json"); // Especificamos que la respuesta será JSON

if($data['puntos']>=500){
    $nivel = $con->prepare("UPDATE usuario set nivel =2 WHERE id_usuario =:usuario");
    $nivel->bindParam(":usuario", $_SESSION['id_user'],PDO::PARAM_INT);
    $nivel->execute();
}else{
    $nivel = $con->prepare("UPDATE usuario set nivel =1 WHERE id_usuario =:usuario");
    $nivel->bindParam(":usuario", $_SESSION['id_user'],PDO::PARAM_INT);
    $nivel->execute();
}

// FALTA ACOMODARLO