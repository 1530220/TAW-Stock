<?php  
	//clase del controlador
	class MvcController{
		//metodo para incluir plantilla
		public function plantilla(){
			header("location:Vistas/plantilla.php");
		}

		//metodo para cambiar de vista
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

		//metodo para iniciar sesion
		public function login(){
			if(isset($_POST['usuario'])&&isset($_POST['contraseña'])){
				//se guardan en variables los datos ingresados y recibido por el metodo post
				$usuario = $_POST['usuario'];
				$contraseña = $_POST['contraseña'];

				//instancia del modelo 
				$log = new Datos();
				//se guarda en $r los datos del usuario que inicio sesion
				$r = $log->Iniciar_Sesion($usuario,$contraseña);
				if($r){
					//se crean variables de sesion
					$_SESSION['usuario'] = $r['nombre_usuario'];
					$_SESSION['contraseña'] = $r['password'];
					$_SESSION['imagen'] = $r['ruta_img'];
					$_SESSION['id'] = $r['id'];
					header("location:plantilla.php");
				}else{
					//sino se manda una alerta indicando usuario o contraseña incorrecta
					echo "<script>alert('Usuario o contraseña incorrecta.')</script>";
				}
			}
		}

		//function para obtener todos los registros de una tabla
		public function getAllController($tabla){
			//instancia del modelo datos
			$datos = new Datos();

			//retornar los datos de la tabla
			return $datos->getAllModel($tabla);
		}

		//metodo para obtener los usuarios menos el usuario en sesion
		public function getUsersController(){
			//instancia del modelo datos
			$datos = new Datos();
			//modelo para obtener los datos de usuarios, excluyendo el de sesion
			return $datos->getUsersModel($_SESSION['usuario']);
		}

		//metodo para actualizar los datos de un usuario
		public function updateUserController($id){
			//guardar en varibles la informacion obtenida de un formulario, enviados por el metodo post
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
				//en caso de que el usuario no haya querido subir una imagen:
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

		//metodo para registrar un usuarios
		public function RegistrarUsuarioController(){
			//variables para guardar los datos del formulario de registrar un usuario, informacion enviada por el metodo post
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
				//instancia del modelo datos
				$registro = new Datos();
				//imagen que se toma por defecto
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

		//metodo para obtener la informacion de un usuario
		public function getInfoUserController($id){
			//instancia del modelo datos
			$userModel = new Datos();
			return $userModel->getInfoUserModel($id);
		}

		//metodo para obtener la informacion de una categoria
		public function getInfoCategoryController($id){
			$userModel = new Datos();
			return $userModel->getInfoCategoryModel($id);
		}

		//metodo para obtener la informacion de un producto
		public function getInfoProductoController($id){
			//instancia del modelo datos
			$userModel = new Datos();
			return $userModel->getInfoProductoModel($id);
		}

		//metodo para actualizar la informacion de una categoria
		public function updateCategoryController($id){
			//almacenar en las variables la informacion del formulario para editar una categoria
			$nombre = $_POST['nombre'];
			$descripcion = $_POST['descripcion'];
			$registro = new Datos();
			//condicion para validar que la categoria haya sido actualizada exitosamente
			if($registro->updateCategoriaModel($nombre,$descripcion,$id)==true){
				echo "<script>alert('Categoria Actualizada')</script>";
			}else{
				echo "<script>alert('Categoria No Actualizada')</script>";
			}
		}

		//metodo para actualizar un producto
		public function updateProductoController($id){

			//variables que contienen la informacion obtenida por el metodo post del formulario de actualizar un producto
			$nombre = $_POST['nombre'];
			$categoria = $_POST['categoria'];
			$precio = $_POST['precio'];

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
	
						//condicion para validar que el modelo haya realizado el registro
						if($registro->updateProductoModel($nombre,$categoria,$precio,$ruta_destino,$id)==true){
							return true;	
						}else{
							//mostrar un alerta para indicar que no se pudo realizar el registro
							echo "<script>alert('No se ha podido editar el producto')</script>";
							return false;
						}
					
					}
				}else{
					//si la imagen es muy grande se indica al alumno
					echo "<script>alert('Error. Tamaño de la imagen excedido')</script>";
					return false;
				}
			}else{
				$registro = new Datos();
				$ruta_destino = "imagen";
				if($registro->updateProductoModel($nombre,$categoria,$precio,$ruta_destino,$id)==true){
					return true;
				}else{
					//mostrar un alerta para indicar que no se pudo realizar el registro
					echo "<script>alert('No se ha podido editar el producto')</script>";
					return false;
				}
			}
		}

		//metodo para borrar una categoria
		public function deleteCategoriaController($id){
			$deleteUser = new Datos();
			return $deleteUser->deleteCategoriaModel($id);
		}

		//metodo para borrar un usuarios
		public function deleteUserController($id){
			$deleteUser = new Datos();
			return $deleteUser->deleteUserModel($id);
		}

		//metodo para borrar un producto
		public function deleteProductoController($id){
			$deleteUser = new Datos();
			return $deleteUser->deleteProductoModel($id);
		}

		//metodo para agregar una categoria
		public function agregarCategoria(){
			//almacenar en las variables la informacion obtenida mediante el metodo post desde el formulario para registrar una categoria
			if(isset($_POST['nombre'])){
				$nombre=$_POST['nombre'];
				$descripcion=$_POST['descripcion'];
				$datos= array('nombre_categoria' =>$nombre,
							  'descripcion_categoria' =>$descripcion );
				//instancia del modelo datos
				$r = new Datos();
				//se envia la informacion al modelo
				$respuesta= $r->agregarCategoriaModel($datos);
				if($respuesta){
					echo "<script>alert('Categoria se agrego exitosamente!')</script>";
				}else{
					echo "<script>alert('Categoria no se agrego exitosamente!')</script>";
				}
			}
		}

		//metodo para que se registre en el historial cuando se añaden productos de un determinado producto, dependiendo del id
		public function HistorialAddController($id){
			//instancia del modelo datos
			$add = new Datos();
			$add->HistorialAdd($id,$_POST['cantidad']);
			return $add->HistorialModel($id,$_SESSION['id']," ",$_POST['referencia'],$_POST['cantidad'],"sumar");
		}

		//metodo para que se registre en el historial cuando se quitan productos de un determinado producto, dependiendo del id
		public function HistorialRemoveController($id){
			//instancia del modelo datos
			$add = new Datos();
			$add->HistorialRemove($id,$_POST['cantidad']);
			return $add->HistorialModel($id,$_SESSION['id'],$_POST['observacion'],$_POST['referencia'],$_POST['cantidad'],"quitar");
		}

		//metodo para obtener el historial de un producto
		public function getHistorialController($producto){
			$historial = new Datos();
			return $historial->getHistorialModel($producto);
		}

		//metodo para agregar productos
		public function AddStockController(){
			//informacion obtenida del formulario del registrar producto y que es enviada por el metodo post
			$codigo = $_POST['codigo'];
			$nombre = $_POST['nombre'];
			$precio = $_POST['precio'];
			$stock = $_POST['stock'];
			$categoria = $_POST['categoria'];

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

						if($registro->verificarCodigoModel($codigo)==false){
							
							//condicion para validar que el modelo haya realizado el registro
							if($registro->RegistrarProductoModel($codigo,$nombre,$precio,$stock,$categoria,$ruta_destino)==true){
								$id_producto = $registro->ProductModel($codigo);
								$registro->HistorialModel($id_producto['id'],$_SESSION['id'],"Alta de Producto",$codigo,$stock,"inicial");
								echo "<script>alert('Producto registrado exitosamente!')</script>";	
							}else{
								//mostrar un alerta para indicar que no se pudo realizar el registro
								echo "<script>alert('No se ha podido registrar el producto')</script>";
							}
						
						}else{
							echo "<script>alert('No se pudo realizar el registro. Ya existe un producto con ese codigo')</script>";
						}
						
					}
				}else{
					//si la imagen es muy grande se indica al alumno
					echo "<script>alert('Error. Tamaño de la imagen excedido')</script>";
				}
			}else{
				//en caso de que no se cargue una foto para el producto:
				//instancia del modelo datos
				$registro = new Datos();
				$ruta_destino = '../media/default/default_product.jpg';
				if($registro->verificarCodigoModel($codigo)==false){
					//condicion para validar que el modelo haya realizado el registro
					if($registro->RegistrarProductoModel($codigo,$nombre,$precio,$stock,$categoria,$ruta_destino)==true){
						$id_producto = $registro->ProductModel($codigo);
						$registro->HistorialModel($id_producto['id'],$_SESSION['id'],"Alta de Producto",$codigo,$stock,"inicial");
						echo "<script>alert('Producto registrado exitosamente!')</script>";	
					}else{
						//mostrar un alerta para indicar que no se pudo realizar el registro
						echo "<script>alert('No se ha podido registrar el producto')</script>";
					}
				
				}else{
					echo "<script>alert('No se pudo realizar el registro. Ya existe un producto con ese codigo')</script>";
				}
			}
		}
	}
?>