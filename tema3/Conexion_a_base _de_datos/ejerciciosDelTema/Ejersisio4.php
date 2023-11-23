<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
       
        $cadena='mysql:dbname=empresa;host=127.0.0.1';
        $usuario='root';
        $pass='';
        
        $nombre=isset($_POST["nombre"]) ? $_POST["nombre"] : "";
        $clave=isset($_POST["clave"]) ? $_POST["clave"] : "";
        $rol=isset($_POST["rol"]) ? $_POST["rol"] : "";

        try{
            $pdo = new PDO($cadena,$usuario,$pass);

            $query = 'INSERT into usuarios (nombre, clave, rol) values (:nombre, :clave, :rol)';
    
            $stm = $pdo->prepare($query);

            $stm -> bindParam(':nombre',$nombre);
            $stm -> bindParam(':clave',$clave);
            $stm -> bindParam(':rol',$rol);

            $stm ->execute();

            echo '<p>han sido afectadas '.$stm->rowCount().' filas</p>';

            echo '<a href=Ejercicio4.php>volver a formulario</href>';

        }catch(PDOException $e){
            echo "error de conexion con base de datos: tipo:".$e->getMessage();
        };
        
    ?>
</body>
</html>