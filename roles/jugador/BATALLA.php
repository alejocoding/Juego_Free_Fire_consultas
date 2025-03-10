<?php
session_start();
require_once("../../includes/ValidarSesion.php");
require_once('../../Database/database.php');
$conexion = new database;
$con = $conexion->conectar();


// CONSULTA DE LAS Armas

$armas = $con->prepare("SELECT * FROM armas WHERE nivel_requerido <= :nivel");
$armas->bindParam(":nivel", $_SESSION['nivel_usuario'],PDO::PARAM_INT);
$armas->execute();



$armas =  $armas->fetchAll(PDO::FETCH_ASSOC);

if(isset($_GET['id_sala'])){
    $bloquear = $con->prepare("UPDATE salas SET id_estado = 4 WHERE id_sala = :sala");
    $bloquear->bindParam(":sala",$_GET['id_sala'],PDO::PARAM_INT);
    $bloquear->execute();


    $ahora = date('Y-m-d H:i:s');
    $contador = $con->prepare("UPDATE salas SET fecha_inicio = :inicio WHERE id_sala = :sala");
    $contador->bindParam(":sala",$_GET['id_sala'],PDO::PARAM_INT);
    $contador->bindParam(":inicio", $ahora, PDO::PARAM_STR);
    $contador->execute();
   
}




?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PARTIDA</title>
    <link rel="stylesheet" href="css/batalla.css">
</head>
<body>

<div class="fondo">

    <div class="salir"> <div id="contador" style="color: white;">Tiempo: 0h 0m 0s</div></div>

    <div class="informacion"> ESCOGE A QUIEN ATACAR</div>
    <div class="users" id="users">

        </div>


        <form class="ataques" method="post" id="ataque">
            

            <div class="Container_armas">
                <select name="Armas" id="eleccion">
                    <?php foreach ($armas as $arma) {?>
                        

                        <option value="<?php echo $arma['id_arma']; ?>"><?php echo $arma['nombre'];?>  </option> 
                    <?php } ?>
                </select>

                <div class="arma_sola" id ="arma_individual">


                </div>

                <div class="mi-vida-container">
                    <h3>Tu Vida</h3>
                    <progress id="mi-vida-barra" class="mi-vida-barra" max="100" value="100"></progress>
                    <span id="mi-vida-texto">100%</span>
                </div>

            </div>

          

            <input type="number" name="persona" value="" id="replace" placeholder="" hidden>


            <input type="text" value="" id="nombre" readonly>

            <div class="atacado_mostrar" id="atacar_show">

            </div>

            <input type="submit" class="boton" value="ATACAR" name ="enviar" id ="send">
        </form>
        
       

    </div>
    

<script>



