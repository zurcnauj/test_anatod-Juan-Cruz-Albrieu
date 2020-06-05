<?php
    include("conexionBD/class.database.php");   

    $nombre_ant = trim($_REQUEST["nombre_ant"]);
    $dni_ant = (int)$_REQUEST["dni_ant"];
    $localidad_ant = trim($_REQUEST["localidad_ant"]);

    $nombre_nue = trim($_REQUEST["nombre_nue"]);
    $dni_nue = (int)$_REQUEST["dni_nue"];
    $localidad_nue = trim($_REQUEST["localidad_nue"]);
    
    $conexion = new class_db();

    // Verifica si la ciudad puesto existe, si no es asi, retorna "F"
    $localidad_codigo_ant = $conexion->codigo_ciudad($localidad_ant);
    //  Si no existe la ciudad, lo avisa
    if( $localidad_codigo_ant == "F"){
        $error = true;
        $mensaje = "La ciudad actual no existe";
    }
    //  Si la ciudad existe
    else{
        // Una vez confirmada, se verifica que el usuario exista.
        if($conexion->existe_usuario($nombre_ant, $dni_ant,$localidad_codigo_ant )){
            // Verifica si la ciudad nueva es diferente al anterior
            if($localidad_ant != $localidad_nue){
                $localidad_codigo_ant = $conexion->codigo_ciudad($localidad_nue);
                
            }
            // Si la ciudad nueva es la misma que la que ya estaba, no se vuelve a buscar
            else{
                $localidad_codigo_nue = $localidad_codigo_ant;
            }
            // Si la ciudad nueva no existe, lo avisa
            if($localidad_codigo_nue == "F"){
                $error = true;
                $mensaje = "La ciudad nueva no existe";
            }
            // Si la ciudad nueva existe, se procede a verificar que los cambios no hagan que se repitan.
            else{
                //  Si los cambios producen que el usuario ya existe, lo avisa
                if($conexion->existe_usuario($nombre_nue, $dni_nue,$localidad_codigo_nue) ){
                    $error = true;
                    $mensaje = "Los cambios no pueden aplicarse <br> Ya existe un usuario con estos datos";
                }
                // si no produce un problema, procede a modificar el usuario
                else{
                    $conexion->editar_usuario($nombre_ant, $dni_ant,$localidad_codigo_ant,$nombre_nue, $dni_nue,$localidad_codigo_nue);
                    $error = false;
                    $mensaje = "Se realizo con existo";
                }
            }     
        }
        // Si el usuario no existe, avisa que no se puede modificar
        else{
            $error = true;
            $mensaje = "El usuario a cambiar no existe";
        }
    }

    $conexion->close();
    header("Location: editar_usuario.php?error=".$error."&mensaje=".$mensaje);
?>