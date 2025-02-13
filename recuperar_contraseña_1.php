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
    
<?php include('template/header.html')?>

    <div class="contenido_grid">

        <div class="seccion">

            <img src="assets\img/Freefirelogo.png" alt="logo" class="free_fire">
            <h1 class="recuperar">RECUPERAR CONTRASEÑA</h1>
            <p class="oracion">INGRESA EL CORREO REGISTRADO</p>
                
            <form action="" method= "POST" enctype = "multipart/form-data" class="formulario">

                <label for="input_correo">Correo:*</label>
                <input type="text" class="datos" id="input_correo" name="input_correo" required>
                <span></span>

                <div class="botones">
                    <button type="button" onclick="window.location.href='login.php'" class="volver">Volver</button>
                    <button type="submit" class="continuar" onclick="window.location.href='contraseña_codigo_2.php'">Continuar</button>
                </div>

                
            </form>
                
            
        </div>

        <div class="imagen"></div>

    </div>

    <?php include('template/footer.html')?>
</body>
</html>