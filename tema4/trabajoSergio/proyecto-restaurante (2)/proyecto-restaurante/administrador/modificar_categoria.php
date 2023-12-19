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

    if ($_SERVER["REQUEST_METHOD"]=="POST") {  // MODIFICAR CATEGORÍA
        
        $CodCat = $_POST["CodCat"];
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

                   $sql = "update categorias set Nombre = :nombre, Descripcion= :descripcion
                            where CodCat= :CodCat";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':CodCat',$CodCat);
                    $stmt->bindParam(':nombre',$nombre);
                    $stmt->bindParam(':descripcion',$descripcion);

                    $stmt->execute();

                 }
                catch (PDOException $err) {
                    // Mostramos un mensaje genérico de error.
                    echo "Error: ejecutando consulta SQL.";
                }
        }

    }
    elseif ($_SERVER["REQUEST_METHOD"]=="GET") { // SELECCIONAR DATOS DE LA CATEGORÍA
       
        if (isset($_GET["CodCat"])) {
            $CodCat=$_GET["CodCat"];

            try {
                $sql = 'select * from categorias where CodCat= :CodCat';
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':CodCat',$CodCat);
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $stmt->execute();
                $row = $stmt->fetch();
                $nombre = $row["Nombre"];
                $descripcion = $row["Descripcion"];
                $codCat = $row["CodCat"];
            }
            catch (PDOException $err) {
                // Mostramos un mensaje genérico de error.
                echo "Error: ejecutando consulta SQL.";
            }
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
											<h2>Modificar categoría: <?php echo $nombre ?></h2>
										</header>
                                        <?php
                                            if ($hay_errores) {
                                           
                                        ?>
                                        <header class="major">
										    <h2>Error al modificar la categoría</h2>
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
										        <h2>Categoría modificada satisfactoriamente.</h2>
									        </header>   
                                            <hr class="major">
                                        <?php        
                                                }
                                             }
                                        ?>
										<div class="row">
											<div class="col-1">
											</div>
											<div class="col-10 col-12-small">
                                                <form action="modificar_categoria.php" method="post">
                                                    <div class="row gtr-uniform">
                                                        <div class="col-4 col-12-xsmall">
                                                            <h4>Nombre</h4>
                                                            <input type="Text" name="nombre" id="nombre" value="<?php echo $nombre?>" required>
                                                        </div>
                                                        <div class="col-4 col-12-xsmall">
                                                            <h4>Descripción</h4>
                                                            <textarea name="descripcion" required><?php echo $descripcion ?></textarea>
                                                        </div>
                                                        <div class="col-4 col-12-xsmall">
                                                            <h4>Acción</h4>
                                                            <input type="hidden" name="CodCat" value="<?php echo $CodCat ?>" >
                                                            <input type="submit" value="Modificar" class="primary">
                                                        </div>
                                                    </div>
                                                </form>
												
											</div>	
										</div>
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
                                            <form action="modificar_categoria.php" method="GET" >
                                                <div class="row">
                                                    <div class="col-6">
                                                        <?php echo $select_categorias;?>
                                                    </div>
                                                    <div class="col-6">
                                                        <input type="submit" value="Seleccionar" class="button primary icon solid fa-searc">
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