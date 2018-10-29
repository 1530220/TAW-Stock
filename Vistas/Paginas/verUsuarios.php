<?php  
    $controller = new MvcController();

    $usuarios = $controller->getUsersController();

?>

<div class="main-body">
    <div class="page-wrapper">
        
    	<div class="page-header-title">
            <div class="d-inline">
                <h3>Lista de Usuarios</h3>
            </div>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="#"> <i class="ti-user"></i> </a>
                </li>
                <li class="breadcrumb-item">Usuarios</li>
                <li class="breadcrumb-item">Ver Usuarios</li>
            </ul>
        </div>

        <br><br>
        <div class="page-body">



            <div class="card">
                <div class="card-header">
                    <span>Lista de todos los usuarios registrados en el sistema.</span>
                </div>
                <div class="card-block">
                    <div class="dt-responsive table-responsive">
                        <table id="compact" class="table compact table-striped table-bordered nowrap">
                            <thead>
                                <tr>
                                    <th>Nombre Completo</th>
                                    <th>E-mail</th>
                                    <th>Registrado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($usuarios as $usuario) { ?>
                                    <tr>
                                        <td><?php echo $usuario['nombre']." ".$usuario['paterno']." ".$usuario['materno'] ?></td>
                                        <td><?php echo $usuario['correo'] ?></td>
                                        <td><?php echo $usuario['fecha_registro'] ?></td>
                                        <td><center>
                                            <a href="?action=verPerfil&id=<?php echo $usuario['id'] ?>"><i class="btn btn-info btn-outline-info zmdi zmdi-eye"></i></a>
                                            <a href="?action=editarUsuario&id=<?php echo $usuario['id'] ?>"><i class="btn btn-info btn-outline-info zmdi zmdi-edit"></i></a>
                                            <a href="?action=eliminarUsuario&id=<?php echo $usuario['id'] ?>"><i class="btn btn-info btn-outline-info zmdi zmdi-delete"></i></a>
                                            </center>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nombre Completo</th>
                                    <th>E-mail</th>
                                    <th>Registrado</th>
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