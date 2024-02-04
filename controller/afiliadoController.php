<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/tmp'));
include '../model/afiliado.php';

if(isset($_POST['id'])){
	$id =  $_POST['id'];
}

if(isset($_POST['id_usuarios'])){
	$id_usuarios =  $_POST['id_usuarios'];
}

if(isset($_POST['nombre'])){
	$nombre =  $_POST['nombre'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $nombre)) { die('error nombre');}
}

if(isset($_POST['apellido'])){
	$apellido =  $_POST['apellido'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $apellido)) { die('error apellido');}
}

if(isset($_POST['codigo'])){
	$codigo =  $_POST['codigo'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $codigo)) { die('error codigo');}
}

if(isset($_POST['img'])){
	$img =  $_POST['img'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $img)) { die('error img');}
}

if(isset($_POST['telefono'])){
	$telefono =  $_POST['telefono'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $telefono)) { die('error telefono');}
}


if(isset($_POST['estado'])){
	$estado =  $_POST['estado'];
}

if(isset($_POST['op'])){
	$op =  $_POST['op'];
}

switch ($op) {
	case 'registrar':
		$n_afiliado  = new afiliado();
		$resultado = $n_afiliado  -> registrar_afiliado('',$id_usuarios,$nombre,$apellido,$codigo,$img,$telefono,'');
		echo $resultado;
	break;
	case 'buscar':
		$n_afiliado  = new afiliado();
		$resultado = $n_afiliado  -> buscar_afiliado();
		if($resultado==0){
			exit();
		}
		foreach ($resultado as $key) {
			if($key['estado']=='1'){
				$st = 'En espera';
				
			}elseif($key['estado']=='2'){
				$st = 'Aprobado';
			}else{
				$st = 'Rechazado';
			}
		$key['id']=$key['id_afiliado'];
		?>
		<tr>
			<td><?= $key['id_afiliado']; ?></td>
			<td><?= $key['nombre']; ?></td>
			<td><?= $key['apellido']; ?></td>
			<td><?= $key['codigo']; ?></td>
			<td><?= $key['img']; ?></td>
			<td><?= $key['telefono']; ?></td>
			<td><?php echo $st;  ?></td>
			<td>
				<div class="dropdown" <?php if ($key['estado'] == 2 || $key['estado'] == 3) { echo "style='display:none;'"; } ?>>
					<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Acciones
						<i class="mdi mdi-chevron-down"></i>
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="margin: 0px;">
						<a class="dropdown-item" href="#" onclick="validar_afiliado(<?php echo $key['id_usuarios']; ?>)">Aprobar afiliado</a>
							<a class="dropdown-item" href="#" onclick="cancelar_afiliado(<?php echo $key['id_usuarios']; ?>)">Cancelar afiliado</a>
						</div>
					</div>
			</td>
		</tr>
		<?php
		}
	break; 
	case 'cambiar_estado':
		$n_afiliado  = new afiliado();
		$resultado = $n_afiliado  -> cambiar_estado_afiliado($id, $estado);
		echo 1;
	break;
	case 'validar_afiliado':
		$n_afiliado  = new afiliado();
		$resultado = $n_afiliado  -> validar_afiliado($id);
		echo 1;
	break;
	case 'cancelar_afiliado':
		$n_afiliado  = new afiliado();
		$resultado = $n_afiliado  -> cancelar_afiliado($id);
		echo 1;
	break;
	case 'eliminar':
		$n_afiliado  = new afiliado();
		$resultado = $n_afiliado  -> eliminar_afiliado($id);
		echo 1;
	break;
	case 'buscar_select':
		$n_afiliado  = new afiliado();
		$resultado = $n_afiliado  -> buscar_afiliado();
		foreach ($resultado as $key) {
		?>
			<option value="<?php echo $key['id']; ?>"><?php echo $key['descripcion']; ?></option>;
		<?php
		}
	break;
	case 'buscar_json':
		$n_afiliado  = new afiliado();
		$resultado = $n_afiliado  -> buscar_json_afiliado($id);
		echo $resultado;
	break;
	case 'modificar':
		$n_afiliado  = new afiliado();
		$resultado = $n_afiliado  -> modificar_afiliado($id,$id_usuarios,$nombre,$apellido,$codigo,$img,$telefono);
		echo 1;
	break;
	case 'estadistica':
		$n_afiliado  = new afiliado();
		$resultado = $n_afiliado  -> estadistica($id,$nombre,$apellido,$codigo,$img,$telefono,$estado);
	break;
	default:
	break;
}
