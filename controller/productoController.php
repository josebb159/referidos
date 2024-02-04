<?php
include '../model/producto.php';

if(isset($_POST['id'])){
	$id =  $_POST['id'];
}

if(isset($_POST['id_categoria'])){
	$id_categoria =  $_POST['id_categoria'];
}

if(isset($_POST['descripcion'])){
	$descripcion =  $_POST['descripcion'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $descripcion)) { die('error descripcion');}
}

if(isset($_POST['valor'])){
	$valor =  $_POST['valor'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $valor)) { die('error valor');}
}


if(isset($_POST['estado'])){
	$estado =  $_POST['estado'];
}

if(isset($_POST['op'])){
	$op =  $_POST['op'];
}

switch ($op) {
	case 'registrar':
		$n_producto  = new producto();
		$resultado = $n_producto  -> registrar_producto('',$id_categoria,$descripcion,$valor,'');
		echo $resultado;
	break;
	case 'buscar':
		$n_producto  = new producto();
		$resultado = $n_producto  -> buscar_producto();
		if($resultado==0){
			exit();
		}
		foreach ($resultado as $key) {
			if($key['estado']=='1'){
				$st = 'checked';
			}else{
				$st = '';
			}
		$key['id']=$key['id_categoria'];
		?>
		<tr>
			<td><?= $key['id_producto']; ?></td>
			<td><?= $key['descripcion']; ?></td>
			<td><?= $key['valor']; ?></td>
			<td><?php include '../view/static/bt_estado.php';  ?></td>
			<td>
				<div class="dropdown">
					<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Acciones
						<i class="mdi mdi-chevron-down"></i>
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="margin: 0px;">
							<a class="dropdown-item" href="#"  data-bs-toggle="modal" data-bs-target="#myModal" onclick="cargar_datos(<?php echo "'".$key['id_producto']."','".$key['descripcion']."','".$key['valor']."'"; ?>)">Modificar</a>
							<a class="dropdown-item" href="#" onclick="eliminar(<?php echo $key['id_producto']; ?>)">Eliminar</a>
						</div>
					</div>
			</td>
		</tr>
		<?php
		}
	break;
	case 'cambiar_estado':
		$n_producto  = new producto();
		$resultado = $n_producto  -> cambiar_estado_producto($id, $estado);
		echo 1;
	break;
	case 'eliminar':
		$n_producto  = new producto();
		$resultado = $n_producto  -> eliminar_producto($id);
		echo 1;
	break;
	case 'buscar_select':
		$n_producto  = new producto();
		$resultado = $n_producto  -> buscar_producto();
		foreach ($resultado as $key) {
		?>
			<option value="<?php echo $key['id']; ?>"><?php echo $key['descripcion']; ?></option>;
		<?php
		}
	break;
	case 'buscar_json':
		$n_producto  = new producto();
		$resultado = $n_producto  -> buscar_json_producto($id);
		echo $resultado;
	break;
	case 'modificar':
		$n_producto  = new producto();
		$resultado = $n_producto  -> modificar_producto($id,$id_categoria,$descripcion,$valor);
		echo 1;
	break;
	case 'rango':
		$n_producto  = new producto();
		$resultado = $n_producto  -> rango($id,$descripcion,$valor,$estado);
	break;
	default:
	break;
}
