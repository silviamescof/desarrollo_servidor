<?php
	session_start();
    if (!isset($_SESSION["usuario"])) {
        header("Location:../index.php");
        exit();
    }
	$usuario = $_SESSION["usuario"]; 
	require_once "../includes/lib_connect.php";
	require_once "../includes/lib_funciones.php";
    $perfil ="Restaurante";
	listar_categorias($pdo,$perfil, $tabla, $hay_categorias)
  
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Zona privada Restaurante</title>
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
									<h2>Restaurante:</h2>
									<h2><?php echo $usuario ?></h2>

								</header>

							<!-- Banner -->
								<section id="banner">
									<div class="content">
										<header>
											<h1>Categorías</h1>
										</header>
										<div class="row">
											<div class="col-2">
											</div>
											<div class="col-8 col-12-small">
												<?php
													if (!$hay_categorias) {
												?>
													<h2>No hay categorias para listar</h2>
												<?php
													}
													else {
												         echo $tabla;
													}
												?>
											</div>	
										</div>								
									</div>
                                    
								</section>
						</div>
					</div>

				<!-- Sidebar -->
					<div id="sidebar">
						<div class="inner">
							<!-- Menu -->
								<nav id="menu">
									<?php include "../includes/menu_restaurante.html"; ?>
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