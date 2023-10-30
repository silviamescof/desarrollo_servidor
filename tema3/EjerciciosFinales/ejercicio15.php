<?php
/**
 * Ejercicio15.php
 * @author Silvia Mesa 
 * 
 * Crea una web donde se pida un usuario y una contraseña. Este debe ser validado
*por una página en php que además debe crear un sesión. El valor correcto para
*usuario es “usuario” y la contraseña correcta será “12345”.
*● Si es correcto debe la página de validación nos mostrará el nombre de
*usuario y un botón para cerrar la sesión y redirigirnos al formulario de login
*inicial.
*● En caso de acceder a la página protegida sin iniciar sesión, debe redirigirnos
*al formulario de login inicial
 */
session_start();
$mensaje;



 if($_SERVER["REQUEST_METHOD"]=="POST"){

    if (isset($_POST['boton_enviar'])) {

        session_destroy();
        $mensaje="la sesion se ha cerrado correctamente";
    };

    if($_POST["usuario"]=="usuario" && $_POST["password"]=="12345"){
        $_SESSION["usuario"]="usuario";
        header("Location: http://localhost/desarrollo_servidor/tema3/EjerciciosFinales/ejercicio15_2.php");
        

    }else{

        echo "<h1>Inicio de sesion incorrecto</h1>";
        header("Location: http://localhost/desarrollo_servidor/tema3/EjerciciosFinales/ejercicio15.php");

}

 }else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">"

        <label for="usuario">Introduce usuario</label>
        <input type="text" name="usuario"><br><br>

        <label for="password">introduce contraseña</label>
        <input type="text" name="password"><br><br>

        <input type="submit" value="Enviar">

    </form>
        <!--no se muestra porque en el else se recarga la pagina -->
        <p><?php $mensaje ?></p>
</body>
</html>
<?php
 }
 ?>