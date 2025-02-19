<?php

if(!$_SESSION['id_user']){
    unset($_SESSION['id_user']);
    unset($_SESSION['username']);
    unset($_SESSION['id_rol']);

    $_SESSION = array();
    session_destroy();
    session_write_close();

    header("Location: ../index.php");
}
?>