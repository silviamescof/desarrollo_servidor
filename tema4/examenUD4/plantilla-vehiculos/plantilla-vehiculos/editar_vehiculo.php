<?php
	 session_start();
	 if(!isset($_SESSION['usuario'])){
		 header('Location:index.php');
	 };
 
	 include_once('./includes/lib_connect.php');
	 
	 $id = isset($_POST['idVehiculo']) ? trim(strip_tags($_POST['idVehiculo'])) : '';


	 $stm1 = $pdo->prepare('SELECT * from vehiculos WHERE id = :id');
	 $stm1->bindParam(':id', $id);
	 $stm1->execute();

	 $stm2 = $pdo->prepare('SELECT id, nombre from marcas ');
	 $stm2->execute();
	 $marcas = $stm2->fetchAll(PDO::FETCH_OBJ);

	 $vehiculos = $stm1->fetchAll(PDO::FETCH_OBJ);


	 if($_SERVER['REQUEST_METHOD'] == 'POST'){


		$erroresEditar='';
		$valido=true;

		$modelo = isset($_POST['modelo']) ? trim(strip_tags($_POST['modelo'])) : '';
		$precio =  isset($_POST['precio']) ? trim(strip_tags($_POST['precio'])) : '';
		$anyoMatriculacion = isset($_POST['anyoMatriculacion']) ? trim(strip_tags($_POST['anyoMatriculacion'])) : '';
		$marca = isset($_POST['marca']) ? trim(strip_tags($_POST['marca'])) : '';
		$descripcion = isset($_POST['descripcion']) ? trim(strip_tags($_POST['descripcion'])) : '';
		$imagen = isset($_POST['imagen']) ? trim(strip_tags($_POST['imagen'])) : '';


		if(empty($modelo)){
			$erroresEditar = $erroresEditar.'<br> El modelo no puede estar vacio';
			$valido=false;
		};
		if(empty($precio)){
			$erroresEditar = $erroresEditar.'<br> El prcio no puede estar vacio';
			$valido=false;
		};
		if(empty($anyoMatriculacion)){
			$erroresEditar = $erroresEditar.'<br> El anyo no puede estar vacio';
			$valido=false;
		};
		if(empty($marca)){
			$erroresEditar = $erroresEditar.'<br> El campo marca no puede estar vacio';
			$valido=false;
		};
		if(empty($descripcion)){
			$erroresEditar = $erroresEditar.'<br> El campo descripcion no puede estar vacio';
			$valido=false;
		};
		if(empty($imagen)){
			$erroresEditar = $erroresEditar.'<br> El campo imagen  no puede estar vacio';
			$valido=false;
		};

		if($valido){

			$stm = $pdo->prepare('UPDATE vehiculos
								SET modelo = :modelo, precio = :precio, anyoMatriculacion = :anyoMatriculacion , marca = :marca , descripcion = :descripcion , imagen = :imagen
								WHERE id = :id');
			$stm->bindParam(':id', $id);
			$stm->bindParam(':modelo', $modelo);
			$stm->bindParam(':precio', $precio);
			$stm->bindParam(':anyoMatriculacion', $anyoMatriculacion);
			$stm->bindParam(':marca', $marca);
			$stm->bindParam(':descripcion', $descripcion);
			$stm->bindParam(':imagen', $imagen);

			$stm->execute();

			if($stm->rowCount() > 0){

				$erroresEditar = 'El registro se ha modificado correctamente';
				exit;
			}else{
				$erroresEditar= 'ERROR INESPERADO: Registro no modificado';
			};

		};

	 };

?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>SILVIA MESA COFRADES- Examen de recuperación. </title>
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
									<h2>Administración base de datos de vehículos</h2> 
                        		</header>

							<!-- Banner -->
								<section id="banner">
									<div class="content">
										<header>
											<h1>Editar Vehículo</h1>
											<h3><?php echo isset($erroresEditar) ? $erroresEditar : '' ?></h3>
											
										</header>
                                        
                                         <!-- ESPACIO PARA AÑADIR CONTENIDO -->

										 <form action="editar_vehiculo.php" method="POST">
                                            <div class="row">
                                                <div class="col-2 col-12-small"></div>
                                                <div class="col-8 col-12-small">
                                                    <table>
                                                        <tbody>
															
                                                            <tr>
                                                                <td><h3>Modelo</h3></td>
                                                                <td><input type="text" name="modelo" id="modelo" value="<?php echo $vehiculos[0]->modelo; ?>"></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h3>Marca</h3></td>
                                                                <td>
                                                                    <select name="marca" id="marca">
																		<?php
																			foreach ($marcas as $key => $marca) {
																				# code...
																			
																		?>
																		<option value="<?php echo $marca->id; ?>"><?php echo $marca->nombre; ?></option>

																		<?php
																			};
																		?>
																	</select>                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><h3>Precio</h3></td>
                                                                <td><input type="text" name="precio" id="precio" value="<?php echo $vehiculos[0]->precio; ?>"></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h3>Año de Matriculación</h3></td>
                                                                <td><input type="text" name="anyoMatriculacion" id="anyoMatriculacion" value="<?php echo $vehiculos[0]->anyoMatriculacion; ?>"></td>
                                                            </tr>	
                                                            <tr>
                                                                <td><h3>Descripcion</h3></td>
                                                                <td><textarea name="descripcion"><?php echo $vehiculos[0]->descripcion; ?></textarea>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><h3>Imagen</h3></td>
                                                                <td><input type="text" name="imagen" id="imagen" value="<?php echo $vehiculos[0]->imagen; ?>"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                <input type="hidden" name="idVehiculo" value="<?php echo $vehiculos[0]->id; ?>">
                                                                </td>
                                                                    
                                                                <td><input type="submit" value="Enviar"></td>
                                                            </tr>
                                                        </tbody>			
                                                    </table>
                                                </div>
                                            </div>
                                        </form>


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