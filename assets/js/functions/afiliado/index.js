$(document).ready(function(){
    	ver_registros_t();
	mis_afiliados();
	mi_porcentaje();
	mi_saldo();
	ver_registros2();
	ver_registros_t_json();

});


function registrar(){
	var result = function_ajax({
		'op':'retirar',
	
		'valor':$("#valoragg").val()
}	,'../controller/transaccionesController.php').then(function(result){
	if(result=="1"){
		alert_success();
		$("#valoragg").val("");
	}
	}).catch(function(error) {console.log('Error:', error);});
}


function ver_registros_t(){
	
	var result = function_ajax({
		'op':'buscar_id_group'
}	,'../controller/ramasController.php').then(function(result){
	$("#datos").html(result);

	}).catch(function(error) {console.log('Error:', error);});
}

function ver_registros_t_json(){
	
	var result = function_ajax({
		'op':'buscar_id_group_json'
}	,'../controller/ramasController.php').then(function(result){
	result = JSON.parse(result);
	general_pie_register(result)

	}).catch(function(error) {console.log('Error:', error);});
}



function mis_afiliados(){

	var result = function_ajax({
		'op':'mis_afiliados'
}	,'../controller/ramasController.php').then(function(result){
	$("#afiliados").html(result);
	}).catch(function(error) {console.log('Error:', error);});
}

function mi_porcentaje(){

	var result = function_ajax({
		'op':'mi_porcentaje'
}	,'../controller/ramasController.php').then(function(result){
	$("#porcentaje").html(result);

	}).catch(function(error) {console.log('Error:', error);});
}

function mi_saldo(){

	var result = function_ajax({
		'op':'mi_saldo'
}	,'../controller/ramasController.php').then(function(result){
	$("#saldo").html(result +" USD" );

	}).catch(function(error) {console.log('Error:', error);});
}




function ver_registros2(){

	var result = function_ajax({
		'op':'diagram_id'
}	,'../controller/ramasController.php').then(function(result){
	result = JSON.parse(result);
	generate_diagram(result);
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
}	,'../controller/ramasController.php').then(function(result){
	if(result=="1"){
		alert_success_status();
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
}			,'../controller/ramasController.php').then(function(result){
			if(result=="1"){
				ver_registros();
				Swal.fire("Eliminado!", "La registro fue eliminado.", "success");
			}
			}).catch(function(error) {console.log('Error:', error);});
		}
	});
}

function cargar_datos(id_ramas,id_usuarios,nivel,archo,porcentaje){
	$("#id").val(id_ramas);
	$("#nivel").val(nivel);
	$("#archo").val(archo);
	$("#porcentaje").val(porcentaje);
	$("#id_usuarios").val(id_usuarios);
}

function modificar(){
	var id =  $("#id_ramas").val();
	var usuarios =  $("#id_usuarios").val();
	var nivel =  $("#nivel").val();
	var archo =  $("#archo").val();
	var porcentaje =  $("#porcentaje").val();
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
				'usuarios': id_usuarios,
				'nivel': nivel,
				'archo': archo,
				'porcentaje': porcentaje,
			},'../controller/ramasController.php').then(function(result){
			if(result=="1"){
				ver_registros();
				Swal.fire("Modificado!", "El registro fue modificado.", "success");
				$('#myModal').modal('hide');
			}
			}).catch(function(error) {console.log('Error:', error);});
		}
	});
}

function generate_diagram(data) {
    
Highcharts.chart('container', {
    title: {
        text: 'Referidos'
    },
    series: [
        {
            type: 'treegraph',
            data,
            tooltip: {
                pointFormat: '{point.name}'
            },
            marker: {
                symbol: 'rect',
                width: '10%'
            },
            borderRadius: 10,
            dataLabels: {
                pointFormat: '{point.name}',
                style: {
                    whiteSpace: 'nowrap'
                }
            },
            levels: [
                {
                    level: 1,
                    levelIsConstant: false
                },
                {
                    level: 2,
                    colorByPoint: true
                },
                {
                    level: 3,
                    colorVariation: {
                        key: 'brightness',
                        to: -0.5
                    }
                },
                {
                    level: 4,
                    colorVariation: {
                        key: 'brightness',
                        to: 0.5
                    }
                }
            ]
        }
    ]
});
}

function generate_diagram2(datos) {
    // Crear un objeto D3.js para el diagrama de árbol

	console.log(datos);
	

	console.log(datos);
	var arbol = d3.tree().size([800, 400]);

    var svg = d3.select("#diagrama").append("svg")
        .attr("width", 1000)
        .attr("height", 500)
        .append("g")
        .attr("transform", "translate(50,50)");

    var jerarquia = d3.stratify()
        .id(function(d) { return d.id_ramas; })
        .parentId(function(d) { return d.referido_padre; })
        (datos);

    var nodos = arbol(jerarquia);

	svg.selectAll("image")
    .data(nodos.descendants())
    .enter().append("image")
    .attr("x", function(d) { return d.x - 12; })  // Ajusta la posición x según el tamaño del icono
    .attr("y", function(d) { return d.y - 12; })  // Ajusta la posición y según el tamaño del icono
    .attr("width", 24)  // Ajusta el ancho del icono
    .attr("height", 24)  // Ajusta la altura del icono
    .attr("xlink:href", "../assets/images/user.png"); 


    // Agregar texto asociado a cada círculo
	svg.selectAll("text")
    .data(nodos.descendants())
    .enter().append("text")
    .attr("x", function(d) { return d.x + 5; })
    .attr("y", function(d) { return d.y; })
    .text(function(d) { return d.data.name; })
    .transition()
    .duration(500);

    // Agregar enlaces al SVG
    svg.selectAll("path")
        .data(nodos.links())
        .enter().append("path")
        .attr("d", function(d) {
            return "M" + d.source.x + "," + d.source.y +
                "C" + d.source.x + "," + (d.source.y + d.target.y) / 2 +
                " " + d.target.x + "," + (d.source.y + d.target.y) / 2 +
                " " + d.target.x + "," + d.target.y;
        })
		.attr("fill", "none")
		.attr("stroke", "#aaa"); // Cambiar el color de las líneas
}

function alert_success(){
	Swal.fire({
		title: 'Listo, se esta procesando su retiro!',
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

function general_pie_register(data){
    
        Highcharts.chart('container2', {
    chart: {
        type: 'pie'
    },
    title: {
        text: 'Grafica'
    },
    tooltip: {
        valueSuffix: '%'
    },
    subtitle: {
        text:
        ''
    },
    plotOptions: {
        series: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: [{
                enabled: true,
                distance: 20
            }, {
                enabled: true,
                distance: -40,
                format: '{point.percentage:.1f}%',
                style: {
                    fontSize: '1.2em',
                    textOutline: 'none',
                    opacity: 0.7
                },
                filter: {
                    operator: '>',
                    property: 'Porcentaje',
                    value: 10
                }
            }]
        }
    },
    series: [
        {
            name: 'Percentage',
            colorByPoint: true,
            data: data
        }
    ]
});

    
}

