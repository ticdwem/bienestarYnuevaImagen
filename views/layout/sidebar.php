
<div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Inicio</div>
                            <a class="nav-link" href="<?=base_url?>Paciente/index">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                               NUEVO PACIENTE
                            </a>
                            <a class="nav-link" href="<?=base_url?>Consultorio/index">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                               ALTA CONSULTORIO
                            </a>
                            <a class="nav-link" href="<?=base_url?>Consultorio/corteDiario">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                               REGISTRO DIARIO
                            </a>
                            <a class="nav-link" href="<?=base_url?>Consultorio/gastos">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                               REGISTRO GASTOS
                            </a>
                            <div class="sb-sidenav-menu-heading">SUCURSALES</div>
                            <a class="nav-link" href="<?=base_url?>Consultorio/nuevo">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                               PACIENTES NUEVOS
                            </a>
                            <a class="nav-link" href="<?=base_url?>Consulta/lista">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                               MIS PACIENTES
                            </a>
                                <!-- <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts"
                                    ><div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                    Layouts
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div
                                ></a> 
                                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="layout-static.html">Static Navigation</a>
                                        <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                                    </nav>
                                </div> -->

                            <!-- <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                                aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Toluca
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a> -->
                          <!--                  <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth"
                                            >Authentication
                                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div
                                        ></a>
                                        <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                            <nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="login.html">Login</a><a class="nav-link" href="register.html">Register</a><a class="nav-link" href="password.html">Forgot Password</a></nav>
                                        </div>
                                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError"
                                            >Error
                                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div
                                        ></a>
                                        <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                            <nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="401.html">401 Page</a><a class="nav-link" href="404.html">404 Page</a><a class="nav-link" href="500.html">500 Page</a></nav>
                                        </div>
                                    </nav>
                                </div> -->
                            <div class="sb-sidenav-menu-heading">Administracion</div>
                            <a class="nav-link" href="<?=base_url?>Consultorio/control">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                CONTROL
                            </a>
                            <a class="nav-link" href="<?=base_url?>Doctor/index">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                ALTA DOCTOR
                            </a>
                            <!-- <a class="nav-link" href="">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Pagos
                            </a> -->
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                    <?php if(isset($_SESSION['usuario'])){ ?>
                        <div class="small">Hola Dr:</div>
                        <?php
                        echo ucwords(SED::decryption($_SESSION['usuario']['nombre'])).' '.Utls::getApellido($_SESSION['usuario']['apeliidos']);                       
                        //echo ucwords(SED::decryption($_SESSION['usuario']['nombre']));  
                    }                     
                       ?>
                        
                    </div>
                </nav>
            </div>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">