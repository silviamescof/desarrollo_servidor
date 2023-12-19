<?php
	session_start();
    if (!isset($_SESSION["usuario"])) {
        header("Location:../index.php");
        exit();
    }
	$usuario = $_SESSION["usuario"]; 
	
   
    if ($_SERVER["REQUEST_METHOD"]<>"GET") {
        header("location:listar_categorias.php");
    }
    else {
      
        require_once "../includes/lib_connect.php";
		require_once "../includes/lib_funciones.php";
        $CodCat=$_GET["CodCat"];

        try {
            $sql = 'select Nombre from categorias where CodCat= :CodCat';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':CodCat',$CodCat);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            $row = $stmt->fetch();
            $nombre_categoria = $row["Nombre"];
         
			sql_listar_productos($pdo, $stmt_productos, $hay_productos, $CodCat);
			if ($hay_productos>0) {
				$tabla_productos = listar_productos($stmt_productos,"Restaurante");
			}
   
      		select_categorias ($pdo, $hay_mas_categorias, $select_categorias, $CodCat);
            
            cerrar_conexion();
        }
        catch (PDOException $err) {
            // Mostramos un mensaje genérico de error.
            echo "Error: ejecutando consulta SQL.";
        }
    }    
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
											<h1>Categoría: <?php echo $nombre_categoria ?></h1>
										</header>
										<div class="row">
											<div class="col-1">
											</div>
											<div class="col-10 col-12-small">
												<?php
													if (!$hay_productos) {
												?>
													<h2>No hay productos de esa categoría</h2>
												<?php
													}
													else {
														echo $tabla_productos;
													}
												?>
											</div>	
										</div>
                                        <?php 
                                            if ($hay_mas_categorias) {}
                                        ?>
                                        <hr>
                                        <header class="major">
										    <h3>Otras Categorías</h3>
									    </header>
                                        <div class="col-1">
										</div>
										<div class="col-10 col-12-small">
                                            <form action="ver_productos_categoria.php" method="GET" >
                                                <div class="row">
                                                    <div class="col-6">
                                                        <?php echo $select_categorias ?>
                                                    </div>
                                                    <div class="col-6">
                                                        <input type="submit" value="Listar" class="button primary icon solid fa-searc">
                                                    </div>
                                                </div>
                                            </form>
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