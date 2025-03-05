<?php

require_once("../../Database/database.php");
$conexion = new database;
$con = $conexion->conectar();


$users = $con->prepare("SELECT * FROM usuario u
INNER JOIN roles r USING (id_rol)
INNER JOIN estado e USING (id_estado)
INNER JOIN personajes p USING (id_personaje)
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
            <li><a href=""><i class="bi bi-gear"></i>Modificar Usuarios</a></li>
            <li><a href="../../includes/Sesion_destroy.php"><i class="bi bi-box-arrow-left"></i>Cerrar Sesion</a></li>
        </ul>
    </div>

    <div class="content">
        <h1>Seccion Usuarios</h1>
        
        <div class="barra_busqueda">
            <input type="text" placeholder="Buscar Usuario por username">
        </div>

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
            <?php foreach ($users as $user) { ?>
                <tr data-id="<?= $user['id_usuario'] ?>">
                    <td><?= $user['id_usuario'] ?></td>
                    <td><?= $user['username'] ?></td>
                    <td><input type="text" class="correo" value="<?= $user['correo'] ?>"></td>
                    <td><input type="text" class="vida" value="<?= $user['vida'] ?>"></td>
                    <td><input type="text" class="nivel" value="<?= $user['nivel'] ?>"></td>
                    <td><input type="text" class="puntos" value="<?= $user['puntos'] ?>"></td>
                    <td>
                        <select class="rol">
                            <option value="<?= $user['id_rol'] ?>" selected><?= $user['rol'] ?></option>
                            <?php foreach ($con->query("SELECT * FROM roles WHERE id_rol != $user[id_rol]") as $rol) { ?>
                                <option value="<?= $rol['id_rol'] ?>"><?= $rol['rol'] ?></option>
                            <?php } ?>
                        </select>
                    </td>
                    <td>
                        <select class="personaje">
                            <option value="<?= $user['id_personaje'] ?>" selected><?= $user['nombre'] ?></option>
                            <?php foreach ($con->query("SELECT * FROM personajes WHERE id_personaje != $user[id_personaje]") as $personaje) { ?>
                                <option value="<?= $personaje['id_personaje'] ?>"><?= $personaje['nombre'] ?></option>
                            <?php } ?>
                        </select>
                    </td>
                    <td>
                        <select class="estado">
                            <option value="<?= $user['id_estado'] ?>" selected><?= $user['estado'] ?></option>
                            <?php foreach ($con->query("SELECT * FROM estado WHERE id_estado < 3 AND id_estado != $user[id_estado]") as $estado) { ?>
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
        console.log(JSON.stringify({ usuarios }));

        const response = await fetch("fetch/actualizar_usuarios.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ usuarios })
        });

        const result = await response.json();
        if (result.status === "success") {
            alert("Usuarios actualizados correctamente.");

        }else {
            alert("Error al actualizar los usuarios.");
        }
    } catch (error) {
        console.error("Error:", error);
        alert("Se han actualizado los datos correctamente.");
    }
});
</script>

</body>
</html>