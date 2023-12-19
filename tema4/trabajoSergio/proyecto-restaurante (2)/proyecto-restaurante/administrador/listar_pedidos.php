<?php
	session_start();
    if (!isset($_SESSION["usuario"])) {
        header("Location:../index.php");
        exit();
    }
	$usuario = $_SESSION["usuario"]; 
	require_once "../includes/lib_connect.php";
	require_once "../includes/lib_funciones.php";

	if ($_SERVER["REQUEST_METHOD"]=="POST") {
		try {
			$codPed = $_POST["codPed"];
			$sql = 'update pedidos set Enviado = 1 where CodPed= :codPed';
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(':codPed',$codPed);
			$stmt->execute();
		}
		catch (PDOException $err) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL.";
		}	
	}

    try {
		
		$sql = "select p.*, r.Correo from pedidos p, restaurantes r 
				where p.Restaurante= r.CodRes";
		$stmt_pedido = $pdo->query($sql);
		$stmt_pedido ->setFetchMode(PDO::FETCH_ASSOC);
		$hay_pedidos = $stmt_pedido->rowCount();
		
		cerrar_conexion();
    }
    catch (PDOException $err) {
        // Mostramos un mensaje genérico de error.
        echo "Error: ejecutando consulta SQL.";
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
											if ($_SERVER["REQUEST_METHOD"]=="POST") {
                                        ?>
                                             <header class="major">
										        <h2>Pedido enviado</h2>
									        </header>   
                                            <hr class="major">
										<?php
											}
										?>
										<header>
											<h1>Pedidos</h1>
										</header>
										<div class="row">
											
											<div class="col-12 col-12-small">
												<?php
													if (!$hay_pedidos) {
												?>
													<h2>No hay pedidos para listar</h2>
												<?php
													}
													else {
												?>
												<table class="alt">
													<thead>
														<tr>
															<th>Código</th>
															<th>Restaurante</th>
															<th>Fecha</th>
															<th>Estado</th>
															<th>Acción</th>
														</tr>
													</thead>
													<tbody>
														<?php
															while ($row = $stmt_pedido->fetch()) {
																$enviado = $row["Enviado"];
																$acciones = "";
																$fecha = $row["Fecha"];
                                                                $codRes = $row["Restaurante"];
																genera_enviado_acciones($enviado,$acciones,$row["CodPed"],$fecha,$codRes,1);
																echo '<tr>
																<td>' . $row["CodPed"] . '</td>
																<td>' . $row["Correo"] . '</td>	
																<td>' . $fecha . '</td>
																<td>' . $enviado . '</td>
																<td>' . $acciones . '</td>
																</tr>';
															}
														?>		
													</tbody>
													
												</table>
												<?php
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