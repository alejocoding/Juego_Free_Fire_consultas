
<?php
session_start();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free fire</title>
    <link rel="stylesheet" href="css/index_usuario.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>


    <div class="video-container">
        <video id="miVideo" autoplay loop playsinline>
            <source src="../../assets/videos/intro.mp4" type="video/mp4">
        </video>

        <button class="botoncito_salir">
        <i class="bi bi-person-fill"></i>
        <h1 class="close_sesion" onclick="window.location.href='../../includes/Sesion_destroy.php'">Cerrar sesion</h1>

        </button>

        <div class="JOIN">
            <img src="../../assets/img/Freefirelogo.png" alt="logo free fire">
            <button class="jugar" onclick="window.location.href='ver_new_user.php'">JUGAR</button>
    
        </div>
        
    </div>
    <script>
        document.addEventListener("click", function() {
            let video = document.getElementById("miVideo");
            if (video.paused) {
                video.play();
            }
        });

        let video = document.getElementById("miVideo");

        video.addEventListener("timeupdate", function() {
            let duracion = video.duration;
            let segundosMenos = 4;

            if (video.currentTime >= duracion - segundosMenos) {
                video.currentTime = 0; 
            }
        });
    </script>
</body>
</html>