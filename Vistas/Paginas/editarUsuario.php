<?php  
    $controller = new MvcController();
    $info_user = $controller->getInfoUserController($_GET['id']);
    if(isset($_POST['nombre'])){
        $controller->updateUserController($_GET['id']);
    }
?>


<div class="main-body">
    <div class="page-wrapper">
        
    	<div class="page-header-title">
            <div class="d-inline">
                <h3>Editar Usuario</h3>
            </div>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="#"> <i class="ti-user"></i> </a>
                </li>
                <li class="breadcrumb-item">Usuarios</li>
                <li class="breadcrumb-item">Editar Usuario</li>
            </ul>
        </div>

        <br><br>
        <div class="page-body">

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <span>Favor de llenar todos los campos para editar el usuario</span>
                        </div>    
                        <div class="card-block">

                            <form method="post" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <div class="col-sm-2"></div>
                                    <label class="col-sm-3 col-form-label">Nombre:</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control form-control-center form-control-round" placeholder="Nombre" value="<?php echo $info_user['nombre'] ?>" name="nombre" required>
                                    </div>
                                </div>   
                                <div class="form-group row">
                                    <div class="col-sm-2"></div>
                                    <label class="col-sm-3 col-form-label">Apellido Paterno:</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control form-control-center form-control-round" placeholder="Apellido Paterno" value="<?php echo $info_user['paterno'] ?>" name="paterno" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-2"></div>
                                    <label class="col-sm-3 col-form-label">Apellido Materno:</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control form-control-center form-control-round" placeholder="Apellido Materno" value="<?php echo $info_user['materno'] ?>" name="materno" required>
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <div class="col-sm-2"></div>
                                    <label class="col-sm-3 col-form-label">E-mail:</label>
                                    <div class="col-sm-7">
                                        <input type="email" class="form-control form-control-center form-control-round" placeholder="E-mail" value="<?php echo $info_user['correo'] ?>" name="email" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-1"></div>
                                    <label class="col-sm-4 col-form-label"><strong>Datos de Acceso</strong></label>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-2"></div>
                                    <label class="col-sm-3 col-form-label">Usuario:</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control form-control-center form-control-round" placeholder="Usuario" value="<?php echo $info_user['nombre_usuario'] ?>" name="usuario" disabled>
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <div class="col-sm-2"></div>
                                    <label class="col-sm-3 col-form-label">Contraseña:</label>
                                    <div class="col-sm-7">
                                        <input type="password" class="form-control form-control-center form-control-round" placeholder="Contraseña" value="<?php echo $info_user['password'] ?>" name="contraseña1" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-2"></div>
                                    <label class="col-sm-3 col-form-label">Verificar contraseña:</label>
                                    <div class="col-sm-7">
                                        <input type="password" class="form-control form-control-center form-control-round" placeholder="Verificar contraseña" value="<?php echo $info_user['password'] ?>" name="contraseña2" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-1"></div>
                                    <label class="col-sm-4 col-form-label"><strong>Cargar foto de perfil</strong></label>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-2"></div>
                                    <label class="col-sm-3 col-form-label">Foto de perfil:</label>
                                    <div class="col-sm-7">
                                        <input type="file" class="form-control form-control-center form-control-round" name="imagen">
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <div class="col-sm-6"></div>
                                    <input type="submit" class="btn col-sm-5 btn-round btn-inverse" value="Actualizar">

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>