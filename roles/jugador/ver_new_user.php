<?php
session_start();

require_once('../../Database/database.php');
$conexion = new database;
$con = $conexion->conectar();

$_SESSION['id_user'];

try{

    $consulta = $con->prepare("SELECT id_personaje FROM usuario WHERE id_usuario = :id_user");
    $consulta->bindParam(":id_user", $_SESSION['id_user'], PDO::PARAM_INT);
    $consulta->execute();

    $var = $consulta->fetch();

    if(!$var['id_personaje'] == null || !empty($var['id_personaje'])){
        header("Location: lobby.php");
        exit();
    }
    

}catch(PDOException){
    echo "Error Usuario no encontrado, Contacte con un administrador";

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<main class="lobby">
    
    <div class="alert"> 
        <h1 class="titulo">SELECCIONE UN PERSONAJE</h1>
        <form action="" method="POST">
            <div class="personajes_container">
            
                    <?php 

                        $sql = $con->prepare("SELECT * FROM personajes");
                        $sql->execute();

                        $consulta_2 = $sql->fetchAll();

                        foreach ($consulta_2 as $personajes){ ?>

                        <div class="personaje">
                        
                            <button class="people" value="<?php  echo $personajes['id_personaje']?>" type="submit" name="submit">
                                <h1><?php echo $personajes['nombre']?></h1>
                                <img src="img/<?php echo $personajes['foto_personaje'];?>" alt="">
                            </button>
                        
                        </div>

                                
                        <?php };?> 
            
            </div>
        </form>
    </div>

    
<?php

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



</main>

<style>
*{
    padding: 0;
    margin:0;
    box-sizing: border-box;

   
}
.aviso_horizontal{
    display: none;
}
.lobby{
    position: fixed;
    background-image: url('img/lobby.png');
    background-repeat: no-repeat;
    background-size: cover;
    width: 100vw;
    height: 100vh;
    background-color: black;
    overflow-x: hidden;
    z-index: 0;
    color: white;
}
.alert{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 2%;
    position: fixed;
 
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
    width: 75%;
    height: 90%;
}
.titulo{
    padding: 20px;
}

.personajes_container{
    display: flex;
    width: 100vw;
    justify-content: center;
    gap: 20px;  
   
}
.escoger{
    background-color: #f80000;
    border: 2px solid white;
    color: white;
}


.people{
    background-color: rgba(248, 0, 0, 0.5);
    border: none;
    width: 250px;
    color: white;
}

.people:hover{
    border: 2px solid white;
}
.people:focus{
    background-color: green;
}



.personaje img{
    width: 200px;
    height: 500px;
    object-fit: cover;
}

@media (min-width:1100px) and (max-height:700px){
    .people {
        width: 200px;
    }

    .personaje img {
        width: 100%;
        height: auto;
    }
}
@media (max-width:1100px) and (max-height:1000px){
    .personajes_container {
        display: grid;
        grid-template-columns: repeat(4, 200px);

        justify-items: center; 
        gap: 10px;
    }

    .people {    
        width: 194px;
}
    .personaje img {
    width: 196px;
    height: 332px;
    object-fit: cover;
}
}

@media (max-width:850px) and (min-height:300px) and (max-height:1000px){
    .personajes_container {
        display: grid;
        grid-template-columns: repeat(4, 120px);
        justify-items: center;
        gap: 10px;
    }
    .people h1{
        font-size: 14px;
        padding: 10px;
    }
    .personaje img {
        width: 111px;
        height: 219px;
    }
    .people {
        width: 120px;
    }

}

@media (max-width:592px) {
    .personajes_container {
        display: grid;
        grid-template-columns: repeat(2, 120px);
        justify-items: center;
        gap: 10px;
    }
    .titulo {
    text-align: center;
    padding: 17px;
    }
}
    



</style>

</body>
</html>