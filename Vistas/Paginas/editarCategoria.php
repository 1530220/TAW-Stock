<?php  
    //controlador
    $controller = new MvcController();
    //obtener la informacion de una categoria
    $info_user = $controller->getInfoCategoryController($_GET['id']);
    if(isset($_POST['nombre'])){
        $controller->updateCategoryController($_GET['id']);
    }
?>


<div class="main-body">
    <div class="page-wrapper">
        
    	<div class="page-header-title">
            <div class="d-inline">
                <h3>Editar Categoria</h3>
            </div>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="#"> <i class="ti-user"></i> </a>
                </li>
                <li class="breadcrumb-item">Categorias</li>
                <li class="breadcrumb-item">Editar Categorias</li>
            </ul>
        </div>

        <br><br>
        <div class="page-body">

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <span>Favor de llenar todos los campos para editar la categoria</span>
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
                                    <label class="col-sm-3 col-form-label">Descripción:</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control form-control-center form-control-round" placeholder="Descripción" value="<?php echo $info_user['descripcion'] ?>" name="descripcion" required>
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