document.addEventListener("DOMContentLoaded", function () {
    // Obtener el ID de la sala desde la URL

    let partida_finalizada = false;
    let jugadorMuerto = false; 
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

                
                data.forEach(player => {

                    let button = document.createElement("button");
                    const user = <?php echo json_encode($_SESSION['id_user'])?>;

                    button.innerHTML = `
                        ${player.username}
                        <div class="vida-container">
                            <div class= "image"> <img src="img/caras/${player.foto_personaje}" alt =""> </div>
                            <div class="barra_vida">
                                ${player.vida}%
                                <progress class="vida-barra" max="100" value="${player.vida}"></progress>
                            </div>
                        </div>
                    `;
                   
                    if(player.id_usuario == user){

                        button.style.display="none";
                    }
                    button.classList.add('personajes');
                    button.id='prueba';

                    button.addEventListener("click", function() {
                        const input = document.getElementById('nombre');
                        input.value = player.username;

                        const input_form = document.getElementById('replace');
                        input_form.value = player.id_usuario;
                     
                    });

                    usersDiv.appendChild(button);
                   
                });



                if(data.length == 1 && !partida_finalizada){
                    partida_finalizada = true; // Marcar la partida como finalizada
                    setTimeout(() => {
                        window.location.href="AJAX/ganador.php?id_sala=" +id_sala;
                    }, 1500);
                    
                }
            })
            .catch(error => console.error("Error:", error));
        } else {
            console.error("No se encontró el ID de la sala en la URL");
        }
    }

    actualizarJugadores(); // Llamar la función al cargar la página
    setInterval(actualizarJugadores, 2000); // Repetir cada 5 segundos


    // AQUI HAGO LA FUNCION PARA VERIFICAR LA VIDA DE LA PERSONA

    function verificarVida() {
         

        fetch("AJAX/muerte.php?id_sala=" + id_sala)
            .then(response => response.json())
            .then(data => {

                
                if (data.status === "dead") {
                    jugadorMuerto = true;
                    window.location.href = "AJAX/perdedor.php?id_sala=" +id_sala; // Redirigir a mostrarle la alerta

                } else {
                    
                  
                    let miVidaBarra = document.getElementById("mi-vida-barra");
                    let miVidaTexto = document.getElementById("mi-vida-texto");

                    miVidaBarra.value = data.vida;
                    miVidaTexto.textContent = data.vida + "%";

                    // Cambiar color de la barra según la vida restante
                    if (data.vida > 50) {
                        miVidaBarra.style.setProperty("--progress-color", "green");
                    } else if (data.vida > 25) {
                        miVidaBarra.style.setProperty("--progress-color", "orange");
                    } else {
                        miVidaBarra.style.setProperty("--progress-color", "red");
                    }
                }
            })
            .catch(error => console.error("Error al verificar la vida:", error));
    }

    actualizarJugadores(); // Llamar la función al cargar la página
    verificarVida(); // Verificar la vida al inicio
    setInterval(() => {
        actualizarJugadores();
        verificarVida(); // Comprobar si un jugador debe ser expulsado
    }, 2000); // Repetir cada 2 segundos


    // AQUI HAGO LA FUNCION PARA TRAERME EL ARMA 


    document.getElementById('eleccion').addEventListener('change', function() {
        obtenerArma(this.value);
    });

    obtenerArma(document.getElementById('eleccion').value)
    
    function obtenerArma(id_arma){
        
        fetch("AJAX/Arma_batalla.php?id_arma=" +id_arma)
        .then(response => response.json())
        .then(arma =>{

            if(arma.error){
                console.log("error con la consulta del arma", arma.error);
                return;
            }
           
            const Armadiv = document.getElementById('arma_individual');
            Armadiv.innerHTML = `
                                <img src ="img/${arma.imagen}" class ="arma_Foto">

                                <div class="info_arma">
                                    <h3>Balas: ${arma.intentos}</h3>
                                    <h3>Daño: ${arma.puntos_daño}</h3>
                                </div>
                                
                                
            `
        }).catch(error=> console.log("error al consultar el arma", error))
    }

    
   

    // AQUI HAGO LA RECOLECCION DE DATOS 

    document.getElementById("ataque").addEventListener("submit", function(event) {
            event.preventDefault(); // Evita el envío tradicional del formulario

            if (jugadorMuerto) {
                console.log("El usuario está muerto, no puede atacar.");
                return; 
            }



            const formData = new FormData(this);

            const send = document.getElementById('send');
            
                
            send.disabled =true

            setTimeout(() => {
                
                send.disabled =false
                
            }, 1500);
            
            fetch("AJAX/ataque.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.text()) // ⬅️ Cambiado de .json() a .text()
            .then(data => {
                console.log("Respuesta del servidor:", data);
                
            })
            .catch(error => console.error("Error en el envío:", error));
    });

        // AQUI LLAMO LA FUNCION DEL CONTADOR

        function iniciarContador() {
            fetch("AJAX/obtener_fecha_inicio.php?id_sala=" + id_sala)
                .then(response => response.json())
                .then(data => {
                    if (data.fecha_inicio) {
                        let inicio = new Date(data.fecha_inicio).getTime();
                        let tiempoLimite = inicio + (5 * 60 * 1000); // 5 minutos en milisegundos
                        let contadorElemento = document.getElementById("contador");

                       
                        function actualizarContador() {
                            let ahora = new Date().getTime();
                            let tiempoRestante = tiempoLimite - ahora;
                            
                           

                            if (tiempoRestante <= 0) {
                                clearInterval(intervaloContador);
                                determinarGanador();
                                return;
                            }

                            let minutos = Math.floor((tiempoRestante % (1000 * 60 * 60)) / (1000 * 60));
                            let segundos = Math.floor((tiempoRestante % (1000 * 60)) / 1000);

                            contadorElemento.innerText = `Tiempo: ${minutos}m ${segundos}s`;
                        }

                        actualizarContador();
                        let intervaloContador = setInterval(actualizarContador, 1000);
                    }
                })
                .catch(error => console.error("Error al obtener la fecha de inicio:", error));
                }


// AQUI ESTA LA FUNCION DE DETERMINAR GANADOR SI SE ACABA EL TIEMPO

        setInterval(() => {
               determinarGanador();
            }, 299000); // Repetir cada 5 minutos segundos



        function determinarGanador() {
            if (partida_finalizada) return;
            
                fetch("AJAX/saber_ganador.php?id_sala=" + id_sala)
                    .then(response => response.json())
                    .then(data => {
                        const id_usuario_sesion = <?php echo json_encode($_SESSION['id_user']); ?>;

                        if (data.status === "success") {
                            partida_finalizada = true;
                            if (id_usuario_sesion == data.id_ganador) {

                                setTimeout(() => {
                                    window.location.href="AJAX/ganador.php?id_sala=" +id_sala;
                                }, 3000);

                            } else {
                                window.location.href = "AJAX/perdedor.php?id_sala=" + id_sala;
                            }
                        } else {
                           
                            alert("No se pudo determinar un ganador.");
                        }
                    })
                    .catch(error => console.error("Error al determinar el ganador:", error));
            }

    iniciarContador();

});







</script>
</body>
</html>