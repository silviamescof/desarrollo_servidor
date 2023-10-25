<?php
/**
 * Ejercicio14.php
 * @author Silvia Mesa Cofrades
 * 
 * Crea un formulario que permita seleccionar las preferencias en un vuelo. Los datos a
*introducir serán los siguientes:
*• Nombre del usuario
*• Asiento: pasillo, ventanilla o centro.
*• Menú: vegetariano, no-vegetariano, diabético o infantil.
*• Si está interesado en recibir informaciones comerciales (checkbox)
*Una vez enviado el formulario se mostrará un mensaje indicando que la información
*ha sido correctamente almacenada.
*Al volver a cargar el formulario se incluirán los valores anteriormente seleccionados
*por el usuario, que estarán guardados en cookies.
*Si se modifican los valores del formulario de deberá actualizar el valor de las
*cookies.
*Se establecerá un tiempo de duración de las cookies de 10 días.
 */
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Elimina las cookies antiguas
    setcookie("nombre", "", time() - 3600);
    setcookie("asiento", "", time() - 3600);
    setcookie("menu", "", time() - 3600);
    setcookie("informacion", "", time() - 3600);

    // Establece las nuevas cookies
    setcookie("nombre", $_POST["nombre"], time() + 3600 * 24 * 10);
    setcookie("asiento", $_POST["asiento"], time() + 3600 * 24 * 10);
    setcookie("menu", $_POST["menu"], time() + 3600 * 24 * 10);
    setcookie("informacion", $_POST["informacion"], time() + 3600 * 24 * 10);

    echo "<h1>Hemos almacenado y actualizado tu información</h1>";

}else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Preferencias</title>
</head>
<body>
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
    <label for="nombre">Nombre Completo</label>
    <input type="text" name="nombre" value="<?php echo $_COOKIE['nombre'] ?? ''; ?>"><br><br>
    <label for="asiento">Selecciona preferencias de asiento</label>
    <input type="radio" name="asiento" value="pasillo" <?php if ($_COOKIE['asiento'] === 'pasillo') echo 'checked'; ?>>Pasillo
    <input type="radio" name="asiento" value="ventana" <?php if ($_COOKIE['asiento'] === 'ventana') echo 'checked'; ?>>Ventanilla
    <input type="radio" name="asiento" value="centro" <?php if ($_COOKIE['asiento'] === 'centro') echo 'checked'; ?>>Centro<br><br>
    <label for="menu">Elige el tipo de menú</label>
    <input type="radio" name="menu" value="vegetariano" <?php if ($_COOKIE['menu'] === 'vegetariano') echo 'checked'; ?>>Vegetariano
    <input type="radio" name="menu" value="carnivoro" <?php if ($_COOKIE['menu'] === 'carnivoro') echo 'checked'; ?>>Carnívoro
    <input type="radio" name="menu" value="diabetico" <?php if ($_COOKIE['menu'] === 'diabetico') echo 'checked'; ?>>Diabético
    <input type="radio" name="menu" value="infantil" <?php if ($_COOKIE['menu'] === 'infantil') echo 'checked'; ?>>Infantil<br><br>
    <label for="informacion">¿Quieres recibir información comercial?</label>
    <input type="checkbox" name="informacion" value="si" <?php if ($_COOKIE['informacion'] === 'si') echo 'checked'; ?>>Sí
    <input type="checkbox" name="informacion" value="no" <?php if ($_COOKIE['informacion'] === 'no') echo 'checked'; ?>>No<br><br>

    <input type="submit" value="Enviar">
</form>
</body>
</html>
<?php
};
?>