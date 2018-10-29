<?php
    //bandera para saber cuando ya se ha realizado la actualizacion del producto
    $flag = 0;  
    $controller = new MvcController();
    //obtener la informacion de un producto
    $producto = $controller->getInfoProductoController($_GET['id']);
    //obtener la informacion de las categorias
    $categorias = $controller->getAllController("categorias");
    if($_POST){
        if($controller->updateProductoController($_GET['id'])==true){
            $flag=1;
        }
    }
?>


<div class="main-body">
    <div class="page-wrapper">
        
    	<div class="page-header-title">
            <div class="d-inline">
                <h3>Editar Producto</h3>
            </div>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="#"> <i class="ti-package"></i> </a>
                </li>
                <li class="breadcrumb-item">Inventario</li>
                <li class="breadcrumb-item">Editar Producto</li>
            </ul>
        </div>

        <br><br>
        <div class="page-body">

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <span>Favor de llenar todos los campos para actualizar el producto deseado</span>
                        </div>    
                        <div class="card-block">

                        <?php if($flag==0){ ?>
                            <form method="post" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <div class="col-sm-2"></div>
                                    <label class="col-sm-3 col-form-label">Codigo:</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control form-control-center form-control-round" placeholder="Codigo del producto" value="<?php echo $producto['codigo'] ?>" name="codigo" disabled>
                                    </div>
                                </div>   
                                <div class="form-group row">
                                    <div class="col-sm-2"></div>
                                    <label class="col-sm-3 col-form-label">Nombre:</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control form-control-center form-control-round" placeholder="Nombre del producto" name="nombre" value="<?php echo $producto['nombre'] ?>" required>
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
                                        <input type="number" class="form-control form-control-center form-control-round" placeholder="Precio de venta del producto" value="<?php echo $producto['precio'] ?>" name="precio" min="0" step="any" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-2"></div>
                                    <label class="col-sm-3 col-form-label">Stock:</label>
                                    <div class="col-sm-7">
                                        <input type="number" class="form-control form-control-center form-control-round" placeholder="Inventario inicial" name="stock" min="1" value="<?php echo $producto['stock'] ?>" disabled>
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
                                    <input type="submit" class="btn col-sm-5 btn-round btn-inverse" value="Actualizar">

                                </div>
                            </form>
                        <?php }else{ ?>

                        <div class="card-block">
                            <div class="alert alert-success icons-alert">
                                <center>
                                    <p>Mensaje:</p>
                                    <strong>Producto actualizado exitosamente.</strong>
                                </center>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4"></div>
                                <div class="col-sm-6">
                                    <a href="?action=verProductos" class="btn btn-inverse btn-round col-sm-8">Volver</a>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>