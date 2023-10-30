<!--Crea una pagina web con un formulario para elegir el idioma en el que se muestra, ingles, o español
Almacena la eleccion del usuario, con una coockie para que la siguiente vez que el usuario se conecte la pagina aparezca
direcctamente en su idioma. Si la cookie no existe, la pagina se mostrara en español-->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   
</form>
    <?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(!isset($_COOKIE["idioma"])){
            setcookie("idioma",$_POST["radio"],time()+3600*24);
            echo 'Bienvenido por primera vez te hablaremos por defecto en español pero   ';
            echo 'Tu idioma preferente para el futuro es :  '.$_POST["radio"]; 
        };
    }else{
        if(!isset($_COOKIE["idioma"])){
    ?>
            <form action="<?php $_SERVER["SCRIPT_NAME"]?>" method="POST">
            <label for="radio">Escribe tu idioma favorito</label><br><br>
            <input type="radio" value="ingles" name="radio">Ingles<br><br>
            <input type="radio" value="spain" name="radio">Spain<br><br>
            <input type="submit">';
    <?php
        }else{
            echo 'Tu idioma preferente es :  '.$_COOKIE["idioma"];
        };
    };
    //usar para resetear la cookie
    //setcookie("idioma",$_POST["radio"],time()-3600*24);
    ?>
</body>
</html>