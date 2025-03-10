<?php


    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/Exception.php';
    require 'PHPMailer/PHPMailer.php';
    require 'PHPMailer/SMTP.php';


require_once('Database/database.php');

$conexion = new database;
$con = $conexion->conectar();   


if(isset($_POST['enviar'])){

    $elEmail = $_POST['input_correo'];
    
    if(empty($_POST['input_correo'])){
        echo "<script>alert('Archivos vacios')</script>";
        die();
    }


    $Cemail = $con->prepare("SELECT correo FROM usuario WHERE correo = '$elEmail' AND id_estado = 1");
    $Cemail->execute();

    
    $Cenviar = $Cemail->fetchColumn();

    $user = $con->prepare("SELECT * FROM usuario WHERE correo = '$elEmail' AND id_estado = 1");
    $user->execute();

    $usuario = $user->fetch(PDO::FETCH_ASSOC);

    if($usuario){

        //generamos un número aleatorio
        $numero_aleatorio = rand(1000,9999);

        session_start();

        $_SESSION['user'] = $usuario['id_usuario'];
        $_SESSION['code'] = $numero_aleatorio;

    }

    if($Cenviar){

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'Freefiremailadso@gmail.com';                     //SMTP username
            $mail->Password   = 'arqz llic liaj iruc';                               //SMTP password
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('freefiremailadso@gmail.com', 'FREE FIRE');
            $mail->addAddress($Cenviar);     //Add a recipient
                           //Name is optional
            

         

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'FREE FIRE REESTABLECER';
            $mail->Body    = 'Su codigo para restablecer contraseña es el siguiente: ' . $_SESSION['code'];
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            header("location: contraseña_codigo_2.php");
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }


    }else{
        echo "<script>alert('correo no encontrado')</script>";
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
            <h1 class="recuperar">RECUPERAR CONTRASEÑA</h1>
            <p class="oracion">INGRESA EL CORREO REGISTRADO</p>
                
            <form action="" method= "POST" enctype = "multipart/form-data" class="formulario">

                <label for="input_correo">Correo:*</label>
                <input type="mail" class="datos" id="input_correo" name="input_correo" required>
                <span></span>

                <div class="botones">
                    <button type="button" onclick="window.location.href='login.php'" class="volver">Volver</button>
                    <button type="submit" name = "enviar" class="continuar">Continuar</button>
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