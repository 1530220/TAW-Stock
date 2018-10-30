<?php  
    //Instancia del controlador
    $controller = new MvcController();
    //Obtner las categorias
    $categorias = $controller->getAllController("categorias");
    //Condición para enviar los datos del formulario
    if($_POST){
        //Llamar al controlador la función de agregar productos
        $controller->AddStockController();
    }
?>

<div class="main-body">
    <div class="page-wrapper">
        
    	<div class="page-header-title">
            <div class="d-inline">
                <h3>Agregar Nuevo Producto</h3>
            </div>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="#"> <i class="ti-package"></i> </a>
                </li>
                <li class="breadcrumb-item">Inventario</li>
                <li class="breadcrumb-item">Agregar Producto</li>
            </ul>
        </div>

        <br><br>
        <div class="page-body">

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <span>Favor de llenar todos los campos para registrar el producto deseado</span>
                        </div>    
                        <div class="card-block">

                            <!--Crea el formulario del formulario de agregar producto mediante el metodo post y con ecriptación para poder guardar una imagen-->
                            
                            <form method="post" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <div class="col-sm-2"></div>
                                    <label class="col-sm-3 col-form-label">Codigo:</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control form-control-center form-control-round" placeholder="Codigo del producto" name="codigo" required>
                                    </div>
                                </div>   
                                <div class="form-group row">
                                    <div class="col-sm-2"></div>
                                    <label class="col-sm-3 col-form-label">Nombre:</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control form-control-center form-control-round" placeholder="Nombre del producto" name="nombre" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-2"></div>
                                    <label class="col-sm-3 col-form-label">Categoria:</label>
                                    <div class="col-sm-7">
                                        <select name="categoria" class="form-control form-control-center form-control-round">
                                            <?php foreach ($categorias as $categoria) { ?>
                                                <option value="<?php echo $categoria['id'] ?>"><?php echo $categoria['nombre'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <div class="col-sm-2"></div>
                                    <label class="col-sm-3 col-form-label">Precio:</label>
                                    <div class="col-sm-7">
                                        <input type="number" class="form-control form-control-center form-control-round" placeholder="Precio de venta del producto" name="precio" min="0" step="any" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-2"></div>
                                    <label class="col-sm-3 col-form-label">Stock:</label>
                                    <div class="col-sm-7">
                                        <input type="number" class="form-control form-control-center form-control-round" placeholder="Inventario inicial" name="stock" min="1" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-1"></div>
                                    <label class="col-sm-4 col-form-label"><strong>Cargar imagen del producto</strong></label>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-2"></div>
                                    <label class="col-sm-3 col-form-label">Imagen:</label>
                                    <div class="col-sm-7">
                                        <input type="file" class="form-control form-control-center form-control-round" name="imagen">
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