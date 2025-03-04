<?php
session_start();
require_once('includes/validar_contra.php');
require_once('Database/database.php');

$conexion = new database;
$con = $conexion->conectar();   

if(isset($_POST['enviar'])){

        $contrasena = $_POST['new_contraseña'];
        $contrasena_Verify = $_POST['confirmar_con'];
        echo  $contrasena ."pureba". $contrasena_Verify;

        if (!preg_match('/^[a-zA-Z0-9]+$/', $contrasena)) {

            echo "<script>alert('La contraseña solo puede contener letras y números.');</script>";

        }else if(empty($contrasena) || empty($contrasena_Verify)){

            echo "<script>alert('DATOS VACIOS')</script>";
         
        }else{
            
            $encripted = password_hash($contrasena, PASSWORD_BCRYPT, array("cost" => 12));

            if(password_verify($contrasena_Verify, $encripted)){

                $sql = $con->prepare("UPDATE usuario SET password = :contrasena WHERE id_usuario = :user");
                $sql->bindParam(":contrasena", $encripted,PDO::FETCH_ASSOC);
                $sql->bindParam(":user",$_SESSION['user']);

                $sql->execute();


                header("location: includes/destruir_contra.php");

            }else{
                echo "<script>alert('CONTRASEÑAS DESIGUALES')</script>";
            }
        }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <link rel="icon" type="image/png" href="assets/img/garena.png">
    <link rel="stylesheet" href="Css/contraseña.css">

</head>
<body>
    
<?php include('template/header_2.html')?>

    <div class="contenido_grid">

        <div class="seccion">

            <img src="assets\img/Freefirelogo.png" alt="logo" class="free_fire">
            <h1 class="recuperar">CAMBIAR CONTRASEÑA</h1>
           
                
            <form action="" method= "POST" enctype = "multipart/form-data" class="formulario">

                <label for="new_contraseña">Nueva contraseña:*</label>
                <input type="text" class="datos" id="new_contraseña" name="new_contraseña" required>
                <span></span>

                <label for="confirmar_con">Confirmar Contraseña:*</label>
                <input type="text" class="datos" id="confirmar_con" name="confirmar_con" required>
                <span></span>
      
                <div class="botones">
                    <button type="submit" class="continuar" name ="enviar">Cambiar</button>
                </div>
                
                

                
            </form>
                
            
        </div>

        <div class="imagen"></div>

    </div>

    <?php include('template/footer.html')?>

    
</body>
</html>