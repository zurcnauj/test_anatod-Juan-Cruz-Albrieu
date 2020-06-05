<?php
    include("conexionBD/class.database.php");   

    $nombre = trim($_REQUEST["nombre"]);
    $dni = (int)$_REQUEST["dni"];
    $localidad = trim($_REQUEST["localidad"]);
    
    $conexion = new class_db();
    
    $localidad_codigo = $conexion->codigo_ciudad($localidad);
    // Si la ciudad no existe retorna "F" y enviar para mostrar el error
    if( $localidad_codigo == "F" ){
        $mensaje = "La ciudad no fue encontrada ";
        $error = true;
    }
    // Si existe, retorna el id de la ciudad
    else{
        // Si el usuario a crear existe, lo avisa
        $error = $conexion->existe_usuario($nombre,$dni,$localidad_codigo);
        if( $error){
            $mensaje = "El cliente existe.";
        }
        // Si el usuario no existe, procede a crearlo
        else{
            $conexion->agregar_usuario($nombre,$dni,$localidad_codigo);
            $mensaje = "La operación se realizó con éxito.";
        }
    }
    $conexion->close();
    // Se redirige a la pagina y confirma el restulado
    header("Location: alta_usuario.php?error=".$error."&mensaje=".$mensaje);
?>