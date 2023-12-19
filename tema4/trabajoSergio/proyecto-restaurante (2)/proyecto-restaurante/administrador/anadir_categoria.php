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

    if ($_SERVER["REQUEST_METHOD"]<>"POST") {
        
        $nombre = "";
        $descripcion = "";
    }
    else {
        
        $nombre=comprueba_valido($_POST["nombre"],"texto");
        $descripcion = comprueba_valido($_POST["descripcion"],"texto");

        if (!$nombre) {
            $errores[] = "El nombre introducido no es válido <br>";
            $nombre = "";
            $hay_errores=true;
        }
        if (!$descripcion) {
            $errores[] = "La descripción añadida no es válida <br>";
            $descripcion = "";
            $hay_errores=true;
        }
        
    
        if (!$hay_errores) {
            try {
                $sql = 'insert into categorias (Nombre, Descripcion) values (:nombre, :descripcion)';
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':nombre',$nombre);
                $stmt->bindParam(':descripcion',$descripcion);
               
             
                $stmt->execute();

                $nombre = "";
                $descripcion="";
            }
            catch (PDOException $err) {
                // Mostramos un mensaje genérico de error.
                echo "Error: ejecutando consulta SQL.";
            }
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
									<h2>Usuario:</h2>
									<h2><?php echo $usuario ?></h2>
									
								</header>

							<!-- Banner -->
								<section id="banner">
									<div class="content">
                                        <header>
											<h1>Añadir Categoría</h1>
										</header>
                                        <?php
                                            if ($hay_errores) {
                                           
                                        ?>
                                        <header class="major">
										    <h2>Error al añadir categoría</h2>
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
                                       <hr class="major">
										   
                                        <?php
                                             }
                                             else {
                                                if ($_SERVER["REQUEST_METHOD"]=="POST") {
                                        ?>
                                             <header class="major">
										        <h2>Categoría añadida satisfactoriamente.</h2>
									        </header>   
                                            <hr class="major">
                                        <?php        
                                                }
                                             }
                                        ?>
                                        <form action="anadir_categoria.php" method="post">
                                            <div class="row gtr-uniform">
                                                <div class="col-6 col-12-xsmall">
                                                    <h4>Nombre</h4>
                                                    <input type="Text" name="nombre" id="nombre" value="<?php echo $nombre?>" required>
                                                </div>
                                                <div class="col-6 col-12-xsmall">
                                                </div>
                                                <div class="col-6 col-12-xsmall">
                                                    <h4>Descripción</h4>
                                                    <textarea name="descripcion" required><?php echo $descripcion ?></textarea>
                                                </div>
                                                 <div class="col-12">
                                                    <ul class="actions">
                                                        <li><input type="submit" value="Añadir" class="primary"></li>
                                                        
                                                    </ul>
                                                </div>
                                            </div>
                                        </form>
                        
										
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