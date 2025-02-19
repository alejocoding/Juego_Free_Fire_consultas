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
            <h1 class="recuperar">CAMBIAR CONTRASEÑA</h1>
           
                
            <form action="" method= "POST" enctype = "multipart/form-data" class="formulario">

                <label for="new_contraseña">Nueva contraseña:*</label>
                <input type="text" class="datos" id="new_contraseña" name="new_contraseña" required>
                <span></span>

                <label for="confirmar_con">Confirmar Contraseña:*</label>
                <input type="text" class="datos" id="confirmar_con" name="confirmar_con" required>
                <span></span>
      
                <div class="botones">
                    <button type="submit" class="continuar" onclick="window.location.href='login.php'">Cambiar</button>
                </div>
                
                

                
            </form>
                
            
        </div>

        <div class="imagen"></div>

    </div>

    <?php include('template/footer.html')?>

    
</body>
</html>