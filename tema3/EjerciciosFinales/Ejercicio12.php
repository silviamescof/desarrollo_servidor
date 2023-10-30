<?php
/**
 * Ejercicio12.php
 * @author Silvia Mesa Cofrades
 * Escriba una página que permita crear una cookie de duración limitada, comprobar el estado
*de la cookie y destruirla.
*Ejemplo de funcionamiento:
*https://www.mclibre.org/consultar/php/ejercicios/sesiones/cookies/cookies-2.php
 */

 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["accion"])) {
        $accion = $_POST["accion"];
        if ($accion === "CREAR") {
            if ($_POST["duracion"] < 1 || $_POST["duracion"] > 60 || empty($_POST["duracion"])) {
                echo "La duración no es correcta. No se ha creado la cookie";
            } else {
                setcookie("cookie", time()+($_POST["duracion"]), time() + ($_POST["duracion"]));
                echo "La cookie se ha creado correctamente";
            };
        } elseif ($accion === "COMPROBAR") {
            $hora_actual = time();
            $tiempoRestante = isset($_COOKIE["cookie"]) ? $_COOKIE["cookie"] - $hora_actual : 0;
            
            echo 'La cookie se destruirá en ' . $tiempoRestante . ' segundos';
        } elseif ($accion === "DESTRUIR") {
            setcookie("cookie", 1, time() - 100);
            echo "La cookie ha sido destruida";
        } else {
            echo "Error imprevisto";
        }
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
    <p>Elija una opción</p>
    <form action="<?php echo $_SERVER["SCRIPT_NAME"]; ?>" method="POST">
        <ul>
            <li>Crear una cookie con una duracion de <input type="number" name="duracion" min="1" max="60"> segundos entre
            1 y 60 <input type="submit" value="CREAR" name="accion"></li>
            <li>Comprobar la cookie<input type="submit" value="COMPROBAR" name="accion"></li>
            <li>Destruir la cookie<input type="submit" value="DESTRUIR" name="accion"></li>
        </ul>
    </form>
</body>
</html>