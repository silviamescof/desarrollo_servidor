<?php
/**
 * Simulacro de examen 
 * @author Silvia Mesa Cofrades
 */
session_start();
$valido=true;
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
                <h1>Validación resgistro de usuario</h1>
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
                            <a class="nav-link tm-text-gray" href="inicio_registrados.php">Inicio registrados
                                
                            </a>
                        </li>
                        
                        
                    </ul>
                </div>
            </nav>

        </section>

      
        <section class="tm-section-12" id="tm-section-12">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-xs-4"></div>
                <div class="col-lg-8 col-md-8 col-xs-8">
                    <div class="contact_message">
                        
                        <?php
                        //////////////////////////////////codigo aqui/////////////////////////////
                if($_SERVER["REQUEST_METHOD"]=="POST"){
                    if(isset($_POST["validar"])){
                        if(empty($_POST["nombre"] || empty($_POST["apellido"]))){
                            echo "<p>no se puede dejar vacio el nombre, vuelve a realizar el formulario</p>";
                            $valido=false;
                        };
                        if(preg_match('/^[^@\s]+@([a‐z0‐9]+\.)+[a‐z]{2,}$/i', $_POST['email'])){
                            echo "<p>el emial debe coincidir con el formato </p>";
                            $valido=false;
                        };
                        if(strlen( $_POST["password"])<8){
                            echo "<p>La contraseña debe tener como minimo 8 caracteres</p>";
                            $valido=false;
                        };
                        if($_POST["password"]!=$_POST["passwordconfirm"]){
                            echo "<p>Debe coincidir la contraseña y la verificacion</p>";
                            $valido=false;
                        };
                        if(!isset($_POST["deporte"])&& !isset($_POST["tecnologia"]) && !isset($_POST["musica"]) && !isset($_POST["teatro"]) && !isset($_POST["cine"])){
                            echo "<p>Debes rellenar como minimo un interes</p>";
                            $valido=false;
                        };
                    };
                        echo '<a href=formulario_registro.php>Pulsa aqui para volver al formulario </a>';

                        if($valido){
                            echo "<p>Tu usuario se ha creado correctamente</p>";
                            setcookie("nombre",$_POST["nombre"],time()+3600);
                            setcookie("apellido",$_POST["apellido"],time()+3600);
                            $_SESSION["nombre"]=$_POST["nombre"];
                            
                        }

                        if(isset($_POST["reset"])){

                            setcookie("nombre",$_POST["nombre"],time()-100);
                            setcookie("apellido",$_POST["apellido"],time()-100);
                            
                        };

                    }else{
                        header("Location:http://localhost/desarrollo_servidor/tema3/plantilla_examen/formulario_registro.php");
                    };

                        ?>

                        

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