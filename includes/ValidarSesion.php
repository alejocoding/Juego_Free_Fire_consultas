<?php

if(!$_SESSION['id_user']){

    unset($_SESSION['id_user']);
    unset($_SESSION['username']);
    unset($_SESSION['id_rol']);
    unset($_SESSION['id_personaje']);
    unset($_SESSION['nivel_usuario']);

    $_SESSION = array();
    session_destroy();
    session_write_close();

    echo "<script>
            alert('ACCIÓN NO PERMITIDA'); 
            window.location.href = '../../login.php';
            
            </script>";
    exit(); // Cierro el script
}
?>