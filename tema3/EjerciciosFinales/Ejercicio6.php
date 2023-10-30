<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="ejercicios-formularios.css">
    <title>Document</title>
</head>
<body>
    <?php
        if(isset($_REQUEST["fruta"])){
            echo '<img class="fruta" src="img/img/frutas/'.$_REQUEST["fruta"].'" alt="Imagen de fruta:'.$_REQUEST["fruta"].'" />'; 
        }
    ?>
</body>
</html>