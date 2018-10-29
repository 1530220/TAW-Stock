<?php  
	//se requiere el archivo que contiene nuestra conexion por PDO
	require_once "conexion.php";

	//clase datos que hereda de la clase de conexion
	class Datos extends Conexion{

		//metodo para verificar si el usuario que desea iniciar sesion  esta registrado
		public function Iniciar_Sesion($usuario,$contraseña){
			//consulta en la tabla usuarios
			$sql = "SELECT * FROM usuarios WHERE nombre_usuario = ? and password = ?";
			//se prepara la consulta
			$stmt = Conexion::conectar()->prepare($sql);
			//se ejecuta la consulta
			$stmt->execute(array($usuario,$contraseña));
			$r = $stmt->fetch();

			if($r){
				return $r;
			}else{
				return [];
			}
		}

		//metodo para obtener toda la informacion de una tabla
		public function getAllModel($tabla){
			//consulta
			$sql = "SELECT * FROM $tabla";
			//se prepara la consulta
			$stmt = Conexion::conectar()->prepare($sql);
			//se executa la consulta
			$stmt->execute();
			//se asocian los registros a $r
			$r = $stmt->fetchAll();
			if($r){
				//retornan los registros
				return $r;
			}else{
				return [];
			}
		}

		//metodo para obtener la informacion de un usuario
		public function getInfoUserModel($id){
			//consulta, que tiene la clausula where para obtener solo registros del usuario con el id especifico
			$sql = "SELECT * FROM usuarios WHERE id = ?";
			//se prepara la consulta
			$stmt = Conexion::conectar()->prepare($sql);
			//se ejecuta la consulta
			$stmt->execute(array($id));
			//se asocian los registros a $r
			$r = $stmt->fetch();

			if($r){
				return $r;
			}else{
				return [];
			}
		}

		//metodo para obtener los usuarios menos uno en especifico
		public function getUsersModel($usuario){
			//consulta para obtner los usuarios menos el que tiene como parametro de entrada el metodo
			$sql = "SELECT * FROM usuarios WHERE nombre_usuario != ?";
			//se prepara la consulta
			$stmt = Conexion::conectar()->prepare($sql);
			//se executa la consulta
			$stmt->execute(array($usuario));
			//se asocian los registros a r
			$r = $stmt->fetchAll();
			if($r){
				//retornan los registros
				return $r;
			}else{
				return [];
			}
		}

		//metodo para verificar que un usuario no se repita
		public function verificarUsuarioModel($usuario){
			//consulta
			$sql = "SELECT * FROM usuarios WHERE nombre_usuario = ?";
			// se prepara la consulta
			$stmt = Conexion::conectar()->prepare($sql);
			//se executa la consulta
			$stmt->execute(array($usuario));
			//se asocian los registros a $r
			$r = $stmt->fetch();
			if($r){
				return true;
			}else{
				return false;
			}
		}

		//metodo para actualizar la informacion de un usuario
		public function updateUsuarioModel($nombre,$paterno,$materno,$email,$contraseña,$imagen,$id){
			//si el usario no ingreso una imagen :
			if($imagen=="imagen"){
				//update
				$sql = "UPDATE usuarios SET nombre = :nombre, paterno = :paterno, materno = :materno, correo = :email, password = :password WHERE id = :id";
				//se prepara la sentencia
				$stmt = Conexion::conectar()->prepare($sql);
				//se manda los parametros del metodo a la sentencia a ejecutar
				$stmt->bindParam(":nombre",$nombre);
				$stmt->bindParam(":paterno",$paterno);
				$stmt->bindParam(":materno",$materno);
				$stmt->bindParam(":email",$email);
				$stmt->bindParam(":password",$contraseña);
				$stmt->bindParam(":id",$id);
			}else{
				//si el usuario ingreso una imagen para actualizar
				$sql = "UPDATE usuarios SET nombre = :nombre, paterno = :paterno, materno = :materno, correo = :email, password = :password, ruta_img = :imagen WHERE id = :id";
				//se prepara la consulta
				$stmt = Conexion::conectar()->prepare($sql);
				//se mandan los parametros del metodo a la sentencia a ejecutar
				$stmt->bindParam(":nombre",$nombre);
				$stmt->bindParam(":paterno",$paterno);
				$stmt->bindParam(":materno",$materno);
				$stmt->bindParam(":email",$email);
				$stmt->bindParam(":password",$contraseña);
				$stmt->bindParam(":imagen",$imagen);
				$stmt->bindParam(":id",$id);
			}

			//se ejecuta
			if($stmt->execute()){
				//exitosamente
				return true;
			}else{
				//fallo 
				return false;
			}
		}

		//metodo para actualizar un producto
		public function updateProductoModel($nombre,$categoria,$precio,$imagen,$id){
			//si no se ingreso una imagen
			if($imagen=="imagen"){
				//sentencia update
				$sql = "UPDATE productos SET nombre = :nombre, categoria = :categoria, precio = :precio WHERE id = :id";
				//se prepara la sentencia
				$stmt = Conexion::conectar()->prepare($sql);
				//se mandan los parametros del metodo a la sentencia update
				$stmt->bindParam(":nombre",$nombre);
				$stmt->bindParam(":categoria",$categoria);
				$stmt->bindParam(":precio",$precio);
				$stmt->bindParam(":id",$id);
			}else{
				//si se ingreso una imagen 
				$sql = "UPDATE productos SET nombre = :nombre, categoria = :categoria, precio = :precio, ruta_img = :imagen WHERE id = :id";
				//se prepara la sentencia update
				$stmt = Conexion::conectar()->prepare($sql);
				//se mandan los parametros del metodo a la sentencia update
				$stmt->bindParam(":nombre",$nombre);
				$stmt->bindParam(":categoria",$categoria);
				$stmt->bindParam(":precio",$precio);
				$stmt->bindParam(":imagen",$imagen);
				$stmt->bindParam(":id",$id);
			}

			//se ejecuta el update
			if($stmt->execute()){
				//exitoso
				return true;
			}else{
				//fallo
				return false;
			}
		}

		//metodo para registrar un usuario 
		public function RegistrarUsuarioModel($nombre,$paterno,$materno,$email,$usuario,$contraseña,$imagen){
			//sentencia insert
			$sql = "INSERT INTO usuarios (nombre,paterno,materno,nombre_usuario,password,correo,fecha_registro,ruta_img) VALUES (?,?,?,?,?,?,CURDATE(),?)";

			//se prepara la sentencia
			$stmt = Conexion::conectar()->prepare($sql);

			//se ejecuta
			if($stmt->execute(array($nombre,$paterno,$materno,$usuario,$contraseña,$email,$imagen))){
				//exitosamente
				return true;
			}else{
				//fallo
				return false;
			}
		}

		//metodo para verificar que el codigo de un producto no se repita
		public function verificarCodigoModel($codigo){
			//sentencia para buscar el codigo en la tabla productos
			$sql = "SELECT * FROM productos WHERE codigo = ?";
			//se prepara la sentencia
			$stmt = Conexion::conectar()->prepare($sql);
			//se ejecuta la sentencia, mandando como parametro el codigo del producto que no se desea que se repita
			$stmt->execute(array($codigo));
			//se asocia lo encontrado
			$r = $stmt->fetch();
			if($r){
				//se repite el codigo
				return true;
			}else{
				//no se repite el codigo
				return false;
			}
		}

		//metodo para registrar un producto
		public function RegistrarProductoModel($codigo,$nombre,$precio,$stock,$categoria,$imagen){
			//sentencia para insertar un producto en la tabla productos
			$sql = "INSERT INTO productos (codigo,nombre,fecha_agregado,precio,stock,categoria,ruta_img) VALUES (?,?,CURDATE(),?,?,?,?)";
			//se prepara la sentencia
			$stmt = Conexion::conectar()->prepare($sql);
			//se ejecuta la sentencia insert
			if($stmt->execute(array($codigo,$nombre,$precio,$stock,$categoria,$imagen))){
				//exitosamente
				return true;
			}else{
				//fallo
				return false;
			}
		}

		//metodo para obtener la informacion de una categoria
		public function getInfoCategoryModel($id){
			//consulta
			$sql = "SELECT * FROM categorias WHERE id = ?";
			//se prepara la consulta
			$stmt = Conexion::conectar()->prepare($sql);
			//se executa
			$stmt->execute(array($id));
			$r = $stmt->fetch();
			if($r){
				return $r;
			}else{
				return [];
			}
		}

		//metodo para obtner la infromacion de un producto
		public function getInfoProductoModel($id){
			//consulta por el id
			$sql = "SELECT * FROM productos WHERE id = ?";
			//se prepara la consutla
			$stmt = Conexion::conectar()->prepare($sql);
			//se ejecuta la consulta
			$stmt->execute(array($id));
			//se asocia la consulta
			$r = $stmt->fetch();

			if($r){
				return $r;
			}else{
				return [];
			}
		}

		//metodo para agregar una categoria
		public function agregarCategoriaModel($datos){
			//se prepara la consulta insert
			$stmt = Conexion::conectar()->prepare("INSERT INTO categorias (nombre,descripcion,fecha_agregado) VALUES (:nombre,:descripcion,CURDATE())");
			//se mandan los parametros necesarios para el registro
			$stmt->bindParam(":nombre", $datos["nombre_categoria"] , PDO::PARAM_STR);
			$stmt->bindParam(":descripcion",$datos["descripcion_categoria"],PDO::PARAM_STR);
			//se ejecuta el insert 
			return $stmt->execute();
		}

		//metodo para actualizar una categoria
		public function updateCategoriaModel($nombre,$descripcion,$id){
			//sentancia update
			$sql = "UPDATE categorias SET nombre = :nombre, descripcion = :descripcion WHERE id = :id";
			//se prepara la sentencia
			$stmt = Conexion::conectar()->prepare($sql);
			//se mandan los parametros a las sentencia
			$stmt->bindParam(":nombre",$nombre);
			$stmt->bindParam(":descripcion",$descripcion);
			$stmt->bindParam(":id",$id);
			//se ejecuta la actualizacion
			if($stmt->execute()){
				//exitosamente
				return true;
			}else{
				//fallo
				return false;
			}

		}

		//metodo para insertar un registro al historial de los productos
		public function HistorialModel($producto,$usuario,$nota,$referencia,$cantidad,$tipo){
			//sentencia insert
			$sql = "INSERT INTO historiales (producto,usuario,fecha,hora,nota,referencia,cantidad,tipo_registro) VALUES (?,?,CURDATE(),CURTIME(),?,?,?,?)";
			//se prepara la sentencia
			$stmt= Conexion::conectar()->prepare($sql);
			//se ejecuta la sentencia insert
			if($stmt->execute(array($producto,$usuario,$nota,$referencia,$cantidad,$tipo))){
				return true;
			}else{
				return false;
			}
		}

		//metodo para actualizar el stock de un producto añadiendo una determinada cantidad
		public function HistorialAdd($id,$cantidad){
			//sentencia update
			$sql = "UPDATE productos SET stock = stock + ? WHERE id = ?";
			//se prepara la sentencia
			$stmt = Conexion::conectar()->prepare($sql);
			//se executa la sentencia
			$stmt->execute(array($cantidad,$id));
		}

		//metodo para actualizar el stock de un producto quitandole una determinada cantidad
		public function HistorialRemove($id,$cantidad){
			//sentencia update
			$sql = "UPDATE productos SET stock = stock - ? WHERE id = ?";
			$stmt = Conexion::conectar()->prepare($sql);
			//se executa la sentencia
			$stmt->execute(array($cantidad,$id));
		}

		//metodo para obtener la informacion de un producto
		public function ProductModel($codigo){
			//sentencia
			$sql = "SELECT * FROM productos WHERE codigo = ?";
			//se prepara la sentencia
			$stmt = Conexion::conectar()->prepare($sql);
			//se ejecuta la sentencia
			$stmt->execute(array($codigo));
			$r = $stmt->fetch();
			if($r){
				return $r;
			}else{
				return [];
			}
		}

		//metodo para borrar un usuario especifico
		public function deleteUserModel($id){
			$sql = "DELETE FROM usuarios WHERE id = ?";
			//se prepara la sentencia
			$stmt = Conexion::conectar()->prepare($sql);
			//se ejecuta la sentencia
			if($stmt->execute(array($id))){
				return true;
			}else{
				return false;
			}
		}

		//metodo para borrar una categoria especifica
		public function deleteCategoriaModel($id){
			//sentencia delete
			$sql = "DELETE FROM categorias WHERE id = ?";
			//se prepara la sentencia
			$stmt = Conexion::conectar()->prepare($sql);
			//se ejecuta la sentencia
			if($stmt->execute(array($id))){
				return true;
			}else{
				return false;
			}
		}

		//metodo para borrar una producto especifica
		public function deleteProductoModel($id){
			//sentencia delete
			$sql = "DELETE FROM productos WHERE id = ?";
			//se prepara la sentencia
			$stmt = Conexion::conectar()->prepare($sql);
			//se ejecuta la sentencia
			if($stmt->execute(array($id))){
				return true;
			}else{
				return false;
			}
		}

		//metodo para obtener el historial de un producto
		public function getHistorialModel($producto){
			$sql = "SELECT * FROM historiales WHERE producto = ?";
			//se prepara la sentencia
			$stmt = Conexion::conectar()->prepare($sql);
			//se ejecuta la sentencia
			$stmt->execute(array($producto));
			$r = $stmt->fetchAll();

			if($r){
				return $r;
			}else{
				return [];
			}			
		}

	}
?>