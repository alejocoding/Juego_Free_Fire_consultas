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
                    <button type="submit" class="continuar" onclick="window.location.href='contraseña_restablecer_3.php'">Continuar</button>
                </div>
                
                

                
            </form>
                
            
        </div>

        <div class="imagen"></div>

    </div>

    <?php include('template/footer.html')?>

    
</body>
</html>