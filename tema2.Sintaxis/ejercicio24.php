<?php
/**
 * Ejercicio24.php
 * @author Silvia Mesa Cofrades
 */

 $numEmoticonos=random_int(10,20);
 $arrayEmoticonos=[];
 $ausente=0;
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
    <h1>BUSCA EMOTICONO</h1>

    <?php
        echo '<h1>'.$numEmoticonos.' emoticonos</h1>';
        for($i=0;$i<$numEmoticonos;$i++){
            $arrayEmoticonos[$i]=random_int(128512,128580);
            echo '&#'.$arrayEmoticonos[$i];
        }
        $ausente=random_int(128512,128580);
        
        while(array_search($ausente,$arrayEmoticonos)!=false){
            $susente=random_int(128512,128580);
        }

        echo '<h1> El emoticono &#'.$ausente.' NO esta entre ellos';

   ?>  
</body>
</html>