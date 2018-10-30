<?php  
	//Se requiere el archivo que contiene nuestra conexion por PDO
	require_once "conexion.php";

	//Clase datos que hereda de la clase de conexion
	class Datos extends Conexion{

		//Metodo para verificar si el usuario que desea iniciar sesion  esta registrado
		public function Iniciar_Sesion($usuario,$contraseña){
			//Consulta para seleccionar la tabla usuarios
			$sql = "SELECT * FROM usuarios WHERE nombre_usuario = ? and password = ?";
			//Se prepara la consulta
			$stmt = Conexion::conectar()->prepare($sql);
			//Se ejecuta la consulta
			$stmt->execute(array($usuario,$contraseña));
			$r = $stmt->fetch();
			//Una condicion para que devuelva la respuesta o un array vacio
			if($r){
				return $r;
			}else{
				return [];
			}
		}

		//Metodo para obtener toda la informacion de una tabla
		public function getAllModel($tabla){
			//Consulta para seleccionar la tabla
			$sql = "SELECT * FROM $tabla";
			//Se prepara la consulta
			$stmt = Conexion::conectar()->prepare($sql);
			//Se executa la consulta
			$stmt->execute();
			//Se asocian los registros a $r
			$r = $stmt->fetchAll();
			//Una condicion para que devuelva la respuesta o un array vacio
			if($r){
				return $r;
			}else{
				return [];
			}
		}

		//Metodo para obtener la informacion de un usuario
		public function getInfoUserModel($id){
			//Consulta, que tiene la clausula where para obtener solo registros del usuario con el id especifico
			$sql = "SELECT * FROM usuarios WHERE id = ?";
			//Se prepara la consulta
			$stmt = Conexion::conectar()->prepare($sql);
			//Se ejecuta la consulta
			$stmt->execute(array($id));
			//Se asocian los registros a $r
			$r = $stmt->fetch();
			//Una condicion para que devuelva la respuesta o un array vacio
			if($r){
				return $r;
			}else{
				return [];
			}
		}

		//Metodo para obtener los usuarios menos uno en especifico
		public function getUsersModel($usuario){
			//Consulta para obtner los usuarios menos el que tiene como parametro de entrada el metodo
			$sql = "SELECT * FROM usuarios WHERE nombre_usuario != ?";
			//Se prepara la consulta
			$stmt = Conexion::conectar()->prepare($sql);
			//Se executa la consulta
			$stmt->execute(array($usuario));
			//Se asocian los registros a r
			$r = $stmt->fetchAll();
			//Una condicion para que devuelva la respuesta o un array vacio
			if($r){
				return $r;
			}else{
				return [];
			}
		}

		//Metodo para verificar que un usuario no se repita
		public function verificarUsuarioModel($usuario){
			//Consulta para verificar que el usuario no se repita en la tabla
			$sql = "SELECT * FROM usuarios WHERE nombre_usuario = ?";
			// Se prepara la consulta
			$stmt = Conexion::conectar()->prepare($sql);
			//Se executa la consulta
			$stmt->execute(array($usuario));
			//Se asocian los registros a $r
			$r = $stmt->fetch();
			//Una condicion para que devuelva la respuesta
			if($r){
				return true;
			}else{
				return false;
			}
		}

		//Metodo para actualizar la informacion de un usuario
		public function updateUsuarioModel($nombre,$paterno,$materno,$email,$contraseña,$imagen,$id){
			//Si el usario no ingreso una imagen :
			if($imagen=="imagen"){
				//Consulta para actualizar los datos del usuario
				$sql = "UPDATE usuarios SET nombre = :nombre, paterno = :paterno, materno = :materno, correo = :email, password = :password WHERE id = :id";
				//Se prepara la sentencia
				$stmt = Conexion::conectar()->prepare($sql);
				//Se manda los parametros del metodo a la sentencia a ejecutar del usuario
				$stmt->bindParam(":nombre",$nombre);
				$stmt->bindParam(":paterno",$paterno);
				$stmt->bindParam(":materno",$materno);
				$stmt->bindParam(":email",$email);
				$stmt->bindParam(":password",$contraseña);
				$stmt->bindParam(":id",$id);
			}else{
				//Si el usuario ingreso una imagen una consulta para poder actualizarla
				$sql = "UPDATE usuarios SET nombre = :nombre, paterno = :paterno, materno = :materno, correo = :email, password = :password, ruta_img = :imagen WHERE id = :id";
				//Se prepara la consulta
				$stmt = Conexion::conectar()->prepare($sql);
				//Se mandan los parametros del metodo a la sentencia a ejecutar del usuario
				$stmt->bindParam(":nombre",$nombre);
				$stmt->bindParam(":paterno",$paterno);
				$stmt->bindParam(":materno",$materno);
				$stmt->bindParam(":email",$email);
				$stmt->bindParam(":password",$contraseña);
				$stmt->bindParam(":imagen",$imagen);
				$stmt->bindParam(":id",$id);
			}

			//Una condicion para ejecutar la sentencia y saber si el usuario se actualizo o no
			if($stmt->execute()){
				//Se actualizo
				return true;
			}else{
				//No se actualizo
				return false;
			}
		}

		//Metodo para actualizar un producto
		public function updateProductoModel($nombre,$categoria,$precio,$imagen,$id){
			//Si no se ingreso una imagen
			if($imagen=="imagen"){
				//Consulta para actualizar los datos del producto
				$sql = "UPDATE productos SET nombre = :nombre, categoria = :categoria, precio = :precio WHERE id = :id";
				//Se prepara la sentencia
				$stmt = Conexion::conectar()->prepare($sql);
				//Se mandan los parametros del metodo a la sentencia update
				$stmt->bindParam(":nombre",$nombre);
				$stmt->bindParam(":categoria",$categoria);
				$stmt->bindParam(":precio",$precio);
				$stmt->bindParam(":id",$id);
			}else{
				//si se ingreso una imagen 
				$sql = "UPDATE productos SET nombre = :nombre, categoria = :categoria, precio = :precio, ruta_img = :imagen WHERE id = :id";
				//se prepara la sentencia update
				$stmt = Conexion::conectar()->prepare($sql);
				//Se mandan los parametros del metodo a la sentencia a ejecutar del producto
				$stmt->bindParam(":nombre",$nombre);
				$stmt->bindParam(":categoria",$categoria);
				$stmt->bindParam(":precio",$precio);
				$stmt->bindParam(":imagen",$imagen);
				$stmt->bindParam(":id",$id);
			}

			//Una condicion para ejecutar la sentencia y saber si el usuario se actualizo o no
			if($stmt->execute()){
				//Se actualizo
				return true;
			}else{
				//No se actualizo
				return false;
			}
		}

		//Metodo para registrar un usuario 
		public function RegistrarUsuarioModel($nombre,$paterno,$materno,$email,$usuario,$contraseña,$imagen){
			//Consulta para poder insertar el usuario
			$sql = "INSERT INTO usuarios (nombre,paterno,materno,nombre_usuario,password,correo,fecha_registro,ruta_img) VALUES (?,?,?,?,?,?,CURDATE(),?)";

			//Se prepara la sentencia
			$stmt = Conexion::conectar()->prepare($sql);

			//Esta condición es para ejecutar la sentencia mandando un arreglo de los datos del usuario y si se agrego o no
			if($stmt->execute(array($nombre,$paterno,$materno,$usuario,$contraseña,$email,$imagen))){
				//Se agrego usuario
				return true;
			}else{
				//No se agrego usuario
				return false;
			}
		}

		//Metodo para verificar que el codigo de un producto no se repita
		public function verificarCodigoModel($codigo){
			//Sentencia para buscar el codigo en la tabla productos
			$sql = "SELECT * FROM productos WHERE codigo = ?";
			//Se prepara la sentencia
			$stmt = Conexion::conectar()->prepare($sql);
			//Se ejecuta la sentencia, mandando como parametro el codigo del producto que no se desea que se repita
			$stmt->execute(array($codigo));
			//Se asocia los registros encontrados
			$r = $stmt->fetch();
			//Una condición para ver si el codigo se repite o no
			if($r){
				//Se repite el codigo
				return true;
			}else{
				//No se repite el codigo
				return false;
			}
		}

		//Metodo para registrar un producto
		public function RegistrarProductoModel($codigo,$nombre,$precio,$stock,$categoria,$imagen){
			//Consulta para insertar un producto en la tabla productos
			$sql = "INSERT INTO productos (codigo,nombre,fecha_agregado,precio,stock,categoria,ruta_img) VALUES (?,?,CURDATE(),?,?,?,?)";
			//Se prepara la sentencia
			$stmt = Conexion::conectar()->prepare($sql);
			//Esta condición es para ejecutar la sentencia mandando un arreglo de los datos del producto y si se agrego o no
			if($stmt->execute(array($codigo,$nombre,$precio,$stock,$categoria,$imagen))){
				//Se agrego producto
				return true;
			}else{
				//No se agrego producto
				return false;
			}
		}

		//Metodo para obtener la informacion de una categoria
		public function getInfoCategoryModel($id){
			//Consulta para conseguir el idde la categoria de la tabla categorias
			$sql = "SELECT * FROM categorias WHERE id = ?";
			//se prepara la consulta
			$stmt = Conexion::conectar()->prepare($sql);
			//Se executa
			$stmt->execute(array($id));
			//Se asocia los registros de la categoria
			$r = $stmt->fetch();
			//Una condicion para que devuelva la respuesta o un array vacio
			if($r){
				return $r;
			}else{
				return [];
			}
		}

		//metodo para obtner la infromacion de un producto
		public function getInfoProductoModel($id){
			//Consulta para conseguir el idde el producto de la tabla productos
			$sql = "SELECT * FROM productos WHERE id = ?";
			//Se prepara la consutla
			$stmt = Conexion::conectar()->prepare($sql);
			//Se ejecuta la consulta
			$stmt->execute(array($id));
			//Se asocia la consulta
			$r = $stmt->fetch();
			//Una condicion para que devuelva la respuesta o un array vacio
			if($r){
				return $r;
			}else{
				return [];
			}
		}

		//Metodo para agregar una categoria
		public function agregarCategoriaModel($datos){
			//Una consulta para agregar las categorias y la prepara antes de enviar los parametros
			$stmt = Conexion::conectar()->prepare("INSERT INTO categorias (nombre,descripcion,fecha_agregado) VALUES (:nombre,:descripcion,CURDATE())");
			//Se mandan los parametros necesarios para el registro
			$stmt->bindParam(":nombre", $datos["nombre_categoria"] , PDO::PARAM_STR);
			$stmt->bindParam(":descripcion",$datos["descripcion_categoria"],PDO::PARAM_STR);
			//Se ejecuta la consulta de agregar categoria
			return $stmt->execute();
		}

		//Metodo para actualizar una categoria
		public function updateCategoriaModel($nombre,$descripcion,$id){
			//Una consulta para poder actualizar los datos de la categoria que se quiere actualizar
			$sql = "UPDATE categorias SET nombre = :nombre, descripcion = :descripcion WHERE id = :id";
			//Se prepara la sentencia
			$stmt = Conexion::conectar()->prepare($sql);
			//Se mandan los parametros a las sentencia
			$stmt->bindParam(":nombre",$nombre);
			$stmt->bindParam(":descripcion",$descripcion);
			$stmt->bindParam(":id",$id);
			//Se ejecuta la consulta para verificar si la categoria se actualizo correcatemento o no
			if($stmt->execute()){
				//Se actualiza la categoria
				return true;
			}else{
				//No se actualiza la categoria
				return false;
			}

		}

		//Metodo para insertar un registro al historial de los productos
		public function HistorialModel($producto,$usuario,$nota,$referencia,$cantidad,$tipo){
			//Una consulta para poder agregar los historiales del producto
			$sql = "INSERT INTO historiales (producto,usuario,fecha,hora,nota,referencia,cantidad,tipo_registro) VALUES (?,?,CURDATE(),CURTIME(),?,?,?,?)";
			//Se prepara la sentencia
			$stmt= Conexion::conectar()->prepare($sql);
			//Esta condición es para ejecutar la sentencia mandando un arreglo de los datos del producto para agregar al historial y si se agrego o no
			if($stmt->execute(array($producto,$usuario,$nota,$referencia,$cantidad,$tipo))){
				//Se agrega el historial
				return true;
			}else{
				//No se agrega el historial
				return false;
			}
		}

		//Metodo para actualizar el stock de un producto añadiendo una determinada cantidad
		public function HistorialAdd($id,$cantidad){
			//Consulta para poder actualizar y añadir la cantidad de productos del stock
			$sql = "UPDATE productos SET stock = stock + ? WHERE id = ?";
			//Se prepara la sentencia
			$stmt = Conexion::conectar()->prepare($sql);
			//Se executa la sentencia
			$stmt->execute(array($cantidad,$id));
		}

		//Metodo para actualizar el stock de un producto quitandole una determinada cantidad
		public function HistorialRemove($id,$cantidad){
			///Consulta para poder quitar y añadir la cantidad de productos del stock
			$sql = "UPDATE productos SET stock = stock - ? WHERE id = ?";
			//Se prepara la consulta
			$stmt = Conexion::conectar()->prepare($sql);
			//Se executa la sentencia
			$stmt->execute(array($cantidad,$id));
		}

		//Metodo para obtener la informacion de un producto
		public function ProductModel($codigo){
			//Consulta para poder llamar los productos por codigo
			$sql = "SELECT * FROM productos WHERE codigo = ?";
			//Se prepara la sentencia
			$stmt = Conexion::conectar()->prepare($sql);
			//Se ejecuta la sentencia
			$stmt->execute(array($codigo));
			//Se asocia la consulta
			$r = $stmt->fetch();
			//Una condicion para que devuelva la respuesta o un array vacio
			if($r){
				return $r;
			}else{
				return [];
			}
		}

		//Metodo para borrar un usuario especifico
		public function deleteUserModel($id){
			//Una consulta para poder eliminar el usuario mediante el id
			$sql = "DELETE FROM usuarios WHERE id = ?";
			//Se prepara la sentencia
			$stmt = Conexion::conectar()->prepare($sql);
			//Esta condición es para ejecutar la sentencia mandando un arreglo de los datos del usuario para saber si se elimino o no
			if($stmt->execute(array($id))){
				//Usuario eliminado
				return true;
			}else{
				//Usuario no eliminado
				return false;
			}
		}

		//Metodo para borrar una categoria especifica
		public function deleteCategoriaModel($id){
			//Una consulta para poder eliminar la categoria mediante el id
			$sql = "DELETE FROM categorias WHERE id = ?";
			//Se prepara la sentencia
			$stmt = Conexion::conectar()->prepare($sql);
			//Esta condición es para ejecutar la sentencia mandando un arreglo de los datos de la categoria para saber si se elimino o no
			if($stmt->execute(array($id))){
				//Categoria eliminada
				return true;
			}else{
				//Categoria no eliminada
				return false;
			}
		}

		//Metodo para borrar una producto especifica
		public function deleteProductoModel($id){
			//Una consulta para poder eliminar el producto mediante el id
			$sql = "DELETE FROM productos WHERE id = ?";
			//Se prepara la sentencia
			$stmt = Conexion::conectar()->prepare($sql);
			//Se ejecuta la sentencia
			if($stmt->execute(array($id))){
				//Producto eliminado
				return true;
			}else{
				//Producto no eliminado
				return false;
			}
		}

		//Metodo para obtener el historial de un producto
		public function getHistorialModel($producto){
			//Una consulta para conseguir el historial del producto
			$sql = "SELECT * FROM historiales WHERE producto = ?";
			//Se prepara la sentencia
			$stmt = Conexion::conectar()->prepare($sql);
			//Se ejecuta la sentencia
			$stmt->execute(array($producto));
			$r = $stmt->fetchAll();
			//Una condicion para que devuelva la respuesta o un array vacio
			if($r){
				return $r;
			}else{
				return [];
			}			
		}

	}
?>