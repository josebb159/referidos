<!-- DataTables -->
<link href="../assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<!-- Responsive datatable examples -->
<link href="../assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Lista de usuarios</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Afiliado ClubSky</a></li>
                            <li class="breadcrumb-item active">Listado de usuarios</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Categorias</h4>
                   
                        </p>

                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NOMBRE</th>
                                    <th>APELLIDO</th>
                                    <th>USUARIO</th>
                                    <th>ROL</th>
                                    <th>FECHA REGISTRO</th>
                                    <th>ESTADO</th>
                                    <th>OPCIONES</th>
                                </tr>
                            </thead>


                            <tbody id="datos">
                               
                               
                            </tbody>
                        </table>


                        <button type="button"  class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#modal_agregar">Agregar usuario</button>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

        <!-- end row-->


        


    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->




<div class="col-sm-6 col-md-4 col-xl-3">
                          

                                <!-- sample modal content -->
                                <div id="myModal" class="modal fade" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title mt-0" id="myModalLabel">Modificar usuario</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form class="needs-validation" id="form_2">
                                            <div class="modal-body">
                                            
                                            <div class="row">
                                                              <div class="col-md-6">
                                                                  <div class="mb-6">
                                                                      <input type="hidden" value="" id="id_usuario">
                                                                      <label for="validationCustom01" class="form-label">Nombre del usuario</label>
                                                                      <input type="text" class="form-control" id="nombre"
                                                                          placeholder="Nombre del usuario" value="" required>
                                                          
                                                                  </div>
                                                              </div>
                                                              <div class="col-md-6">
                                                                  <div class="mb-6">
                                                                      <label for="validationCustom02" class="form-label">Apellido</label>
                                                                      <input type="text" class="form-control" id="apellido"
                                                                          placeholder="Apellido" value="" required>
                                                              
                                                                  </div>
                                                              </div>
                                                              </div>
                                                              <div class="row">
                                                         
                                                              <div class="col-md-6">
                                                                  <div class="mb-6">
                                                                      <label for="validationCustom02" class="form-label">Usuario</label>
                                                                      <input type="text" class="form-control" id="usuario"
                                                                          placeholder="Usuario" value="" required>
                                                              
                                                                  </div>
                                                              </div>

                                                              <div class="col-md-6">
                                                                  <div class="mb-6">
                                                                      <label for="validationCustom02" class="form-label">Contraseña</label>
                                                                      <input type="text" class="form-control" id="contrasena"
                                                                          placeholder="contrasena" value="" required>
                                                              
                                                                  </div>
                                                              </div>
                                                          </div>

                                                          <div class="row">
                                                        
                                                            
                                                          </div>

                                                          <div class="row">
                                                              <div class="col-md-12">
                                                                  <div class="mb-12">
                                                                      <label for="validationCustom02" class="form-label">Rol</label>
                                                                     
                                                                      <select name="" class="form-control" id="rol">
                                                                                  

                                                                      </select>
                                                              
                                                                  </div>
                                                              </div>
                                                            
                                                          </div>
                                                      
                                                      
                                                      
                                                            
                                                               
                                                           
                                                
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light waves-effect"
                                                    data-bs-dismiss="modal">Cerrar</button>
                                                <button type="submit"
                                                    class="btn btn-primary waves-effect waves-light" >Guardar</button>
                                            </div>
                                            </form>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                            </div>




                            <div class="col-sm-6 col-md-4 col-xl-3">
                          

                          <!-- sample modal content -->
                          <div id="modal_agregar" class="modal fade" tabindex="-1" role="dialog"
                              aria-labelledby="myModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h5 class="modal-title mt-0" id="myModalLabel">Agregar Usuario</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal"
                                              aria-label="Close"></button>
                                      </div>
                                      <form class="needs-validation" id="form_1">
                                      <div class="modal-body">
                                      
                                                          <div class="row">
                                                              <div class="col-md-6">
                                                                  <div class="mb-6">
                                                 
                                                                      <label for="validationCustom01" class="form-label">Nombre del usuario</label>
                                                                      <input type="text" class="form-control" id="nombreagg"
                                                                          placeholder="Nombre del usuario" value="" required>
                                                          
                                                                  </div>
                                                              </div>
                                                              <div class="col-md-6">
                                                                  <div class="mb-6">
                                                                      <label for="validationCustom02" class="form-label">Apellido</label>
                                                                      <input type="text" class="form-control" id="apellidoagg"
                                                                          placeholder="Apellido" value="" required>
                                                              
                                                                  </div>
                                                              </div>
                                                              </div>
                                                              <div class="row">
                                                         
                                                              <div class="col-md-6">
                                                                  <div class="mb-6">
                                                                      <label for="validationCustom02" class="form-label">Usuario</label>
                                                                      <input type="text" class="form-control" id="usuarioagg"
                                                                          placeholder="Usuario" value="" required>
                                                              
                                                                  </div>
                                                              </div>

                                                              <div class="col-md-6">
                                                                  <div class="mb-6">
                                                                      <label for="validationCustom02" class="form-label">Contraseña</label>
                                                                      <input type="text" class="form-control" id="contrasenaagg"
                                                                          placeholder="contrasena" value="" required>
                                                              
                                                                  </div>
                                                              </div>
                                                          </div>

                                                          <div class="row">
                                                        
                                                            
                                                          </div>

                                                          <div class="row">
                                                              <div class="col-md-12">
                                                                  <div class="mb-12">
                                                                      <label for="validationCustom02" class="form-label">Rol</label>
                                                                     
                                                                      <select name="" class="form-control" id="rolagg">


                                                                      </select>
                                                              
                                                                  </div>
                                                              </div>
                                                            
                                                          </div>
                                                      
                                                      
                                                      
                                                         
                                                     
                                          
                                      </div>
                                      <div class="modal-footer">
                                          <button type="button" class="btn btn-light waves-effect"
                                              data-bs-dismiss="modal">Cerrar</button>
                                          <button type="submit"
                                              class="btn btn-primary waves-effect waves-light" >Agregar</button>
                                      </div>
                                      </form>
                                  </div><!-- /.modal-content -->
                              </div><!-- /.modal-dialog -->
                          </div><!-- /.modal -->
                      </div>



<?php 
$aditionals_js='
<!-- Required datatable js -->
<script src="../assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="../assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="../assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="../assets/libs/jszip/jszip.min.js"></script>
<script src="../assets/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="../assets/libs/pdfmake/build/vfs_fonts.js"></script>
<script src="../assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="../assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="../assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

<script src="../assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="../assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>

<!-- Responsive examples -->
<script src="../assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="../assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<!-- Datatable init js -->
<script src="../assets/js/pages/datatables.init.js"></script>

';

?>
