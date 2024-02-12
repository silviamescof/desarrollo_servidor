<?php
	session_start();
	if(!isset($_SESSION['usuario'])){
		header('Location:index.php');
	};

	include_once('./includes/lib_connect.php');
	
	$marca = $_GET['idMarca'];

	$stm = $pdo->prepare('SELECT * FROM vehiculos where marca = :marca ');
	$stm->bindParam(':marca', $marca);
	$stm->execute();
	$vehiculos = $stm->fetchAll(PDO::FETCH_OBJ);
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
									<div class="row">
										<div class="col-4 col-12-small">
											<!-- IMAGEN LOGO MARCA -->
										</div>
										<div class="col-6 col-12-small">
											<h1><!-- NOMBRE DE LA MARCA --></h1>
										</div>
                                        <div class="col-2 col-12-small">
                                            <a href="listar_vehiculos.php" class="button icon solid fa-reply">Volver al listado</a>
										</div>
										
									</div>
								</header>
								

							<!-- Banner -->
								<section id="banner">
									<div class="content">
										<header>
											<h2>Listado de vehículos disponibles</h2>
										</header>
										
										<!-- ESPACIO PARA AÑADIR CONTENIDO -->

										<table class="alt">
                    <thead>
                        <tr>
                            <th>Imagen</th>
                            <th>Modelo</th>
                            <th>Marca</th>
                            <th>Precio</th>
                            <th>Año de matriculación</th>
                            <th>Descripción</th>
                             <th>Acciones</th>        
                        </tr>
                    </thead>
                    <tbody>
					<?php
									foreach ($vehiculos as $key => $vehiculo) {
										# code...
									
									?>
						
					<tr>
                                <td><img class="img_tabla" src="img/vehiculos/<?php echo $vehiculo->imagen; ?>"></td>
                                <td><?php echo $vehiculo->modelo; ?></a></td>
                                <td><?php echo $vehiculo->marca; ?></td>
                                <td><?php echo $vehiculo->precio; ?></td>
                                <td><?php echo $vehiculo->anyoMatriculacion; ?></td>
                                <td><?php echo $vehiculo->descripcion; ?></td>
                                 <td>
                                    <a href="editar_vehiculo.php?idVehiculo=1" class="button icon small solid fa-edit">Editar</a><br><br>
                                    <a href="eliminar_vehiculo.php?idVehiculo=1" class="button icon small solid fa-trash primary">Eliminar</a>
                                </td>
                                </tr>
								<?php
							};
							?>
							</tbody></table>



										<!---->
								
								
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

							<!-- Footer -->
                               <!-- ESPACIO PARA AÑADIR FOOTER -->
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