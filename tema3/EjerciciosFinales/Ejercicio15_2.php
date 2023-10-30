<?php
    session_start();
    if(!isset($_SESSION["usuario"])){
        header("Location: http://localhost/desarrollo_servidor/tema3/EjerciciosFinales/ejercicio15.php");
        exit;
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
    <p>Bievenido <?php echo $_SESSION["usuario"]; ?></p>
    <form method="post" action="ejercicio15.php">
    <input type="submit" name="boton_enviar" value="Cerrar Sesion">
</form>

</body>
</html>