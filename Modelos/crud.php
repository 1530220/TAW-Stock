<?php  
	require_once "conexion.php";

	class Datos extends Conexion{

		public function Iniciar_Sesion($usuario,$contraseña){
			$sql = "SELECT * FROM usuarios WHERE nombre_usuario = ? and password = ?";

			$stmt = Conexion::conectar()->prepare($sql);
			$stmt->execute(array($usuario,$contraseña));
			$r = $stmt->fetch();

			if($r){
				return $r;
			}else{
				return [];
			}
		}

		public function getAllModel($tabla){
			$sql = "SELECT * FROM $tabla";

			$stmt = Conexion::conectar()->prepare($sql);
			$stmt->execute();
			$r = $stmt->fetchAll();
			if($r){
				return $r;
			}else{
				return [];
			}
		}
		public function getInfoUserModel($id){
			$sql = "SELECT * FROM usuarios WHERE id = ?";

			$stmt = Conexion::conectar()->prepare($sql);
			$stmt->execute(array($id));
			$r = $stmt->fetch();

			if($r){
				return $r;
			}else{
				return [];
			}
		}

		public function getUsersModel($usuario){
			$sql = "SELECT * FROM usuarios WHERE nombre_usuario != ?";
			$stmt = Conexion::conectar()->prepare($sql);
			$stmt->execute(array($usuario));
			$r = $stmt->fetchAll();
			if($r){
				return $r;
			}else{
				return [];
			}
		}

		public function verificarUsuarioModel($usuario){
			$sql = "SELECT * FROM usuarios WHERE nombre_usuario = ?";

			$stmt = Conexion::conectar()->prepare($sql);
			$stmt->execute(array($usuario));
			$r = $stmt->fetch();
			if($r){
				return true;
			}else{
				return false;
			}
		}

		public function updateUsuarioModel($nombre,$paterno,$materno,$email,$contraseña,$imagen,$id){
			if($imagen=="imagen"){
				$sql = "UPDATE usuarios SET nombre = :nombre, paterno = :paterno, materno = :materno, correo = :email, password = :password WHERE id = :id";
				$stmt = Conexion::conectar()->prepare($sql);
				$stmt->bindParam(":nombre",$nombre);
				$stmt->bindParam(":paterno",$paterno);
				$stmt->bindParam(":materno",$materno);
				$stmt->bindParam(":email",$email);
				$stmt->bindParam(":password",$contraseña);
				$stmt->bindParam(":id",$id);
			}else{
				$sql = "UPDATE usuarios SET nombre = :nombre, paterno = :paterno, materno = :materno, correo = :email, password = :password, ruta_img = :imagen WHERE id = :id";
				$stmt = Conexion::conectar()->prepare($sql);
				$stmt->bindParam(":nombre",$nombre);
				$stmt->bindParam(":paterno",$paterno);
				$stmt->bindParam(":materno",$materno);
				$stmt->bindParam(":email",$email);
				$stmt->bindParam(":password",$contraseña);
				$stmt->bindParam(":imagen",$imagen);
				$stmt->bindParam(":id",$id);
			}

			if($stmt->execute()){
				return true;
			}else{
				return false;
			}
		}

		public function RegistrarUsuarioModel($nombre,$paterno,$materno,$email,$usuario,$contraseña,$imagen){

			$sql = "INSERT INTO usuarios (nombre,paterno,materno,nombre_usuario,password,correo,fecha_registro,ruta_img) VALUES (?,?,?,?,?,?,CURDATE(),?)";

			$stmt = Conexion::conectar()->prepare($sql);

			if($stmt->execute(array($nombre,$paterno,$materno,$usuario,$contraseña,$email,$imagen))){
				return true;
			}else{
				return false;
			}
		}
	}
?>