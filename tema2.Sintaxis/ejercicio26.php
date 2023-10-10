<?php
/**
 * Ejercicio26.php
 * @author Silvia Mesa Cofrades
 */

$emoticonos=[];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/ejercicios_arrays.css" type="text/css">
    <title>Document</title>
</head>
<body>
    <?php
    
    $emoticonos=array_merge(range(128512 ,128580),
                            range(129296 ,129303),
                            range(129312 ,129327),
                            range(129392,129392),
                            range(129393,129393),
                            range(129395 ,129398),
                            range(129402 ,129402),
                            range(129488, 129488));
    
    echo '<h1>'.count($emoticonos).' emoticonos </h1>';

    foreach($emoticonos as $valor) {
        echo '<span class="emoticono">&#' . $valor.'</span>';
    }
        echo '<h1>Uno al azar</h1>';
        $azar=array_rand($emoticonos);
        echo '<span class="emoticono">&#'.$emoticonos[$azar].'</span>';

 
    ?>
    <h1>Silvia Mesa Cofrades</h1>   
</body>
</html>