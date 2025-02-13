<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="icon" type="image/png" href="assets/img/garena.png">
    <link rel="stylesheet" href="css/registro.css">
</head>
<body>

<?php include('template/header.html')?>

<div class="contenido_grid">

    <div class="registro">
        <img src="assets/img/Freefirelogo.png" alt="IMAGEN DE FREE FIRE" class="free_fire">
        <p class="titulo">CREA TU CUENTA FREE FIRE</p>

        <form action="" method="post" class="formulario">

        <label for="username" >username:*</label>
        <input type="text" id="username" class="input" required>
        <span></span>

        <label for="correo">Correo:*</label>
        <input type="text" id="correo" class="input" required>
        <span></span>

        <label for="contraseña">Contraseña:*</label>
        <input type="password" id="contraseña" class="input" required>
        <span></span>

        <label for="con_contraseña">Confirmar contraseña:*</label>
        <input type="password" id="con_contraseña" class="input" required>
        <span></span>

        <input type="submit" name="submit" value="Crear Cuenta" class="input_submit">
        <span></span>

        </form>

        <button type="buttom" class="login" onclick="window.location.href='login.php'"> ¿Ya tienes cuenta? <p>ingresa aqui</p></button>
    </div>

    <img src="assets/img/fondo_registro.png" alt="" class="img_fondo">
</div>
    <?php include('template/footer.html')?>
</body>
</html>