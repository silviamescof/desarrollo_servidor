<!DOCTYPE html>
<!--Crea un script que nos muestre una tabla con todos los datos almacenados en la
tabla usuarios de la base de datos empleados.
-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $cadena_conexion='mysql:dbname=empresa;host=127.0.0.1';
        $usuario='root';
        $pass='';

        try{
            $pdo = new PDO ($cadena_conexion,$usuario,$pass);
            echo "Conexion establecida con exito ok <br>";
            $consulta='SELECT codigo,nombre,clave,rol FROM usuarios';
            $stm=$pdo->query($consulta);
            $stm->setFetchMode(PDO::FETCH_OBJ);
            echo '<form action="Ejercicio3.php" method="post">';
            while ($fila=$stm->fetch()){
                echo '<p>Codigo: '.$fila->codigo.' Nombre: '.$fila->nombre.' Clave: '.$fila->clave.' Rol '.$fila->rol.'</p><button type="submit" name="codigo" value="'.$fila->codigo.'">Eliminar</button><br>';

            };
            echo '</form>';
        }catch(PDOException $e){

        };
    ?>
</body>
</html>