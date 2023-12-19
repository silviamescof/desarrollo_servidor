<?php
	session_start();
    if (!isset($_SESSION["usuario"])) {
        header("Location:../index.php");
        exit();
    }
	require_once "../includes/lib_connect.php";
    require_once "../includes/lib_funciones.php";
    $usuario = $_SESSION["usuario"]; 
    $errores=[];
    $hay_errores=false;
    $anadido=false;

    if ($_SERVER["REQUEST_METHOD"]<>"POST") {
        
        $correo = "";
        $clave = "";
        $pais = "";
        $codigo_postal = ""; 
        $ciudad = "";
        $direccion = "";
    }
    else {
        
        $correo=comprueba_valido($_POST["correo"],"email");
        $clave=comprueba_valido($_POST["clave"],"pass",$_POST["confirma_clave"]);
        $pais = comprueba_valido($_POST["pais"],"texto");
        $codigo_postal = comprueba_valido($_POST["codigo_postal"],"codigopostal");
        $ciudad = comprueba_valido($_POST["ciudad"],"texto");
        $direccion = comprueba_valido($_POST["direccion"],"texto");

        if (!$correo) {
            $errores[] = "El email introducido no es válido <br>";
            $hay_errores=true;
        }
        if (!$clave) {
            $errores[] = "No coinciden la clave y su confirmación <br>";
            $hay_errores=true;
        }
        if (!$pais) {
            $errores[] = "Debe introducir un pais <br>";
            $hay_errores=true;
        }
        if (!$codigo_postal) {
            $errores[] = "El código postal introducido no es válido <br>";
            $hay_errores=true;
        }
        if (!$ciudad) {
            $errores[] = "Debe introducir una ciudad <br>";
            $hay_errores=true;
        }
        if (!$direccion) {
            $errores[] = "Debe introducir una dirección <br>";
            $hay_errores=true;
        }
        
        if (!$hay_errores) {
            try {
                $sql = 'insert into restaurantes (Correo, Clave, Pais, CP, Ciudad, Direccion, Rol) value (:correo, :clave, :pais, :codigo_postal, :ciudad, :direccion,1)';
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':correo',$correo);
                $stmt->bindParam(':clave',$clave);
                $stmt->bindParam(':pais',$pais);
                $stmt->bindParam(':codigo_postal',$codigo_postal);
                $stmt->bindParam(':ciudad',$ciudad);
                $stmt->bindParam(':direccion',$direccion);
             
                $stmt->execute();
                $anadido = true;
            }
            catch (PDOException $err) {
                // Mostramos un mensaje genérico de error.
                echo "Error: ejecutando consulta SQL.";
            }
        }
    }


	
    
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Zona privada Administrador</title>
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
									<h2>Usuario:</h2>
									<h2><?php echo $usuario ?></h2>
									
								</header>

							<!-- Banner -->
								<section id="banner">
									<div class="content">
                                        <?php
                                            if ($hay_errores) {
                                           
                                        ?>
                                        <header class="major">
										    <h2>Error de modificación</h2>
									    </header>
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Descripción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               <?php 
                                                    foreach ($errores as $error) { 
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $error; ?>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                                
                                            </tbody>
                                       </table>
                                       <hr class="major">
										   
                                        <?php
                                             }
                                             else {
                                                if ($_SERVER["REQUEST_METHOD"]=="POST") {
                                        ?>
                                             <header class="major">
										        <h2>Restaurante añadido satisfactoriamente.</h2>
									        </header>   
                                            <hr class="major">
                                        <?php        
                                                }
                                             }
                                        ?>
                                        <form action="anadir_restaurante.php" method="post">
                                            <div class="row gtr-uniform">
                                                <div class="col-6 col-12-xsmall">
                                                    <h4>Email</h4>
                                                    <input type="email" name="correo" id="correo" value="<?php echo $correo?>" required>
                                                </div>
                                                <div class="col-6 col-12-xsmall">
                                                </div>
                                                <div class="col-6 col-12-xsmall">
                                                    <h4>Clave</h4>
                                                    <input type="password" name="clave" id="pass" value="<?php echo $clave?>" required>
                                                </div>
                                                <div class="col-6 col-12-xsmall">
                                                    <h4>Confirma clave</h4>
                                                    <input type="password" name="confirma_clave" id="confirma_clave" value="<?php echo $clave?>" required>
                                                </div>
                                                <div class="col-6 col-12-xsmall">
                                                    <h4>Dirección</h4>
                                                    <input type="text" name="direccion" id="direccion" value="<?php echo $direccion?>" required>
                                                </div>
                                                <div class="col-6 col-12-xsmall">
                                                    <h4>Ciudad</h4>
                                                    <input type="text" name="ciudad" id="ciudad" value="<?php echo $ciudad?>" required>
                                                </div>
                                                <div class="col-6 col-12-xsmall">
                                                    <h4>Código postal</h4>
                                                    <input type="text" name="codigo_postal" id="codigo_postal" value="<?php echo $codigo_postal?>" required>
                                                </div>
                                                <div class="col-6 col-12-xsmall">
                                                    <h4>Pais</h4>
                                                    <input type="text" name="pais" id="pais" value="<?php echo $pais?>" required>
                                                </div>
                                                <?php
                                                    if (!$anadido) {
                                                ?>
                                                 <div class="col-12">
                                                    <ul class="actions">
                                                        <li><input type="submit" value="Añadir" class="primary"></li>
                                                        
                                                    </ul>
                                                </div>
                                                <?php
                                                    }
                                                ?>
                                            </div>
                                        </form>
                        
										
									</div>
                                    
								</section>
						</div>
					</div>

				<!-- Sidebar -->
					<div id="sidebar">
						<div class="inner">
							<!-- Menu -->
								<nav id="menu">
									<?php include "../includes/menu_administrador.html"; ?>
								</nav>

							<!-- Footer  -->
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