<?php
session_start();

require_once('../../../Database/database.php');
$conexion = new database;
$con = $conexion->conectar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $arma_id = $_POST['Armas'] ?? null;
    $atacado = $_POST['persona'] ?? null;
    $usuario = $_SESSION['id_user'];
    $mensaje_extra = "No se realizó ningún ataque."; // Asegurar valor por defecto

    if ($arma_id && $atacado) {  
            
        // Obtener el daño del arma
        $daño_arma = $con->prepare("SELECT puntos_daño FROM categoria 
                                    INNER JOIN armas ON armas.id_categoria = categoria.id_categoria 
                                    WHERE id_arma = ?");
        $daño_arma->execute([$arma_id]);
        $daño = $daño_arma->fetchColumn();

        // PROBABILIDAD DE HEADSHOT
        $probabilidad = rand(1, 100);
        if ($probabilidad <= 9) { // 9% de probabilidad
            $daño = 75;
            $mensaje_extra = "¡Golpe en la cabeza!";
        } else {
            $mensaje_extra = "Golpe normal.";
        }

        // Registrar el ataque
        $ataque = $con->prepare("INSERT INTO daño_batalla (id_usuario, id_atacado, id_arma, dano_causado) 
                                 VALUES (:user, :atacado, :arma, :dano)");
        $ataque->bindParam(":user", $usuario, PDO::PARAM_INT);
        $ataque->bindParam(":atacado", $atacado, PDO::PARAM_INT);
        $ataque->bindParam(":arma", $arma_id, PDO::PARAM_INT);
        $ataque->bindParam(":dano", $daño, PDO::PARAM_INT);
        $ataque->execute(); 

        // Reducir la vida del jugador atacado
        $consultaVida = $con->prepare("SELECT vida FROM usuario WHERE id_usuario = :atacado");
        $consultaVida->bindParam(":atacado", $atacado, PDO::PARAM_INT);
        $consultaVida->execute();
        $vida = $consultaVida->fetchColumn();

        if ($vida - $daño < 0) {
            // El jugador muere → Atacante gana 100 puntos
            $muerte = $con->prepare("UPDATE usuario SET puntos = puntos + 100 WHERE id_usuario = :id_user");
            $muerte->bindParam(":id_user", $usuario, PDO::PARAM_INT);
            $muerte->execute();

            

            // Si se muere pailas
            $stmt = $con->prepare("UPDATE usuario SET vida = 0 WHERE id_usuario = :atacado");
            $stmt->bindParam(":atacado", $atacado, PDO::PARAM_INT);
            $stmt->execute();

            $respuesta = ["status" => "success", "mensaje" => "USUARIO ELIMINADO +100 PUNTOS"];
        } else {
            // Actualizar vida y puntos del atacado
            $bajar = $con->prepare("UPDATE usuario SET vida = vida - :dano1, 
                                                    puntos = GREATEST(0, puntos - :dano2) 
                                    WHERE id_usuario = :atacado");
            $bajar->bindParam(":atacado", $atacado, PDO::PARAM_INT);
            $bajar->bindParam(":dano1", $daño, PDO::PARAM_INT);
            $bajar->bindParam(":dano2", $daño, PDO::PARAM_INT);
            $bajar->execute();

            // Sumar puntos al atacante
            $subir_user = $con->prepare("UPDATE usuario SET puntos = puntos + :dano WHERE id_usuario = :id_user");
            $subir_user->bindParam(":id_user", $usuario, PDO::PARAM_INT);
            $subir_user->bindParam(":dano", $daño, PDO::PARAM_INT);
            $subir_user->execute();

            $respuesta = ["status" => "success", "mensaje" => "Ataque registrado con éxito"];
        }
    } else {
        $respuesta = ["status" => "error", "mensaje" => "Faltan datos", "detalle" => $mensaje_extra];
    }

    header('Content-Type: application/json');
    echo json_encode($respuesta);
}
?>
