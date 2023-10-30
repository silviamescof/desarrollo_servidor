<?php
/**
 * Ejercicio17.php
 * @author Silvia Mesa Cofrades
 * 
 * Escriba un programa de dos páginas que muestre un punto sobre una línea y permita
 *moverlo a derecha o izquierda mediante dos botones.
 *● Laprimera página contiene un formulario con tres botones de tipo submit con el
 *mismo atributo name.
 *● Lasegunda página recibe el dato, modifica la variable que contiene la posición y
 *redirige a la primera página.
 *● Elnúmero se guarda en una variable de sesión. Si la variable no está definida, se le
 *dará el valor 0.
 *● Elancho de la línea son 600px y las coordenadas van de-300 a 300.
 *● Elpunto avanza o retrocede de 20px en 20px.
 *● Cuandoel punto sale del dibujo por un lado, aparece en el lado opuesto.
 *Ejemplo de funcionamiento:
 *https://www.mclibre.org/consultar/php/ejercicios/sesiones/sesiones-1/sesiones-1-12-1.php

 *
 * 
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    if(isset($_POST["izquierda"]))
    {
        if(isset($_SESSION["x"]))
        {
            $_SESSION["x"]-=20;
        }elseif($_SESSION["x"]<-300){

            $_SESSION["x"]= 300;

        }else{
            $_SESSION["x"]= -20;
        };

    }elseif(isset($_POST["derecha"])){
        if(isset($_SESSION["x"]))
        {
            
            if($_SESSION["x"]>300){

                $_SESSION["x"]=-300;
            }else{
                $_SESSION["x"]+=20;
            }
            
        
        }else{
            $_SESSION["x"]=20;
        };

    }elseif(isset($_POST["reset"])){
        $_SESSION["x"]=0;
        session_destroy();
    };
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
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">

        <button type="submit" name="izquierda">☜</button>
        <button type="submit" name="derecha">☞</button>
        <button type="submit" name="reset">Volver al centro</button>
 </form>
    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="600" height="20" viewbox="-300 0 600 20">
        <line x1="-300" y1="10" x2="300" y2="10" stroke="black" stroke-width="5" />
        <circle cx="<?php echo isset($_SESSION['x']) ? $_SESSION['x'] : 0; ?>" cy="10" r="8" fill="red" />
    </svg>
</body>
</html>