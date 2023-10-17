<?php
/**
 * Ejercicio4.php
 * 
 * @author Silvia Mesa
 * 
 * Escriba un programa que dibuje un cuadrado que conste de dos páginas.
*● En la primera página se solicitan el tamaño del cuadrado en píxeles. (Debe ser un
*tamaño válido, de lo contrario informar al usuario)
*● En la segunda página se muestra el cuadrado negro.

 */
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
        if($_POST["lado"]>0){
    ?>
    <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
     width="120" height="100" viewBox="0 0 120 100">
    <rect x="10" y="10" width="<?php echo $_POST["lado"]?>" height="<?php echo $_POST["lado"]?>"
        fill="RoyalBlue" />
    </svg>
    <?php
        }else{
            echo "no me engañas, la medida es negativa";
        }
    ?>
   </body>
</html>
