
    <nav class="pcoded-navbar">
        <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
        <div class="pcoded-inner-navbar main-menu">
            <div class="">
                <div class="main-menu-header">
                    <img class="img-40 img-radius" src="<?php echo $_SESSION['imagen'] ?>" alt="User-Profile-Image">
                    <div class="user-details">
                        <span><?php echo $_SESSION['usuario'] ?></span>
                        <span id="more-details">Usuario</span>
                    </div>
                </div>
            </div>

            <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation">Menu</div>
            <ul class="pcoded-item pcoded-left-item">


                <li class="">
                    <a href="../index.php">
                        <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                        <span class="pcoded-mtext">Inicio</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
                
                <li class="pcoded-hasmenu">    
                    <a href="javascript:void(0)">        
                        <span class="pcoded-micon"><i class="ti-package"></i><b>N</b></span>        
                        <span class="pcoded-mtext">Inventario</span>        
                        <span class="pcoded-mcaret"></span>    
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="?action=verProductos">
                            <a href="?action=verProductos">
                                <span class="pcoded-mtext">Ver Productos</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="?action=agregarProducto">
                                <span class="pcoded-mtext">Agregar Producto</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="pcoded-hasmenu">    
                    <a href="javascript:void(0)">        
                        <span class="pcoded-micon"><i class="ti-pin-alt"></i><b>C</b></span>        
                        <span class="pcoded-mtext">Categorias</span>        
                        <span class="pcoded-mcaret"></span>    
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="">
                            <a href="?action=verCategorias">
                                <span class="pcoded-mtext">Ver Categorias</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="?action=agregarCategoria">
                                <span class="pcoded-mtext">Agregar Categoria</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="pcoded-hasmenu">    
                    <a href="javascript:void(0)">        
                        <span class="pcoded-micon"><i class="ti-user"></i><b>E</b></span>        
                        <span class="pcoded-mtext">Usuarios</span>        
                        <span class="pcoded-mcaret"></span>    
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="">
                            <a href="?action=verUsuarios">
                                <span class="pcoded-mtext">Ver Usuarios</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="?action=agregarUsuario">
                                <span class="pcoded-mtext">Agregar Usuario</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            
            </div>

    </nav>
