<?php
	session_start();
    if (!isset($_SESSION["usuario"])) {
        header("Location:../index.php");
        exit();
    }
	$usuario = $_SESSION["usuario"]; 
    $lineas_pedido = 0;
    $accion = null;

	require_once "../includes/lib_connect.php";
    require('../includes/fpdf186/fpdf.php');

    if ($_SERVER["REQUEST_METHOD"]=="POST") {
        $accion = $_POST["accion"];
        $codRes = $_POST["codRes"];
        $codPed = $_POST["codPed"];

        if (isset($_POST["pdf"])){
            
            $stm=$pdo->prepare('SELECT p.*, pp.Unidades, pp.CodPedProd from pedidosproductos pp, productos p
            where (p.CodProd = pp.Producto) and (pp.Pedido = :codPed)');

            $stm->bindParam(":codPed", $codPed);

            $stm->execute();
            

                class PDF extends FPDF
                {
                    // Cabecera de página
                    function Header()
                    {
                        $this->SetFont('Arial', 'B', 12);
                        $this->Cell(0, 10, 'Codigo de pedido: '.$_POST["codPed"].' Fecha de pedido: '.$_POST["fecha"], 0, 1, 'C');
                        $this->Cell(0, 10, 'LISTADO DE PRODUCTOS', 0, 1, 'C');
                    }

                    // Pie de página
                    function Footer()
                    {
                        $this->SetY(-15);
                        $this->SetFont('Arial', 'I', 8);
                        $this->Cell(0, 10, 'Página ' . $this->PageNo(), 0, 0, 'C');
                    }

                    // Crear tabla
                    function CreateTable($header, $data)
                    {
                        // Cabecera
                        foreach ($header as $col) {
                            $this->Cell(40, 10, $col, 1);
                        }
                        $this->Ln();

                        // Datos
                        foreach ($data as $row) {
                            foreach ($row as $col) {
                                $this->Cell(40, 10, $col, 1);
                            }
                            $this->Ln();
                        }
                    }
                }

            // Crear instancia de PDF
            $pdf = new PDF();
            $pdf->AddPage();

            // Cabecera y datos de ejemplo
            $header = array('Nombre', 'Descripcion', 'Peso', 'Unidades');
            $data = [];

            while ($row_linea = $stm->fetch()) {
               $data[]=[$row_linea["Nombre"],$row_linea["Descripcion"],$row_linea["Peso"],$row_linea["Unidades"] ];
            }       

            // Crear tabla en el PDF
            $pdf->CreateTable($header, $data);

            // Salida del PDF
            $pdf->Output();



        }elseif($accion == "eliminar_ped") { // ELIMINAR PEDIDO
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
        
       
    }
    else {
        header("Location:inicio_administrador.php");
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