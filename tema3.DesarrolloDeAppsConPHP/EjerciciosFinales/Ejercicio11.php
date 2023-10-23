<?php
/**
 * Ejercicio11.php
 * @author Silvia Mesa Cofrades
 */
$email="";
$info=false;

if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
    echo "La dirección de correo electrónico no es válida.";
}elseif($_POST["email"]!=$_POST["emailDos"]){
    echo "La dirección de correo electrónico no coinciden."; 
}else{
    $email=$_POST["email"];
    $info=$_POST["info"];

    echo 'Tu email es'.$email.' y tu eleccion para recibir info es: '.$info;
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
    <form action="Ejercicio11.html" method="POST">
        <input type="submit" value="IR AL FORMULARIO">
    </form>
</body>
</html>