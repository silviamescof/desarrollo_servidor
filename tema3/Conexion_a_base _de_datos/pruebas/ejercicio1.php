<?php
$cadena_conexion='mysql:dbname=empresa;host=127.0.0.1';
$usuario='root';
$clave='';
try{
    $bd=new PDO($cadena_conexion,$usuario,$clave);
    echo "Conexion realizada con exito";
    $sql='SELECT nombre,clave,rol FROM usuarios';
    $usuarios=$bd->query($sql);
    echo $usuarios->rowCount()."<br>";
    foreach ($usuarios as $row){
        echo $row['nombre']."\t";
        echo $row['clave']."\t";
    }
    $bd->close();

}catch(PDOException $e){
    echo 'Error con la base de datos: '.$e->getMessage();
}
?>