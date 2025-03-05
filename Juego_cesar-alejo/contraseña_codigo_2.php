<?php
session_start();
require_once('includes/validar_contra.php');
require_once('Database/database.php');

$conexion = new database;
$con = $conexion->conectar();   


if(isset($_POST['enviar'])){

    $codigo = $_POST['codigo'];
    

    if(empty($codigo)){
        echo "<script>alert('Archivos vacios')</script>";
        exit();
    }
  

    if($codigo == $_SESSION['code']){
    
        header("location: contraseña_restablecer_3.php");
    }else{  
        echo "<script>alert('Codigo incorrecto')</script>";
        
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
            <h1 class="recuperar">CODIGO DE VERIFICACION</h1>
           
                
            <form action="" method= "POST" enctype = "multipart/form-data" class="formulario">

                <label for="codigo">Codigo:*</label>
                <input type="text" class="datos" id="codigo" name="codigo" required>
                <span></span>
      
                <div class="botones">
                    <button type="submit" name ="enviar" class="continuar">Continuar</button>
                </div>
                
                

                
            </form>
                
            
        </div>

        <div class="imagen"></div>

    </div>

    <div class="footer">

        <img src="assets/img/garena.png" alt="">
        <p>DERECHOS DE AUTOR, LIGADO A TERMINOS Y CONDICIONES ©</p>
        <img src="assets/img/Freefirelogo.png" alt="">

    </div>

    
</body>
</html>