<?php
	session_start();
    if (!isset($_SESSION["usuario"])) {
        header("Location:../index.php");
        exit();
    }
	$usuario = $_SESSION["usuario"]; 

?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Zona administrador</title>
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
									<h2>Administración gestor de pedidos</h2> 
                                    <h2>Usuario: <?php echo $usuario ?></h2>
								</header>

							<!-- Banner -->
								<section id="banner">
									<div class="content">
										<header>
											<h1>Inicio</h1>
											<p>Gestión integral de pedidos, grupo de restaurantes.</p>
										</header>
										<p>Un sistema de gestión de pedidos para un restaurante es una herramienta esencial que permite agilizar y organizar eficientemente todas las operaciones relacionadas con la oferta de alimentos y bebidas. Este sistema se encarga de la creación, actualización y eliminación de categorías de productos, productos y restaurantes que pueden realizar pedidos. </p>
										
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