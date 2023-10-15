<?php
/**
 * Ejercucio 2 Tema 3
 * @author Silvia Mesa 
 * 
 * 
 * Añade un vinculo para borrar la cookie de este ejemplo:  
 * 
 * 
 * if (!isset($_COOKIE['visitas'])) { // si no existe
  *  setcookie('visitas', '1', time() + 3600 * 24);
   * echo "Bienvenido por primera vez";
   * } else { // si existe
   * $visitas = (int) $_COOKIE['visitas'];
   * $visitas++; // se reescribe incrementada
    * setcookie( 'visitas', $visitas, time() + 3600 * 24);
   * echo "Bienvenido por $visitas vez";
    * }
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
if (isset($_GET["link"]) && $_GET["link"] == "pulsado") {
    setcookie('visitas', '', time() - 3600); // Elimina la cookie configurando el tiempo de vida en el pasado
    echo "Cookie eliminada";
    header("Location: " . $_SERVER["SCRIPT_NAME"]);
    
    exit; // Asegúrate de que el script se detenga aquí
}
?>

<a href="<?php echo $_SERVER["SCRIPT_NAME"]; ?>?link=pulsado">Eliminar cookies</a><br>

<?php
if (!isset($_COOKIE['visitas'])) { // si no existe
    setcookie('visitas', '1', time() + 3600 * 24);
    echo "Bienvenido por primera vez";
} else { // si existe
    $visitas = (int) $_COOKIE['visitas'];
    $visitas++; // se reescribe incrementada
    setcookie('visitas', $visitas, time() + 3600 * 24);
    echo "Bienvenido por $visitas vez";
}

?>
</body>
</html>