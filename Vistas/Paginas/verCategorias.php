<?php  
    $controller = new MvcController();//Hace la instacia al controlador
    //Consigue los datos de las categorias
    $categorias = $controller->getAllController("categorias");

?>

<div class="main-body">
    <div class="page-wrapper">
        
        <div class="page-header-title">
            <div class="d-inline">
                <h3>Lista de Categorias</h3>
            </div>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="#"> <i class="ti-pin-alt"></i> </a>
                </li>
                <li class="breadcrumb-item">Categorias</li>
                <li class="breadcrumb-item">Ver Categorias</li>
            </ul>
        </div>

        <br><br>
        <div class="page-body">



            <div class="card">
                <div class="card-header">
                    <span>Lista de todas las categorias registradas en el sistema.</span>
                </div>
                <div class="card-block">
                    <div class="dt-responsive table-responsive">
                        <table id="compact" class="table compact table-striped table-bordered nowrap">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Descripcion</th>
                                    <th>Fecha de registro</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                //Recorre el arreglo de la tabla categorias para obtener los datos de la categoria
                                foreach ($categorias as $categoria) { ?>
                                    <tr>
                                        <td><?php echo $categoria['nombre']?></td>
                                        <td><?php echo $categoria['descripcion'] ?></td>
                                        <td><?php echo $categoria['fecha_agregado'] ?></td>
                                        <td>
                                            <center>
                                            <a href="?action=editarCategoria&id=<?php echo $categoria['id'] ?>"><i class="btn btn-info btn-outline-info zmdi zmdi-edit"></i></a>
                                            <a href="?action=eliminarCategoria&id=<?php echo $categoria['id'] ?>"><i class="btn btn-info btn-outline-info zmdi zmdi-delete"></i></a>
                                            </center>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Descripcion</th>
                                    <th>Fecha de registro</th>
                                    <th>Acciones</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
                  
        </div>

    </div>
</div>