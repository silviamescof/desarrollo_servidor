<?php
    if ($_SERVER["REQUEST_METHOD"]<>"POST") {
 		header("Location: index.php");
        exit();
    }
    else {
		session_start();

         require_once "includes/lib_connect.php";
       
        $usuario = trim(html_entity_decode($_POST["usuario"]));
        $pass = trim(html_entity_decode($_POST["pass"]));
        $tipo_acceso= $_POST["tipo_login"];
        if ($tipo_acceso == "administrador") {
            $sql = 'SELECT * FROM administradores
                    WHERE usuario = :usuario AND pass = :pass';
        }
        else {
            $sql = 'SELECT * FROM restaurantes
                    WHERE Correo = :usuario AND Clave = :pass';
        }
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':usuario',$usuario);
            $stmt->bindParam(':pass',$pass);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            $valido  = $stmt->rowCount();
			
         } 
        catch (PDOException $err) {
            // Mostramos un mensaje genérico de error.
            echo "Error: ejecutando consulta SQL.";
        }
		if ($valido == 1) {
			$row = $stmt->fetch();
			
			
			$_SESSION["usuario"]=$usuario;

			if ($tipo_acceso == "administrador") {
				$_SESSION["id"] = $row["id"];
				header("Location:administrador/inicio_administrador.php");
				exit();
			}
			else {
				$_SESSION["CodRes"] = $row["CodRes"];
				header("Location:restaurante/inicio_restaurante.php");
				exit();	
			}

		}
		else {
		
	
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Error de Acceso </title>
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
									<a href="index.html" class="logo"><h2>Gestor de pedidos</h2> </a>
								</header>

							<!-- Banner -->
								<section id="banner">
									<div class="content">
										<header>
											
											<p>Gestión integral de pedidos, grupo de restaurantes.</p>
										</header>
										<p>Un sistema de gestión de pedidos para un restaurante es una herramienta esencial que permite agilizar y organizar eficientemente todas las operaciones relacionadas con la oferta de alimentos y bebidas. Este sistema se encarga de la creación, actualización y eliminación de categorías de productos, productos y restaurantes que pueden realizar pedidos. </p>
										
									</div>
									<div class="content">
                                    	<h1>Error de acceso</h1>
										<a href="index.php" class="button primary fit">Volver a intentarlo</a>
									</div>
                                    
								</section>
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
<?php
	}
}

?>