<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="StyleSheet" href="css/index.css" >
    <link rel="StyleSheet" href="css/formulario.css" >
    
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <title>Alta Usuario</title>
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
        <form action="alta_usuario_control.php" method="post">
            <?php verificar_datos();?>
            <input class="campo" type="text" name="nombre" placeholder="Nombre usuario" required>
            <br>
            <input class="campo" type="number" name="dni" placeholder="D.N.I. "min="0" required>
            <br>
            <input class="campo" type="text" name="localidad" placeholder="Localidad" required>
            <br>
            <br>
            <input type="submit" name="dar_de_alta" value="Dar de alta">
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
?>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="js/formulario.js"></script>
</body>
</html>
