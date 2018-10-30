
<?php  
    $controller = new MvcController();//Llama la instancia del controlador
    //Bandera para cuando ya se ha realizado la eliminacion de la categoria
    $flag = 0;
    $id = $_GET['id'];
    if(isset($_POST['contraseña'])){
        //Obtener la contraseña ingresada
        $contraseña = $_POST['contraseña'];
        //Validar que sea correcta
        if($contraseña==$_SESSION['contraseña']){
            //Proceder a ejecutar el metodo del controlador para borrar una categoria
            if($controller->deleteCategoriaController($id)==true){
                $flag=1;
            }else{
                echo "<script>alert('No se ha podido eliminar la categoria. Vuelve a intentarlo')</script>";  
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
                <h3>Eliminar Categoria</h3>
            </div>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="#"> <i class="ti ti-pin-alt"></i> </a>
                </li>
                <li class="breadcrumb-item"><a href="#">Categorias</a> </li>
                <li class="breadcrumb-item"><a href="#">Eliminar Categoria</a> </li>
            </ul>
        </div>

        <br><br>
        <div class="page-body">
        	<div class="card">
                <?php if($flag==1){ ?>
                <div class="card-block">
                    <div class="alert alert-warning icons-alert">
                        <center>
                            <p>Contraseña correcta.</p>
                            <strong>Categoria eliminada exitosamente</strong>
                        </center>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-6">
                            <a href="?action=verCategorias" class="btn btn-warning btn-round col-sm-8">Volver</a>
                        </div>
                    </div>
                </div>
                <?php }else{ ?>
                <div class="card-header">
                    <span>Favor de ingresar la contraseña del usuario en sesion para proceder a eliminar la categoria seleccionada</span>
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

