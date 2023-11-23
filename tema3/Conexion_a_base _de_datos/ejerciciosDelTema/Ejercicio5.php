<?php
/**
 * Ejercicio 5:
*Crea una pequeña aplicación, que conste de dos ficheros. El primero será un formulario que
*nos permita recoger los datos para la creación de un nuevo empleado. El segundo será un
*script en php que valide los datos y en caso de ser correctos, los almacene en la tabla
*usuarios de la base de datos empresa e informar que el proceso se ha realizado
*correctamente. En caso de error, debe informar al usuario
 */

 $cadena='mysql:dbname=empresa;host=127.0.0.1';
 $usuario='root';
 $pass='';
 
 $nombre=isset($_POST["nombre"]) ? $_POST["nombre"] : "";
 $clave=isset($_POST["clave"]) ? $_POST["clave"] : "";
 $rol=isset($_POST["rol"]) ? $_POST["rol"] : "";

 try{
     $pdo = new PDO($cadena,$usuario,$pass);

     $query = 'SELECT coddept from departamentos';

     $stm = $pdo->prepare($query);

     $stm ->execute();

     //debug echo '<p>han sido afectadas '.$stm->rowCount().' filas</p>';

 }catch(PDOException $e){
     echo "error de conexion con base de datos: tipo:".$e->getMessage();
 };

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<form action="Ejersisio5.php" method="post">ALTA DE EMPLEADO<br><br>
    <table>
        <tr>
            <td><label for="nombre">NOMBRE</label></td>
            <td><input type="text" name="nombre"></td>
        </tr>
        <tr>
            <td><label for="apellidoUno">APELLIDO1</label></td>
            <td><input type="text" name="apellidoUno"></td>
        </tr>  
        <tr>  
            <td><label for="apellidoDos">APELLIDO2</label></td>
            <td><input type="text" name="apellidoDos"></td>
        </tr>
        <tr>  
            <td><label for="departamento">DEPARTAMENTO</label></td>
            <td><select name=departamento>
                    <?php
                        while($fila=$stm->fetch()){
                            echo '<option value="'.$fila["coddept"].'">'.$fila["coddept"].'</option>';
                        }
                    ?>
                
                </select>
            </td>
        </tr>
        <tr>
            <td colespan="2"><input type="submit" name="enviar"></td>
        </tr>
    </form>
</body>
</html>