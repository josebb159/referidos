<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/tmp'));
include '../model/transacciones.php';

if(isset($_POST['id'])){
	$id =  $_POST['id'];
}

if(isset($_POST['id_usuarios'])){
	$id_usuarios =  $_POST['id_usuarios'];
}

if(isset($_POST['entrada'])){
	$entrada =  $_POST['entrada'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $entrada)) { die('error entrada');}
}

if(isset($_POST['salida'])){
	$salida =  $_POST['salida'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $salida)) { die('error salida');}
}

if(isset($_POST['valor'])){
	$valor =  $_POST['valor'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $valor)) { die('error valor');}
}

if(isset($_POST['porcentaje'])){
	$porcentaje =  $_POST['porcentaje'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $porcentaje)) { die('error porcentaje');}
}


if(isset($_POST['estado'])){
	$estado =  $_POST['estado'];
}

if(isset($_POST['op'])){
	$op =  $_POST['op'];
}

switch ($op) {
	case 'registrar':
		$n_transacciones  = new transacciones();
		$resultado = $n_transacciones  -> registrar_transacciones('',$id_usuarios,$entrada,$salida,$valor,$porcentaje,'');
		echo $resultado;
	break;
	case 'buscar':
		$n_transacciones  = new transacciones();
		$resultado = $n_transacciones  -> buscar_transacciones();
		if($resultado==0){
			exit();
		}
		foreach ($resultado as $key) {
			if($key['estado']=='1'){
				$st = 'checked';
			}else{
				$st = '';
			}
		$key['id']=$key['id_transacciones'];
		?>
		<tr>
			<td><?= $key['id_transacciones']; ?></td>
			<td><?= $key['entrada']; ?></td>
			<td><?= $key['salida']; ?></td>
			<td><?= $key['valor']; ?> USD</td>
			<td><?= $key['porcentaje']; ?></td>
			<td><?php include '../view/static/bt_estado.php';  ?></td>
			<td>
				<div class="dropdown">
					<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Acciones
						<i class="mdi mdi-chevron-down"></i>
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="margin: 0px;">
							<a class="dropdown-item" href="#"  data-bs-toggle="modal" data-bs-target="#myModal" onclick="cargar_datos(<?php echo "'".$key['id_transacciones']."','".$key['entrada']."','".$key['salida']."','".$key['valor']."','".$key['porcentaje']."'"; ?>)">Modificar</a>
							<a class="dropdown-item" href="#" onclick="eliminar(<?php echo $key['id_transacciones']; ?>)">Eliminar</a>
						</div>
					</div>
			</td>
		</tr>
		<?php
		}
	break;
	case 'buscar_pagar':
		$n_transacciones  = new transacciones();
		$resultado = $n_transacciones  -> buscar_transacciones();
		if($resultado==0){
			exit();
		}
		foreach ($resultado as $key) {
			if($key['estado']=='1'){
				$st = 'checked';
			}else{
				$st = '';
			}
		$key['id']=$key['id_transacciones'];
		?>
		<tr>
			<td><?= $key['id_transacciones']; ?></td>
			<td><?= $key['entrada']; ?></td>
			<td><?= $key['salida']; ?></td>
			<td><?= $key['valor']; ?> USD</td>
			<td><?= $key['porcentaje']; ?></td>
			<td><?php include '../view/static/bt_estado.php';  ?></td>
			<td>
			    
				<div class="dropdown">
					<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Acciones
						<i class="mdi mdi-chevron-down"></i>
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="margin: 0px;">
							<a class="dropdown-item" href="#"   onclick="pagar(<?php echo "'".$key['id_transacciones']."','".$key['id_usuarios']."','".$key['valor']."'"; ?>)">Pagar</a>
							<a class="dropdown-item" href="#" onclick="eliminar(<?php echo $key['id_transacciones']; ?>)">Eliminar</a>
						</div>
					</div>
			</td>
		</tr>
		<?php
		}
	break;
	case 'buscar_id':
		$n_transacciones  = new transacciones();
		session_start();
		$resultado = $n_transacciones  -> buscar_transacciones_id($_SESSION['id_usuario']);
		if($resultado==0){
			exit();
		}
		foreach ($resultado as $key) {
			if($key['estado']=='1'){
				$st = 'checked';
			}else{
				$st = '';
			}
				$tipo = "Ingreso";
			if($key['entrada']==1){
			    $tipo = "Descuento";
			}
			if($key['salida']==2){
			    $tipo = "Retiro";
			}
		$key['id']=$key['id_transacciones'];
		?>
		<tr>
			<td><?= $key['id_transacciones']; ?></td>
			<td><?= "Nuevo referido"; ?></td>
			<td><?= $tipo ?></td>
			<td><?= $key['valor']; ?> USD</td>
			<td><?= $key['porcentaje']; ?></td>
			
		
		</tr>
		<?php
		}
	break;
	case 'descuenta':
		$n_transacciones  = new transacciones();
		
		$resultado = $n_transacciones  -> descontar($id_usuarios,$id,$valor);
		echo 1;
	break;
	case 'retirar':
		$n_transacciones  = new transacciones();
		session_start();
		$resultado = $n_transacciones  -> registrar_retiro($_SESSION['id_usuario'],$valor);
		echo 1;
	break;
		case 'cambiar_estado':
		$n_transacciones  = new transacciones();
		$resultado = $n_transacciones  -> cambiar_estado_transacciones($id, $estado);
		echo 1;
	break;
	case 'eliminar':
		$n_transacciones  = new transacciones();
		$resultado = $n_transacciones  -> eliminar_transacciones($id);
		echo 1;
	break;
	case 'buscar_select':
		$n_transacciones  = new transacciones();
		$resultado = $n_transacciones  -> buscar_transacciones();
		foreach ($resultado as $key) {
		?>
			<option value="<?php echo $key['id']; ?>"><?php echo $key['descripcion']; ?></option>;
		<?php
		}
	break;
	case 'buscar_json':
		$n_transacciones  = new transacciones();
		$resultado = $n_transacciones  -> buscar_json_transacciones($id);
		echo $resultado;
	break;
	case 'modificar':
		$n_transacciones  = new transacciones();
		$resultado = $n_transacciones  -> modificar_transacciones($id,$id_usuarios,$entrada,$salida,$valor,$porcentaje);
		echo 1;
	break;
	case 'estadistica':
		$n_transacciones  = new transacciones();
		$resultado = $n_transacciones  -> estadistica($id,$entrada,$salida,$valor,$porcentaje,$estado);
	break;
	default:
	break;
}
