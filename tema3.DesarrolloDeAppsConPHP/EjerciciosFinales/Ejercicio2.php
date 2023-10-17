<?php
/**
 * Ejercicio 2:
*Diseñar un formulario web que pida la altura y el diámetro de un cilindro en metros. Una vez
*el usuario introduzca los datos y pulse el botón calcular, deberá calcularse el volumen del
*cilindro y mostrarse el resultado en el navegador. Debes comprobar e informar al usuario si
*los datos introducidos no son válidos.
 */
$respuesta;
$altura;
$diametro;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        if(empty($_POST["altura"])||is_null($_POST["altura"])){

            echo "lo siento , pero la altura no puede estar vacía ni nula, revisa el dato";

        }elseif(!is_numeric($_POST["altura"])){

            echo "lo siento, pero asegurate de introducir numeros";

        }else{

            $altura=$_POST["altura"];
        }

        if(empty($_POST["diametro"])||is_null($_POST["diametro"])){

            echo "lo siento , pero la altura no puede estar vacía ni nula, revisa el dato";

        }elseif(!is_numeric($_POST["diametro"])){

            echo "lo siento, pero asegurate de introducir numeros";

        }else{

            $diametro=$_POST["diametro"];
        }

        $areaBase= 3.14*pow(($diametro/2),2);
        echo "El area del cilindro es ".$areaBase*$altura;
    ?>
</body>
</html>