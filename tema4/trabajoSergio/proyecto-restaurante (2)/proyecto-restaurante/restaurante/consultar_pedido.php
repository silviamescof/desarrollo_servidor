<?php
	session_start();
    if (!isset($_SESSION["usuario"])) {
        header("Location:../index.php");
        exit();
    }
	$usuario = $_SESSION["usuario"]; 
	
   
    if ($_SERVER["REQUEST_METHOD"]<>"GET") {
        header("location:listar_pedidos.php");
    }
    else {
      
        require_once "../includes/lib_connect.php";
        require_once "../includes/lib_funciones.php";
        $codPed=$_GET["codPed"];
  
        try {
            $sql = 'select Fecha, Enviado from pedidos where CodPed= :codPed';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':codPed',$codPed);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            $row = $stmt->fetch();
            $fecha = $row["Fecha"];
            $enviado = $row["Enviado"];
            $estado = $enviado;
            $acciones = "";
            genera_enviado_acciones($estado,$acciones,$codPed, $fecha);
         
            $sql = "SELECT p.*, pp.Unidades, pp.CodPedProd from pedidosproductos pp, productos p
                    where (p.CodProd = pp.Producto) and (pp.Pedido = :codPed)";
            $stmt_linea = $pdo->prepare($sql);
            $stmt_linea->bindParam(':codPed',$codPed);
            $stmt_linea->execute();
            $lineas_pedido = $stmt_linea->rowCount();
           
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
											<h1>Ver Pedido</h1>
										</header>
										<div class="row">
                                            <div class="col-4">
                                                <h3>Código de Pedido: <?php echo $codPed ?> </h3>
                                            </div>
                                            <div class="col-4">
                                                <h3>Fecha: <?php echo $fecha ?> </h3>
                                            </div>
                                            <div class="col-3">
                                                <h3>Estado: <?php echo $estado ?> </h3>
                                            </div>
                                        </div>
                                            <?php 
                                                if ($enviado == 0 ) { // AÚN SE PUEDE ELIMINAR
                                                   
                                           ?>
                                        <div class="row">  
                                            <div class="col-6"> 
                                            </div>
                                            <div class="col-6"> 
                                               <?php 
                                                    echo $acciones;  
                                               ?>
                                            </div> 
                                        </div>    
                                            <?php
                                                }
                                            ?>
                                        
                                        <hr>
                                        <?php                              
                                            if ($lineas_pedido==0) {  // NO HAY PRODUCTOS EN EL PEDIDO
                                        ?>
                                        <div class="row">
                                            <div class="col-4">
                                                <h3 class="inline">No hay productos en el pedido </h3>
                                            </div>
                                            
                                        </div>        
                                        <?php
                                            }
                                            else { // HAY PRODUCTOS EN EL PEDIDO
                                        ?>
                                        <div class="row">
                                            <div class="col-1">
                                            </div>
                                            <div class="col-10 col-12-small">
                                                <header class="major">
                                                    <h2 class="major">Productos añadidos</h2>
                                                </header>    
                                                <table class="alt">
                                                    <thead>
                                                        <tr>
                                                            <th>Nombre</th>
                                                            <th>Descripción</th>
                                                            <th>Peso</th>
                                                            <th>Unidades</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            while ($row_linea = $stmt_linea->fetch()) {
                                                                echo '<form action="generar_pedido.php" method="post" >
                                                                        <tr>
                                                                            <td>' . $row_linea["Nombre"] . '</td>
                                                                            <td>' . $row_linea["Descripcion"] . '</td>
                                                                            <td>' . $row_linea["Peso"] . '</td>
                                                                            <td>' . $row_linea["Unidades"] . '</td>
                                                                            
                                                                        </tr>
                                                                    </form>';
                                                            }
                                                        ?>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td><a href="listar_pedidos.php" class="button icon solid fa-reply">Volver</a></td>
                                                        </tr>	
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