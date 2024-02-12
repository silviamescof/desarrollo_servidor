<?php
session_start();
include_once('./includes/lib_connect.php');

	if($_SERVER['REQUEST_METHOD']== 'POST'){


		$valido=true;
		$erroresInicio = '';


		$usuario = isset($_POST['usuario']) ? trim(strip_tags(htmlspecialchars($_POST['usuario'])))  : '';
		$pass = isset($_POST['pass']) ? trim(strip_tags(htmlspecialchars( $_POST['pass'])))  : '';

		$stm = $pdo->prepare('SELECT * FROM administradores WHERE usuario = :usuario AND pass = :pass');
		$stm->bindParam(':usuario', $usuario);
		$stm->bindParam(':pass', $pass);

		$stm->execute();

		if(empty($usuario)){
			$erroresInicio = $erroresInicio.'<br> El usuario no puede estar vacio';
			$valido=false;
		}
		if(empty($pass)){
			$erroresInicio = $erroresInicio.'<br> ElLa contraseña no puede estar vacia ';
			$valido=false;
		}
		if($stm->rowCount()<= 0){
			$erroresInicio = $erroresInicio.'<br> Credenciales incorrectas';
			$valido=false;
		}

		if($valido){
			$_SESSION['usuario'] = $usuario;
			header('Location:listar_vehiculos.php');
		}else{
			$_SESSION['erroresIndex'] = $erroresInicio;
			header('Location:index.php');
		}
	};


