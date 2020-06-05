<?php
     include("conexionBD/class.database.php"); 

    function terminar_tabla(){
        $conexion = new class_db();
        $clientes = $conexion->clientes_ciudades_provincias();
        // $cuantificador es una lista 
        $cuantificador = [];
        
        foreach($clientes as $cliente){
            $cuantificador = cuantificar($cuantificador, $cliente);
        }
        
        foreach($cuantificador as $linea){
            escribir_linea( $linea );
        }
        $conexion->close();
    }

    // Cuantifica las ciudaddes;
    function cuantificar($cuantificador, $cliente){
        $provincia_id = $cliente["provincia_id"];
        $provincia_nombre = $cliente["provincia_nombre"];
        $localidad = $cliente["localidad_nombre"];
        // Si el $cuantificador tiene agregado un elemento con la ciudad como llave, le suma uno al cotador
        if( array_key_exists($localidad, $cuantificador) ){
            $cuantificador[$localidad][3]++;
        }
        // Si el $cuantificador no tiene agregado un elemento con la ciudad como llave, agrega una lista de tres elementos
        //  arg0: provincia id, arg1: nombre de la provincia, arg2: localidad, arg3: contador, comenzado en 1];
        else{
            $cuantificador[$localidad] = [$provincia_id, $provincia_nombre, $localidad, 1];
        }
        return $cuantificador;
    }

    function escribir_linea( $linea ){
        echo("
        <tr id='cuerpo'>
            <td>".$linea[0]."</td>
            <td>".$linea[1]."</td>
            <td>".$linea[2]."</td>
            <td>".$linea[3]."</td>
        </tr>
        ");
    }
?>