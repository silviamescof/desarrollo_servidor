<?php
	session_start();
    if (!isset($_SESSION["usuario"])) {
        header("Location:../index.php");
        exit();
    }
	$usuario = $_SESSION["usuario"]; 
 
    $lineas_pedido = 0;
    $codPed=null;
    $accion = null;

	require_once "../includes/lib_connect.php";
    
    if (($_SERVER["REQUEST_METHOD"]=="GET") && (isset($_GET["codPed"]))) {
      
        $codPed = $_GET["codPed"];
        $codRes = $_GET["codRes"];
        $sql = "select * from pedidos where CodPed = :codPed";
		$stmt_cabecera = $pdo->prepare($sql);
        $stmt_cabecera -> bindParam(':codPed',$codPed);
		$stmt_cabecera -> setFetchMode(PDO::FETCH_ASSOC);
        $stmt_cabecera -> execute();
        $row = $stmt_cabecera->fetch();
        $fecha = $row["Fecha"];
 
    }    
    elseif ($_SERVER["REQUEST_METHOD"]=="POST") {
        $accion = $_POST["accion"];
        $codRes = $_POST["codRes"];
        
        if ($accion == "linea") { // AÑADIR LINEA A PEDIDO
            $fecha =$_POST["fecha"];
            $codProd = $_POST["codProd"];
            $unidades = $_POST["unidades"];
            $codPed=$_POST["codPed"];
            
            try {
                $sql = "INSERT into pedidosproductos (Pedido,Producto,Unidades) values (:codPed, :codProd, :unidades)";
                $stmt_insert= $pdo->prepare($sql);
                $stmt_insert->bindParam(':codPed',$codPed);
                $stmt_insert->bindParam(':codProd',$codProd);
                $stmt_insert->bindParam(':unidades',$unidades);
                $stmt_insert->execute();
                
            }
            catch (PDOException $err) {
                // Mostramos un mensaje genérico de error.
                echo "Error: ejecutando consulta SQL.";
            }
        }
        elseif ($accion == "elimina") { // ELIMINAR LÍNEA DE PEDIDO
            $fecha =$_POST["fecha"];
            $codPedProd = $_POST["codPedProd"];
            $codPed=$_POST["codPed"];
            try {
                $sql = "DELETE from pedidosproductos where CodPedProd = :codPedProd";
                $stmt_delete= $pdo->prepare($sql);
                $stmt_delete->bindParam(':codPedProd',$codPedProd);
                $stmt_delete->execute();
            }
            catch (PDOException $err) {
                    // Mostramos un mensaje genérico de error.
                    echo "Error: ejecutando consulta SQL.";
            }
    
        }
        elseif($accion == "cerrar") { // CERRAR PEDIDO
            $codPed=null;
        }
        
        
       
    }
    else {
        header("location: listar_pedidos_restaurante.php");
        exit();
    }

    try {
        $sql = "SELECT p.*, pp.Unidades, pp.CodPedProd from pedidosproductos pp, productos p
                where (p.CodProd = pp.Producto) and (pp.Pedido = :codPed)";
        $stmt_linea= $pdo->prepare($sql);
        $stmt_linea->setFetchMode(PDO::FETCH_ASSOC);
        $stmt_linea->bindParam(':codPed',$codPed);
        $stmt_linea->execute();
        $lineas_pedido = $stmt_linea->rowCount();


        $sql = 'SELECT p.CodProd, p.Nombre, p.Descripcion, p.Peso, p.Stock, c.Nombre as nombreCat, c.CodCat
                FROM productos p, categorias c 
                WHERE p.Categoria=c.CodCat';
        $stmt = $pdo->query($sql);
        $hay_productos = $stmt->rowCount();
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
						<h2>Usuario:<?php echo $usuario ?></h2>
					</header>
					<!-- Banner -->
					<section id="banner">
						<div class="content">
                            <?php 
                                if($codPed==null) {
                            ?>
                            <div class="row">
                                <div class="col-8">
                                    <?php
                                        if ($accion == "cerrar") {
                                    ?>
                                    <header class="major">
										<h2>Pedido cerrado correctamente</h2>
									</header>
                                    <?php
                                        }
                                    ?>
                                    
                                </div>
                                <div class="col-4">
                                    <a href="listar_pedidos_restaurante.php?CodRes=<?php echo $codRes ?>" class="button icon solid fa-reply">Volver</a>
                                </div>
                            </div>
                            <?php
                                }
                                else { // SEGIMOS EDITANDO EL PEDIDO
                            ?>
                            <div class="row">
                                <div class="col-4">
                                    <h2>Código de Pedido: <?php echo $codPed ?> </h2>
                                </div>
                                <div class="col-4">
                                    <h2>Fecha: <?php echo $fecha ?> </h2>
                                </div>
                                <div class="col-4">
                                    <a href="listar_pedidos_restaurante.php?CodRes=<?php echo $codRes ?>" class="button icon solid fa-reply">Volver</a>
                                </div>
                                
                            </div>
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
                                                <th>Eliminar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                while ($row_linea = $stmt_linea->fetch()) {
                                                    echo '<form action="modificar_pedido.php" method="post" >
                                                            <tr>
                                                                <td>' . $row_linea["Nombre"] . '</td>
                                                                <td>' . $row_linea["Descripcion"] . '</td>
                                                                <td>' . $row_linea["Peso"] . '</td>
                                                                <td>' . $row_linea["Unidades"] . '</td>
                                                                <td>
                                                                    <input type="hidden" name="codPedProd" value="' . $row_linea["CodPedProd"] . '">
                                                                    <input type="hidden" name="fecha" value="' . $fecha . '">
                                                                    <input type="hidden" name="codPed" value="' . $codPed . '">
                                                                    <input type="hidden" name="codRes" value="' . $codRes . '">

                                                                    <input type="hidden" name="accion" value="elimina">
                                                                    <input type="submit" value="Eliminar" class="primary">
                                                                </td>
                                                            </tr>
                                                        </form>';
                                                }
                                            ?>		
                                        </tbody>
                                    </table>
                                </div>	
                            </div>
                            <div class="row">
                                <div class="col-8">
                                </div>
                                <div class="col-4 col-12-small">
                                    <form action="modificar_pedido.php" method="post" class="inline">
                                        <input type="hidden" name="codRes" value="<?php echo  $codRes ?>">
                                        <input type="submit" value="Cerrar pedido" class="button">
                                        <input type="hidden" name="accion" value="cerrar">                      
                                    </form>
                                          
                                </div>
                            </div>    
                            <hr>               
                            <?php
                                }
                            ?>
                            <div class="row">
                                <div class="col-1">
                                </div>
                                <div class="col-10 col-12-small">
                                    <header class="major">
                                        <h2 class="major">Productos disponibles</h2>
                                    </header>    
                                    <table class="alt">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Descripción</th>
                                                <th>Peso</th>
                                                <th>Stock</th>
                                                <th>Cantidad</th>
                                                <th>Añadir</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                while ($row = $stmt->fetch()) {
                                                    echo '<form action="modificar_pedido.php" method="post" >
                                                            <tr>
                                                                <td>' . $row["Nombre"] . '</td>
                                                                <td>' . $row["Descripcion"] . '</td>
                                                                <td>' . $row["Peso"] . '</td>
                                                                <td>' . $row["Stock"] . '</td>
                                                                <td>
                                                                    <input name="unidades" value="1" type="number" min="1" max="' . $row["Stock"] . '"/>
                                                                </td>
                                                                <td>
                                                                    <input type="hidden" name="codProd" value="' . $row["CodProd"] . '">
                                                                    <input type="hidden" name="fecha" value="' . $fecha . '">
                                                                    <input type="hidden" name="codPed" value="' . $codPed . '">
                                                                    <input type="hidden" name="codRes" value="' . $codRes . '">
                                                                    <input type="hidden" name="accion" value="linea">
                                                                    <input type="submit" value="Añadir" class="primary">
                                                                </td>
                                                            </tr>
                                                        </form>';
                                                }
                                            ?>		
                                        </tbody>
                                    </table>
                                
                                </div>
                            </div>
                            <?php
                            }
                            ?>
                            </div>
                        </div>	
                    </section>
				</div>
				<!-- Sidebar -->
                <?php 
                    if($codPed==null) {
                ?>
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
                <?php
                }
                ?>            
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