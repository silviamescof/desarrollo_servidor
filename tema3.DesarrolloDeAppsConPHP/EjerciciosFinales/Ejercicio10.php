<?php
/**
 * Ejercicio10.php
 * @author Silvia Mesa Cofrades
 */
$sexo="";
$aficiones=[];

if(empty($_POST["sexo"])){
    echo "<h1>has dejado vacia el sexo</h1>";
}elseif(!isset($_POST["aficiones"])){
    echo "<h1>No has marcado ninguna aficion</h1>";
}else{
    $aficiones=$_POST["aficiones"];
    $sexo=$_POST["sexo"];

    echo '<h1>Tu sexo es : '.$sexo.'<br> Y tus aficiones son:  ';
    foreach($aficiones as $aficion){
        echo ' '. $aficion.' ';
    }
    echo '</h1>';
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
<form action="Ejercicio10.html" method="POST">
        <input type="submit" value="IR AL FORMULARIO">
    </form>
</body>
</html>