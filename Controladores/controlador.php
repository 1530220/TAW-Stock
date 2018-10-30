<?php  
	//Clase del controlador donde se manejan todos los datos que se envian a las vistas
	class MvcController{
		//Función para mandar llamar a la plantilla para las vistas que se van a mostrar
		public function plantilla(){
			//Aquí es para redirigir a la plantilla para mostrar la vista
			header("location:Vistas/plantilla.php");
		}

		//Función para poder llamar a la vista que quiere ver el usuario
		public function enlacesPaginasController(){
			//Trabajar con los enlaces de las paginas
			//Validar si la variable "action" viene vacia, es decir, cuando se abre la pagina por primera vez, se debe cargar la vista index.php
			if (isset($_GET['action'])) {
				//Se consigue el action para poder ingresar a la vista
				$enlacesController = $_GET['action'];
			}else{
				//Si viene vacio inicializo con index
				$enlacesController = "index";
			}
			//Se crea un objeto de la clase EnlacesPaginas
			$respuesta = new EnlacesPaginas();

			//Aqui con la variable respuesta manda llamar la función del modelo que va hacer la tarea de mostrar la vista.
			include $respuesta->enlacesPaginasModel($enlacesController);
		}

		//Esta función sirve para ingresar con un usuario y contraseña para entrar a la pantalla principal(dashboard)
		public function login(){
			if(isset($_POST['usuario'])&&isset($_POST['contraseña'])){
				//Mediante variables mandar llamar a los campos de usuario y contraseña de la vista del login
				$usuario = $_POST['usuario'];
				$contraseña = $_POST['contraseña'];

				//Se crea un objeto de la clase Datos
				$log = new Datos();
				//Aqui se manda la información que se ir a la función de Iniciar_Sesión para que haga la consulta correspondiente
				$r = $log->Iniciar_Sesion($usuario,$contraseña);
				//Esta condición es para mandar la respuesta si es verdadero que inicie la sesión o si no mandar una alerta de error para que ingrese bien los datos
				if($r){
					//Las variables para poder iniciar la sesión mediante el nombre, el password, la imagen y el id
					$_SESSION['usuario'] = $r['nombre_usuario'];
					$_SESSION['contraseña'] = $r['password'];
					$_SESSION['imagen'] = $r['ruta_img'];
					$_SESSION['id'] = $r['id'];
					//Redirige a la plantilla y para que muestra el dashboard
					header("location:plantilla.php");
				}else{
					//Sino se manda una alerta indicando usuario o contraseña incorrecta
					echo "<script>alert('Usuario o contraseña incorrecta.')</script>";
				}
			}
		}

		//Función para obtener todos los registros de una tabla
		public function getAllController($tabla){
			//Instancia del modelo datos
			$datos = new Datos();

			//Retornar los datos de la tabla
			return $datos->getAllModel($tabla);
		}

		//Metodo para obtener los usuarios menos el usuario en sesion
		public function getUsersController(){
			//Instancia del modelo datos
			$datos = new Datos();
			//Modelo para obtener los datos de usuarios, excluyendo el de sesion
			return $datos->getUsersModel($_SESSION['usuario']);
		}

		//Metodo para actualizar los datos de un usuario
		public function updateUserController($id){
			//Guardar en varibles la informacion obtenida de un formulario, enviados por el metodo post de la vista editarUsuario.php
			$nombre = $_POST['nombre'];
			$paterno = $_POST['paterno'];
			$materno = $_POST['materno'];
			$email = $_POST['email'];
			$contraseña1 = $_POST['contraseña1'];
			$contraseña2 = $_POST['contraseña2'];

			//Arreglo para indicar las posibles extensiones de las imagenes que se admitiran
			$extensiones = array('image/jpg','image/jpeg','image/png');
			//Indicar el tamaño maximo de la imagen que se permitira subir
			$max = 1024 * 1024 * 8;
			//Variable para guardar la ruta temporal donde se almacena la imagen
			$ruta_origen = $_FILES['imagen']['tmp_name'];
			//variable para guardar la ruta que se desea tener para guardar la imagen
			$ruta_destino = '../media/'.rand(0, 99999999999).$_FILES['imagen']['name'];

			//Se verifica que la imagen subida sea de extension indicada anteriormente, gracias a la variable type
			if(in_array($_FILES['imagen']['type'],$extensiones)){
				//Se verifica que la imagen sea menor al tamañano maximo indicado
				if($_FILES['imagen']['size']<$max){
					//Condicion para saber si se pudo subir la imagen a la ruta deseada
					if(move_uploaded_file($ruta_origen,$ruta_destino)){			
						//Instanciar la clase datos
						$registro = new Datos();
						//Esta condición es para comparar si las contraseñas son correctas
						if($contraseña1==$contraseña2){
							//Condicion para validar que el modelo haya realizado el registro
							if($registro->updateUsuarioModel($nombre,$paterno,$materno,$email,$contraseña1,$ruta_destino,$id)==true){
								//Una alerta por si no se actualizo el usuario
								echo "<script>alert('Usuario actualizado exitosamente!')</script>";	
							}else{
								//Mostrar un alerta para indicar que no se pudo realizar el registro
								echo "<script>alert('No se ha podido editar el usuario')</script>";
							}
						}else{
							//Una alert por si la contraseña no coincida
							echo "<script>alert('Las contraseñas no coinciden')</script>";
						}						
					}
				}else{
					//Una alerta por si el tamaño de la imagen es grande
					echo "<script>alert('Error. Tamaño de la imagen excedido')</script>";
				}
			}else{
				//En caso de que el usuario no haya querido subir una imagen:
				$registro = new Datos();
				$ruta_destino = "imagen";
				//Esta condición es para comparar si las contraseñas son correctas
				if($contraseña1==$contraseña2){
					//Condicion para validar que el modelo haya realizado el update
					if($registro->updateUsuarioModel($nombre,$paterno,$materno,$email,$contraseña1,$ruta_destino,$id)==true){
						//Una alerta por si el usuario actualizo los datos correctamente
						echo "<script>alert('Usuario actualizado exitosamente!')</script>";
					}else{
						//Mostrar un alerta para indicar que no se pudo realizar el update
						echo "<script>alert('No se ha podido editar el usuario')</script>";
					}
				}else{
					//Una alerta para ver si las contraseñas no coincidan
					echo "<script>alert('Las contraseñas no coinciden')</script>";
				}
			}
		}

		//Metodo para registrar un usuarios de la vista agregar 
		public function RegistrarUsuarioController(){
			//Variables para guardar los datos del formulario de registrar un usuario, informacion enviada por el metodo post
			$nombre = $_POST['nombre'];
			$paterno = $_POST['paterno'];
			$materno = $_POST['materno'];
			$email = $_POST['email'];
			$usuario = $_POST['usuario'];
			$contraseña1 = $_POST['contraseña1'];
			$contraseña2 = $_POST['contraseña2'];

			//Arreglo para indicar las posibles extensiones de las imagenes que se admitiran
			$extensiones = array('image/jpg','image/jpeg','image/png');
			//Indicar el tamaño maximo de la imagen que se permitira subir
			$max = 1024 * 1024 * 8;
			//Variable para guardar la ruta temporal donde se almacena la imagen
			$ruta_origen = $_FILES['imagen']['tmp_name'];
			//Variable para guardar la ruta que se desea tener para guardar la imagen
			$ruta_destino = '../media/'.rand(0, 99999999999).$_FILES['imagen']['name'];

			//Se verifica que la imagen subida sea de extension indicada anteriormente, gracias a la variable type
			if(in_array($_FILES['imagen']['type'],$extensiones)){
				//Se verifica que la imagen sea menor al tamañano maximo indicado
				if($_FILES['imagen']['size']<$max){
					//Condicion para saber si se pudo subir la imagen a la ruta deseada
					if(move_uploaded_file($ruta_origen,$ruta_destino)){			
						//Instanciar la clase datos
						$registro = new Datos();
						//Verificar si el usuario no esta registrado
						if($registro->verificarUsuarioModel($usuario)==false){
							//Esta condición es para comparar si las contraseñas son correctas
							if($contraseña1==$contraseña2){
								//Condicion para validar que el modelo haya realizado el registro
								if($registro->RegistrarUsuarioModel($nombre,$paterno,$materno,$email,$usuario,$contraseña1,$ruta_destino)==true){
									echo "<script>alert('Usuario registrado exitosamente!')</script>";	
								}else{
									//Mostrar un alerta para indicar que no se pudo realizar el registro
									echo "<script>alert('No se ha podido registrar el usuario')</script>";
								}
							}else{
								//Una alerta para ver si las contraseñas no coincidan
								echo "<script>alert('Las contraseñas no coinciden')</script>";
							}
						}else{
							//Una alerta por si no se realizo el registro y el usuario existe
							echo "<script>alert('No se pudo realizar el registro. Usuario en uso')</script>";
						}
						
					}
				}else{
					//Una alerta por si el tamaño de la imagen es grande
					echo "<script>alert('Error. Tamaño de la imagen excedido')</script>";
				}
			}else{
				//Instancia del modelo datos
				$registro = new Datos();
				//Imagen que se toma por defecto
				$ruta_destino = '../media/default/default.png';
				//Verificar si el usuario no esta registrado
				if($registro->verificarUsuarioModel($usuario)==false){
					if($contraseña1==$contraseña2){
						//Condicion para validar que el modelo haya realizado el registro
						if($registro->RegistrarUsuarioModel($nombre,$paterno,$materno,$email,$usuario,$contraseña1,$ruta_destino)==true){
							//Una alerta por si el usuario esta registrado
							echo "<script>alert('Usuario registrado exitosamente!')</script>";	
						}else{
							//Mostrar un alerta para indicar que no se pudo realizar el registro
							echo "<script>alert('No se ha podido registrar el usuario')</script>";
						}
					}else{
						//Una alerta para ver si las contraseñas no coincidan
						echo "<script>alert('Las contraseñas no coinciden')</script>";
					}
				}else{
					//Una alerta para que si no se realizo el registro correctamente
					echo "<script>alert('No se pudo realizar el registro. Usuario en uso')</script>";
				}
			}
		}

		//Metodo para obtener la informacion de un usuario
		public function getInfoUserController($id){
			//Instancia del modelo datos
			$userModel = new Datos();
			return $userModel->getInfoUserModel($id);
		}

		//Metodo para obtener la informacion de una categoria
		public function getInfoCategoryController($id){
			//Una instancia de la clase Datos
			$userModel = new Datos();
			//Y retorna la información con el id de la categoria
			return $userModel->getInfoCategoryModel($id);
		}

		//Metodo para obtener la informacion de un producto
		public function getInfoProductoController($id){
			//Instancia del modelo datos
			$userModel = new Datos();
			//Y retorna la información con el id del producto
			return $userModel->getInfoProductoModel($id);
		}

		//Metodo para actualizar la informacion de una categoria
		public function updateCategoryController($id){
			//Almacenar en las variables la informacion del formulario para editar una categoria
			$nombre = $_POST['nombre'];
			$descripcion = $_POST['descripcion'];
			//Una instancia para los datos
			$registro = new Datos();
			//Condición para validar que la categoria haya sido actualizada exitosamente
			if($registro->updateCategoriaModel($nombre,$descripcion,$id)==true){
				//Una alerta para saber si se actualizo la categoria
				echo "<script>alert('Categoria Actualizada')</script>";
			}else{
				//Una alerta para saber si no se actualizo la categoria
				echo "<script>alert('Categoria No Actualizada')</script>";
			}
		}

		//Metodo para actualizar un producto
		public function updateProductoController($id){

			//Variables que contienen la informacion obtenida por el metodo post del formulario de actualizar un producto
			$nombre = $_POST['nombre'];
			$categoria = $_POST['categoria'];
			$precio = $_POST['precio'];

			//Arreglo para indicar las posibles extensiones de las imagenes que se admitiran
			$extensiones = array('image/jpg','image/jpeg','image/png');
			//Indicar el tamaño maximo de la imagen que se permitira subir
			$max = 1024 * 1024 * 8;
			//Variable para guardar la ruta temporal donde se almacena la imagen
			$ruta_origen = $_FILES['imagen']['tmp_name'];
			//Variable para guardar la ruta que se desea tener para guardar la imagen
			$ruta_destino = '../media/'.rand(0, 99999999999).$_FILES['imagen']['name'];

			//Se verifica que la imagen subida sea de extension indicada anteriormente, gracias a la variable type
			if(in_array($_FILES['imagen']['type'],$extensiones)){
				//Se verifica que la imagen sea menor al tamañano maximo indicado
				if($_FILES['imagen']['size']<$max){
					//Condicion para saber si se pudo subir la imagen a la ruta deseada
					if(move_uploaded_file($ruta_origen,$ruta_destino)){			
						//Instanciar la clase datos
						$registro = new Datos();
	
						//Condicion para validar que el modelo haya realizado el registro
						if($registro->updateProductoModel($nombre,$categoria,$precio,$ruta_destino,$id)==true){
							//Regresar un verdadero por si esta actualizado el producto
							return true;	
						}else{
							//Mostrar un alerta para indicar que no se pudo realizar el registro
							echo "<script>alert('No se ha podido editar el producto')</script>";
							return false;
						}
					
					}
				}else{
					//Si la imagen es muy grande se indica al alumno
					echo "<script>alert('Error. Tamaño de la imagen excedido')</script>";
					return false;
				}
			}else{
				//Una instancia para los datos 
				$registro = new Datos();
				//Poner la ruta de la imagen
				$ruta_destino = "imagen";
				//Condicion para validar que el modelo haya realizado el registro
				if($registro->updateProductoModel($nombre,$categoria,$precio,$ruta_destino,$id)==true){
					//Regresar un verdadero por si esta actualizado el producto
					return true;
				}else{
					//Mostrar un alerta para indicar que no se pudo realizar el registro
					echo "<script>alert('No se ha podido editar el producto')</script>";
					return false;
				}
			}
		}

		//Metodo para borrar una categoria
		public function deleteCategoriaController($id){
			//Inicia una instancia de los datos
			$deleteUser = new Datos();
			//Devuelve la categoria que se van a eliminar mediante el id
			return $deleteUser->deleteCategoriaModel($id);
		}

		//Metodo para borrar un usuario
		public function deleteUserController($id){
			//Inicia una instancia de los datos
			$deleteUser = new Datos();
			//Devuelve la categoria que se van a eliminar mediante el id
			return $deleteUser->deleteUserModel($id);
		}

		//Metodo para borrar un producto
		public function deleteProductoController($id){
			//Inicia una instancia de los datos
			$deleteUser = new Datos();
			//Devuelve la categoria que se van a eliminar mediante el id
			return $deleteUser->deleteProductoModel($id);
		}

		//Metodo para agregar una categoria
		public function agregarCategoria(){
			//Almacenar en las variables la informacion obtenida mediante el metodo post desde el formulario para registrar una categoria
			if(isset($_POST['nombre'])){
				$nombre=$_POST['nombre'];
				$descripcion=$_POST['descripcion'];
				$datos= array('nombre_categoria' =>$nombre,
							  'descripcion_categoria' =>$descripcion );
				//Instancia del modelo datos
				$r = new Datos();
				//Se envia la informacion al modelo
				$respuesta= $r->agregarCategoriaModel($datos);
				if($respuesta){
					//Una alerta para saber si el usuario registro la categoria correctamente
					echo "<script>alert('Categoria se agrego exitosamente!')</script>";
				}else{
					//Una alerta para saber si la categoria no se agrego
					echo "<script>alert('Categoria no se agrego exitosamente!')</script>";
				}
			}
		}

		//Metodo para que se registre en el historial cuando se añaden productos de un determinado producto, dependiendo del id
		public function HistorialAddController($id){
			//Instancia del modelo datos
			$add = new Datos();
			//Enviar los datos de id y cantidad de productos para añadir
			$add->HistorialAdd($id,$_POST['cantidad']);
			//Devuelve el historial donde se envio los datos de la sesion del id del usuario,un espacio en blanco donde la observación no conlleva, la referencia, la cantidad que va agregar y la acción que es la de sumar productos.
			return $add->HistorialModel($id,$_SESSION['id']," ",$_POST['referencia'],$_POST['cantidad'],"sumar");
		}

		//Metodo para que se registre en el historial cuando se quitan productos de un determinado producto, dependiendo del id
		public function HistorialRemoveController($id){
			//Instancia del modelo datos
			$add = new Datos();
			//Enviar los datos de id y cantidad de productos para quitar
			$add->HistorialRemove($id,$_POST['cantidad']);
			//Devuelve el historial donde se envio los datos de la sesion del id del usuario,la observación por algún de defecto, caducidad,etc., la referencia, la cantidad de producto que se quito y la acción que se va hacer que es restar productos
			return $add->HistorialModel($id,$_SESSION['id'],$_POST['observacion'],$_POST['referencia'],$_POST['cantidad'],"quitar");
		}

		//Metodo para obtener el historial de un producto
		public function getHistorialController($producto){
			//Instancia para el modelo de datos
			$historial = new Datos();
			//Retorna el historial del producto
			return $historial->getHistorialModel($producto);
		}

		//Metodo para agregar productos
		public function AddStockController(){
			//Informacion obtenida del formulario del registrar producto y que es enviada por el metodo post
			$codigo = $_POST['codigo'];
			$nombre = $_POST['nombre'];
			$precio = $_POST['precio'];
			$stock = $_POST['stock'];
			$categoria = $_POST['categoria'];

			//Arreglo para indicar las posibles extensiones de las imagenes que se admitiran
			$extensiones = array('image/jpg','image/jpeg','image/png');
			//Indicar el tamaño maximo de la imagen que se permitira subir
			$max = 1024 * 1024 * 8;
			//Variable para guardar la ruta temporal donde se almacena la imagen
			$ruta_origen = $_FILES['imagen']['tmp_name'];
			//Variable para guardar la ruta que se desea tener para guardar la imagen
			$ruta_destino = '../media/'.rand(0, 99999999999).$_FILES['imagen']['name'];

			//Se verifica que la imagen subida sea de extension indicada anteriormente, gracias a la variable type
			if(in_array($_FILES['imagen']['type'],$extensiones)){
				//Se verifica que la imagen sea menor al tamañano maximo indicado
				if($_FILES['imagen']['size']<$max){
					//Condicion para saber si se pudo subir la imagen a la ruta deseada
					if(move_uploaded_file($ruta_origen,$ruta_destino)){			
						//Innstanciar la clase datos
						$registro = new Datos();
						//Verificar si el codigo del producto no aparece en la base de datos
						if($registro->verificarCodigoModel($codigo)==false){
							
							//Condicion para validar que el modelo haya realizado el registro
							if($registro->RegistrarProductoModel($codigo,$nombre,$precio,$stock,$categoria,$ruta_destino)==true){
								//Envia los datos del codigo de la vista anadirProductos
								$id_producto = $registro->ProductModel($codigo);
								//Se crea el historial del producto
								$registro->HistorialModel($id_producto['id'],$_SESSION['id'],"Alta de Producto",$codigo,$stock,"inicial");
								//Una alerta para indicar que el producto esta registrado
								echo "<script>alert('Producto registrado exitosamente!')</script>";	
							}else{
								//Mostrar un alerta para indicar que no se pudo realizar el registro
								echo "<script>alert('No se ha podido registrar el producto')</script>";
							}
						
						}else{
							//Una alerta donde que el producto ya es existente
							echo "<script>alert('No se pudo realizar el registro. Ya existe un producto con ese codigo')</script>";
						}
						
					}
				}else{
					//Si la imagen es muy grande se indica al alumno
					echo "<script>alert('Error. Tamaño de la imagen excedido')</script>";
				}
			}else{
				//En caso de que no se cargue una foto para el producto:
				//Instancia del modelo datos
				$registro = new Datos();
				//Mandar llamar la ruta de la imagen para el producto
				$ruta_destino = '../media/default/default_product.jpg';
				//Verificar si el codigo del producto no aparece en la base de datos
				if($registro->verificarCodigoModel($codigo)==false){
					//Condicion para validar que el modelo haya realizado el registro
					if($registro->RegistrarProductoModel($codigo,$nombre,$precio,$stock,$categoria,$ruta_destino)==true){
						//Envia los datos del codigo de la vista anadirProductos
						$id_producto = $registro->ProductModel($codigo);
						//Se crea el historial del producto
						$registro->HistorialModel($id_producto['id'],$_SESSION['id'],"Alta de Producto",$codigo,$stock,"inicial");
						//Una alerta para indicar que el producto esta registrado
						echo "<script>alert('Producto registrado exitosamente!')</script>";	
					}else{
						//Mostrar un alerta para indicar que no se pudo realizar el registro
						echo "<script>alert('No se ha podido registrar el producto')</script>";
					}
				
				}else{
					////Una alerta para indicar que el producto ya existe
					echo "<script>alert('No se pudo realizar el registro. Ya existe un producto con ese codigo')</script>";
				}
			}
		}
	}
?>