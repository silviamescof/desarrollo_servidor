<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    // Variables para almacenar
    $direccion;
    $precio = $_POST["precio"];
    $tamano = $_POST["tamano"];
    $errores = "";

    // Comprobación si está relleno

    if (empty($_POST["direccion"])) {
        $errores=$errores. "* Se requiere dirección de la vivienda";
    }else{
        $direccion = $_POST["direccion"];
    }; 
    if(empty($_POST["tamano"])) {
        $errores=$errores. "* Se requiere tamano de la vivienda";
    } else{
        $tamano = $_POST["direccion"];
    }
    if(empty($_POST["precio"])){
        $errores=$errores. "* Se requiere precio de la vivienda";
    }else{
        $precio = $_POST["direccion"];
    }
    // comprobar si son numeros
    
    // Si hay errores, mostrarlos
    if (!empty($errores)) {
        
        echo "<h1> No se ha podido realizar la inserción debido a los siguientes errores: </h1><br>";
        echo "<p>".$errores."</p>";

    } else {

    }
?>
    
</body>
</html>
