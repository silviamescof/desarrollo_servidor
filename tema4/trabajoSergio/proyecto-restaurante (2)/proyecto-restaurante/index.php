<!DOCTYPE HTML>
<html>
	<head>
		<title>Gestor de Restaurantes</title>
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
									<a href="index.html" class="logo"><h2>Gestor de pedidos</h2> </a>
								</header>

							<!-- Banner -->
								<section id="banner">
									<div class="content">
										<header>
											<h1></h1>
											<p>Gestión integral de pedidos, grupo de restaurantes.</p>
										</header>
										<p>Un sistema de gestión de pedidos para un restaurante es una herramienta esencial que permite agilizar y organizar eficientemente todas las operaciones relacionadas con la oferta de alimentos y bebidas. Este sistema se encarga de la creación, actualización y eliminación de categorías de productos, productos y restaurantes que pueden realizar pedidos. </p>
										
									</div>
                                    <div class="content">
                                        <h1>Login acceso</h1>
                                      
                                        <form action="valida_login.php" method="post">
                                            <div class="row gtr-uniform">
                                                <div class="col-6 col-12-xsmall">
                                                    <input type="text" name="usuario" id="usuario" value="" placeholder="Usuario" />
                                                </div>
                                                <div class="col-6 col-12-xsmall">
                                                    <input type="password" name="pass" id="pass" value="" placeholder="Constraseña" />
                                                </div>
                                                <div class="col-6 col-12-xsmall">
                                                    <select name="tipo_login" id="tipo_login" placeholder="Tipo login">
                                                        <option value="administrador">Administrador</option>
                                                        <option value="restaurante">Restaurante</option>
                                                    </select>
                                                </div>
                                                <div class="col-12">
                                                    <ul class="actions">
                                                        <li><input type="submit" value="Entrar" class="primary" /></li>
                                                        <li><input type="reset" value="Borrar datos" /></li>
                                                    </ul>
                                                </div>
                                        </form>
                                    </div>
								</section>
						</div>
					</div>

				<!-- Sidebar 
					<div id="sidebar">
						<div class="inner">
							<!-- Menu
								<nav id="menu">
									
								</nav>

							<!-- Footer 
								<footer id="footer">
									<p class="copyright">&copy; Gestión de pedidos Web <br>Módulo Desarrollo Web en Entorno Servidor <br>Curso 23/24 </p>
								</footer>

						</div>
					</div> -->

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>