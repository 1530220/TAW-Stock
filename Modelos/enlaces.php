<?php  
	class EnlacesPaginas{
		//Function con el parametro $enlacesModel que se recibe a travez del controlador
		public function enlacesPaginasModel($enlacesModel){
			//Validar que si existe el nombre de la vista 
			if($enlacesModel=="verProductos" || $enlacesModel == "verUsuarios" || $enlacesModel == "agregarUsuario" || $enlacesModel == "verPerfil" || $enlacesModel=="editarUsuario" || $enlacesModel=="eliminarUsuario" ||$enlacesModel== "verProductos" ||$enlacesModel=="agregarProducto" || $enlacesModel=="agregarCategoria" || $enlacesModel=="verCategorias" || $enlacesModel=="editarCategoria" || $enlacesModel=="Producto" ||$enlacesModel=="eliminarCategoria" || $enlacesModel=="editarProducto" || $enlacesModel=="eliminarProducto" ||$enlacesModel=="anadirProductos" || $enlacesModel== "quitarProductos"){
				//Mostramos el URL concatenado con $enlacesModel
				$module = "Paginas/".$enlacesModel.".php";
			}
			//Validar una lista blanca
			else{
				$module = "Paginas/inicio.php";		
			}
			//Retorna la vista
			return $module;
		}
	}
?>