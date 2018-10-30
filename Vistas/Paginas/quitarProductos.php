
<?php  
    $controller = new MvcController();//Crea una instancia al controlador
    //Flag para despues de que se ha quitado productos
    $flag = 0;
    $id = $_GET['id'];
    //Obtener informacion de producto para saber el maximo de productos a qitar
    $productos = $controller->getInfoProductoController($id);
    if(isset($_POST['cantidad'])){
        //Remover stock
        if($controller->HistorialRemoveController($id)==true){
            $flag=1;
        }else{
            echo "<script>alert('No se ha podido quitar el stock. Vuelve a intentarlo')</script>";
        }
        
    }
?>

<div class="main-body">
    <div class="page-wrapper">

        <div class="page-header-title">
            <div class="d-inline">
                <h3>Quitar Stock</h3>
            </div>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="#"> <i class="ti ti-pin-alt"></i> </a>
                </li>
                <li class="breadcrumb-item"><a href="#">Productos</a> </li>
                <li class="breadcrumb-item"><a href="#">Quitar Stock</a> </li>
            </ul>
        </div>

        <br><br>
        <div class="page-body">
            <div class="card">
                <?php 
                //Una condición para poder quitar del stock correctamente o no
                if($flag==1){ ?>
                <div class="card-block">
                    <div class="alert alert-success icons-alert">
                        <center>
                            <p>Mensaje:</p>
                            <strong>Stock actualizado exitosamente.</strong>
                        </center>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-6">
                            <a href="?action=Producto&id=<?php echo $_GET['id'] ?>" class="btn btn-inverse btn-round col-sm-8">Volver</a>
                        </div>
                    </div>
                </div>
                <?php }else{ ?>
                <div class="card-header">
                    <span>Favor de ingresar la referencia, la cantidad de productos a quitar, y una observacion</span>
                </div>  
                <br>
                <div class="card-block">
                    <form method="post">
                        <div class="form-group row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-center form-control-round" placeholder="Referencia" name="referencia" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-8">
                                <input type="number" class="form-control form-control-center form-control-round" placeholder="Cantidad" name="cantidad" max="<?php echo $productos['stock'] ?>" min="1" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-center form-control-round" placeholder="Observacion" name="observacion" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-6">
                                <input type="submit" class="btn btn-inverse btn-round col-sm-7" value="Aceptar">
                            </div>
                        </div>
                    </form>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
