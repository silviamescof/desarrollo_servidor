<?php
/**
 * Ejercicio final simulacro examen
 * @author silvia mesa cofrades
 */
$valido=true;
$errores="Se han encontrado los siguientes errores:<br>";
    

 if($_SERVER["REQUEST_METHOD"]=="POST"){

        //funcion que filtra los valores para hacer una lectura limpia///
        function limpiarDato($var){
            $dato=htmlspecialchars(strip_tags(trim($var)));
            return $dato;
        };
        ///lectura limpia de los datos//

    $nombre=limpiarDato($_POST["nombre"]);
    $email=limpiarDato($_POST["email"]);
    $password=limpiarDato($_POST["password"]);
    $password2=limpiarDato($_POST["passwordConfirm"]);
    $genero=isset($_POST["genero"])? limpiarDato($_POST["genero"]):"";
    $terminos=isset($_POST["terminos"])? limpiarDato($_POST["terminos"]):"no";
    
        //requisitos de nuestro negocio//

    if($nombre==""||$email==""){
        $errores=$errores."<br>".'*Ni el nombre ni el email deben estar vacios';
        $valido=false;
    };
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errores=$errores."<br>".'*El email no cumple con el patron de validacion';
        $valido=false;
    };
    if($password!=$password2){
        $errores=$errores."<br>"."*Las contraseñas no coinciden";
        $valido=false;
    };
    if($genero==""){
        $errores=$errores."<br>"."*No has marcado ningun genero";
        $valido=false;
    };
    if($terminos!="si"){
        $errores=$errores."<br>"."*Es obligatorio aceptar los terminos para continuar";
        $valido=false;
    };

    //accion si la validacion es correcta o no///
    if($valido==true){
        session_start();
        setcookie("usuarioRegistrado",$nombre,time()+3600*24);
        $_SESSION["nombreUsuario"]=$nombre;
    }

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
    <form action="formulario.php" method="POST">
    <label for="nombre">Escribe aqui tu nombre si es la primera vez    
    <input type="text" name="nombre" value="<?php echo isset($_COOKIE["usuarioRegistrado"])?$_COOKIE["usuarioRegistrado"]: "" ?>"><br><br>

    <label for="email">Escribe aqui tu email</label>
    <input type="email" name="email"><br><br>

    <label for="password">Escribe aqui tu contraseña</label>
    <input type="password" name="password"><br><br>

    <label for="passwordConfirm">Repite contraseña</label>
    <input type="password" name="passwordConfirm"><br><br>
    <fieldset>Seleccione identidad de genero<br>
    <label for="genero">Fenemino</label>
    <input type="radio" name="genero" value="fenemino"><br><br>

    <label for="genero">Maculino</label>
    <input type="radio" name="genero" value="masculino"><br><br>
   
    <label for="genero">Otro</label>
    <input type="radio" name="genero" value="otro" ><br><br>
    
    </fieldset>
    <label for="terminos">Aceptar terminos y condiciones</label>
    <input type="checkbox" name="terminos" value="si"><br><br>

    <input type="submit" name="enviar" value="enviar"><br><br>
</form> 
    <?php
        if($valido==true){
            echo "<p>Su usuario se ha creado correctamente.";
        ?>
        <form action="http://localhost/desarrollo_servidor/tema3/modelo%20de%20examen/bienvenida.php" method="POST">
            <button type="submit" name="acceso" value="pulsado">Pulsa para ir a zona privada</button>
        </form>
        <?php   
        }else{
            echo "<p>$errores</p>";
        };
    ?>
</body>
</html>