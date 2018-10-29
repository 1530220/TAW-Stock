<?php 
    $controller = new MvcController();
    //obtener todos los usuario
    $usuarios = $controller->getAllController("usuarios");
    //obtener informacion del producto
    $producto = $controller->getInfoProductoController($_GET['id']);
    //historial del producto
    $historial = $controller->getHistorialController($_GET['id']);
?>
<div class="main-body">
    <div class="page-wrapper">

    	<div class="page-header-title">
            <div class="d-inline">
                <h3>Producto: <?php echo $producto['nombre'] ?></h3>
            </div>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="#"> <i class="icofont icofont-user"></i> </a>
                </li>
                <li class="breadcrumb-item"><a href="#">Lista Productos</a> </li>
                <li class="breadcrumb-item"><a href="#">Producto</a> </li>
            </ul>
        </div>

        <br><br>
        <div class="page-body">
        	<div class="card">
        		<div class="card-header">
                    <span>Informacion del producto: <?php echo $producto['nombre'] ?></span>
                </div>  

		        <div class="card-block user-detail-card">
                    <div class="row">
                        <div class="col-sm-4">
                            <img src="<?php echo $producto['ruta_img'] ?>" alt="" class="img-fluid p-b-10">
                        </div>
                        <div class="col-sm-8 user-detail">
                            <div class="row">
                                <div class="col-sm-5">
                                    <h6 class="f-w-400 m-b-30">Codigo:</h6>
                                </div>
                                <div class="col-sm-7">
                                    <h6 class="m-b-30"><?php echo $producto['codigo']?></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-5">
                                    <h6 class="f-w-400 m-b-30">Nombre:</h6>
                                </div>
                                <div class="col-sm-7">
                                    <h6 class="m-b-30"><?php echo $producto['nombre'] ?></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-5">
                                    <h6 class="f-w-400 m-b-30">Precio:</h6>
                                </div>
                                <div class="col-sm-7">
                                    <h6 class="m-b-30">$ <?php echo $producto['precio'] ?></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-5">
                                    <h6 class="f-w-400 m-b-30">Unidades en Inventario:</h6>
                                </div>
                                <div class="col-sm-7">
                                    <h6 class="m-b-30"><?php echo $producto['stock'] ?> unidades</h6>
                                </div>
                            </div>
                           	<br>
                            <div class="row">
                           		
                                <div class="col-lg-2"></div>
                           		<a href="?action=editarProducto&id=<?php echo $producto['id'] ?>" class="btn btn-info btn-outline-info col-lg-3">Editar</a>
                                <div class="col-lg-2"></div>
                                <a href="?action=eliminarProducto&id=<?php echo $producto['id'] ?>" class="btn btn-info btn-outline-info col-lg-3">Eliminar</a>                                
                            </div>
                        </div>
                        <div class="row"></div>
                            <div class="col-lg-6"></div>
                            <a href="?action=verProductos" class="btn btn-inverse btn-outline-inverse col-lg-4">Volver</a>
                    </div>
                </div>                
        	</div>
            <div class="card">
                <div class="card-block">
                    <br>
                    <div class="row">
                        <div class="col-lg-1"></div>
                        <a href="?action=anadirProductos&id=<?php echo $producto['id'] ?>" class="btn btn-danger btn-outline-danger col-lg-4">Agregar Stock</a>
                        <div class="col-lg-2"></div>
                        <a href="?action=quitarProductos&id=<?php echo $producto['id'] ?>" class="btn btn-danger btn-outline-danger col-lg-4">Quitar Stock</a>
                    
                        
                    </div>
                </div>
                <div class="card-header">
                    <span>Historial de Inventario del Producto: <?php echo $producto['nombre'] ?></span>
                </div>
                <div class="card-block">
                    <table id="demo-foo-filtering" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Descripcion</th>
                                <th>Cantidad</th>
                                <th>Referencia</th>
                                <th>Observacion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($historial as $dato) { ?>
                                <tr>
                                    <td><?php echo $dato['fecha'] ?></td>
                                    <td><?php echo $dato['hora'] ?></td>
                                    <td>
                                        <?php 
                                        if($dato['tipo_registro']=="inicial"){
                                            $accion = "registró";
                                        }elseif ($dato['tipo_registro']=="sumar") {
                                            $accion = "agregó";
                                        }else{
                                            $accion = "quitó";
                                        }

                                        $usuario_historial = "DESCONOCIDO";
                                        foreach ($usuarios as $usuario ) {
                                            if($dato['usuario']==$usuario['id']){
                                                $usuario_historial = $usuario['nombre'];
                                            }
                                        }
                                        echo $usuario_historial." ".$accion." ".$dato['cantidad']." producto(s)";
                                        ?>

                                    </td>
                                    <td><?php echo $dato['cantidad'] ?></td>
                                    <td><?php echo $dato['referencia'] ?></td>
                                    <td><?php echo $dato['nota'] ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
