<!-- jquery.vectormap css -->
<link href="../assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet"
    type="text/css" />

<!-- DataTables -->
<link href="../assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<!-- Responsive datatable examples -->
<link href="../assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet"
    type="text/css" />
    
     <style>
    #container {
    max-width: 800px;
    min-width: 360px;
    margin: 0 auto;
    height: 600px;
}




.highcharts-figure,
.highcharts-data-table table {
    min-width: 320px;
    max-width: 800px;
    margin: 1em auto;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
    padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

input[type="number"] {
    min-width: 50px;
}




 </style>

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Dashboard</h4>

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
                            <div class="card-body" style="background-color: #bb13d9; color:#ffffff"> 
                                <div class="d-flex">
                                    <div class="flex-1 overflow-hidden">
                                        <p class="text-truncate font-size-14 mb-2">Afiliados</p>
                                        <h4 class="mb-0" id="afiliados"  style="color:#ffffff">0</h4>
                                    </div>
                                    <div class="text-primary ms-auto">
                                    <i class="mdi dripicons-network-3  mdi-36px" style="color:#ffffff"></i>
                                    </div>
                                </div>
                            </div>

                           
                        </div>
                    </div> 
                    <div class="col-md-4" style="display:none">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-1 overflow-hidden">
                                        <p class="text-truncate font-size-14 mb-2">Tu porcentaje</p>
                                        <h4 class="mb-0" id="porcentaje">0</h4>
                                    </div>
                                    <div class="text-primary ms-auto">
                                    <i class="mdi mdi-file-percent  mdi-36px"></i>
                                   
                                    
                                    </div>
                                </div>
                            </div>
                         
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body"  style="background-color: #812df5; color:#ffffff">
                                <div class="d-flex">
                                    <div class="flex-1 overflow-hidden">
                                        <p class="text-truncate font-size-14 mb-2">Monedero</p>
                                        <h4 class="mb-0" id="saldo" style="color: #ffffff !important;">0</h4>
                                        <label >Monto mínimo de retiro (5 USD)</label>
                                        <div class="progress-bar bg-success
                                    progress-bar-striped progress-bar-animated" style="width: 33.3333%;"></div>
                                    </div>
                                    <div class="text-primary ms-auto">
                                     <i class="mdi dripicons-wallet mdi-36px" style="color: #ffffff;"></i>
                                     <input type="button"  data-bs-toggle="modal" data-bs-target="#modal_agregar" value="Retirar" class="form-control">
                                    </div>
                                </div>
                            </div>
                         
                        </div>
                    </div>
                   
                </div>
                <!-- end row -->


            <!-- end col -->
        </div> <!-- end row-->

                <div class="card">
                    <div class="card-body">
                      
                        <h4 class="card-title mb-4">Tu red</h4>
                        <div>
                            <div id="line-column-chart" class="apex-charts" dir="ltr"></div>
                        </div>
                    </div>

                    <div class="card-body border-top text-center">
                        <div class="row">
                       
                           
                            <div class="col-sm-12">
                                <div class="mt-12 mt-sm-0">
                                <div id="diagrama"></div>
                                
                                
                                
                                
                                <script src="https://code.highcharts.com/highcharts.js"></script>
                                <script src="https://code.highcharts.com/modules/treemap.js"></script>
                                <script src="https://code.highcharts.com/modules/treegraph.js"></script>
                                <script src="https://code.highcharts.com/modules/exporting.js"></script>
                                <script src="https://code.highcharts.com/modules/accessibility.js"></script>
                                
                                <div id="container"></div>
                                
                                
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                   <div class="card">
                    <div class="card-body">
                      
                        <h4 class="card-title mb-4">Registros</h4>
                        <div>
                            <div id="line-column-chart" class="apex-charts" dir="ltr"></div>
                        </div>
                    </div>

                    <div class="card-body border-top text-center">
                        <div class="row">
                       
                           
                            <div class="col-sm-12">
                                <div class="mt-12 mt-sm-0">
                                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        							<thead>
        								<th>Referidos</th>
        								<th>Nivel</th>
        								<th>Porcentaje</th>
        						
        							<thead>
        							<tbody id="datos">
        							</tbody>
        						</table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            
            
            
            
            
            
                 <div class="row">
            <div class="col-xl-5">
                <!-- card -->
                <div class="card card-h-100">
                    <!-- card body -->
                    <div class="card-body">
                        <div class="d-flex flex-wrap align-items-center mb-4">
                            <h5 class="card-title me-2">Balance de registro</h5>
                       
                        </div>

                        <div class="row align-items-center">
                            <div class="col-sm">
                               <div id="container2"></div>
                            </div>
                          
                        </div>
                    </div>
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
            <div class="col-xl-7">
                <div class="row">
                    <div class="col-xl-8">
                        <!-- card -->
                        <div class="card card-h-100">
                            <!-- card body -->
                            <div class="card-body">
                                <div class="d-flex flex-wrap align-items-center
                                    mb-4">
                                    <h5 class="card-title me-2">Analitica por mes</h5>
                                    <div class="ms-auto">
                                        <select class="form-select
                                            form-select-sm">
                                            <option value="1" selected="">Enero</option>
                                            <option value="2">Febrero</option>
                                            <option value="3">Marzo</option>
                                            <option value="4">Abril</option>
                                            <option value="5">Mayo</option>
                                            <option value="6">Junio</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row align-items-center">
                                    <div class="col-sm">
                                          <div id="container3"></div>
                                    </div>
                              
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->

                    <div class="col-xl-4">
                        <!-- card -->
                        <div class="card bg-primary text-white shadow-primary
                            card-h-100">
                            <!-- card body -->
                            <div class="card-body p-0">
                                <div id="carouselExampleCaptions"
                                    class="carousel slide text-center
                                    widget-carousel" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <div class="text-center p-4">
                                                <i class="mdi mdi-bitcoin
                                                    widget-box-1-icon"></i>
                                                <div class="avatar-md m-auto">
                                                    <span class="avatar-title
                                                        rounded-circle
                                                        bg-soft-light text-white
                                                        font-size-24">
                                                        <i class="mdi
                                                            mdi-currency-btc"></i>
                                                    </span>
                                                </div>
                                                <h4 class="mt-3 lh-base
                                                    fw-normal text-white"><b>Bitcoin</b>
                                                    News</h4>
                                                <p class="text-white-50
                                                    font-size-13">Bitcoin prices
                                                    fell sharply amid the global
                                                    sell-off in equities.
                                                    Negative news
                                                    over the Bitcoin past week
                                                    has dampened Bitcoin basics
                                                    sentiment for bitcoin. </p>
                                                <button type="button" class="btn
                                                    btn-light btn-sm">View
                                                    details <i class="mdi
                                                        mdi-arrow-right ms-1"></i></button>
                                            </div>
                                        </div>
                                        <!-- end carousel-item -->
                                        <div class="carousel-item">
                                            <div class="text-center p-4">
                                                <i class="mdi mdi-ethereum
                                                    widget-box-1-icon"></i>
                                                <div class="avatar-md m-auto">
                                                    <span class="avatar-title
                                                        rounded-circle
                                                        bg-soft-light text-white
                                                        font-size-24">
                                                        <i class="mdi
                                                            mdi-ethereum"></i>
                                                    </span>
                                                </div>
                                                <h4 class="mt-3 lh-base
                                                    fw-normal text-white"><b>ETH</b>
                                                    News</h4>
                                                <p class="text-white-50
                                                    font-size-13">Bitcoin prices
                                                    fell sharply amid the global
                                                    sell-off in equities.
                                                    Negative news
                                                    over the Bitcoin past week
                                                    has dampened Bitcoin basics
                                                    sentiment for bitcoin. </p>
                                                <button type="button" class="btn
                                                    btn-light btn-sm">View
                                                    details <i class="mdi
                                                        mdi-arrow-right ms-1"></i></button>
                                            </div>
                                        </div>
                                        <!-- end carousel-item -->
                                        <div class="carousel-item">
                                            <div class="text-center p-4">
                                                <i class="mdi mdi-litecoin
                                                    widget-box-1-icon"></i>
                                                <div class="avatar-md m-auto">
                                                    <span class="avatar-title
                                                        rounded-circle
                                                        bg-soft-light text-white
                                                        font-size-24">
                                                        <i class="mdi
                                                            mdi-litecoin"></i>
                                                    </span>
                                                </div>
                                                <h4 class="mt-3 lh-base
                                                    fw-normal text-white"><b>Litecoin</b>
                                                    News</h4>
                                                <p class="text-white-50
                                                    font-size-13">Bitcoin prices
                                                    fell sharply amid the global
                                                    sell-off in equities.
                                                    Negative news
                                                    over the Bitcoin past week
                                                    has dampened Bitcoin basics
                                                    sentiment for bitcoin. </p>
                                                <button type="button" class="btn
                                                    btn-light btn-sm">View
                                                    details <i class="mdi
                                                        mdi-arrow-right ms-1"></i></button>
                                            </div>
                                        </div>
                                        <!-- end carousel-item -->
                                    </div>
                                    <!-- end carousel-inner -->

                                    <div class="carousel-indicators
                                        carousel-indicators-rounded">
                                        <button type="button"
                                            data-bs-target="#carouselExampleCaptions"
                                            data-bs-slide-to="0" class="active"
                                            aria-current="true"
                                            aria-label="Slide 1"></button>
                                        <button type="button"
                                            data-bs-target="#carouselExampleCaptions"
                                            data-bs-slide-to="1"
                                            aria-label="Slide 2"></button>
                                        <button type="button"
                                            data-bs-target="#carouselExampleCaptions"
                                            data-bs-slide-to="2"
                                            aria-label="Slide 3"></button>
                                    </div>
                                    <!-- end carousel-indicators -->
                                </div>
                                <!-- end carousel -->
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            

           <div class="col-sm-6 col-md-4 col-xl-3">
	<div id="modal_agregar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title mt-0" id="myModalLabel">Retirar</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form class="needs-validation" id="form_1">
					<div class="modal-body">
						<div class="row">
							
						
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Limite monto mínimo de retiro (5 dolares)</label>
									<input type="number" min="5" class="form-control" id="valoragg" placeholder="valor USD" value="" required>
								</div>
							</div>
							
						
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Cerrar</button>
						<button type="submit" class="btn btn-primary waves-effect waves-light" >Guardar</button>
					</div>
				</form>
			</div>
		</div>
	</div>


</div>
<!-- End Page-content -->

<!-- apexcharts -->




<?php $aditionals_js='
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

<script src="../../assets/js/pages/dashboard.init.js"></script>

<script src="https://d3js.org/d3.v5.min.js"></script>

<script
    src="assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
<script src="assets/libs/twitter-bootstrap-wizard/prettify.js"></script>
'; ?>

<script>

// Data retrieved from https://netmarketshare.com/
Highcharts.chart('container3', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: 0,
        plotShadow: false
    },
    title: {
        text: 'Browser<br>shares<br>January<br>2022',
        align: 'center',
        verticalAlign: 'middle',
        y: 60
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            dataLabels: {
                enabled: true,
                distance: -50,
                style: {
                    fontWeight: 'bold',
                    color: 'white'
                }
            },
            startAngle: -90,
            endAngle: 90,
            center: ['50%', '75%'],
            size: '110%'
        }
    },
    series: [{
        type: 'pie',
        name: 'Browser share',
        innerSize: '50%',
        data: [
            ['Chrome', 73.86],
            ['Edge', 11.97],
            ['Firefox', 5.52],
            ['Safari', 2.98],
            ['Internet Explorer', 1.90],
            ['Other', 3.77]
        ]
    }]
});

$(document).ready(function() {
    $('#basic-pills-wizard').bootstrapWizard({
        'tabClass': 'nav nav-pills nav-justified'
    });

    $('#progrss-wizard').bootstrapWizard({onTabShow: function(tab, navigation, index) {
        var $total = navigation.find('li').length;
        var $current = index+1;
        var $percent = ($current/$total) * 100;
        $('#progrss-wizard').find('.progress-bar').css({width:$percent+'%'});
    }});

});

    
</script>

