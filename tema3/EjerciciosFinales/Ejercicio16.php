<?php
/**
 * Ejercicio 16.php
 * @author Silvia Mesa Cofrades 
 * 
 * Escriba un programa de dos páginas que muestre un valor numérico y permita
 *subirlo o bajarlo mediante dos botones.
 * Laprimera página contiene un formulario con tres botones de tipo submit con
 *el mismo name.
 *● Lasegunda página recibe el dato, modifica el número y redirige a la primera
 *página.
 *● Elnúmero se guarda en una variable de sesión. Si la variable no está
 *definida, se le dará el valor 0.
 *Ejemplo de funcionamiento:
 *https://www.mclibre.org/consultar/php/ejercicios/sesiones/sesiones-1/sesiones-1-11-1.php
 * 
 * 
 */
session_start();

if($_SERVER["REQUEST_METHOD"]=="POST"){
        
    if(isset($_POST["subir"])){

        if(isset($_SESSION["valor"])){
            $_SESSION["valor"]++;
        } else {
            $_SESSION["valor"] = 1;
        };

    }elseif(isset($_POST["bajar"])){

        if(isset($_SESSION["valor"])){
            $_SESSION["valor"]--;
        } else {
            $_SESSION["valor"] = -1;
        }

    }elseif(isset($_POST["reset"])){
        $_SESSION["valor"] = 0;
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
    <form action=<?php echo $_SERVER["PHP_SELF"]; ?> method="POST">
    <p>
        <span><button type="submit" name="bajar" value="bajar">-</button></span>
        <span><input type="text" name="valor" value="<?php echo isset($_SESSION['valor']) ? $_SESSION['valor'] : 0; ?>" readonly></span>
        <span><button type="submit" name="subir" value="subir">+</button></span>
        <span><button type="submit" name="reset" value="reset">Reset</button></span>
    </p>
</form>
</body>
</html>