<?php
/**
 * Ejercicio 8.php
 * @author Silvia Mesa Cofrades
 */
$nombre;
$apellido;

if(!empty($_POST["nombre"])){
    $nombre=$_POST["nombre"];
    $nombre=strip_tags($nombre);
    $nombre=htmlspecialchars($nombre);
    $nombre=trim($nombre);
    echo '<h1>El nombre introducido es'.$nombre.' </h1>';
}else{
    echo "<h1>has dejado vacio el nombre</h1>";
}


if(!empty($_POST["apellidos"])){
    $apellido=$_POST["apellidos"];
    $apellido=strip_tags($apellido);
    $apellido=htmlspecialchars($apellido);
    $apellido=trim($apellido);
    echo '<h1>El apellido introducido es'.$apellido.' </h1>';

}else{
    echo "<h1>has dejado vacio el apellido</h1>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="Ejercicio8.html" method="POST">
        <input type="submit" value="IR AL FORMULARIO">
    </form>
</body>
</html>