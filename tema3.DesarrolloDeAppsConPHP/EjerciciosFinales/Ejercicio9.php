<?php
/**
 * Ejercicio9.php
 * @author Silvia Mesa Cofrades
 */
$edad=0;
$peso=0;
if(empty($_POST["edad"])){
    echo "<h1>has dejado vacia la edad</h1>";
}elseif(!is_numeric($_POST["edad"])){
    echo "<h1>has de introducir un dato numeérico</h1>";
}elseif(!ctype_digit($_POST["edad"])){
    echo "<h1>La edad no puede contener decimales</h1>";
}elseif($_POST["edad"]<0){
    echo "<h1>Tienes que poner un numero positivo</h1>";
}elseif($_POST["edad"]<5||$_POST["edad"]>130){
    echo "<h1>La edad ha de ser comprendida entre 5 y 130</h1>";
}else{
    $edad=$_POST["edad"];
};

if(empty($_POST["peso"])){
    echo "<h1>has dejado vacio el peso</h1>";
}elseif(!is_numeric($_POST["peso"])){
    echo "<h1>has de introducir un dato numérico</h1>";
}elseif($_POST["peso"]<0){
    echo "<h1>Tienes que poner un numero positivo</h1>";
}elseif($_POST["peso"]<10||$_POST["peso"]>1150){
    echo "<h1>El peso ha de ser comprendida entre 10 y 150</h1>";
}else{
    $peso=$_POST["peso"];
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
    <form action="Ejercicio9.html" method="POST">
        <input type="submit" value="IR AL FORMULARIO">
    </form>
</body>
</html>