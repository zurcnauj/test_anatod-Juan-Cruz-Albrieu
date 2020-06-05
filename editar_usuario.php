<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="StyleSheet" href="index.css" >
    <link rel="StyleSheet" href="css/index.css" >
    <link rel="StyleSheet" href="css/formulario.css" >
    
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <title>Editar usuarios</title>
</head>
<body>

    <nav>
        <ul>
            <li><a href="alta_usuario.php">Alta cliente</a></li>
            <li><a href="editar_usuario.php">Editar cliente</a></li>
            <li><a href="clientes.php">Clientes</a></li>
            <li><a href="provincias.php">Provincias</a></li>
          </ul>
    </nav>    
    
    <div id="form">
        <form action="editar_usuario_control.php" method="post">
            <?php verificar_datos();?>

            <input class="campo" type="text" name="nombre_ant" placeholder="Nombre usuario actual" valur=<?php valor_nombre();?> required>
            <br>
            <input class="campo" type="number" name="dni_ant" placeholder="D.N.I. actual"min="0" required>
            <br>
            <input class="campo" type="text" name="localidad_ant" placeholder="Localidad actual" required>
            <br>
            <br>

            <input class="campo" type="text" name="nombre_nue" placeholder="Nuevo nombre usuario"required> 
            <br>
            <input class="campo" type="number" name="dni_nue" placeholder="Nuevo D.N.I. "min="0" required>
            <br>
            <input class="campo" type="text" name="localidad_nue" placeholder="Nuevo localidad" required>
            <br>
            <br>
            <input type="submit" name="dar_de_alta" value="Editar">
        </form>

    </div>

<?php
    function verificar_datos(){
        
        if( array_key_exists("error", $_REQUEST) ){
            
            $error = $_REQUEST["error"];
            if($error){
                echo("<div class='mensaje' id='error'> <p>".$_REQUEST['mensaje']."</p> </div>");
            }
            else{
                echo("<div class='mensaje' id='exito'> <p>".$_REQUEST['mensaje']."</p> </div>");
            }
        }
        else{

        }
    }

    function valor_nombre(){
        if( array_key_exists("error", $_REQUEST) && $_REQUEST["error"] ){
            return "adsf";
        }
        else{
            return "''";
        }
    }
?>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="js/formulario.js"></script>
</body>
</html>