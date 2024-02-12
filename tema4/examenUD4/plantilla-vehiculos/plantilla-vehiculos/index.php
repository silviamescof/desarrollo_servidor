<?php
	session_start();
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>SILVIA MESA	 - Examen de recuperación. </title>
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
										<div class="col-6 col-12-small">
											<a href="index.php" class="logo"><h2>Base de datos de vehículos</h2> </a>
										</div>
										<div class="col-6 col-12-small">
											<h3>Acceso a administradores</h3>
											<h5><?php echo isset($_SESSION['erroresIndex']) ? $_SESSION['erroresIndex'] : '' ?></h5>
											<form action="valida_login.php" method="post">
												<div class="row gtr-uniform">
													<div class="col-6 col-12-xsmall">
														<input type="text" name="usuario" id="usuario" value="" placeholder="Usuario" />
													</div>
													<div class="col-6 col-12-xsmall">
														<input type="password" name="pass" id="pass" value="" placeholder="Constraseña" />
													</div>
													
													<div class="col-12">
														<ul class="actions">
															<li><input type="submit" value="Entrar" class="primary" /></li>
															<li><input type="reset" value="Borrar datos" /></li>
														</ul>
													</div>
											</form>
										</div>
									</div>
								</header>
								

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