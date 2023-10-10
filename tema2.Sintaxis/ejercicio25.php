<?php
/**
 * Ejercicio25.php
 * @author Silvia Mesa Cofrades
 */
$numCorazones=random_int(7,20);
$arrayCorazones=[];
$cuentaValores=[];
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>cuenta corazones</h1>
    <?php
        echo '<h2>'.$numCorazones.' corazones</h2>';
        for($i=0;$i<$numCorazones;$i++){
            $arrayCorazones[$i]=random_int(128147,128152);
            echo '&#'.$arrayCorazones[$i];
        }
        $cuentaValores= array_count_values($arrayCorazones);

        echo '<h2>Conteo</h2>';

        foreach($cuentaValores as $valor => $clave) {
            echo '<h2>'.'&#'.$valor.' => '.$clave.'</h2>';
        }

    ?>
    
</body>
</html>