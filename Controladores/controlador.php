<?php  
	class MvcController{
		public function plantilla(){
			header("location:Vistas/plantilla.php");
			//include "Vistas/plantilla.php";
		}

		
		public function enlacesPaginasController(){
			//trabajar con los enlaces de las paginas
			//validar si la variable "action" viene vacia, es decir, cuando se abre la pagina por primera vez, se debe cargar la vista index.php

			if (isset($_GET['action'])) {
				$enlacesController = $_GET['action'];
			}else{
				//si viene vacio inicializo con index
				$enlacesController = "index";
			}

			$respuesta = new EnlacesPaginas();

			include $respuesta->enlacesPaginasModel($enlacesController);
		}

		public function login(){
			if(isset($_POST['usuario'])&&isset($_POST['contraseña'])){

				$usuario = $_POST['usuario'];
				$contraseña = $_POST['contraseña'];
				$log = new Datos();

				$r = $log->Iniciar_Sesion($usuario,$contraseña);
				if($r){
					$_SESSION['usuario'] = $r['nombre_usuario'];
					$_SESSION['imagen'] = $r['ruta_img'];
					header("location:plantilla.php");
				}else{
					echo "<script>alert('Usuario o contraseña incorrecta.')</script>";
				}
			}
		}

		public function getAllController($tabla){
			$datos = new Datos();

			return $datos->getAllModel($tabla);
		}

		public function getUsersController(){
			$datos = new Datos();
			return $datos->getUsersModel($_SESSION['usuario']);
		}

		public function updateUserController($id){
			$nombre = $_POST['nombre'];
			$paterno = $_POST['paterno'];
			$materno = $_POST['materno'];
			$email = $_POST['email'];
			$contraseña1 = $_POST['contraseña1'];
			$contraseña2 = $_POST['contraseña2'];

			//arreglo para indicar las posibles extensiones de las imagenes que se admitiran
			$extensiones = array('image/jpg','image/jpeg','image/png');
			//indicar el tamaño maximo de la imagen que se permitira subir
			$max = 1024 * 1024 * 8;
			//variable para guardar la ruta temporal donde se almacena la imagen
			$ruta_origen = $_FILES['imagen']['tmp_name'];
			//variable para guardar la ruta que se desea tener para guardar la imagen
			$ruta_destino = '../media/'.rand(0, 99999999999).$_FILES['imagen']['name'];

			//se verifica que la imagen subida sea de extension indicada anteriormente, gracias a la variable type
			if(in_array($_FILES['imagen']['type'],$extensiones)){
				//se verifica que la imagen sea menor al tamañano maximo indicado
				if($_FILES['imagen']['size']<$max){
					//condicion para saber si se pudo subir la imagen a la ruta deseada
					if(move_uploaded_file($ruta_origen,$ruta_destino)){			
						//instanciar la clase datos
						$registro = new Datos();

						if($contraseña1==$contraseña2){
							//condicion para validar que el modelo haya realizado el registro
							if($registro->updateUsuarioModel($nombre,$paterno,$materno,$email,$contraseña1,$ruta_destino,$id)==true){
								echo "<script>alert('Usuario actualizado exitosamente!')</script>";	
							}else{
								//mostrar un alerta para indicar que no se pudo realizar el registro
								echo "<script>alert('No se ha podido editar el usuario')</script>";
							}
						}else{
							echo "<script>alert('Las contraseñas no coinciden')</script>";
						}						
					}
				}else{
					//si la imagen es muy grande se indica al alumno
					echo "<script>alert('Error. Tamaño de la imagen excedido')</script>";
				}
			}else{
				$registro = new Datos();
				$ruta_destino = "imagen";
				if($contraseña1==$contraseña2){
					//condicion para validar que el modelo haya realizado el update
					if($registro->updateUsuarioModel($nombre,$paterno,$materno,$email,$contraseña1,$ruta_destino,$id)==true){
						echo "<script>alert('Usuario actualizado exitosamente!')</script>";
					}else{
						//mostrar un alerta para indicar que no se pudo realizar el update
						echo "<script>alert('No se ha podido editar el usuario')</script>";
					}
				}else{
					echo "<script>alert('Las contraseñas no coinciden')</script>";
				}
			}
		}

		public function RegistrarUsuarioController(){
			
			$nombre = $_POST['nombre'];
			$paterno = $_POST['paterno'];
			$materno = $_POST['materno'];
			$email = $_POST['email'];
			$usuario = $_POST['usuario'];
			$contraseña1 = $_POST['contraseña1'];
			$contraseña2 = $_POST['contraseña2'];

			//arreglo para indicar las posibles extensiones de las imagenes que se admitiran
			$extensiones = array('image/jpg','image/jpeg','image/png');
			//indicar el tamaño maximo de la imagen que se permitira subir
			$max = 1024 * 1024 * 8;
			//variable para guardar la ruta temporal donde se almacena la imagen
			$ruta_origen = $_FILES['imagen']['tmp_name'];
			//variable para guardar la ruta que se desea tener para guardar la imagen
			$ruta_destino = '../media/'.rand(0, 99999999999).$_FILES['imagen']['name'];

			//se verifica que la imagen subida sea de extension indicada anteriormente, gracias a la variable type
			if(in_array($_FILES['imagen']['type'],$extensiones)){
				//se verifica que la imagen sea menor al tamañano maximo indicado
				if($_FILES['imagen']['size']<$max){
					//condicion para saber si se pudo subir la imagen a la ruta deseada
					if(move_uploaded_file($ruta_origen,$ruta_destino)){			
						//instanciar la clase datos
						$registro = new Datos();

						if($registro->verificarUsuarioModel($usuario)==false){
							if($contraseña1==$contraseña2){
								//condicion para validar que el modelo haya realizado el registro
								if($registro->RegistrarUsuarioModel($nombre,$paterno,$materno,$email,$usuario,$contraseña1,$ruta_destino)==true){
									echo "<script>alert('Usuario registrado exitosamente!')</script>";	
								}else{
									//mostrar un alerta para indicar que no se pudo realizar el registro
									echo "<script>alert('No se ha podido registrar el usuario')</script>";
								}
							}else{
								echo "<script>alert('Las contraseñas no coinciden')</script>";
							}
						}else{
							echo "<script>alert('No se pudo realizar el registro. Usuario en uso')</script>";
						}
						
					}
				}else{
					//si la imagen es muy grande se indica al alumno
					echo "<script>alert('Error. Tamaño de la imagen excedido')</script>";
				}
			}else{
				$registro = new Datos();
				$ruta_destino = '../media/default/default.png';
				if($registro->verificarUsuarioModel($usuario)==false){
					if($contraseña1==$contraseña2){
						//condicion para validar que el modelo haya realizado el registro
						if($registro->RegistrarUsuarioModel($nombre,$paterno,$materno,$email,$usuario,$contraseña1,$ruta_destino)==true){
							echo "<script>alert('Usuario registrado exitosamente!')</script>";	
						}else{
							//mostrar un alerta para indicar que no se pudo realizar el registro
							echo "<script>alert('No se ha podido registrar el usuario')</script>";
						}
					}else{
						echo "<script>alert('Las contraseñas no coinciden')</script>";
					}
				}else{
					echo "<script>alert('No se pudo realizar el registro. Usuario en uso')</script>";
				}
			}
		}

		public function getInfoUserController($id){
			$userModel = new Datos();
			return $userModel->getInfoUserModel($id);
		}
	}
?>