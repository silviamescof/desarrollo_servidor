<?php

session_start();
	if(!isset($_SESSION["usuario"])){
		header("Location:index.php");
	};
    //variables del control de errores
    $hay_errores = "";
    $errores = false;
    $salida = "";

    //variable que almacenara los datos de la ID
    $id_producto = "";

    //variables del formulario
    $nombre = "";
    $descripcion = ""; 
    $peso = ""; 
    $stock = ""; 
    $categoria = ""; 


    //si viene de post enlazamos conexión con BD
    if($_SERVER["REQUEST_METHOD"]=="POST"){

        //recogemos datos del formulario - comprobando primerp que el campo no esté vacío
        if(!empty($_POST["categoria"])){
            $id_producto = $_POST["categoria"];
        }else{
            $hay_errores = "El campo ID está vacío";
            $errores = true;
        }
		//si el campo no esta vacio pasa al siguiente paso para eliminar la categoria
        if($hay_errores==false){
            try{
				//conexión bd
				$cadena_conexion = 'mysql:dbname=pedidos;host=127.0.0.1';
				$usuario = 'root';
				$clave = '';
				$bd = new PDO($cadena_conexion, $usuario, $clave);

				//comprobamos que la categoría existe
				$sql = "SELECT codprod, nombre, descripcion, peso, stock, categoria FROM productos WHERE codprod = $id_producto";
				$resultado = $bd->query($sql);
				if($resultado->rowCount()==0){
					$hay_errores = "La categoría no existe";
					$errores = true;
				}else{
                    foreach ($resultado as $fila) {
                        $id_producto = $fila['codprod'];
                        $nombre = $fila['nombre'];
                        $descripcion = $fila['descripcion'];
                        $peso = $fila['peso'];
                        $stock = $fila['stock'];
                        $categoria = $fila['categoria'];
                    }
				}
			}catch(PDOException $e){
                echo $e->getMessage();
			}
        }
    }

?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Editorial by HTML5 UP</title>
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
									<h2>Gestor de pedidos</h2>
								</header>

							<!-- Banner -->
								<section id="banner">
									<div class="content">
										<header>
											<h1>Editar Producto</h1>
											<p>Gestión integral de pedidos, grupo de restaurantes.</p>
										</header>
										<p>Introduzca la ID del producto que desea modificar</p>
										<!--AQUI EMPIEZA EL FORMULARIO-->
                                        <form action="editar_producto.php" method="POST">
                                            <div class="row gtr-uniform">
                                                <div class="col-6 col-12-xsmall">
                                                    <input type="text" name="categoria" id="categoria" value="" placeholder="ID" />
                                                </div>
                                                <!-- Break -->
                                                <div class="col-12">
                                                    <ul class="actions">
                                                        <li><input type="submit" value="Buscar" class="primary"/></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </form>
                                        <!--FIN DEL FORMNULARIO-->
                                        <?php
                                            //salida info
                                            if($errores == true){
                                                echo("Se han producido los siguientes errores: <br> $hay_errores");
                                            }else{
                                                echo($salida);
                                            }
                                        ?>
                                        <!--AQUI EMPIEZA EL FORMULARIO-->
                                        <form action="procesar_editar_producto.php" method="POST">
                                        <h2>Actualizar datos de un Producto</h2>
                                            <div class="row gtr-uniform">
                                                <div class="col-6 col-12-xsmall">
                                                    <label for="codigo">ID</label>
                                                    <input type="text" name="codigo" id="actualizar" value="<?php echo $id_producto; ?>"/>
                                                </div>
                                                <div class="col-6 col-12-xsmall">
                                                    <label for="nombre">Nombre</label>
                                                    <input type="text" name="nombre" id="actualizar" value="<?php echo $nombre; ?>"/>
                                                </div>
                                                <div class="col-6 col-12-xsmall">
                                                    <label for="descripcion">Descripcion</label>
                                                    <input type="text" name="descripcion" id="actualizar" value="<?php echo $descripcion; ?>"/>
                                                </div>
                                                <div class="col-6 col-12-xsmall">
                                                    <label for="peso">Peso</label>
                                                    <input type="number" name="peso" id="actualizar" value="<?php echo $peso; ?>"/>
                                                </div>
                                                <div class="col-6 col-12-xsmall">
                                                    <label for="stock">Stock</label>
                                                    <input type="number" name="stock" id="actualizar" value="<?php echo $stock; ?>"/>
                                                </div>
                                                <div class="col-6 col-12-xsmall">
                                                    <label for="categoria">Categoría</label>
                                                    <input type="number" name="categoria" id="actualizar" value="<?php echo $categoria; ?>"/>
                                                </div>
                                                <!-- Break -->
                                                <div class="col-12">
                                                    <ul class="actions">
                                                        <li><input type="submit" value="Actualizar Datos" class="primary"/></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </form>
                                        <!--FIN DEL FORMNULARIO-->
                                        
									</div>
									
								</section>
						</div>
					</div>

				<!-- Sidebar -->
					<div id="sidebar">
						<div class="inner">
							<!-- Menu -->
								<nav id="menu">
								<?php
									if($_SESSION["perfil"]=="restaurante"){

										include "../includes/menu_restaurante.php";

									}elseif($_SESSION["perfil"]=="administrador"){

										include "../includes/menu_admin.php";
									};
										
								?>
								</nav>

							<!-- Footer -->
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