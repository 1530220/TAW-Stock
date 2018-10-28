<?php  
    session_start();
    require_once "../Controladores/controlador.php";
    require_once "../Modelos/enlaces.php";
    require_once "../Modelos/crud.php";

    if(isset($_SESSION['usuario'])){
        header("location:plantilla.php");
    }
    if($_POST){
        $log = new MvcController();
        $log->login(); 
    }
?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <title>Iniciar Sesion</title>
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
                        <form method="post" class="md-float-material">
                            <div class="text-center d-none d-lg-block  d-xl-block">
                                <img src="assets/images/auth/inventario.png" alt="logo.png">
                            </div>
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
                                <hr/>
                                
                            </div>
                        </form>
                        <!-- end of form -->
                    </div>
                    <!-- Authentication card end -->
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container-fluid -->

    </section>
    


    <div class="footer bg-inverse">
        <p class="text-center">Copyright &copy; 2018 TAW , Miguel Perez - Rodrigo Rojas.</p>
    </div>

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