<?php
/**
 * Escribe un programa que reciba el codigo de un usuario y muestre por pantalla todos sus datos
 */
    $cadena='mysql:dbname=empresa;host=127.2.2.1';
    $usuario='root';
    $clave='';
    $id_usuario=1;
    try{
        $bd=new PDO($cadena,$usuario,$clave);
        echo 'Conexion realizada con exito<br>';
        $consulta='SELECT * FROM usuarios WHERE codigo ='.$id_usuario;
        $respuesta=$bd->query($consulta);
        foreach ($respuesta as $usuario){
            echo '  codigo  '. $usuario[0].' Nombre: '.$usuario[1].'  Clave:  '.$usuario[2].' Rol: '.$usuario[3];
        };
    }catch (PDOException $e){
        echo 'Error con la conexion de tipo'.$e->getMessage();
    };
?>