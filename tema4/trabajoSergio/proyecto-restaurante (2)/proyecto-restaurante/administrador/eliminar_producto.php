<?php
	session_start();
    if (!isset($_SESSION["usuario"])) {
        header("Location:../index.php");
        exit();
    }
	require_once "../includes/lib_connect.php";
    require_once "../includes/lib_funciones.php";
    $usuario = $_SESSION["usuario"]; 
    $errores=[];
    $hay_errores=false;

    if (($_SERVER["REQUEST_METHOD"]=="GET") && (isset($_GET["CodProd"]))) {
        
        try {
            $CodProd = $_GET["CodProd"];
            $sql = "Select * from pedidosproductos where Producto= :CodProd";
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':CodProd',$CodProd);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $hay_producto = $stmt->rowCount();
            if ($hay_producto==0 ) {
                $sql = "Delete from productos where CodProd= :CodProd";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':CodProd',$CodProd);
                $stmt->execute();
            }
            else {
                $hay_errores=true;
                $errores[] = "No se puede eliminar el producto porque está en pedidos.";
               
            }
        
        }
        catch (PDOException $err) {
            // Mostramos un mensaje genérico de error.
            echo "Error: ejecutando consulta SQL.";
        }
      
    }
    
    else {
        header("Location: listar_productos.php");
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
									<h2>Usuario:</h2>
									<h2><?php echo $usuario ?></h2>
									
								</header>

							<!-- Banner -->
								<section id="banner">
									<div class="content">
                                        <header>
											<h1>Eliminar Producto</h1>
										</header>
                                        <?php
                                            if ($hay_errores) {
                                           
                                        ?>
                                        <header class="major">
										    <h2>Error al eliminar el producto</h2>
									    </header>
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Descripción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               <?php 
                                                    foreach ($errores as $error) { 
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $error; ?>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                                
                                            </tbody>
                                       </table>
                                     <?php
                                            }
                                            else {

                                            
                                    ?>   
                                    <header class="major">
										    <h2>Producto eliminado satisfactoriamente.</h2>
									    </header>
                                        <?php
                                            }
                                        

                                            
                                    ?> 
                                       <hr class="major">
										   
                                        
                                        
                        
										
									</div>
                                    
								</section>
						</div>
					</div>

				<!-- Sidebar -->
					<div id="sidebar">
						<div class="inner">
							<!-- Menu -->
								<nav id="menu">
									<?php include "../includes/menu_administrador.html" ?>
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