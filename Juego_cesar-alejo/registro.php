<?php
require_once('Database/database.php');

$conexion = new database;
$con = $conexion->conectar();


if(isset($_POST['submit'])){

    $usuario =$_POST['username'];
    $correo =$_POST['correo'];
    $contrasena = $_POST['contrasena'];
    $val_contra = $_POST['con_contrasena'];
   
    if(empty($usuario)||empty( $correo)|| empty($contrasena) || empty($val_contra)){

        echo "<script>alert('DATOS VACIOS')</script>";
        echo "<script>window.location.href='registro.php'</script>";

    }else if(strlen($usuario) > 11 || !preg_match('/^[a-zA-Z0-9]+$/', $usuario)){
        echo "<script>alert('El Username debe tener menos de 10 caracteres, Solo numeros y letras')</script>";
        echo "<script>window.location.href='registro.php'</script>";

    }else if(!preg_match('/^[a-zA-Z0-9][a-zA-Z0-9._%+-]*@gmail\.com$/', $correo)){

        echo "<script>alert('El correo debe ser una dirección válida de Gmail (@gmail.com).');</script>";
        echo "<script>window.location.href='registro.php';</script>";

    }else if(!preg_match('/^[a-zA-Z0-9]+$/', $contrasena) || strlen($contrasena) <5) {

        echo "<script>alert('La contraseña debe tener como minimo 5 caracteres, solo puede contener letras y números .');</script>";
        echo "<script>window.location.href='registro.php'</script>";

    }else{
        $encripted = password_hash($contrasena, PASSWORD_BCRYPT, array("cost" => 12));

        if(password_verify($val_contra,$encripted)){

            $sql = $con->prepare("SELECT * FROM usuario WHERE username =:usuario");
            $sql->bindParam(":usuario",$usuario, PDO::PARAM_STR);
            $sql->execute();
       
    
            if($sql->rowCount() > 0){
    
                echo "<script>alert('Usuario ya registrado ')</script>";
                
            }else{
                
                try{
                    $sql2 = $con->prepare("INSERT INTO usuario (username,password,correo,id_rol,id_estado) VALUES (:user,:pass,:mail,2,2)");
                    $sql2->bindParam(":user",$usuario,PDO::PARAM_STR);
                    $sql2->bindParam(":pass",$encripted,PDO::PARAM_STR);
                    $sql2->bindParam(":mail",$correo,PDO::PARAM_STR);
    
                    $sql2->execute();
                    
                   
    
                    if($sql2){
                        echo "<script>alert('Registrado correctamente')</script>";
                        echo "<script>window.location.href='login.php'</script>";
                    }else{
                        echo "<script>alert('Error de registro, intentalo de nuevo')</script>";
                    }
    
                }catch(PDOException $e){
                    echo "<script>alert('Correo duplicado')</script>";
                   
                }
               
                
            }   

        }else{
            echo "<script>alert('CONTRASEÑAS DESIGUALES')</script>";
       
        }

        // VALIDACION DE USUARIO EXISTENTE
       

    }



    

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="icon" type="image/png" href="assets/img/garena.png">
    <link rel="stylesheet" href="css/registro.css">
    
</head>
<body>

<?php include('template/header_2.html')?>

<div class="contenido_grid">

    <div class="registro">
        <img src="assets/img/Freefirelogo.png" alt="IMAGEN DE FREE FIRE" class="free_fire">
        <p class="titulo">CREA TU CUENTA FREE FIRE</p>

        <form action="" method="POST" class="formulario">

        <label for="username" >username:*</label>
        <input type="text" id="username" name ="username" class="input" required>
        <span></span>

        <label for="correo">Correo:*</label>
        <input type="text" id="correo" name ="correo" class="input" required>
        <span></span>

        <label for="contraseña">Contraseña:*</label>
        <input type="password" id="contrasena" name ="contrasena" class="input" required>
        <span></span>

        <label for="con_contraseña">Confirmar contraseña:*</label>
        <input type="password" id="con_contrasena" name ="con_contrasena" class="input" required>
        <span></span>

        <input type="submit" name="submit" value="Crear Cuenta" class="input_submit">
        <span></span>

        </form>

        <button type="buttom" class="login" onclick="window.location.href='login.php'"> ¿Ya tienes cuenta? <p>ingresa aqui</p></button>
    </div>

    <img src="assets/img/fondo_registro.png" alt="" class="img_fondo">
</div>
    <?php include('template/footer.html')?>
</body>
</html>