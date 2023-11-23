<?php
/**
* Ejercicio 3:
*Modifica el ejercicio anterior y añade al final de cada fila de datos, un botón eliminar.
*Este debe lanzar un script que elimine el usuario concreto.
*
*/

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar usuario</title>
</head>
<body>
    <?php
        $cadena='mysql:dbname=empresa;host=127.0.0.1';
        $usuario='root';
        $clave='';
        $id=isset($_POST["codigo"]) ? $_POST["codigo"] : "";

        try{
            $pdo = new PDO($cadena,$usuario,$clave);

            $query = 'DELETE FROM usuarios WHERE codigo = :id';
    
            $stm = $pdo->prepare($query);
            $stm -> bindParam(':id',$id);
            $stm ->execute();

            echo '<p>han sido afectadas '.$stm->rowCount().' filas</p>';

            echo '<a href=Ejercicio2.php>volver a ejercicio2</href>';
            
            $pdo=null;
        }catch(PDOException $e){
            echo "error de conexion con base de datos: tipo:".$e;
        };
        

    ?>
</body>
</html>