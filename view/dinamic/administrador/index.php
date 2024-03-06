<?php
include '../model/transacciones.php';
include '../model/usuario.php';
include '../model/monedero.php';
$transacciones = new transacciones;
$monedero = new monedero;
$usuario = new usuario();

?>
<!-- jquery.vectormap css -->
<link href="../assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet"
    type="text/css" />

<!-- DataTables -->
<link href="../assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<!-- Responsive datatable examples -->
<link href="../assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet"
    type="text/css" />


<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Panel Administrativo</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Afiliado ClubSky</a></li>
                            <li class="breadcrumb-item active">Panel Administrativo</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-xl-8">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-1 overflow-hidden">
                                        <p class="text-truncate font-size-14 mb-2">Afiliados</p>
                                        <h4 class="mb-0" id="comercios"><?= $usuario->total_afiliados(); ?></h4>
                                    </div>
                                    <div class="text-primary ms-auto">
                                        <i class="ri-store-2-line font-size-24"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body border-top py-3">
                                <div class="text-truncate">
                                    <span class="badge badge-soft-success font-size-11"><i class="mdi mdi-menu-up"> </i>
                                        2.4% </span>
                                    <span class="text-muted ms-2">Del periodo anterior</span>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-1 overflow-hidden">
                                        <p class="text-truncate font-size-14 mb-2">Venta</p>
                                        <h4 class="mb-0" id="ventas"><?= $transacciones->get_total_transaccion(); ?>$</h4>
                                    </div>
                                    <div class="text-primary ms-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 512 512"><path fill="currentColor" d="M64 0C46.3 0 32 14.3 32 32v64c0 17.7 14.3 32 32 32h80v32H87c-31.6 0-58.5 23.1-63.3 54.4L1.1 364.1c-.7 4.7-1.1 9.5-1.1 14.3V448c0 35.3 28.7 64 64 64h384c35.3 0 64-28.7 64-64v-69.6c0-4.8-.4-9.6-1.1-14.4l-22.7-149.6c-4.7-31.3-31.6-54.4-63.2-54.4H208v-32h80c17.7 0 32-14.3 32-32V32c0-17.7-14.3-32-32-32H64zm32 48h160c8.8 0 16 7.2 16 16s-7.2 16-16 16H96c-8.8 0-16-7.2-16-16s7.2-16 16-16zM64 432c0-8.8 7.2-16 16-16h352c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16zm48-168a24 24 0 1 1 0-48a24 24 0 1 1 0 48zm120-24a24 24 0 1 1-48 0a24 24 0 1 1 48 0zm-72 104a24 24 0 1 1 0-48a24 24 0 1 1 0 48zm168-104a24 24 0 1 1-48 0a24 24 0 1 1 48 0zm-72 104a24 24 0 1 1 0-48a24 24 0 1 1 0 48zm168-104a24 24 0 1 1-48 0a24 24 0 1 1 48 0zm-72 104a24 24 0 1 1 0-48a24 24 0 1 1 0 48z"/></svg>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body border-top py-3">
                                <div class="text-truncate">
                                    <span class="badge badge-soft-success font-size-11"><i class="mdi mdi-menu-up"> </i>
                                        2.4% </span>
                                    <span class="text-muted ms-2">Del periodo anterior</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-1 overflow-hidden">
                                        <p class="text-truncate font-size-14 mb-2">Transacciones</p>
                                        <h4 class="mb-0" id="domiciliario"><?= $transacciones->get_count_transaccion();?></h4>
                                    </div>
                                    <div class="text-primary ms-auto">
                                     
                                        <svg xmlns="http://www.w3.org/2000/svg" class="font-size-30" width="30" height="30" viewBox="0 0 24 24"><path fill="currentColor" d="M19 15c.55 0 1 .45 1 1s-.45 1-1 1s-1-.45-1-1s.45-1 1-1m0-2c-1.66 0-3 1.34-3 3s1.34 3 3 3s3-1.34 3-3s-1.34-3-3-3m-9-7H5v2h5V6m7-1h-3v2h3v2.65L13.5 14H10V9H6c-2.21 0-4 1.79-4 4v3h2c0 1.66 1.34 3 3 3s3-1.34 3-3h4.5l4.5-5.65V7a2 2 0 0 0-2-2M7 17c-.55 0-1-.45-1-1h2c0 .55-.45 1-1 1Z"/></svg>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body border-top py-3">
                                <div class="text-truncate">
                                    <span class="badge badge-soft-success font-size-11"><i class="mdi mdi-menu-up"> </i>
                                        2.4% </span>
                                    <span class="text-muted ms-2">Del periodo anterior</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="card">
                    <div class="card-body">
                        <div class="float-end d-none d-md-inline-block">
                            <div class="btn-group mb-2">
                                <button type="button" class="btn btn-sm btn-light">Hoy</button>
                                <button type="button" class="btn btn-sm btn-light active">Semanalmente</button>
                                <button type="button" class="btn btn-sm btn-light">Mensual</button>
                            </div>
                        </div>
                        <h4 class="card-title mb-4">Análisis de ingresos</h4>
                        <div>
                            <div id="line-column-chart" class="apex-charts" dir="ltr"></div>
                        </div>
                    </div>

                    <div class="card-body border-top text-center">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="d-inline-flex">
                                    <h5 class="me-2">$12,253</h5>
                                    <div class="text-success">
                                        <i class="mdi mdi-menu-up font-size-14"> </i>2.2 %
                                    </div>
                                </div>
                                <p class="text-muted text-truncate mb-0">Este mes</p>
                            </div>

                            <div class="col-sm-4">
                                <div class="mt-4 mt-sm-0">
                                    <p class="mb-2 text-muted text-truncate"><i
                                            class="mdi mdi-circle text-primary font-size-10 me-1"></i> Este año:</p>
                                    <div class="d-inline-flex">
                                        <h5 class="mb-0 me-2">$ 34,254</h5>
                                        <div class="text-success">
                                            <i class="mdi mdi-menu-up font-size-14"> </i>2.1 %
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mt-4 mt-sm-0">
                                    <p class="mb-2 text-muted text-truncate"><i
                                            class="mdi mdi-circle text-success font-size-10 me-1"></i> Año anterior:
                                    </p>
                                    <div class="d-inline-flex">
                                        <h5 class="mb-0">$ 32,695</h5>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="float-end">
                            <select class="form-select form-select-sm">
                                <option selected>Abr</option>
                                <option value="1">Mar</option>
                                <option value="2">Feb</option>
                                <option value="3">Ene</option>
                            </select>
                        </div>
                        <h4 class="card-title mb-4">Análisis de ventas</h4>

                        <div id="donut-chart" class="apex-charts"></div>

                        <div class="row">
                            <div class="col-4">
                                <div class="text-center mt-4">
                                    <p class="mb-2 text-truncate"><i
                                            class="mdi mdi-circle text-primary font-size-10 me-1"></i> Producto A</p>
                                    <h5>42 %</h5>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="text-center mt-4">
                                    <p class="mb-2 text-truncate"><i
                                            class="mdi mdi-circle text-success font-size-10 me-1"></i> Producto B</p>
                                    <h5>26 %</h5>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="text-center mt-4">
                                    <p class="mb-2 text-truncate"><i
                                            class="mdi mdi-circle text-warning font-size-10 me-1"></i> Producto C</p>
                                    <h5>42 %</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="dropdown float-end">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Reporte de ventas</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Reporte de exportacion</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Lucro</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Acción</a>
                            </div>
                        </div>

                        <h4 class="card-title mb-4">Informes de ingresos</h4>
                        <div class="text-center">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div>
                                        <div class="mb-3">
                                            <div id="radialchart-1" class="apex-charts"></div>
                                        </div>

                                        <p class="text-muted text-truncate mb-2">Ingresos semanales</p>
                                        <h5 class="mb-0">$2,523</h5>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="mt-5 mt-sm-0">
                                        <div class="mb-3">
                                            <div id="radialchart-2" class="apex-charts"></div>
                                        </div>

                                        <p class="text-muted text-truncate mb-2">Ingresos mensuales</p>
                                        <h5 class="mb-0">$11,235</h5>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="dropdown float-end">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Reporte de ventas</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Reporte de exportacion</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Lucro</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Acción</a>
                            </div>
                        </div>

                        <h4 class="card-title mb-3">Fuentes</h4>

                        <div>
                            <div class="text-center">
                                <p class="mb-2">Fuentes totales</p>
                                <h4>$ 7652</h4>
                                <div class="text-success">
                                    <i class="mdi mdi-menu-up font-size-14"> </i>2.2 %
                                </div>
                            </div>

                            <div class="table-responsive mt-4">
                                <table class="table table-hover mb-0 table-centered table-nowrap">
                                    <tbody>
                                        <tr>
                                            <td style="width: 60px;">
                                                <div class="avatar-xs">
                                                    <div class="avatar-title rounded-circle bg-light">
                                                        <img src="assets/images/companies/img-1.png" alt="img-1"
                                                            height="20">
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <h5 class="font-size-14 mb-0">Fuente 1</h5>
                                            </td>
                                            <td>
                                                <div id="spak-chart1"></div>
                                            </td>
                                            <td>
                                                <p class="text-muted mb-0">$ 2478</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="avatar-xs">
                                                    <div class="avatar-title rounded-circle bg-light">
                                                        <img src="assets/images/companies/img-2.png" alt="img-2"
                                                            height="20">
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="font-size-14 mb-0">Fuente 2</h5>
                                            </td>

                                            <td>
                                                <div id="spak-chart2"></div>
                                            </td>
                                            <td>
                                                <p class="text-muted mb-0">$ 2625</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="avatar-xs">
                                                    <div class="avatar-title rounded-circle bg-light">
                                                        <img src="assets/images/companies/img-3.png" alt="img-3"
                                                            height="20">
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="font-size-14 mb-0">Fuente 3</h5>
                                            </td>
                                            <td>
                                                <div id="spak-chart3"></div>
                                            </td>
                                            <td>
                                                <p class="text-muted mb-0">$ 2856</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="text-center mt-4">
                                <a href="#" class="btn btn-primary btn-sm">Ver más</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="dropdown float-end">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Reporte de ventas</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Reporte de exportacion</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Lucro</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Acción</a>
                            </div>
                        </div>

                        <h4 class="card-title mb-4">Fuente de actividad reciente</h4>

                        <div data-simplebar style="max-height: 330px;">
                            <ul class="list-unstyled activity-wid">
                                <li class="activity-list">
                                    <div class="activity-icon avatar-xs">
                                        <span class="avatar-title bg-soft-primary text-primary rounded-circle">
                                            <i class="ri-edit-2-fill"></i>
                                        </span>
                                    </div>
                                    <div>
                                        <div>
                                            <h5 class="font-size-13">28 Abr, 2020 <small class="text-muted">12:07
                                                    am</small></h5>
                                        </div>

                                        <div>
                                            <p class="text-muted mb-0">Respondió a la necesidad de “Actividades de Voluntariado”</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="activity-list">
                                    <div class="activity-icon avatar-xs">
                                        <span class="avatar-title bg-soft-primary text-primary rounded-circle">
                                            <i class="ri-user-2-fill"></i>
                                        </span>
                                    </div>
                                    <div>
                                        <div>
                                            <h5 class="font-size-13">21 Abr, 2020 <small class="text-muted">08:01
                                                    pm</small></h5>
                                        </div>

                                        <div>
                                            <p class="text-muted mb-0">Se agregó un interés "Actividades de voluntariado"</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="activity-list">
                                    <div class="activity-icon avatar-xs">
                                        <span class="avatar-title bg-soft-primary text-primary rounded-circle">
                                            <i class="ri-bar-chart-fill"></i>
                                        </span>
                                    </div>
                                    <div>
                                        <div>
                                            <h5 class="font-size-13">17 Abr, 2020 <small class="text-muted">09:23
                                                    am</small></h5>
                                        </div>

                                        <div>
                                            <p class="text-muted mb-0">Se unió al grupo “Boardsmanship Forum”</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="activity-list">
                                    <div class="activity-icon avatar-xs">
                                        <span class="avatar-title bg-soft-primary text-primary rounded-circle">
                                            <i class="ri-mail-fill"></i>
                                        </span>
                                    </div>
                                    <div>
                                        <div>
                                            <h5 class="font-size-13">11 Abr, 2020 <small class="text-muted">05:10
                                                    pm</small></h5>
                                        </div>

                                        <div>
                                            <p class="text-muted mb-0">Respondió a la necesidad de "oportunidad en especie"</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="activity-list">
                                    <div class="activity-icon avatar-xs">
                                        <span class="avatar-title bg-soft-primary text-primary rounded-circle">
                                            <i class="ri-calendar-2-fill"></i>
                                        </span>
                                    </div>
                                    <div>
                                        <div>
                                            <h5 class="font-size-13">07 Abr, 2020 <small class="text-muted">12:47
                                                    pm</small></h5>
                                        </div>

                                        <div>
                                            <p class="text-muted mb-0">Necesidad creada “Actividades de Voluntariado”</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="activity-list">
                                    <div class="activity-icon avatar-xs">
                                        <span class="avatar-title bg-soft-primary text-primary rounded-circle">
                                            <i class="ri-edit-2-fill"></i>
                                        </span>
                                    </div>
                                    <div>
                                        <div>
                                            <h5 class="font-size-13">05 Abr, 2020 <small class="text-muted">03:09
                                                    pm</small></h5>
                                        </div>

                                        <div>
                                            <p class="text-muted mb-0">Asistir al evento “Algún evento nuevo”</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="activity-list">
                                    <div class="activity-icon avatar-xs">
                                        <span class="avatar-title bg-soft-primary text-primary rounded-circle">
                                            <i class="ri-user-2-fill"></i>
                                        </span>
                                    </div>
                                    <div>
                                        <div>
                                            <h5 class="font-size-13">02 Abr, 2020 <small class="text-muted">12:07
                                                    am</small></h5>
                                        </div>

                                        <div>
                                            <p class="text-muted mb-0">Respondió a la necesidad de "oportunidad en especie"</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="dropdown float-end">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Reporte de ventas</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Reporte de exportacion</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Lucro</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Acción</a>
                            </div>
                        </div>

                        <h4 class="card-title mb-4">Ingresos por ubicaciones</h4>

                        <div id="usa-vectormap" style="height: 196px"></div>

                        <div class="row justify-content-center">
                            <div class="col-xl-5 col-md-6">
                                <div class="mt-2">
                                    <div class="clearfix py-2">
                                        <h5 class="float-end font-size-16 m-0">$ 2542</h5>
                                        <p class="text-muted mb-0 text-truncate">Cucuta :</p>

                                    </div>
                                    <div class="clearfix py-2">
                                        <h5 class="float-end font-size-16 m-0">$ 2245</h5>
                                        <p class="text-muted mb-0 text-truncate">Cucuta :</p>

                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-5 offset-xl-1 col-md-6">
                                <div class="mt-2">
                                    <div class="clearfix py-2">
                                        <h5 class="float-end font-size-16 m-0">$ 2156</h5>
                                        <p class="text-muted mb-0 text-truncate">Chitaga :</p>

                                    </div>
                                    <div class="clearfix py-2">
                                        <h5 class="float-end font-size-16 m-0">$ 1845</h5>
                                        <p class="text-muted mb-0 text-truncate">Chitaga :</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <a href="#" class="btn btn-primary btn-sm">Aprende más</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row">
           
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="dropdown float-end">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Action</a>
                            </div>
                        </div>

                        <h4 class="card-title mb-4">Ultimas transacciones</h4>

                        <div class="table-responsive">
                            <table class="table table-centered datatable dt-responsive nowrap" data-bs-page-length="5"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>FECHA</th>
                                        <th>PRODUCTO</th>
                                        <th>ESTADO</th>
                                        <th>Cantidad</th>
                                       
                                    </tr>
                                </thead>
                                <tbody id="datos">
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>

</div>
<!-- End Page-content -->

<!-- apexcharts -->
<script src="../assets/libs/apexcharts/apexcharts.min.js"></script>

<!-- jquery.vectormap map -->
<script src="../assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js"></script>

<!-- Required datatable js -->
<script src="../assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

<!-- Responsive examples -->
<script src="../assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="../assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<script src="../assets/js/pages/dashboard.init.js"></script>