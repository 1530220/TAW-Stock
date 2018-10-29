<?php  
	class EnlacesPaginas{
		//function con el parametro $enlacesModel que se recibe a travez del controlador
		public function enlacesPaginasModel($enlacesModel){
			//validar 
			if($enlacesModel=="verProductos" || $enlacesModel == "verUsuarios" || $enlacesModel == "agregarUsuario" || $enlacesModel == "verPerfil" || $enlacesModel=="editarUsuario" || $enlacesModel=="eliminarUsuario" ||$enlacesModel== "verProductos" ||$enlacesModel=="agregarProducto" || $enlacesModel=="agregarCategoria" || $enlacesModel=="verCategorias" || $enlacesModel=="editarCategoria" || $enlacesModel=="Producto" ||$enlacesModel=="eliminarCategoria" || $enlacesModel=="editarProducto" || $enlacesModel=="eliminarProducto" ||$enlacesModel=="anadirProductos" || $enlacesModel== "quitarProductos"){
				//mostramos el URL concatenado con $enlacesModel
				$module = "Paginas/".$enlacesModel.".php";
			}
			//validar una lista blanca
			else{
				$module = "Paginas/inicio.php";		
			}
			return $module;
		}
	}
?>