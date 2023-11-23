<?php
/**
 * Simulacro de examen 
 * @author Silvia Mesa Cofrades
 */

 session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>"NOMBRE_ALUMNO Examen - Validación de Formularios, Cookies y Sesiones</title>
   
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
                <h1>Inicio zona privada</h1>
            </header>

            <nav class="navbar narbar-light">
                <a class="navbar-brand tm-text-gray" href="#">
                    Menu
                </a>
                <button type="button" id="nav-toggle" class="navbar-toggler collapsed" data-toggle="collapse" data-target="#mainNav" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <i class="fa fa-navicon tm-fa-toggler-icon"></i>
                    </span>
                </button>
                <div id="mainNav" class="collapse navbar-collapse tm-bg-white">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link tm-text-gray" href="formulario_registro.php">Formulario de registro</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link tm-text-gray" href="inicio_registrados.php">Inicio registrados</a>
                            <span class="sr-only">(current)</span>
                        </li>
                        
                        
                    </ul>
                </div>
            </nav>

        </section>

      
        <section class="tm-section-12" id="tm-section-12">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-xs-2"></div>
                <div class="col-lg-8 col-md-8 col-xs-8">
                    <div class="contact_message">
                        
                        <?php
                        //////////////////////////codigo aqui//////////////////////////////
                        
                            if(isset($_SESSION["nombre"])){// en realidar evitaria errores de aceso///

                                echo '<p>Bienvenid@'.$_SESSION["nombre"].' disfruta tu esperiencia en nuestra pagina</p>';
                                
                            }else{
                                header("Location: formulario_registro.php");
                            };
                            if($_SERVER["REQUEST_METHOD"]=="POST"){

                            if(isset($_POST["close"])){
                                session_destroy();
                                header("Location: formulario_registro.php");
                            };
                        };
                        
                        ?>
                        <form action='inicio_registrados.php' method="POST">
                            <button type="submit" value="close" name="close">Cerrar Sesion</button>
                        </form>


                    </div>
                </div>

               
            </div>
        </section>
        <footer class="mt-5">
            <p class="text-center">Examen DWES 2/11/2023 "NOMBRE ALUMNO"</p>
        </footer>
    </div>

    <!-- load JS files -->
    <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
    <script src="js/popper.min.js"></script>
    <!-- https://popper.js.org/ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
    
</body>

</html>