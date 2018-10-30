
<?php  
    $controller = new MvcController();//Llama la instancia del controlador
    //Flag para saber si se ha borrado el usuario
    $flag = 0;
    $id = $_GET['id'];
    if(isset($_POST['contraseña'])){
        //obtner la contraseña ingresada
        $contraseña = $_POST['contraseña'];
        //validar que se correcta
        if($contraseña==$_SESSION['contraseña']){
            //borrar usuario
            if($controller->deleteUserController($id)==true){
                $flag=1;
            }else{
                echo "<script>alert('No se ha podido eliminar el usuario. Vuelve a intentarlo')</script>";  
            }
        }else{
            echo "<script>alert('Contraseña incorrecta. Vuelve a intentarlo')</script>";
        }
    }
?>

<div class="main-body">
    <div class="page-wrapper">

    	<div class="page-header-title">
            <div class="d-inline">
                <h3>Eliminar Usuario</h3>
            </div>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="#"> <i class="icofont icofont-user"></i> </a>
                </li>
                <li class="breadcrumb-item"><a href="#">Usuarios</a> </li>
                <li class="breadcrumb-item"><a href="#">Eliminar Usuario</a> </li>
            </ul>
        </div>

        <br><br>
        <div class="page-body">
        	<div class="card">
                <?php 
                //Una condición para si se el usaurio es el que va a eliminar
                if($flag==1){ ?>
                <div class="card-block">
                    <div class="alert alert-warning icons-alert">
                        <center>
                            <p>Contraseña correcta.</p>
                            <strong>Usuario eliminado exitosamente</strong>
                        </center>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-6">
                            <a href="?action=verUsuarios" class="btn btn-warning btn-round col-sm-8">Volver</a>
                        </div>
                    </div>
                </div>
                <?php }else{ ?>
                <div class="card-header">
                    <span>Favor de ingresar la contraseña del usuario en sesion para proceder a eliminar al usuario seleccionado</span>
                </div>  
                <br>
                <div class="card-block">
                    <form method="post">
                        <div class="form-group row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-8">
                                <input type="password" class="form-control form-control-center form-control-round" placeholder="Contraseña" name="contraseña" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-6">
                                <input type="submit" class="btn btn-warning btn-round col-sm-7" value="Aceptar">
                            </div>
                        </div>
                    </form>
                </div>
                <?php } ?>
        	</div>
        </div>
    </div>
</div>

