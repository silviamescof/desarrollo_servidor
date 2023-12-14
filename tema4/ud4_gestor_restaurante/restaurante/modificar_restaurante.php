<?php

session_start();
	if(!isset($_SESSION["usuario"])){
		header("Location:index.php");
	};

/***Esta clase parece estar terminada no tocar */

        
        /////declaracion de variables y lectura de datos//////////
        $host='localhost';
        $user='root';
        $pass='';

        $salida = "";
        $hay_errores="";
        $errores = false;
       
		$stm = "";
        ////////////////////VARIABLES PARA RESTAURANTE////////////////////////
        $codres = "";
        $correo = $_SESSION["usuario"];
        $clave = "";
        $confirmaClave = "";
        $pais = "";
        $cp = "";
        $ciudad = "";
        $direccion = "";
        $rol = 0;
        /////////////////////COMPROBAR SI VIENE DE POST///////////////////////////
        function limpiarDato($dato){
            return trim(htmlspecialchars($dato));
        };


        if ($_SERVER["REQUEST_METHOD"] === "POST"){
            //comprobar que los campos no estén vacíos
            $correo=isset($_POST["correo"]) ? limpiarDato($_POST["correo"]) : "";
            $clave=isset($_POST["clave"]) ? limpiarDato($_POST["clave"]) : "";
            $confirmaClave=isset($_POST["confirmaClave"]) ? limpiarDato($_POST["confirmaClave"]) : "";
            $pais=isset($_POST["pais"]) ? limpiarDato($_POST["pais"]) : "";
            $cp=isset($_POST["cp"]) ? limpiarDato($_POST["cp"]) : "";
            $ciudad=isset($_POST["ciudad"]) ? limpiarDato($_POST["ciudad"]) : "";
            $direccion=isset($_POST["direccion"]) ? limpiarDato($_POST["direccion"]) : "";

            if($correo==""){
                $hay_errores.="El campo correo esta vacio <br>";
                $errores = true;
            }
            if($clave==""){
                $hay_errores.="El campo clave esta vacio <br>";
                $errores = true;
            }
            if($confirmaClave==""){
                $hay_errores.="El campo confirmaClave esta vacio <br>";
                $errores = true;
            }
            if($pais==""){
                $hay_errores.="El campo pais esta vacio <br>";
                $errores = true;
            }
            if($cp==""){
                $hay_errores.="El campo cp esta vacio <br>";
                $errores = true;
            }
            if($ciudad==""){
                $hay_errores.="El campo ciudad esta vacio <br>";
                $errores = true;
            }
            if($direccion==""){
                $hay_errores.="El campo direccion esta vacio <br>";
                $errores = true;
            }
            if($clave!==$confirmaClave){
                $hay_errores.="La contraseña y la confirmacion son distintas<br>";
                $errores = true;
            };
        
            //actualizar los datos en la tabla

            if($errores==false){

                try{
                    $pdo = new PDO("mysql:host=$host;dbname=pedidos;charset=utf8",$user,$pass);
                    $sentencia="UPDATE restaurantes SET correo = :correo, clave= :clave , pais= :pais, cp= :cp , ciudad= :ciudad , direccion=:direccion WHERE correo=:correo";
                    $stm=$pdo->prepare($sentencia);
                    $stm->bindParam(':correo',$correo);
                    $stm->bindParam(':clave',$clave);
                    $stm->bindParam(':pais',$pais);
                    $stm->bindParam(':cp',$cp);
                    $stm->bindParam(':ciudad',$ciudad);
                    $stm->bindParam(':direccion',$direccion);
                    $stm->execute();
                    $stm->setFetchMode(PDO::FETCH_ASSOC);
    
                    if($stm->rowCount() >0){
                        $salida = "Se han actualizado los datos correctamente";
                    }
                }catch(PDOException $e){
                    echo $e->getMessage();
                };
            };
            
        };

        ///////////////////conexion a base de datos///////////////////////////
	try{

		$pdo = new PDO("mysql:host=$host;dbname=pedidos;charset=utf8",$user,$pass);
		$sentencia="SELECT codres, correo, clave, pais, cp, ciudad, direccion FROM restaurantes WHERE correo = '$correo'";
		$stm=$pdo->prepare($sentencia);
		
		$stm->execute();
        $stm->setFetchMode(PDO::FETCH_BOTH);

        if($stm->rowCount()==0){
            $hay_errores = "No se ha podido encontrar el restaurante en la BD";
        }else{
            foreach ($stm as $fila) {
                $codres         = $fila['codres'];
                $correo         = $fila['correo'];
                $clave          = $fila['clave'];
                $confirmaClave  = $fila['clave'];
                $pais           = $fila['pais'];
                $cp             = $fila['cp'];
                $ciudad         = $fila['ciudad'];
                $direccion      = $fila['direccion'];
            }
        }

	}catch(PDOException $e){

        echo $hay_errores + "<br>";
		echo $e->getMessage();

	};


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Restaurante</title>
</head>
<body>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Editorial by HTML5 UP</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../assets/css/main.css" />
	</head>
	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<div id="main">
						<div class="inner">

							<!-- Header -->
								<header id="header">
									<h2>Modificar Restaurante</h2>
    
                                    
								</header>

							<!-- Banner -->
								<section id="formulario">
                                <div class="content">
                                        <!--AQUI EMPIEZA EL FORMULARIO-->
                                        <form action="modificar_restaurante.php" method="POST">
                                        <h2>Actualizar datos del Restaurante</h2>
                                            <div class="row gtr-uniform">
                                                <div class="col-6 col-12-xsmall">
                                                    <label for="correo">Correo</label>
                                                    <?php
                                                    if($_SESSION["perfil"]=="restaurante"){

                                                        echo '<input type="text" name="correo" id="actualizar" value="'.$correo.'" readonly >';
                
                                                    }elseif($_SESSION["perfil"]=="administrador"){
                
                                                        echo '<input type="text" name="correo" id="actualizar" value="'.$correo.'">';
                                                    };
                                                    ?>
                                                    
                                                </div>
                                                <div class="col-6 col-12-xsmall">
                                                </div>
                                                <div class="col-6 col-12-xsmall">
                                                    <label for="clave">Clave</label>
                                                    <input type="password" name="clave" id="actualizar" value="<?php echo $clave; ?>">
                                                </div>
                                                <div class="col-6 col-12-xsmall">
                                                    <label for="confirmaClave">Confirma Clave</label>
                                                    <input type="password" name="confirmaClave" id="actualizar" value="<?php echo $confirmaClave; ?>">
                                                </div>
                                                <div class="col-6 col-12-xsmall">
                                                    <label for="pais">País</label>
                                                    <input type="text" name="pais" id="actualizar" value="<?php echo $pais; ?>">
                                                </div>
                                                <div class="col-6 col-12-xsmall">
                                                    <label for="cp">Código Postal</label>
                                                    <input type="text" name="cp" id="actualizar" value="<?php echo $cp; ?>">
                                                </div>
                                                <div class="col-6 col-12-xsmall">
                                                    <label for="ciudad">Ciudad</label>
                                                    <input type="text" name="ciudad" id="actualizar" value="<?php echo $ciudad; ?>">
                                                </div>
                                                <div class="col-6 col-12-xsmall">
                                                    <label for="direccion">Dirección</label>
                                                    <input type="text" name="direccion" id="actualizar" value="<?php echo $direccion; ?>">
                                                </div>
                                                
                                                <!-- Break -->
                                                <div class="col-12">
                                                    <ul class="actions">
                                                        <li><input type="submit" value="Actualizar Datos" class="primary"/></li>
                                                        <li>
                                                            <?php
                                                                echo $salida;
                                                                echo isset($hay_errores) ? $hay_errores : "";
                                                            ?>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </form>
                                        <!--FIN DEL FORMNULARIO-->

                                    </div>
								</section>
						</div>
					</div>

				<!-- Sidebar -->
					<div id="sidebar">
						<div class="inner">
							<!-- Menu -->
								<nav id="menu">
                                <?php
									if($_SESSION["perfil"]=="restaurante"){

										include "../includes/menu_restaurante.php";

									}elseif($_SESSION["perfil"]=="administrador"){

										include "../includes/menu_admin.php";
									};
										
									?>
								</nav>
							<!-- Footer -->
								<footer id="footer">
									<p class="copyright">&copy; Gestión de pedidos Web <br>Módulo Desarrollo Web en Entorno Servidor <br>Curso 23/24 </p>
								</footer>
						</div>
					</div>
			</div>

		<!-- Scripts -->
			<script src="../assets/js/jquery.min.js"></script>
			<script src="../assets/js/browser.min.js"></script>
			<script src="../assets/js/breakpoints.min.js"></script>
			<script src="../assets/js/util.js"></script>
			<script src="../assets/js/main.js"></script>

	</body>
</html>
</body>
</html>