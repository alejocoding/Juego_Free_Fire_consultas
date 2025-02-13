<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FREE FIRE</title>
    <link rel="icon" type="image/png" href="assets/img/garena.png">
    <link rel="stylesheet" href="css/index.css">
</head>
<body id="home">
    
    <?php include('template/header.html')?>

    <div class="gif">

        <img src="assets/img/Freefirelogo.png" alt="Logo de " class="logo">
        <img src="assets/img/gifs/giphy (1).gif" alt="Gif de free fires">
        <button class="jugar" id ="jugar1" onclick="opened()">JUGAR AHORA</button>
    </div>

    <div class="aviso hidden" id="aviso">

        <button class="cerrar_aviso " id="cerrar_aviso" onclick="closened()"><i class="bi bi-x"></i></button>
        
        <h1>¿YA TIENES CUENTA?</h1>

        <div class="botones">
            <button class="registro" onclick="window.location.href='registro.php'">REGISTRARSE</button>
            <button class="inicio" onclick="window.location.href='login.php'">INICIAR SESION</button>
        </div>
    </div>
    <div class="personajes" id="personajes">
        
        <img src="assets/img/garena.png" alt="" width="80px" height="80px" class="garena">

        <div class="Texto">
            <h1>PERSONAJES</h1>
            <p>Desde las profundidas de bermuda y el purgatorio, los mejores de los mejores justo aqui.</p>
        </div>

        <div class="personajes_fotos">

            <div class="red_card">

                <div class="imagen_container">

                    <img src="assets/img/ORION.png" alt="">

                        <div class="info_spawn">
                            
                            <h1>ORION</h1>

                            <p>Un guerrero oscuro que devora todo. ¿Controlas su poder o te consume?</p>

                        </div>
                    
                </div>
               
                
            </div>

            <div class="red_card">

                <div class="imagen_container">

                    <img src="assets/img/sonia.png" alt="" style="background-color: black;">
                    <div class="info_spawn">
                        
                        <h1>SONIA</h1>
                        <p>Precisión letal, un solo error y estás fuera. ¿Puedes esquivarla?</p>
                   
                    </div>
                </div>
            </div>

            <div class="red_card">
                
                <div class="imagen_container">

                    <img src="assets/img/HAYATO.png" style="background-color: black;">
                    
                    <div class="info_spawn">

                      <h1>HAYATO</h1>
                      <p>Se vuelve más fuerte al borde de la muerte. ¿Te atreves a enfrentarlo?</p>

                    </div>
                    
                </div>
                
            </div>

            <div class="red_card">

                <div class="imagen_container">
                    <img src="assets/img/MOCO.png" style="background-color: black;">
                    
                    <div class="info_spawn">

                        <h1>MOCO</h1>
                        <p>La hacker que todo lo ve. ¿Crees que puedes ocultarte?</p>

                    </div>
                    
                </div>
                
            </div>

        </div>
    </div>

    <div class="armas" style="background-color: white;" id="armas">


            <div class="Texto" style="color:black">
                <h1>ARMAS</h1>
                <p>Nuestros mejores aliados ante cualquier batalla, !nunca te dejaran votado!</p>
            </div>

            <div class="armas_vista">

                <div class="card_gun">
                    <img src="assets/img/ametralladoras.png" alt="">
                    <div class="info_spawn">
                        <h1>AMETRALLADORAS</h1>
                    </div>
                </div>

                <div class="chiquitas">

                    <div class="cardSmall">

                        <img src="assets/img/pistolas.png" alt="">

                        <div class="info_spawn">
                            <h1>PISTOLAS</h1>
                        </div>

                    </div>
                    <div class="cardSmall">

                        <img src="assets/img/puños.png" alt="">
                        <div class="info_spawn">
                            <h1>CUERPO</h1>
                        </div>
                    </div>

                </div>


                <div class="card_gun">

                    <img src="assets/img/snipers.png" alt=" imagen de francos">
                    <div class="info_spawn">
                        <h1>FRANCOTIRADORES</h1>
                    </div>
                </div>
            </div>


    </div>

   <?php include('template/footer.html')?>

    <script>

        const aviso = document.getElementById('aviso');
            function opened(){
                aviso.style.display="flex";
            }
            function closened(){
                aviso.style.display="none";
            }
    </script>
</body>
</html>