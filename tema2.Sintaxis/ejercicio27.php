<?php
/**
 * Ejercicio27.php
 * @author Silvia Mesa Cofrades
 */

 $numeroCartas=random_int(5,10);
 $cartas=[];
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
            $random=random_int(127169,127173);
            $cartas[]=$random;
        for($i=0;$i<$numeroCartas;$i++){
            $random=random_int(127169,127173);
            while(array_search($random,$cartas)!=false){
                $random=random_int(127169,127173); 
            }
            $cartas[]=$random;
        }
        foreach($cartas as $valor){
            echo '<span class="carta">&#' . $valor.'</span>';
        }
        

    ?>
</body>
</html>