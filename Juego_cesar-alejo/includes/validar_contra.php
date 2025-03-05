<?php

if(!$_SESSION['code']){
    unset($_SESSION['user']);


    $_SESSION = array();
    session_destroy();
    session_write_close();
    

    echo "<script>
            alert('ACCIÓN NO PERMITIDA'); 
            window.location.href = 'login.php';
            
            </script>";
    exit(); 
}
?>