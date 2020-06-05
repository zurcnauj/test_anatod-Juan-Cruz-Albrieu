<?php
    include("conexionBD/class.database.php"); 

    function terminar_tabla(){
        $conexion = new class_db();
        $clientes = $conexion->clientes();
        foreach($clientes as $cliente){
            escribir_linea($cliente);
        }
        $conexion->close();
    }

    function escribir_linea($cliente){
        echo("
            <tr id='cuerpo'>
                <td>".$cliente["cliente_id"]."</td>
                <td>".$cliente["cliente_nombre"]."</td>
                <td>".$cliente["cliente_dni"]."</td>
                <td>".$cliente["localidad_nombre"]."</td>
                <td>".$cliente["provincia_nombre"]."</td>
            </tr>
        ");

    }
?>