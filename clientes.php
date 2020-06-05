<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="StyleSheet" href="css/index.css" >
    <link rel="StyleSheet" href="css/tabla.css" >

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <title>Document</title>
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
    <br>
    <br>

    <div id="tabla">
        <p id="titulo">Clientes</p>
        <table >

            <tr id="cabeza">
                <th>Id</th>
                <th>Nombre</th>
                <th>D.N.I.</th>
                <th>Locanidad</th>
                <th>Provincia</th>
            </tr>
            <?php  include("clientes_control.php");
                terminar_tabla();
            ?>
    
        </table> 
    </div>   

</body>
</html>