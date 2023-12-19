<?php
	session_start();
    if (!isset($_SESSION["usuario"])) {
        header("Location:../index.php");
        exit();
    }
	$usuario = $_SESSION["usuario"]; 
    require_once "../includes/lib_connect.php";
	require_once "../includes/lib_funciones.php";
    $nombre_categoria="";
    $hay_errores=false;

   if (($_SERVER["REQUEST_METHOD"]=="GET") && isset($_GET["CodRes"]))
    {
      
        $CodRes = $_GET["CodRes"];

           try {

            $sql = "select * from pedidos where restaurante = $CodRes";
      
            $stmt = $pdo->query($sql);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $hay_pedidos = $stmt->rowCount();
            if ($hay_pedidos>0) 
            {
                $hay_errores = true;
                $error = "No se puede eliminar el restaurante porque tiene pedidos.";

            }
            else {
                $sql = "delete from restaurantes where CodRes = $CodRes";
                $stmt = $pdo->query($sql);
            }


        }
        catch (PDOException $err) {
           // Mostramos un mensaje genérico de error.
            echo "Error: ejecutando consulta SQL.";
        }
    }
    else {
        header("Location: listar_restaurantes.php");
    }
 
    
    cerrar_conexion();
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
                                       
										<header>
											<h2>Eliminar restaurante</h2>
										</header>
                                        <?php
                                            if ($hay_errores) {
                                           
                                        ?>
                                        <header class="major">
										    <h2>Error al eliminar el restaurante</h2>
									    </header>
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Descripción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            
                                                <tr>
                                                    <td>
                                                        <?php echo $error; ?>
                                                    </td>
                                                </tr>
                                             
                                                
                                            </tbody>
                                       </table>
                                       <hr class="major">
										   
                                        <?php
                                             }
                                             else {
                                               
                                        ?>
                                             <header class="major">
										        <h2>Restaurante eliminado satisfactoriamente.</h2>
									        </header>   
                                            <hr class="major">
                                        <?php        
                                                }
                                            
                                        ?>
									
                                        
                                               
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