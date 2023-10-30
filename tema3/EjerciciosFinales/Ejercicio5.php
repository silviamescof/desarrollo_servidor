<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        if($_POST["lado"]>0 && $_POST["lado"]<100){
    ?>
    <svg class="rect" version="1.1" xmlns="http://www.w3.org/2000/svg"
     width="120" height="100" viewBox="0 0 120 100">
    <rect class="rect" x="10" y="10" width="<?php echo $_POST["lado"]?>" height="<?php echo $_POST["lado"]?>"fill="White"stroke-width="4" stroke="Black"  />
    </svg>
    <?php
        }elseif($_POST["lado"]>=100){
            echo "no lo voy a pintar, porque tus medidad exceden las de la ventana y no daría un buen resultado(100px maximo)";
        }else{
            echo "no me engañas, la medida es negativa";
        }
    ?>
   </body>
</html>