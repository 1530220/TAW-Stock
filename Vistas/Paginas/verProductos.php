<?php  
    $controller = new  MvcController();//Crea la instancia del controlador
    $productos = $controller->getAllController("productos");//Obtiene los datos de todos los productos
    $categorias = $controller->getAllController("categorias");//Obtiene todos los datos de las categorias


?>
<div class="main-body">
    <div class="page-wrapper">
        
    	<div class="page-header-title">
            <div class="d-inline">
                <h3>Lista de Productos</h3>
            </div>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="#"> <i class="ti-package"></i> </a>
                </li>
                <li class="breadcrumb-item">Inventario</li>
                <li class="breadcrumb-item">Ver Productos</li>
            </ul>
        </div>

        <br><br>
        <div class="page-body">
            
            <div class="card">
                <div class="card-header">
                    <span>Lista de todos los productos registrados en el sistema.</span>
                </div>
                <div class="card-block">
                    <div class="dt-responsive table-responsive">
                        <table id="compact" class="table compact table-striped table-bordered nowrap">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th>Inventario</th>
                                    <th>Categoria</th>
                                    <th>Ajustes</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                //Recorrer el arreglo de la tabla de los productos para obtener un producto por el id
                                foreach ($productos as $producto){?>                    
                                <?php 
                                    $producto_categoria = "0";
                                    //Recorrer el arreglo de la tabla de las categorias para obtener un producto por su categoria correspondiente
                                    foreach ($categorias as $categoria) {
                                            if($categoria['id']==$producto['categoria']){
                                                $producto_categoria = $categoria['nombre'];
                                            }   
                                    }

                                    if($producto_categoria=="0"){
                                        $producto_categoria = "No posee categoria";
                                    }
                                ?>
                                <tr> 
                                    <td><?php echo $producto['nombre'] ?></td>
                                    <td>$ <?php echo $producto['precio'] ?></td>
                                    <td><?php echo $producto['stock'] ?> unidades</td>
                                    <td><?php echo $producto_categoria ?></td>
                                    <td><center><a href="?action=Producto&id=<?php echo $producto['id'] ?>" class="btn btn-info btn-outline-info zmdi zmdi-settings"></a></center></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>