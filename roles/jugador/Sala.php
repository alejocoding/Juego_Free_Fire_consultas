<?php
session_start();
require_once("../../includes/ValidarSesion.php");
require_once('../../Database/database.php');
$conexion = new database;
$con = $conexion->conectar();



if(isset($_POST['salir'])){
    
    $documento = $_SESSION['id_user'];
    $retiro = $con->prepare("UPDATE usuario_sala SET id_sala = null WHERE id_usuario = :user");
    $retiro->bindParam(":user",$documento,PDO::PARAM_INT);
    $retiro->execute();

    $actualizacion = $con->prepare("UPDATE salas SET cantidad_jugadores = GREATEST(0,cantidad_jugadores - 1) WHERE id_sala = :sala");
    $actualizacion->bindParam(":sala",$_GET['id_sala'],PDO::PARAM_INT);
    $actualizacion->execute();

    header("location: ver_salas.php");
    exit();


}





$mapa = $con->prepare("SELECT * FROM mapas WHERE nivel_requerido = :nivel ");
$mapa->bindParam(":nivel",$_SESSION['nivel_usuario'],PDO::PARAM_INT);
$mapa->execute();

$mapa= $mapa->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SALA</title>
    <link rel="stylesheet" href="css/Sala_iniciar.css">
    <link rel="icon" type="image/png" href="img/garena.png">
</head>
<body>


<div class="fondo">
   

    <form method="POST">
        <button class="salir"  name="salir" type="submit">SALIR</button>
    </form>
    
    <main class="contenido">

    <div class="mapa">
        <?php echo $mapa['mapa'] ?>
        <img src="img/<?php echo $mapa['foto_mapa']?>" alt="">
    </div>
   
    <div class="mostrar_personajes" id="users">
       

    </div>
    
    </main>

    <div class="Empezando" id ="empezando">
        <img src="img/chistoso.png" alt="">
        Empezando ...
    </div>

   
</div>
    



<script>

document.addEventListener("DOMContentLoaded", function () {
    // Obtener el ID de la sala desde la URL
    const urlParams = new URLSearchParams(window.location.search);
    const id_sala = urlParams.get("id_sala"); 

    function actualizarJugadores() {
        if (id_sala) {
            fetch("AJAX/mostrar_jugadores.php", { 
                method: "POST", 
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ id_sala: id_sala }) 
            })
            .then(response => response.json()) 
            .then(data => {
                
                let usersDiv = document.getElementById("users");
                usersDiv.innerHTML = ""; // Limpiar el div antes de mostrar los datos
                let divHTML = "USUARIOS EN SALA DE ESPERA:"; 
                data.forEach(player => {
                    divHTML +=` 
                        <div class="users">
                            
                            <img src="img/caras/${player.foto_personaje}" alt="">
                            <div class="info">
                            <h1> ${player.username}</h1>
                            
                            </div>

                        </div>  
                    `;
                   
                });

                document.getElementById('users').innerHTML = divHTML
                
                // Si hay 4 jugadores en la sala, esperar 10 segundos antes de redirigir
                const alert = document.getElementById('empezando');
                if (data.length === 3) {

                    
                    alert.style.display="flex";
                    
                    setTimeout(() => {
                        window.location.href = "BATALLA.php?id_sala=" + id_sala;
                    }, 5000); // 5 segundos
                }else{
                    alert.style.display="none";
                }
            })
            .catch(error => console.error("Error:", error));
        } else {
            console.error("No se encontró el ID de la sala en la URL");
        }
    }

    actualizarJugadores(); // Llamar la función al cargar la página
    setInterval(actualizarJugadores, 2000); // Repetir cada 1 segundos
});

</script>
</body>
</html>