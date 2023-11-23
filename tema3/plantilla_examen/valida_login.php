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
                <h2>Validación formulario</h2>
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
                                    $valido=true;
                                    //verifica si se ha iniciado sesion prevamente//
                                    if(isset($_SESSION["usuario"])){

                                        echo "bienvenido a nuestro login ".$_SESSION["usuario"];
                                        ?>
                                        <form action="cerrar_sesion.php" method="post">
                                            <button type="submit" name="cerrar" value="Cerrar Sesion">Cerrar Sesion</button>
                                        </form>
                                        <?php

                                    //si no tiene sesion...en este caso vendria o por post o por fuerza bruta//
                                    }else{

                                    //para evitar errores, lo primero es saber si el usuario se ha registrado(Si no viene por fuerza bruta)//
                                    if(isset($_COOKIE["nombre"])&& isset($_COOKIE["password"])){

                                        //esta registardo pero vamos a validar las credenciales//
                                        if($_POST["nombre"]!=$_COOKIE["nombre"] && $_POST["password"]!=$_COOKIE["password"]){
                                            $valido=false;
                                        };
                                        //si no se valida correctamente//
                                        if($valido==false){
                                            echo "<p>Las credenciales son incorrectas</p>";
                                            echo '<a href="login.html"> Pulsa aqui para volver a identificarte </a>';
                                        }else{
                                            //si todo es correcto creamos la sesion
                                            $_SESSION["usuario"]=$_POST["nombre"];
                                            echo 'Bienvenido'.$_SESSION["usuario"];
                                            ?>
                                            <form action="cerrar_sesion.php" method="post">
                                            <button type="submit" name="cerrar" value="Cerrar Sesion">Cerrar Sesion</button>
                                            </form>
                                            <?php

                                        };
                                    //si el usuario no se ha registrado le mandamos de vuelta
                                    }else{
                                            header("Location:formulario_registro.html");
                                    };
                                };
                                    
                                
                            ?>
                            
                  </div>
                </div>
       
            </div>
        </section>
        <footer class="mt-5">
            <p class="text-center">Examen DWES 2/11/2023 Silvia Mesa Cofrades</p>
        </footer>
    </div>
  
</body>

</html>