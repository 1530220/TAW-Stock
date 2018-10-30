<?php  
    //Iniciar la sesión del usuario 
    session_start();
    //Requiere los controlodores y modelos para poder hacer el llamado de una consulta o vista
    require_once "../Controladores/controlador.php";
    require_once "../Modelos/enlaces.php";
    require_once "../Modelos/crud.php";
    //Condición si el usuario inicio sesión
    if(isset($_SESSION['usuario'])){
        //Si la inicio se inicio con el usuario redirige a la plantilla
        header("location:plantilla.php");
    }
    //Condición para llamar los parametros del formulario
    if($_POST){
        //Inicia una instancia del controlador
        $log = new MvcController();
        //Llama a la función de Login de la instacia
        $log->login(); 
    }
?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <title>Iniciar Sesion</title>
    <!--Manda a llamar los componentes css para el diseño de la plantilla-->
    <link rel="icon" href="../Diseños/assets/images/inventario.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../Diseños/components/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../Diseños/assets/icon/themify-icons/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="../Diseños/assets/icon/icofont/css/icofont.css">
    <link rel="stylesheet" type="text/css" href="../Diseños/assets/pages/menu-search/css/component.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="../Diseños/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="../Diseños/assets/css/jquery.mCustomScrollbar.css">
    </head>
    <body>
    <section class="login header p-fixed d-flex text-center bg-primary common-img-bg">
        <!-- Container-fluid starts -->

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="login-card card-block auth-body mr-auto ml-auto">

                        <!--Crea el formulario del login mediante el metodo post-->
                        <form method="post" class="md-float-material">
                            <div class="auth-box">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-center txt-primary">Iniciar Sesion</h3>
                                    </div>
                                </div>
                                <hr/>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Usuario" name="usuario" required>
                                    <span class="md-line"></span>
                                </div>
                                <div class="input-group">
                                    <input type="password" class="form-control" placeholder="Contraseña" name="contraseña" required>
                                    <span class="md-line"></span>
                                </div>
                                
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Acceder</button>
                                    </div>
                                </div>
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
    


    <div class="footer bg-inverse">
        <p class="text-center">Copyright &copy; 2018 TAW. Miguel Perez - Rodrigo Rojas.</p>
    </div>
    <!--Manda a llamar los componentes de javascript-->
    <script type="text/javascript" src="../Diseños/components/jquery/js/jquery.min.js"></script>
    <script type="text/javascript" src="../Diseños/components/jquery-ui/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="../Diseños/components/popper.js/js/popper.min.js"></script>
    <script type="text/javascript" src="../Diseños/components/bootstrap/js/bootstrap.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="../Diseños/components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="../Diseños/components/modernizr/js/modernizr.js"></script>
    <script type="text/javascript" src="../Diseños/components/modernizr/js/css-scrollbars.js"></script>
    <!-- i18next.min.js -->
    <script type="text/javascript" src="../Diseños/components/i18next/js/i18next.min.js"></script>
    <script type="text/javascript" src="../Diseños/components/i18next-xhr-backend/js/i18nextXHRBackend.min.js"></script>
    <script type="text/javascript" src="../Diseños/components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js"></script>
    <script type="text/javascript" src="../Diseños/components/jquery-i18next/js/jquery-i18next.min.js"></script>
    <script type="text/javascript" src="../Diseños/assets/js/common-pages.js"></script>
    </body>
    </html>