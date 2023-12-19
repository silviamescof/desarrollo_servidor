<?php
	session_start();
    if (!isset($_SESSION["usuario"])) {
        header("Location:../index.php");
        exit();
    }
	$usuario = $_SESSION["usuario"]; 
    $CodRes = $_SESSION["CodRes"];
    $lineas_pedido = 0;
    $codPed=null;
    $accion = null;

	require_once "../includes/lib_connect.php";
    if ($_SERVER["REQUEST_METHOD"]=="POST") {
        $accion = $_POST["accion"];
        
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
        elseif ($accion == "pedido") { // AÑADIR PEDIDO
            try {
                $fecha = date("Y-m-d H:i:s");
                $sql = "INSERT into pedidos (Fecha,Enviado,Restaurante) values ('$fecha',0,$CodRes)";
                $stmt = $pdo->query($sql);
    
                $sql = "SELECT CodPed from pedidos where fecha = '$fecha'";
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $stmt = $pdo->query($sql);
                $row = $stmt->fetch();
                $codPed=$row["CodPed"];
            }
            catch (PDOException $err) {
                    // Mostramos un mensaje genérico de error.
                    echo "Error: ejecutando consulta SQL.";
            }
        }
        elseif ($accion == "elimina") { // ELIMINA LÍNEA DE PEDIDO
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
        elseif($accion == "eliminar_ped") { // ELIMINAR PEDIDO
            $codPed=$_POST["codPed"];
            $fecha =$_POST["fecha"];
            try {
                $sql = "DELETE from pedidosproductos where Pedido = :codPed";  //ELILMINO LAS LÍNEAS DE PRODUCTO
                $stmt_delete_linea= $pdo->prepare($sql);
                $stmt_delete_linea->bindParam(':codPed',$codPed);
                $stmt_delete_linea->execute();

                $sql = "DELETE from pedidos where CodPed = :codPed"; // ELIMINO EL PEDIDO
                $stmt_delete = $pdo->prepare($sql);
                $stmt_delete ->bindParam(':codPed',$codPed);
                $stmt_delete ->execute();               
                
                $codPed=null;
            }
            catch (PDOException $err) {
                    // Mostramos un mensaje genérico de error.
                    echo "Error: ejecutando consulta SQL.";
            }

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
						<h2>Restaurante:<?php echo $usuario ?></h2>
					</header>
					<!-- Banner -->
					<section id="banner">
						<div class="content">
                            <?php 
                                if($codPed==null) {
                            ?>
                            <div class="row">
                                <div class="col-6">
                                    <?php
                                        if ($accion == "cerrar") {
                                    ?>
                                    <header class="major">
										<h2>Pedido cerrado correctamente</h2>
									</header>
                                    <?php
                                        }
                                    ?>
                                    <?php
                                        if ($accion == "eliminar_ped") {
                                    ?>
                                    <header class="major">
										<h2>Pedido eliminado correctamente</h2>
									</header>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <h2>Generar nuevo pedido </h2>
                                </div>
                                <div class="col-6">
                                    <form action="generar_pedido.php" method="post" >
                                        <input type="hidden" name="accion" value="pedido">
                                        <input type="submit" value="Generar nuevo pedido" class="primary">
                                    </form>
                                                
                                </div>
                            </div>  
                            <?php
                                }
                                else { // HAY UN PEDIDO
                            ?>
                            <div class="row">
                                <div class="col-4">
                                    <h2>Código de Pedido: <?php echo $codPed ?> </h2>
                                </div>
                                <div class="col-6">
                                    <h2>Fecha: <?php echo $fecha ?> </h2>
                                </div>
                                <div class="col-2">
                                    <form action="generar_pedido.php" method="post" class="inline" >
                                            <input type="submit" value="Eliminar pedido" class="primary">
                                            <input type="hidden" name="accion" value="eliminar_ped">
                                            <input type="hidden" name="codPed" value="<?php echo $codPed ?>"> 
                                            <input type="hidden" name="fecha" value="<?php echo $fecha ?>">                     
                                    </form>
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
                                                    echo '<form action="generar_pedido.php" method="post" >
                                                            <tr>
                                                                <td>' . $row_linea["Nombre"] . '</td>
                                                                <td>' . $row_linea["Descripcion"] . '</td>
                                                                <td>' . $row_linea["Peso"] . '</td>
                                                                <td>' . $row_linea["Unidades"] . '</td>
                                                                <td>
                                                                    <input type="hidden" name="codPedProd" value="' . $row_linea["CodPedProd"] . '">
                                                                    <input type="hidden" name="fecha" value="' . $fecha . '">
                                                                    <input type="hidden" name="codPed" value="' . $codPed . '">
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
                                    <form action="generar_pedido.php" method="post" class="inline">
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
                                                    echo '<form action="generar_pedido.php" method="post" >
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
							<?php include "../includes/menu_restaurante.html"; ?>
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