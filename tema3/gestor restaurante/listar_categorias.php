<?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){

        /////declaracion de variables y lectura de datos//////////
        $host='localhost';
        $user='root';
        $pass='';
       
        ///////////////////conexion a base de datos///////////////////////////

	try{

		$pdo = new PDO("mysql:host=$host;dbname=pedidos;charset=utf8",$user,$pass);
		$sentencia="SELECT * FROM categorias";
		$stm=$pdo->prepare($sentencia);
		
		$stm->execute();
        $stm->setFetchMode(PDO::FETCH_BOTH);

		//$resultado="El registro se ha insertado con exito,modificaciones: ".$stm->rowCount();

	}catch(PDOException $e){

		echo $e->getMessage();
	};

    };    
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Editorial by HTML5 UP</title>
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
									<a href="index.html" class="logo"><h2>Categorias existentes</h2> </a>
								</header>

							<!-- Banner -->
								<section id="lista">
									<div class="content">

                                        <!--EL CODIGO COMIENZA AQUI-->

                                        <table>
                                            <tr>
                                                <td>CodCat</td>
                                                <td>Nombre</td>
                                                <td>Descripcion</td>
                                            </tr>
                                            <?php
                                        
                                        while ($fila=$stm->fetch()){
                                            echo '<tr>';
                                            echo '<td>'.$fila[0].'</td>';
                                            echo '<td>'.$fila[1].'</td>';
                                            echo '<td>'.$fila[2].'</td>';
                                            echo '</tr>';
                                        };
                                        ?>
                                        </table>
										
									</div>
									
								</section>
						</div>
					</div>

				<!-- Sidebar -->
					<div id="sidebar">
						<div class="inner">
							<!-- Menu -->
								<nav id="menu">
									<header class="major">
										<h2>Menu</h2>
									</header>
									<ul>
										<li><a href="index.html">Inicio</a></li>
										<li>
											<span class="opener">Categorías</span>
											<ul>
												<li><a href="add_category.php">Añadir categorías</a></li>
												<li><a href="#">Listar categorías</a></li>
												<li><a href="#">Modificar categoría</a></li>
												<li><a href="#">Eliminar categoría</a></li>
												<li><a href="#">Ver productos categoría</a></li>
											</ul>
										</li>	
										<li>
											<span class="opener">Productos</span>
											<ul>
												<li><a href="#">Añadir producto</a></li>
												<li><a href="#">Listar producto</a></li>
												<li><a href="#">Modificar producto</a></li>
												<li><a href="#">Eliminar producto</a></li>
											</ul>
										</li>
										<li>
											<span class="opener">Restaurantes</span>
											<ul>
												<li><a href="#">Añadir restaurante</a></li>
												<li><a href="#">Listar restaurante</a></li>
												<li><a href="#">Modificar restaurante</a></li>
												<li><a href="#">Eliminar restaurante</a></li>
											</ul>	
										</li>
										<li>
											<span class="opener">Pedidos</span>
											<ul>
												<li><a href="#">Generar pedido</a></li>
												<li><a href="#">Consultar pedido</a></li>
											</ul>
										</li>
										
									</ul>
								</nav>

							<!-- Footer -->
								<footer id="footer">
									<p class="copyright">&copy; Gestión de pedidos Web <br>Módulo Desarrollo Web en Entorno Servidor <br>Curso 23/24 </p>
								</footer>

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