<?php  
	$controller = new MvcController();

	$productos = $controller->getAllController("productos");
	$categorias = $controller->getAllController("categorias");
	$usuarios = $controller->getAllController("usuarios");
?>

<div class="main-body">
    <div class="page-wrapper">
        <!-- Page-header start -->
        	<div class="page-header-title">
	            <div class="d-inline">
	                <h3>Inicio</h3>
	            </div>
	        </div>
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="#"> <i class="icofont icofont-home"></i> </a>
                    </li>
                    <li class="breadcrumb-item"><a href="#">Inicio</a> </li>
                </ul>
	        </div>

	        <br><br>
            <div class="page-body">
				<div class="row">

				<div class="col-sm-4">
					<a href="#">
						<div class="card bg-c-pink text-white widget-visitor-card">
						   <div class="card-block-small text-center">
						        <h2><?php echo count($productos) ?></h2>
						        <h6>Productos</h6>
						        <i class="ti-package"></i>
						    </div>
						</div>
					</a>
				</div>
				<div class="col-sm-4">
					<a href="#">
						<div class="card bg-c-green text-white widget-visitor-card">
						    <div class="card-block-small text-center">
						        <h2><?php echo count($categorias) ?></h2>
						        <h6>Categorias</h6>
						        <i class="ti-pin-alt"></i>
						    </div>
						</div>
					</a>
				</div>
				<div class="col-sm-4">
					<a href="#">
						<div class="card bg-c-yellow text-white widget-visitor-card">
						    <div class="card-block-small text-center">
						        <h2><?php echo count($usuarios) ?></h2>
						        <h6>Usuarios</h6>
						        <i class="ti-user"></i>
						    </div>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>