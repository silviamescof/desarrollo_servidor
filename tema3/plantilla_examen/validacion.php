<!DOCTYPE html>
<!--Silvia Mesa Cofrades-->
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>NOMBRE ALUMNO Examen Validación de Formularios, Cookies y Sesiones</title>
   
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400">
    <!-- Google web font "Open Sans" -->
    <link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css" />
    <link rel="stylesheet" href="css/tooplate-style.css">
    <!-- tooplate style -->
 
</head>

<body>
   
    <div class="container">
        <section class="tm-section-head" id="top">
            <header id="header" class="text-center tm-text-gray">
                <h1>Validación datos del formulario</h1>
            </header>

       </section>
       <section class="tm-section-12" id="tm-section-12">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-xs-4"></div>
                <div class="col-lg-8 col-md-8 col-xs-8">
                    <div class="contact_message">
                            
                            <!-- CREA AQUÍ TU CONTENIDO-->
                            <?php
                            ////////variables globales al script////
                            $valido=true;
                            $errores="";
                            
                            /////// funcion que limpia los datos///////
                            function limpiarDato($var){
                                $dato=htmlspecialchars(trim(strip_tags($var)));
                                return $dato;
                            };

                            //////////////lectura de variables con datos limpios//////

                            //uso ternario para evitar errores al asignar variables
                            // que no existen en el post, si existen y si no las pongo vacías//

                            $nombre=isset($_POST["nombre"]) ? limpiarDato($_POST["nombre"]) : "";
                            $email=isset($_POST["email"]) ? limpiarDato($_POST["email"]) : "";
                            $password=isset($_POST["password"]) ? limpiarDato($_POST["password"]) : "";
                            $password2=isset($_POST["passwordConfirm"]) ? limpiarDato($_POST["passwordConfirm"]) : "";
                            $fecha=isset($_POST["fecha"]) ? limpiarDato($_POST["fecha"]) : "";
                            $genero=isset($_POST["genero"]) ? limpiarDato($_POST["genero"]) : "";
                            $terminos=isset($_POST["terminos"]) ? limpiarDato($_POST["terminos"]) : "";

                            ///////////////validadacion de requisitos del formulario///////////

                            if($nombre==""){
                                $errores=$errores."<br>*El nombre no puede estar vacio";
                                $valido=false;
                            };
                            if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                                $errores=$errores."<br>*El email no cumple con los requisitos de validacion";
                                $valido=false;
                            };
                            if(strlen($password)<8){
                                $errores=$errores."<br>*La contraseña debe tener como minimo 8 caracteres ";
                                $valido=false;
                            };
                            if($password!=$password2){
                                $errores=$errores."<br>*Las contraseñas no coinciden ";
                                $valido=false;
                            };
                            if($genero==""){
                                $errores=$errores."<br>*Debe seleccionar un genero ";
                                $valido=false;
                            };
                            if($terminos==""){
                                $errores=$errores."<br>*Es obligatorio aceptar las condiciones";
                                $valido=false;
                            };

                            ////////////////validacion del resultado de los requiditos y redireccionamiento//////////

                            if($valido==true){
                                setcookie("nombre",$nombre,time()+3600);
                                setcookie("password",$password,time()+3600);
                                header("Location:bienvenida.php");

                            }else{
                                echo "<p>Se han encontrado los soguientes errores en su formulario".$errores."</p>";
                                echo '<a href="formulario_registro.html"> Pulsa aqui para volver al formulario </a>';
                            };
                            ?>
                            
                  </div>

                </div>
         
            </div>
        </section>
        <footer class="mt-5">
            <p class="text-center">Examen DWES 2/11/2023 SILVIA MESA COFRADES</p>
        </footer>
    </div>
  
</body>

</html>