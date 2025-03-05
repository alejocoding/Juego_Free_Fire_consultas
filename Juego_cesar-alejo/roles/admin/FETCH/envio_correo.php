<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../../PHPmailer/Exception.php';
require '../../../PHPmailer/PHPMailer.php';
require '../../../PHPmailer/SMTP.php';

require_once("../../../Database/database.php");

$conexion = new database;
$con = $conexion->conectar();

if (!$con) {
    die("Error de conexión a la base de datos.");
}

// Validar si hay jugadores desbloqueados
try {
    $correousu = $con->prepare("SELECT correo FROM usuario WHERE id_estado = 1;");
    $correousu->execute();
    $correousu = $correousu->fetchAll(PDO::FETCH_ASSOC);

    if (empty($correousu)) {
        echo '<script>alert("No ha sido activado ningún jugador.")</script>';
        exit;
    }
} catch (Exception $e) {
    die("Error al obtener los usuarios: " . $e->getMessage());
}

// Enviar correos solo si hay usuarios desbloqueados
$mail = new PHPMailer(true);

try {
    // Configuración del servidor SMTP
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'Freefiremailadso@gmail.com'; // Cambia por tu correo
    $mail->Password   = 'arqz llic liaj iruc';       // Cambia por una App Password
    $mail->Port       = 587;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->setFrom('Freefiremailadso@gmail.com', 'FREE FIRE');

    // Recorrer los correos y enviar los mensajes
    foreach ($correousu as $usuario) {
        if (!filter_var($usuario['correo'], FILTER_VALIDATE_EMAIL)) {
            continue; // Si el correo no es válido, se omite
        }

        $mail->addAddress($usuario['correo']);
        $mail->isHTML(true);
        $mail->Subject = 'Tu cuenta ha sido desbloqueada';
        $mail->Body    = '<p>Hola,</p><br><p>Tu cuenta ha sido desbloqueada. ¡Ya puedes jugar Free Fire!</p>';

        $mail->send();
        $mail->clearAddresses(); // Limpiar destinatarios
    }

    echo '<script>alert("Se han actualizado los datos correctamente.")</script>';
    echo '<script>window.location = "../jugadores.php"</script>';

} catch (Exception $e) {
    echo "Hubo un error al enviar los correos: {$mail->ErrorInfo}";
}

?>
