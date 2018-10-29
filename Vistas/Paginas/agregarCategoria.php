<?php  
    if($_POST){
        $guardarDatos = new MvcController();
        $guardarDatos->agregarCategoria();
    }
?>

<div class="main-body">
    <div class="page-wrapper">
        
    	<div class="page-header-title">
            <div class="d-inline">
                <h3>Agregar Nueva Categoria</h3>
            </div>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="#"> <i class="ti-user"></i> </a>
                </li>
                <li class="breadcrumb-item">Categorias</li>
                <li class="breadcrumb-item">Agregar Categorias</li>
            </ul>
        </div>

        <br><br>
        <div class="page-body">

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <span>Favor de llenar todos los campos para registrar un nueva categoria</span>
                        </div>    
                        <div class="card-block">

                            <form method="post" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <div class="col-sm-2"></div>
                                    <label class="col-sm-3 col-form-label">Nombre:</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control form-control-center form-control-round" placeholder="Nombre" name="nombre" required>
                                    </div>
                                </div>   
                                <div class="form-group row">
                                    <div class="col-sm-2"></div>
                                    <label class="col-sm-3 col-form-label">Descripción:</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control form-control-center form-control-round" placeholder="Descripción" name="descripcion" required>
                                    </div>
                                </div>
                                
                                <br>
                                <div class="form-group row">
                                    <div class="col-sm-6"></div>
                                    <input type="submit" class="btn col-sm-5 btn-round btn-inverse" value="Guardar">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>