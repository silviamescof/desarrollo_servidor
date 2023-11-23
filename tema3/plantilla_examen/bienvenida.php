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
            <h1> Bienvenido</h1>
            </header>

       </section>
       <section class="tm-section-12" id="tm-section-12">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-xs-4"></div>
                <div class="col-lg-8 col-md-8 col-xs-8">
                    <div class="contact_message">
                            
                            <!-- CREA AQUÍ TU CONTENIDO-->

                            <?php
                                //si no hay cookies, no se ha registrado o no correctamente//
                                if(!isset($_COOKIE["nombre"])||!isset($_COOKIE["password"])){
                                    header("Location:formulario_registro.php");
                                // si sí las hay, le damos la bienvenida y le informmamos de sus credenciales//
                                //le damos acceso a loguin//
                                }else{
                                    echo 'Bienvenido usuario '.$_COOKIE["nombre"].' Te recordamos que tu contraseña es '.$_COOKIE["password"];
                                    echo '<br><a href="login.html"> Pulsa aqui para ir al login </a>';
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