<?php
/**
 * Ejercicio23.php
 * @author Silvia Mesa Cofrades
 */
    $numBolas=random_int(5,15);
    $arrayBolas=[];
    $valoresRepetidos;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/ejercicios_arrays.css" title="Color">
    <title>Document</title>
</head>
<body>
    <?php
    echo '<h1> Entre estas '.$numBolas.' bolas...</h1>';
        for($i=0;$i<$numBolas;$i++){
            $arrayBolas[$i]=random_int(10102,10111);
            echo '&#'.$arrayBolas[$i];
        }
        
        $arrayBolas=array_unique($arrayBolas);
        echo '<h1>.....hay'.count($arrayBolas).' bolas distintas. </h1>';
        //$arrayBolas=array_values($arrayBolas);

        foreach($arrayBolas as $valor ){
            echo '&#'.$valor; 
        }

    ?>   
<!-- </body> -->
</html>