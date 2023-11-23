<?php
$cadena_conexion='mysql:dbname=empresa;host=127.0.0.1';
$usuario='root';
$contra='';
$nombre=isset($_POST["usuario"])?$_POST["usuario"] : "";
$clave=isset($_POST["password"])?$_POST["password"] : "";
$correcto=false;

try{

    $bd=new PDO ($cadena_conexion,$usuario,$contra);
    echo 'Conexion realizada con exito <br>';

    $respuesta=$bd->prepare('select nombre,clave from usuarios where nombre = ? and clave = ?');
    $respuesta->execute(array($nombre,$clave));

    foreach($respuesta as $valor){
        if($nombre==$valor["nombre"] && $clave==$valor["clave"]){
            echo "el usuario y la contraseña con correctos, puede continuar";
            $correcto=true;  
        };
    };
    if(!$correcto){
        echo "Error de login";
    }


}catch(PDOException $e){

    echo $e->getMessage();
};
?>