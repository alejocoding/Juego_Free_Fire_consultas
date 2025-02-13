<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" type="image/png" href="assets/img/garena.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="Css/login.css">
</head>
<body>

    <?php 
        include('template/header.html'); 
    ?>

<div class="contenido_grid">

        <div class = "seccion">
            
                    <img src="assets\img/Freefirelogo.png" alt="logo" class="free_fire">
                    <p class="titulo">INGRESA A TU CUENTA DE FREE FIRE</p>
                
                    <form action="includes/inicio.php" method= "POST" enctype = "multipart/form-data" class="formulario">

                        <div class = "input-gruop">
                            <div class = "input_field">
                                <label for="username" class = "input_label">Username:*</label>
                                <div class="icon">
                                    <i class="bi bi-person-fill"></i>
                                <input type="varchar" name = "username" id="username" placeholder = "Username">
                                </div>
                            </div>

                            <div class = "input_field">
                                <label for="passw">Password:*</label>
                                <div class="icon">
                                 <i class="bi bi-lock-fill"></i>
                                <input type="password" name = "passw" id = "passw" placeholder = "password">
                                </div>
                            </div>

                        </div>

                        <p class="forgot_password">Olvidaste tu contraseña?<a href="recuperar_contraseña_1.php" style="color: #5e17eb;">Recuperala</a></p> 
                        
                        <div class = "btn-field">
                            <button type="submit" name = "log" id="log" value = "Log" class="btn btn-primary">Sig  in</button>
                        </div>
                    </form>
                    <button onclick="window.location.href='registro.php'" class="buton_registro"> ¿Nuevo en FREE FIRE? <p style="color: #f96800">Registrate aqui</p></button>
                
           
             
        </div>

        <div class="imagen"></div>
         
</div>
    <?php include('template/footer.html')?>
    
</body>
</html>