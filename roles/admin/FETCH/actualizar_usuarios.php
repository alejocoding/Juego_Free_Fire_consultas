<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../../PHPMailer/Exception.php';
require '../../../PHPMailer/PHPMailer.php';
require '../../../PHPMailer/SMTP.php';

require_once("../../../Database/database.php");
$conexion = new database;
$con = $conexion->conectar();

// Recibir los datos en JSON
$data = json_decode(file_get_contents("php://input"), true);
$usuarios = $data["usuarios"];



try {
    $con->beginTransaction(); // Iniciar transacción

    foreach ($usuarios as $user) {
       

        $enviar = $con->prepare("SELECT id_estado from usuario WHERE id_usuario = ?");
        $enviar->execute([$user['id_usuario']]);
        $Verificar = $enviar ->fetchColumn();


        $user['id_personaje'] = $user[  'id_personaje'] ?? null;
        $user['vida'] = empty($user['vida']) ? null : $user['vida'];
        $user['puntos'] = empty($user['puntos']) ? null : $user['puntos'];
        $user['nivel'] = empty($user['nivel']) ? null : $user['nivel'];
      

        $sql = "UPDATE usuario SET 
                    correo = ?, 
                    vida = ?, 
                    nivel = ?, 
                    puntos = ?, 
                    id_rol = ?, 
                    id_personaje = NULLIF(?, 0), 
                    id_estado = ? 
                WHERE id_usuario = ?";
        $stmt = $con->prepare($sql);
        $stmt->execute([
            $user["correo"],
            $user["vida"],
            $user["nivel"],
            $user["puntos"],
            $user["id_rol"],
            $user["id_personaje"],
            $user["id_estado"],
            $user["id_usuario"]
        ]);

        if($Verificar == 2 && $user['id_estado'] == 1){


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
                    $mail->addAddress($user['correo']);   //Add a recipient
                                //Name is optional
                    

                

                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = 'FREE FIRE usuario activo';
                    $mail->Body    = 'Su usuario ya ha sido activado, ven y juega :3' ;
                    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                    $mail->send();
                
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }


            

        }

    }

    $con->commit(); // Confirmar cambios
    echo json_encode(["status" => "success", "message" => "Usuarios actualizados correctamente."]);
} catch (Exception $e) {
    $con->rollBack(); // Revertir cambios si hay error
    echo json_encode(["status" => "error", "message" => "Error al actualizar usuarios.", "error" => $e->getMessage()]);
}
?>