<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="shortcut icon" href="assets\img/Freefirelogo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="Css/login.css">
</head>
<body>

    <?php 
        include('template/header.html'); 
    ?>

    <div class = "contenido">
        <div class = "conten_form">
            <div class = "form-info">
                
                <div class = "form-infor">
                    <img src="assets\img/Freefirelogo.png" alt="logo">
                    <h1 class = "titu"> INGRESA A TU CUENTA DE FREE FIRE</h1>
                
                    <form action="includes/inicio.php" method= "POST" enctype = "multipart/form-data">

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

                        <p>Olvidaste tu contraseña?<a href="#">Recuperala</a></p> 
                        
                        <div class = "btn-field">
                            <button type="submit" name = "log" id="log" value = "Log" class="btn btn-primary">Sig  in</button>
                        </div>

                        <div class = "resgister">
                            <a href="Registro.php"><input type="button" value = '¿Nuevo en FREE FIRE?
Registrate aqui'></a>
                        </div>
                        
                    </form>
                </div>
            </div>
            <div class = "imagen-derecha">
                
            </div>   
        </div>
         
    </div>
</body>
</html>