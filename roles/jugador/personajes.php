<?php
session_start();

require_once('../../Database/database.php');
$conexion = new database;
$con = $conexion->conectar();

$sql = $con->prepare("SELECT * , personajes.id_personaje AS personaje_id FROM personajes");
$sql->execute();

$personaje = $sql->fetchAll(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personajes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/personajes.css">
</head>
<body>
<div class="lobby">
    
        <div class="title"> <button onclick="window.location.href='lobby.php'"><i class="bi bi-caret-left-fill"></i></button> <h1>OPRIME EL PERSONAJE PARA CAMBIARLO</h1></div>
        <form action="" method="POST">
            <div class="personajes_container">

                <?php foreach ($personaje as $personajes) {?>
                    <div class="personaje">
                                    
                        <button class="people" value="<?php  echo $personajes['id_personaje']?>" style ="<?php echo ($personajes['id_personaje'] == $_SESSION['id_personaje']) ? 'background-color:green;' : ''  ?>" type="submit" name="submit">
                            <h1><?php echo $personajes['nombre']?></h1>
                            <img src="img/<?php echo $personajes['foto_personaje'];?>" alt="">
                        </button>
                                    
                    </div>
                    
            <?php } ?>

            </div>
        </form>
    
</div>



<?php
//  CONSULTA PARA ENVIAR LA ACTUALIZACION DEL PERSONAJE
if(isset($_POST['submit'])){

    $personaje = $_POST['submit'];

    $sql2= $con->prepare("UPDATE usuario SET id_personaje =:personaje WHERE id_usuario = :user_id");
    $sql2->bindParam(":user_id",$_SESSION['id_user'],PDO::PARAM_INT);
    $sql2->bindParam(":personaje",$personaje ,PDO::PARAM_INT);
    
    if($sql2->execute()){
        header("Location: lobby.php");
    }
}
?>

</body>
</html>