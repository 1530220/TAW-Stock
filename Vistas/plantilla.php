<?php 
    //Iniciar la sesión del usuario 
    session_start();
    //Requiere los controlodores y modelos para poder hacer el llamado de una consulta o vista
    require_once "../Controladores/controlador.php";
    require_once "../Modelos/enlaces.php";
    require_once "../Modelos/crud.php";
?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <title>Sistema de Control de Inventarios</title>
    <!--Manda a llamar los componentes css para el diseño de la plantilla-->

    <link rel="icon" href="../Diseños/assets/images/abc.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../Diseños/components/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../Diseños/assets/icon/material-design/css/material-design-iconic-font.min.css">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="../Diseños/assets/icon/themify-icons/themify-icons.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="../Diseños/assets/icon/icofont/css/icofont.css">
    <!-- flag icon framework css -->
    <link rel="stylesheet" type="text/css" href="../Diseños/assets/pages/flag-icon/flag-icon.min.css">
    <!-- Menu-Search css -->
    <link rel="stylesheet" type="text/css" href="../Diseños/assets/pages/menu-search/css/component.css">
    <!-- Syntax highlighter Prism css -->
    <link rel="stylesheet" type="text/css" href="../Diseños/assets/pages/prism/prism.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="../Diseños/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="../Diseños/assets/css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" type="text/css" href="../Diseños/assets/pages/foo-table/css/footable.bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="../Diseños/components/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="../Diseños/assets/pages/data-table/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="../Diseños/components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css">
    </head>
    <body>
    
    <!--<div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
            </div>
        </div>
    </div>-->


    <div id="pcoded" class="pcoded">


    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">
        
            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">

                    <div class="navbar-logo">
                        <a href="#">
                            <h5>Sistema de Control de Inventario</h5>
                        </a>                    
                    </div>

                    <div class="navbar-container container-fluid">
                        <ul class="nav-left">
                            
                            <li>
                                <a href="#" onclick="javascript:toggleFullScreen()">
                                    <i class="ti-fullscreen"></i>
                                </a>
                            </li>
                        </ul>

                        <ul class="nav-right">
                            
                            <li class="user-profile header-notification">
                                <a href="#!">
                                    <!-- Se agrega una imagen al usaurio -->
                                    <img src="<?php echo $_SESSION['imagen']; ?>" class="img-radius" alt="User-Profile-Image">
                                    <span><?php 
                                    //Aquí inicia la sesión del usuario
                                    echo $_SESSION['usuario'] ?></span>
                                    <i class="ti-angle-down"></i>
                                </a>
                                <ul class="show-notification profile-notification">
                                    <li>
                                    <a href="logout.php">
                                        <i class="ti-layout-sidebar-left"></i> Cerrar Sesion
                                    </a>
                                </li>
                                </ul>
                            </li>
                        </ul>
                        
                    </div>
                </div>
            </nav>

        <div class="pcoded-main-container">
            <div class="pcoded-wrapper">


            <?php  
            //Incluye la navegación para la platilla a mostrar
            include "Paginas/navegacion.php";?>



            <div class="pcoded-content">
                    <div class="pcoded-inner-content">
                        <?php  
                            //Mostraremos un controlador que muestra la plantilla
                            $mvc = new MvcController();
                            //Mostramos la funcion
                            $mvc->enlacesPaginasController();
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Manda a llamar los componente de javascript -->
<script type="text/javascript" src="../Diseños/components/jquery/js/jquery.min.js"></script>
<script type="text/javascript" src="../Diseños/components/jquery-ui/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="../Diseños/components/popper.js/js/popper.min.js"></script>
<script type="text/javascript" src="../Diseños/components/bootstrap/js/bootstrap.min.js"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="../Diseños/components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
<!-- modernizr js -->
<script type="text/javascript" src="../Diseños/components/modernizr/js/modernizr.js"></script>
<script type="text/javascript" src="../Diseños/components/modernizr/js/css-scrollbars.js"></script>

<!-- Syntax highlighter prism js -->
<script type="text/javascript" src="../Diseños/assets/pages/prism/custom-prism.js"></script>
<!-- i18next.min.js -->
<script type="text/javascript" src="../Diseños/components/i18next/js/i18next.min.js"></script>
<script type="text/javascript" src="../Diseños/components/i18next-xhr-backend/js/i18nextXHRBackend.min.js"></script>
<script type="text/javascript"
        src="../Diseños/components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js"></script>
<script type="text/javascript" src="../Diseños/components/jquery-i18next/js/jquery-i18next.min.js"></script>
<script src="../Diseños/assets/pages/foo-table/js/footable.min.js"></script>
<script src="../Diseños/assets/pages/foo-table/js/foo-table-custom.js"></script>
<!-- Custom js -->

<script src="../Diseños/assets/js/pcoded.min.js"></script>
<script src="../Diseños/assets/js/menu/box-layout.js"></script>
<script src="../Diseños/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="../Diseños/assets/js/script.js"></script>

<script src="../Diseños/assets/pages/data-table/js/data-table-custom.js"></script>
<script src="../Diseños/components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../Diseños/components/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="../Diseños/assets/pages/data-table/js/jszip.min.js"></script>
<script src="../Diseños/assets/pages/data-table/js/pdfmake.min.js"></script>
<script src="../Diseños/assets/pages/data-table/js/vfs_fonts.js"></script>
<script src="../Diseños/components/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="../Diseños/components/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="../Diseños/components/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../Diseños/components/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="../Diseños/components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
</body>

</html>