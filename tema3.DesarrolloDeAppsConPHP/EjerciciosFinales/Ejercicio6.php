<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        if(isset($_REQUEST["fruta"])){
            echo '<img src="img/img/frutas/'.$_REQUEST["fruta"].'" alt="Imagen de fruta:'.$_REQUEST["fruta"].'" class="fruta"/>'; 
        }
    ?>
</body>
</html>