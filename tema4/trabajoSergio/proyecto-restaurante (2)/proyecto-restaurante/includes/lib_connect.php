<?php
   
    $host='localhost';
    $dbname='pedidos';
    $user='root';
    $pass='';
    try {
    
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$user, $pass);
    # Para que genere excepciones a la hora de reportar errores.
        $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    
    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }
    function cerrar_conexion() {
        $pdo=null;
    }
?>