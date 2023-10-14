<?php
/**
 * Ejercicio1 Tema 3
 * @author Silvia Mesa
 * 
 * Escribe un fichero que reciba dos parametros, num1 y num2 enviados
 * a través de un formulario y que muestre su suma. Hay que comprobar
 * que los dos argumentos existan y que sean dos numeros.
 */

//si el formulario se carga por el post, devuelve el resultado
 if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(is_numeric($_POST["num1"])&&is_numeric($_POST["num2"])){
        $resultado = $_POST["num1"] + $_POST["num2"];
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method = "POST" action="<?php $_SERVER["SCRIPT_NAME"]?>">
        <label for = "num1">Sumando1</label>
        <input id= "num1" name= "num1" type="number"><br>
        <label for = "num2">Sumando2</label>
        <input id="num2" name="num2" type="number"><br>
        <label for = "resultado">resultado de la suma</label>
        <input id="resultado" type="number" value="<?php echo $resultado; ?>" readonly>
        <button type="submit">Calcular Resultado</button>
    </form>
    
</body>
</html>