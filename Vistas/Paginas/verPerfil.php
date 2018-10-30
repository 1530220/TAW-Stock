<?php  
	$controller = new MvcController();//Hace la instacia al controlador
    //Consigue los datos de los usuarios
	$info_user = $controller->getInfoUserController($_GET['id']);
?>


<div class="main-body">
    <div class="page-wrapper">

    	<div class="page-header-title">
            <div class="d-inline">
                <h3>Perfil de usuario</h3>
            </div>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="#"> <i class="icofont icofont-user"></i> </a>
                </li>
                <li class="breadcrumb-item"><a href="#">Usuarios</a> </li>
                <li class="breadcrumb-item"><a href="#">Perfil</a> </li>
            </ul>
        </div>

        <br><br>
        <div class="page-body">
        	<div class="card">
        		<div class="card-header">
                    <span>Informacion de perfil del usuario: <?php echo $info_user['nombre_usuario'] ?></span>
                </div>  

		        <div class="card-block user-detail-card">
                    <div class="row">
                        <div class="col-sm-4">
                            <img src="<?php echo $info_user['ruta_img'] ?>" alt="" class="img-fluid p-b-10">
                        </div>
                        <div class="col-sm-8 user-detail">
                            <div class="row">
                                <div class="col-sm-5">
                                    <h6 class="f-w-400 m-b-30"><i class="icofont icofont-ui-user"></i>Nombre Completo:</h6>
                                </div>
                                <div class="col-sm-7">
                                    <h6 class="m-b-30"><?php echo $info_user['nombre']." ".$info_user['paterno']." ".$info_user['materno'] ?></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-5">
                                    <h6 class="f-w-400 m-b-30"><i class="icofont icofont-ui-user"></i>Usuario:</h6>
                                </div>
                                <div class="col-sm-7">
                                    <h6 class="m-b-30"><?php echo $info_user['nombre_usuario'] ?></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-5">
                                    <h6 class="f-w-400 m-b-30"><i class="icofont icofont-ui-email"></i>E-mail :</h6>
                                </div>
                                <div class="col-sm-7">
                                    <h6 class="m-b-30"><?php echo $info_user['correo'] ?></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-5">
                                    <h6 class="f-w-400 m-b-30"><i class="icofont icofont-ui-calendar"></i>Fecha de registro :</h6>
                                </div>
                                <div class="col-sm-7">
                                    <h6 class="m-b-30"><?php echo $info_user['fecha_registro'] ?></h6>
                                </div>
                            </div>
                           	<div class="row">
                           		
                           		<div class="col-lg-4"></div>
                           		<a href="?action=verUsuarios" class="btn btn-warning col-lg-3">Volver</a>
                                
                            </div>
                        </div>
                    </div>
                </div>
        	</div>
        </div>
    </div>
</div>