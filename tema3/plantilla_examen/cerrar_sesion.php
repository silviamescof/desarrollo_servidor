
<!DOCTYPE html>
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
            <h1> Cerrar sesión </h1>
            </header>

       </section>
       <section class="tm-section-12" id="tm-section-12">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-xs-4"></div>
                <div class="col-lg-8 col-md-8 col-xs-8">
            
                    <div class="contact_message">
                            
                            <!-- CREA AQUÍ TU CONTENIDO-->
                            
                            <?php
                            session_start();
                            //si vengo por post es porque el usuario ha pulsado el boton de cerrar sesion con lo cual...///
                            if($_SERVER["REQUEST_METHOD"]=="POST"){
                                
                                session_destroy();
                                echo "La sesion se ha cerrado correctamente";
                                echo '<a href="login.html">Pulsa aqui para hacer loguin de nuevo</a>';
                            //se puede acceder sin venir de post pero no pide el ejercicio que se redireccione, podria hacerlo   
                            }else{
                                echo "<p>No deberias estar aqui es una zona prohibida,
                                no te echo porque no me lo pide el ejercicio,
                                pero tampoco consigues nada estando aqui, mejor vete</p>";
                                echo '<a href="login.html">Pulsa aqui para hacer loguin de nuevo</a>';
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