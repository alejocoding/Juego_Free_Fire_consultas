<?php
session_start();
require_once("../../includes/ValidarSesion.php");
require_once("../../Database/database.php");
$conexion = new database;
$con = $conexion->conectar();


$users = $con->prepare("SELECT u.*, r.rol, e.estado, p.nombre AS personaje 
FROM usuario u
LEFT JOIN roles r ON u.id_rol = r.id_rol
LEFT JOIN estado e ON e.id_estado = u.id_estado
LEFT JOIN personajes p ON u.id_personaje = p.id_personaje
WHERE u.id_rol = 2;");
$users->execute();

$users = $users->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administrador</title>
    <link rel="icon" href="img/admin.png">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

   
    <div class="sidebar">
        <h2>Administrador</h2>
        <ul>
            <li><a href="index.php"><i class="bi bi-house-door"></i>inicio</a></li>
            <li><a href="jugadores.php"><i class="bi bi-people"></i>Jugadores</a></li>
            <li><a href="registro_partidas.php"><i class="bi bi-file-text"></i>Registro partidas</a></li>
            <li><a href="../../includes/Sesion_destroy.php"><i class="bi bi-box-arrow-left"></i>Cerrar Sesion</a></li>
        </ul>
    </div>

    <div class="content">
        <h1>Seccion Usuarios</h1>

        <form id="formUsuarios">
    <table>
        <thead>
            <tr>
                <td>ID</td>
                <td>Username</td>
                <td>Correo</td>
                <td>Vida</td>
                <td>Nivel</td>
                <td>Puntos</td>
                <td>Rol</td>
                <td>Personaje</td>
                <td>Estado</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) {
                 ?>
                <tr data-id="<?= $user['id_usuario'] ?>">
                    <td><?= $user['id_usuario'] ?></td>
                    <td><?= $user['username'] ?></td>
                    <td><input type="text" class="correo" value="<?= $user['correo'] ?>"></td>
                    <td><input type="text" class="vida" value="<?= $user['vida'] ?>" placeholder="vacio"></td>
                    <td><input type="text" class="nivel" value="<?= $user['nivel'] ?>" placeholder="vacio"></td>
                    <td><input type="text" class="puntos" value="<?= $user['puntos'] ?? 0 ?>" placeholder="vacio"></td>
                    <td>
                        <select class="rol">
                            <option value="<?= $user['id_rol'] ?>" selected><?= $user['rol'] ? : "Vacio"?></option>
                            <?php foreach ($con->query("SELECT * FROM roles WHERE id_rol != $user[id_rol]") as $rol) { ?>
                                <option value="<?= $rol['id_rol'] ?>"><?= $rol['rol'] ?></option>
                            <?php } ?>
                        </select>
                    </td>
                    <td>
                        <select class="personaje">
                            <option value="<?= $user['id_personaje'] ?? 0 ?>" selected ><?= $user['personaje'] ? : "VACIO"  ?></option>
                            <?php  foreach ($con->query("SELECT * FROM personajes") as $personaje) { ?>
                                <option value="<?= $personaje['id_personaje']  ?>"><?= $personaje['nombre'] ?></option>
                            <?php } ?>
                        </select>
                    </td>
                    <td>
                        <select class="estado">
                            <option value="<?= $user['id_estado'] ?>" selected><?= $user['estado'] ?></option>
                            <?php  foreach ($con->query("SELECT * FROM estado WHERE id_estado < 3 AND id_estado != $user[id_estado]") as $estado) { ?>
                                <option value="<?= $estado['id_estado'] ?>"><?= $estado['estado'] ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <button type="button" id="btnActualizar">Enviar</button>
</form>


    </div>


<script>
    document.getElementById("btnActualizar").addEventListener("click", async function() {
    const filas = document.querySelectorAll("tbody tr"); // Obtener todas las filas de la tabla
    let usuarios = [];

    filas.forEach(fila => {
        const id = fila.dataset.id;
        const correo = fila.querySelector(".correo").value;
        const vida = fila.querySelector(".vida").value;
        const nivel = fila.querySelector(".nivel").value;
        const puntos = fila.querySelector(".puntos").value;
        const rol = fila.querySelector(".rol").value;
        const personaje = fila.querySelector(".personaje").value;
        const estado = fila.querySelector(".estado").value;

        usuarios.push({
            id_usuario: id,
            correo: correo,
            vida: vida,
            nivel: nivel,
            puntos: puntos,
            id_rol: rol,
            id_personaje: personaje,
            id_estado: estado
        });
    });

   

    try {
        const response = await fetch("FETCH/actualizar_usuarios.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ usuarios })
        });

        const result = await response.json();
        if (result.status === "success") {
            alert("Usuarios actualizados correctamente.");
        } else {
            alert("Error al actualizar los usuarios.");
        }
    } catch (error) {
        console.error("Error:", error);
        alert("Hubo un problema con la actualización.");
    }
});
</script>

</body>
</html>

 