$(document).ready(function(){
	ver_registros();
});

function registrar(){
	var result = function_ajax({
		'op':'registrar',
		'nombre': $("#nombre").val(),
		'apellido': $("#apellido").val(),
		'usuario': $("#usuario").val(),
		'contrasena': $("#contrasena").val(),
		'estado':'1'
}	,'../controller/usuarioController.php');
	if(result=="1"){
		alert_success();
		$("#nombre").val("");
		$("#apellido").val("");
		$("#usuario").val("");
		$("#contrasena").val("");
	}
}

function ver_registros(){
	var table = $('#datatable-buttons').DataTable();
	table.destroy();

	var result = function_ajax({
		'op':'buscar'
}	,'../controller/usuarioController.php').then(function(result){

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
}	,'../controller/usuarioController.php');
	if(result=="1"){
		alert_success();
	}
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
				'op':'cambiar_estado',
				'id': id
}			,'../controller/usuarioController.php');
			if(result=="1"){
				ver_registros();
				Swal.fire("Eliminado!", "La registro fue eliminado.", "success");
			}
		}
	});
}

function cargar_datos(id,nombre,apellido,usuario,contrasena,estado){
	$("#id").val(id);
	$("#nombre").val(nombre);
	$("#apellido").val(apellido);
	$("#usuario").val(usuario);
	$("#contrasena").val(contrasena);
	$("#estado").val(estado);
}

function modificar(){
	var id =  $("#id").val();
	var nombre =  $("#nombre").val();
	var apellido =  $("#apellido").val();
	var usuario =  $("#usuario").val();
	var contrasena =  $("#contrasena").val();
	Swal.fire({
		title: "Estas seguro de modificar este registro?",
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
				'op':'modificar',
				'id': id,
				'nombre': nombre,
				'apellido': apellido,
				'usuario': usuario,
				'contrasena': contrasena,
			},'../controller/usuarioController.php');
			if(result=="1"){
				ver_registros();
				Swal.fire("Modificado!", "El registro fue modificado.", "success");
				$('#myModal').modal('hide');
			}
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

function alert_warning(){
	Swal.fire({
		title: 'Error al registrar la categoria!',
		text: 'Preciona el boton para aceptar!',
		icon: 'warning',
		confirmButtonColor: '#5664d2'
	});
}

$('#sa-warning').click(function () {
});

$("#form_1").on('submit', function(evt){
	evt.preventDefault();  
	modificar();
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

