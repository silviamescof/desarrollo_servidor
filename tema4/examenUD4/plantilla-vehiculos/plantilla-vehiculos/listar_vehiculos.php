<?php
	session_start();
	if(!isset($_SESSION['usuario'])){
		header('Location:index.php');
	};

	include_once('./includes/lib_connect.php');

	$stm = $pdo->prepare('SELECT vehiculos.* , marcas.nombre FROM vehiculos INNER JOIN marcas ON vehiculos.marca = marcas.id');
	$stm->execute();

	$vehiculos = $stm->fetchAll(PDO::FETCH_OBJ);


	

?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>SILVIA MESA - Examen de recuperación. </title>
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
								
							<!-- Banner -->
								<section id="banner">
									<div class="content">
										<header>
											<h2>Listado de vehículos disponibles</h2>
											<h3><?php echo isset($_SESSION['eliminar']) ? $_SESSION['eliminar'] : ''; $_SESSION['eliminar'] = ''; ?></h3>
										</header>
										
										<!-- ESPACIO PARA AÑADIR CONTENIDO -->

								


										<table class="alt">
                    <thead>
                        <tr>
                            <th>Imagen</th>
                            <th>Marca</th>
							<th>Modelo</th>
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
                                <td><a href="ver_vehiculos_marca.php?idMarca=<?php echo $vehiculo->marca; ?>"><?php echo $vehiculo->nombre; ?></a></td>
                                <td><?php echo $vehiculo->modelo; ?></td>
                                <td><?php echo $vehiculo->precio; ?></td>
                                <td><?php echo $vehiculo->anyoMatriculacion; ?></td>
                                <td><?php echo $vehiculo->descripcion; ?></td>
                                 <td>
                                    <a href="editar_vehiculo.php?idVehiculo=<?php echo $vehiculo->id; ?>" class="button icon small solid fa-edit">Editar</a><br><br>
                                    <a href="eliminar_vehiculo.php?idVehiculo=<?php echo $vehiculo->id; ?>" class="button icon small solid fa-trash primary">Eliminar</a>
                                </td>
                                </tr>
							<?php
							};
							?>
							
							</tbody></table>



										<!--fin-->


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