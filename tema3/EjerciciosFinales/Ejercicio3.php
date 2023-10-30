<?php
/**
 * Ejercicio3. php
 * 
 * @author Silvia Mesa
 * 
 * Diseñar un desarrollo web simple con php que pida al usuario el precio de tres productos en
*tres establecimientos distintos denominados “Tienda 1”, “Tienda 2” y “Tienda 3”. Una vez se
*introduzca esta información se debe calcular y mostrar el precio medio del producto. Debes
*comprobar e informar al usuario si los datos introducidos no son válidos.
*Para los siguientes ejercicios consulta la siguiente web y encontrarás documentación sobre
*la creación de figuras geométricas con html.

 */

 function comprobarValidez($clave,&$variable){

    if(empty($_POST[$clave])||is_null($_POST[$clave])){

        $variable=null;
        echo '<h1>lo siento , pero el valor de '.$clave.' es nulo</h1><br>';
       
    
    }elseif(!is_numeric($_POST[$clave])){

        $variable=null;
        echo '<h1>lo siento , pero el valor de '.$clave.' no es numerico</h1><br>';
       
    
    }else{
        $variable=$_POST[$clave];
        
        
    }
    

 };

 $tienda1;
 $tienda2;
 $tienda3;

comprobarValidez("tienda1",$tienda1);
comprobarValidez("tienda2",$tienda2);
comprobarValidez("tienda3",$tienda3);

if(is_null($tienda1)||is_null($tienda2||is_null($tienda3))){
    echo "debido al error, no tenemos un valor para resultado";
}else{
    echo "El precio medio del producto es ".($tienda1+$tienda2+$tienda3)/3;
}
 
?>