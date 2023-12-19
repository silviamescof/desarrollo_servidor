<?php
	session_start();
    if (!isset($_SESSION["usuario"])) {
        header("Location:../index.php");
        exit();
    }
	$usuario = $_SESSION["usuario"]; 
    require_once "../includes/lib_connect.php";
	require_once "../includes/lib_funciones.php";
    $nombre_categoria="";
    $CodCat=0;
    $hay_errores=false;

    if ($_SERVER["REQUEST_METHOD"]=="POST")  {// ELIMINAR CATEGORÍA
    
        $CodCat = $_POST["CodCat"];
   
    }
    elseif (($_SERVER["REQUEST_METHOD"]=="GET") && isset($_GET["CodCat"]))
    {
      
        $CodCat = $_GET["CodCat"];

    }
    if ($CodCat <> 0 ) {   
        
        try {

            $sql = "select * from productos where categoria = $CodCat";
      
            $stmt = $pdo->query($sql);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $hay_productos = $stmt->rowCount();
            if ($hay_productos>0) 
            {
                $hay_errores = true;
                $error = "No se puede eliminar la categoría porque hay productos de la misma.";

            }
            else {
                $sql = "delete from categorias where CodCat = $CodCat";
                $stmt = $pdo->query($sql);
            }


        }
        catch (PDOException $err) {
           // Mostramos un mensaje genérico de error.
            echo "Error: ejecutando consulta SQL.";
        }
    }

   select_categorias($pdo, $hay_mas_categorias, $select_categorias,$CodCat);
    
    cerrar_conexion();
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
                                            if ($CodCat<>0) {
                                        ?>
										<header>
											<h2>Eliminar categoría</h2>
										</header>
                                        <?php
                                            if ($hay_errores) {
                                           
                                        ?>
                                        <header class="major">
										    <h2>Error al eliminar la categoría</h2>
									    </header>
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Descripción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            
                                                <tr>
                                                    <td>
                                                        <?php echo $error; ?>
                                                    </td>
                                                </tr>
                                             
                                                
                                            </tbody>
                                       </table>
                                       <hr class="major">
										   
                                        <?php
                                             }
                                             else {
                                                if (($_SERVER["REQUEST_METHOD"]=="POST") || (($_SERVER["REQUEST_METHOD"]=="GET") && isset($_GET["CodCat"])))  {
                                        ?>
                                             <header class="major">
										        <h2>Categoría eliminada satisfactoriamente.</h2>
									        </header>   
                                            <hr class="major">
                                        <?php        
                                                }
                                             }
                                        ?>
										
                                        <?php 
                                            }
                                            
                                        ?>
                                        <hr>
                                        <header class="major">
										    <h3>Seleccione Categoría</h3>
									    </header>
                                        <div class="col-1">
										</div>
										<div class="col-10 col-12-small">
                                            <form action="eliminar_categoria.php" method="POST" >
                                                <div class="row">
                                                    <div class="col-6">
                                                        <?php echo $select_categorias;?>
                                                    </div>
                                                    <div class="col-6">
                                                        <input type="submit" value="Eliminar" class="button primary icon solid fa-searc">
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