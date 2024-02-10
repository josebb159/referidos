$(document).ready(function(){
 ver_registros();
 ver_usuarios();
});


function ver_usuarios(){

	var result = function_ajax({
		'op':'buscar_select'
}	,'../controller/usuarioController.php').then(function(result){
	$("#list_user").html(result);
	}).catch(function(error) {console.log('Error:', error);});
	

}


function async(){


	var result = function_ajax({
		'op':'asyncUser'
}	,'../controller/asyncUserController.php').then(function(result){

	alert_success_async();
	}).catch(function(error) {console.log('Error:', error);});
}

function registrar(){
	var result = function_ajax({
		'op':'registrar',
		'id_usuarios': $("#id_usuariosagg").val(),
		'nombre': $("#nombreagg").val(),
		'apellido': $("#apellidoagg").val(),
		'codigo': $("#codigoagg").val(),
		'img': $("#imgagg").val(),
		'telefono': $("#telefonoagg").val(),
		'estado':'1'
}	,'../controller/afiliadoController.php').then(function(result){
	if(result=="1"){
		alert_success();
		ver_registros();
		$("#nombreagg").val("");
		$("#apellidoagg").val("");
		$("#codigoagg").val("");
		$("#imgagg").val("");
		$("#telefonoagg").val("");
		$("#id_usuariosagg").val("");
	}
	}).catch(function(error) {console.log('Error:', error);});
}

function ver_registros(){
	var table = $('#datatable-buttons').DataTable();
	table.destroy();
	var result = function_ajax({
		'op':'buscar'
}	,'../controller/asyncUserController.php').then(function(result){
	$("#datos").html(result);
	$('#datatable-buttons').DataTable( {
		dom: 'Bfrtip',
		buttons: [
			'copy', 'csv', 'excel', 'pdf', 'print'
		]
	});
	}).catch(function(error) {console.log('Error:', error);});
}

function cambiar_estado(id, estado){
	if(estado==1){
		estado=0
	}else{
		estado=1
	}
	var result = function_ajax({
		'op':'cambiar_estado',
		'id': id,
		'estado':estado
}	,'../controller/afiliadoController.php').then(function(result){
	if(result=="1"){
		alert_success_status();
	}
	}).catch(function(error) {console.log('Error:', error);});
}

function validar_afiliado(id){
	
	var result = function_ajax({
		'op':'validar_afiliado',
		'id': id,
}	,'../controller/afiliadoController.php').then(function(result){
	if(result=="1"){
		alert_success_status();
		ver_registros();
	}
	}).catch(function(error) {console.log('Error:', error);});
}

function cancelar_afiliado(id){
	
	var result = function_ajax({
		'op':'cancelar_afiliado',
		'id': id,
}	,'../controller/afiliadoController.php').then(function(result){
	if(result=="1"){
		alert_success_status();
		ver_registros();
	}
	}).catch(function(error) {console.log('Error:', error);});
}


function eliminar( id ){
	Swal.fire({
		title: "Estas seguro de eliminar este registro?",
		text: "seleccione las siguentes opciones para continuar!",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#1cbb8c",
		cancelButtonColor: "#ff3d60",
		confirmButtonText: "Si, deseo eliminar",
		cancelButtonText: "Cancelar"
	}).then(function (result) {
		if (result.value) {
			var result = function_ajax({
				'op':'eliminar',
				'id': id
}			,'../controller/afiliadoController.php').then(function(result){
			if(result=="1"){
				ver_registros();
				Swal.fire("Eliminado!", "La registro fue eliminado.", "success");
			}
			}).catch(function(error) {console.log('Error:', error);});
		}
	});
}

function cargar_datos(nombre, correo,numero,codigo,contrasena,){
	$("#nombre").val(nombre);
	$("#correo").val(correo);
	$("#numero").val(numero);
	//$("#codigo").val(codigo);
	$("#contrasena").val(contrasena);
	$("#usuario").val('');
}

function modificar(){
	var nombre =  $("#nombre").val();
	var correo =  $("#correo").val();
	var numero =  $("#numero").val();
	var contrasena =  $("#contrasena").val();
	var codigo =  $("#list_user").val();
	var usuario =  $("#usuario").val();

	Swal.fire({
		title: "Estas seguro de agregar este registro?",
		text: "seleccione las siguentes opciones para continuar!",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#1cbb8c",
		cancelButtonColor: "#ff3d60",
		confirmButtonText: "Si, deseo modificar",
		cancelButtonText: "Cancelar"
	}).then(function (result) {
		if (result.value) {
			var result = function_ajax({
				'op':'send_add',
				'user': usuario,
				'email': correo,
				'name': nombre,
				'codigo': codigo,
				'number': numero,
				'password': contrasena,
		
			},'../controller/asyncUserController.php').then(function(result){
	
				ver_registros();
				Swal.fire("Modificado!", "El registro fue modificado.", "success");
				$('#myModal').modal('hide');
			
			}).catch(function(error) {console.log('Error:', error);});
		}
	});
}

function alert_success(){
	Swal.fire({
		title: 'Listo, has agregado un registro!',
		text: 'Preciona el boton para aceptar!',
		icon: 'success',
		confirmButtonColor: '#5664d2'
	});
}

function alert_success_async(){
	Swal.fire({
		title: 'Se actualizaron los registros!',
		text: 'Preciona el boton para aceptar!',
		icon: 'success',
		confirmButtonColor: '#5664d2'
	});
}

function alert_success_status(){
	Swal.fire({
		title: 'Listo, has cambiado el estado del registro!',
		text: 'Preciona el boton para aceptar!',
		icon: 'success',
		confirmButtonColor: '#5664d2'
	});
}

function alert_warning(){
	Swal.fire({
		title: 'Error al registrar!',
		text: 'Preciona el boton para aceptar!',
		icon: 'warning',
		confirmButtonColor: '#5664d2'
	});
}

$('#sa-warning').click(function () {
});

$("#form_1").on('submit', function(evt){
	evt.preventDefault();  
	registrar();
});

$("#form_2").on('submit', function(evt){
	evt.preventDefault();  
	modificar();
});

function function_ajax(data,url){
	return new Promise(function(resolve, reject) {
		$.post({
			type: 'POST',
			url: url,
			data: data,
			success: function(response){
				resolve(response);
			},
			error: function(error) {
				reject(error);
			}
		});
	});
}
