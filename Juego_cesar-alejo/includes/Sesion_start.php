    <?php
    require_once('../Database/database.php');
    $conexion = new database();
    $con = $conexion->conectar();

    session_start();


    if($_POST['submit']){

        if(!empty($_POST['username']) && !empty($_POST['passw'])){

            $sql = $con->prepare("SELECT * FROM usuario WHERE username = :user_name");
            $sql->bindParam(":user_name", $_POST['username'],PDO::PARAM_STR);
            $sql->execute();

        




            if($consulta = $sql->fetch(PDO::FETCH_ASSOC)){

                        // EN CASO DE ERROR BORRAR TODA ESTA SECCION

                        // if($consulta['id_estado'] == 1){

                        //     $bloqueo_dias = $con->prepare("SELECT DATEDIFF(NOW(), fecha_entrada) AS dias_diferencia 
                        //     FROM registro_ingreso 
                        //     WHERE id_usuario = :id_user 
                        //     ORDER BY id_registro DESC 
                        //     LIMIT 1");
        
                        //     $bloqueo_dias->bindParam(":id_user", $consulta['id_usuario'], PDO::PARAM_INT);
                        //     $bloqueo_dias->execute();
                        //     $datos = $bloqueo_dias->fetch(PDO::FETCH_ASSOC);
        
                        //     $diferenciaDias = $datos ? $datos['dias_diferencia'] : 0;
                            
                            
                            
                        
                        //     if ($diferenciaDias > 9) {
        
                        //         $desactivar = $con->prepare("UPDATE usuario SET id_estado = 2 WHERE id_usuario = :user_id");
                        //         $desactivar->bindParam(":user_id", $consulta['id_usuario'], PDO::PARAM_INT);
                        //         $desactivar->execute();
                            
                        //         $aviso_admin = $con->prepare("INSERT INTO solicitud_ingreso (id_usuario) VALUES (:user_id)");
                        //         $aviso_admin->bindParam(":user_id", $consulta['id_usuario'],PDO::PARAM_INT);
                        //         $aviso_admin->execute();
        
                        //         echo "<script>alert('Error, Usuario inactivo por inactividad de más de 10 días. Se envio una alerta para restablecer Usuario.'); 
                        //             window.location.href='../login.php';</script>";
                        //         exit();
                        //     }

                        // }

                    

                        // JUSTAMENTE HASTA ACA

                    //  AQUI VERIFICO EL ESTADO DE LA PERSONA

                    $contra = $consulta['password'];


                    //  AQUI VERIFICO LA CONTRASEÑA 
                    if(password_verify($_POST['passw'],$contra)){

                    // SI LA CONTRASEÑA ES IGUAL PASO A VERIFICAR EL ESTADO

                        if($consulta['id_estado'] == 1){
        
                                $_SESSION['id_user'] = $consulta['id_usuario'];
                                $_SESSION['username'] = $_POST['username'];
                                $_SESSION['rol'] = $consulta['id_rol'];

                                // SI LA CONTRASEÑA ES IGUAL PASO A VERIFICAR EL ROL 
                
                                if($_SESSION['rol'] == 1){
                
                                    //  SI EL ROL ES IGUAL A 1 ES EL ADMINISTRADOR ENTONCES  INSERTO UN REGISTRO Y LO DEJO ENTRARR 
                                    $insertar = $con->prepare("INSERT INTO registro_ingreso (id_usuario) VALUES (:user_id)");
                                    $insertar->bindParam(":user_id", $_SESSION['id_user'],PDO::PARAM_INT);
                                    $insertar ->execute();
                
                                    echo "<script>window.location.href='../roles/admin/index.php'</script>";
                                    exit();

                                }else if($_SESSION['rol'] ==2){

                                    // SI EL ROL ES 2 ME TOCA HACER VERIFICACION PARA ASIGNARLE LA VIDA Y LOS PUNTOS DE PRIMER INGRESO 
                
                                    $sql2 = $con->prepare("SELECT COUNT(*) FROM registro_ingreso WHERE id_usuario = :user_id");
                                    $sql2->bindParam(":user_id", $_SESSION['id_user'],PDO::PARAM_INT);
                                    $sql2 ->execute();
                
                                    $primerIngreso= $sql2->fetchColumn();
                
                                    // ESTO ES PARA VERIFICAR SI LA PERSONA TIENE UN REGISTRO DE INGRESO AL SOFTWARE O NO
                
                                    if($primerIngreso == 0){
                
                                        //  SI NO TIENE LO QUE HAGO ES ACTUALIZARLE LA VIDA, PUNTOS Y NIVEL 
                                        $actualizar = $con->prepare("UPDATE usuario SET vida = 100, nivel = 1, puntos =0 WHERE id_usuario =:user_id and username = :username");
                                        $actualizar->bindParam(":user_id", $_SESSION['id_user'],PDO::PARAM_INT);
                                        $actualizar->bindParam(":username", $_SESSION['username'],PDO::PARAM_STR);
                                        $actualizar->execute();
                
                                    }

                                        // SI TIENE SOLO INGRESO OTRO REGISTRO DE INGRESO 

                                        $insertar = $con->prepare("INSERT INTO registro_ingreso (id_usuario) VALUES (:user_id)");
                                        $insertar->bindParam(":user_id", $_SESSION['id_user'],PDO::PARAM_INT);
                                        $insertar ->execute();
                
                                        header("Location: ../roles/jugador/index.php");
                                        exit();
                
                
                                } 
                                // ESTE ES EL ELSE DEL ROL

                        }else{

                            // ESTE ES EL ELSE DEL ESTADO, DEJO ESTE COMENTARIO POR SI AGREGO LA FUNCIONALIDAD DE MANDAR SOLICITUDES AL ADMIN

                            $aviso_admin = $con->prepare("INSERT INTO solicitud_ingreso (id_usuario) VALUES (:user_id)");
                            $aviso_admin->bindParam(":user_id", $consulta['id_usuario'],PDO::PARAM_INT);
                            $aviso_admin->execute();
                            
                            echo "<script>alert('Error, Usuario inactivo, se envio una alerta para restablecer tu usuario'); window.location.href='../login.php';</script>";
                        }
                
                        
        
                    }else{
                        // ESTE ES EL DE LA CONTRASEÑA INCORRECTA
                        echo "<script>alert('Error, Contraseña incorrecta'); window.location.href='../login.php';</script>";
                        exit();
                    }

                
            

            
            }else{
                // AQUI REVISO SI EL USUARIO SE ENCUENTRA EN LA BASE O NO
                echo "<script>alert('Error, Usuario no encontrado'); window.location.href='../login.php';</script>";
            }

            
        




        }else{
            // AQUI VERIFICO LAS VARIABLES SI ESTAN VACIAS 
            echo "<script>alert('Error, Faltan datos en el formulario'); window.location.href='../login.php';</script>";
        }

    
    }
    // AQUI TERMINA EL POSTSUBMIT