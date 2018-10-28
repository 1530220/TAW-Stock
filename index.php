<?php  
	session_start();

	require_once "Controladores/controlador.php";
	require_once "Modelos/enlaces.php";
	require_once "Modelos/crud.php";

	if(isset($_SESSION['usuario'])){
		$plantilla = new MvcController();
		$plantilla->plantilla();
	}else{
		header("location:Vistas/login.php");
	}
?>