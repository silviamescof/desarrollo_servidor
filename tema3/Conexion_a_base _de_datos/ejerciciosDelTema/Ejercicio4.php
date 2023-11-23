<?php
/**
 * Ejercicio 4:
*Crea una pequeña aplicación, que conste de dos ficheros. El primero será un formulario
*que nos permita recoger los datos para la creación de un nuevo usuario. El segundo será
*un script en php que valide los datos y en caso de ser correctos, los almacene en la tabla
*usuarios de la base de datos empresa e informar que el proceso se ha realizado
*correctamente. En caso de error, debe informar al usuario.
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio4</title>
</head>
<body>
    
    <form action="Ejersisio4.php" method="post">ALTA DE USUAIO<br><br>
    <table>
        <tr>
            <td><label for="nombre">NOMBRE</label></td>
            <td><input type="text" name="nombre"></td>
        </tr>
        <tr>
            <td><label for="clave">CLAVE</label></td>
            <td><input type="text" name="clave"></td>
        </tr>  
        <tr>  
            <td><label for="rol">ROL</label></td>
            <td><input type="number" name="rol"></td>
        </tr>
        <tr>
            <td colespan="2"><input type="submit" name="enviar"></td>
        </tr>
    </form>
</table>
</body>
</html>