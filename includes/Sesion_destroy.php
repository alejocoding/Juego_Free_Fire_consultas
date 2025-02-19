<?php

session_start();

unset($_SESSION['id_user']);
unset($_SESSION['username']);
unset($_SESSION['rol']);
session_destroy();
session_write_close();
header("Location: ../index.php");

exit();
?>