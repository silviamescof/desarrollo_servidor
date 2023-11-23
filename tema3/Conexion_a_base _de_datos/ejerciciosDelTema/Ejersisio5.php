<?php
/**
 * 
 */

 function limpiaDato($dato){
    return trim(htmlspecialchars(strip_tags($dato)));
 };

 $nombre=isset($_POST["nombre"]) ? limpiaDato($_POST["nombre"]) : "";
 $apellidouno=isset($_POST["apellidoUno"]) ? limpiaDato($_POST["apellidoUno"]) : "";
 $apellidodos=isset($_POST["apellidoDos"]) ? limpiaDato($_POST["apellidoDos"]) : "";
 $departamento=isset($_POST["departamento"]) ? limpiaDato($_POST["departamento"]) : "";
 
 $errores;

 if(empty($nombre)|| empty($apellidouno) || empty($apellidodos) || empty($departamento)){
    echo '<p>Has dejado campos vacios y asi no se puede enviar el formulario</p>';
 }else{
    
 try{


    $cadena='mysql:dbname=empresa;host=127.0.0.1';
    $usuario='root';
    $pass='';

    $pdo = new PDO($cadena,$usuario,$pass);

    $query = 'INSERT into empleados (nombre, apellido1, apellido2, departamento) values (:nombre, :apellido1, :apellido2, :departamento)';

    $stm = $pdo->prepare($query);
    
    $stm->bindParam(':nombre',$nombre);
    $stm->bindParam(':apellido1',$apellidouno);
    $stm->bindParam(':apellido2',$apellidodos);
    $stm->bindParam(':departamento',$departamento);


    $stm ->execute();

    

}catch(PDOException $e){
    echo "error de conexion con base de datos: tipo:".$e->getMessage();
};
 };

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        echo '<p>han sido afectadas '.$stm->rowCount().' filas</p>';
    ?>
</body>
</html>