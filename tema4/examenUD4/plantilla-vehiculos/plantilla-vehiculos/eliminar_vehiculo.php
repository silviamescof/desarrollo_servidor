<?php
    session_start();
	if(!isset($_SESSION['usuario'])){
		header('Location:index.php');
	};

	include_once('./includes/lib_connect.php');

	///no controlo si viene por post o get porque viene por get por lo que la pagina es de acceso publico, controlo acceso con sesiones

	$id = isset($_GET['idVehiculo']) ? trim(strip_tags($_GET['idVehiculo'])) : '';

	$stm = $pdo->prepare('DELETE FROM vehiculos WHERE id = :id');
	$stm->bindParam(':id', $id);
	$stm->execute();

	if($stm->rowCount() > 0){
		$_SESSION['eliminar'] = 'El registro ha sido eliminado correctamente';
		header('Location:listar_vehiculos.php');
	}else{
		$_SESSION['eliminar'] = 'FALLO INESPERADO: registro no eliminado o no existe en la bbdd';
		header('Location:listar_vehiculos.php');
	};

?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>PON AQUÍ TU NOMBRE - Examen de recuperación. </title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<div id="main">
						<div class="inner">

							<!-- Header -->
								<header id="header">
									<h2>Gestión de vehículos</h2> 
                        		</header>

							<!-- Banner -->
								<section id="banner">
									<div class="content">
										<header>
												<h1>Eliminar vehículo</h1>
												
										</header>

										<!-- ESPACIO PARA AÑADIR CONTENIDO -->
                                        
									</div>
									
								</section>
						</div>
					</div>

				<!-- Sidebar -->
					<div id="sidebar">
						<div class="inner">
							<!-- Menu -->
							<?php
						   include_once('./includes/menu.php');
						   include_once('./includes/footer.php');

						   ?>
						</div>
					</div>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>