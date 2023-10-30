<?php
/**
 * Ejercicio13.php
 * @author Silvia Mesa Cofrades
 * 
 * 
 * Ejercicio 13:
*Crea una pagina que simule ser la de un periódico. La misma debe permitir configurar que tipo
*de titular deseamos que aparezca al visitarla, pudiendo ser:
*1. Noticia política.
*2. Noticia económica.
*3. Noticia deportiva.
*● Mediante tres objetos de tipo radio, permitir seleccionar que titular debe mostrar el
*periódico.
*● Almacenar en una cookie el tipo de titutar que desea ver el cliente.
*
 */

 $noticia;
 

if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(!isset($_COOKIE["noticia"])){
        setcookie("noticia",$_POST["tipo"],time()+3600*30);
        echo "<h1>Te mostraremos tus preferencias y las almacenaremos para el futuro</h1>";
    };
    switch($_POST["tipo"]){
        case "politica":
            $noticia="https://www.publico.es/politica";
            break;
        case "economica":
            $noticia="https://www.eleconomista.es/economia/";
            break;
        case "deportiva":
            $noticia="https://www.marca.com/ultimas-noticias.html";
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
        <iframe src="<?php echo $noticia; ?>" width="1500" height="2000"></iframe>
    </body>
    </html>
    <?php


}else{
    setcookie("noticia",0,time()-1);
    echo "<h1>vamos a almacenar de nuevo tus preferencias, elige</h1>";

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
            <label for=tipo>Escribe el tipo de noticia que prefieres ver</label>
            <input type="radio" name=tipo value="politica" checked>Noticia Politica
            <input type="radio" name=tipo value="economica">Noticia Economica
            <input type="radio" name=tipo value="deportiva">Noticia Deportiva
            <input type=submit value="enviar">
        </form>
    </body>
    </html>
    <?php
}
?>
