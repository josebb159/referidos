<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/tmp'));
include '../model/ramas.php';

if(isset($_POST['id'])){
	$id =  $_POST['id'];
}

if(isset($_POST['id_usuarios'])){
	$id_usuarios =  $_POST['id_usuarios'];
}

if(isset($_POST['nivel'])){
	$nivel =  $_POST['nivel'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $nivel)) { die('error nivel');}
}

if(isset($_POST['archo'])){
	$archo =  $_POST['archo'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $archo)) { die('error archo');}
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
		$n_ramas  = new ramas();
		$resultado = $n_ramas  -> registrar_ramas('',$id_usuarios,$nivel,$archo,$porcentaje,'');
		echo $resultado;
	break;
	case 'buscar':
		$n_ramas  = new ramas();
		$resultado = $n_ramas  -> buscar_ramas();
		if($resultado==0){
			exit();
		}
		foreach ($resultado as $key) {
			if($key['estado']=='1'){
				$st = 'checked';
			}else{
				$st = '';
			}
		$key['id']=$key['id_ramas'];
		?>
		<tr>
			<td><?= $key['id_ramas']; ?></td>
			<td><?= $key['nivel']; ?></td>
			<td><?= $key['ancho']; ?></td>
			<td><?= $key['porcentaje']; ?></td>
			<td><?php include '../view/static/bt_estado.php';  ?></td>
			<td>
				<div class="dropdown">
					<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Acciones
						<i class="mdi mdi-chevron-down"></i>
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="margin: 0px;">
							<a class="dropdown-item" href="#"  data-bs-toggle="modal" data-bs-target="#myModal" onclick="cargar_datos(<?php echo "'".$key['id_ramas']."','".$key['nivel']."','".$key['archo']."','".$key['porcentaje']."'"; ?>)">Modificar</a>
							<a class="dropdown-item" href="#" onclick="eliminar(<?php echo $key['id_ramas']; ?>)">Eliminar</a>
						</div>
					</div>
			</td>
		</tr>
		<?php
		}
	break;
	case 'buscar_id':
		$n_ramas  = new ramas();
		session_start();
		$resultado = $n_ramas  -> buscar_ramas_id($_SESSION['id_usuario']);
		if($resultado==0){
			exit();
		}
		foreach ($resultado as $key) {
			if($key['estado']=='1'){
				$st = 'Activo';
			}else{
				$st = 'Inactivo';
			}
		$key['id']=$key['id_ramas'];
		?>
		<tr>
			<td><?= $key['id_ramas']; ?>(<?= $key['name']; ?>) </td>
			<td><?= $key['nivel']; ?></td>
			<td><?= $key['ancho']; ?></td>
			<td><?= $key['porcentaje']; ?></td>
			<td><?= $st; ?></td>
			<td>
				<div class="dropdown">
					<button disabled class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Acciones
						<i class="mdi mdi-chevron-down"></i>
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="margin: 0px;">
							<a class="dropdown-item" href="#"  data-bs-toggle="modal" data-bs-target="#myModal" onclick="cargar_datos(<?php echo "'".$key['id_ramas']."','".$key['nivel']."','".$key['archo']."','".$key['porcentaje']."'"; ?>)">Modificar</a>
							<a class="dropdown-item" href="#" onclick="eliminar(<?php echo $key['id_ramas']; ?>)">Eliminar</a>
						</div>
					</div>
			</td>
		</tr>
		<?php
		}
	break;
	case 'cambiar_estado':
		$n_ramas  = new ramas();
		$resultado = $n_ramas  -> cambiar_estado_ramas($id, $estado);
		echo 1;
	break;
	case 'mis_afiliados':
		$n_ramas  = new ramas();
		session_start();
		$resultado = $n_ramas  -> mis_afiliados($_SESSION['id_usuario']);
		$datos_json = json_encode($resultado);
		echo $datos_json;

	break;
	case 'buscar_id_group':
		$n_ramas  = new ramas();
		session_start();


    $resultado = $n_ramas  -> get_group_id($_SESSION['id_usuario']);
    
    
    $i = 1;
    foreach($resultado as $re){
        if($i==8){
            exit;
        }
        if($i==1){
            $porcentaje=18;
        }
        if($i==2){
            $porcentaje=16;
        }
        if($i==3){
            $porcentaje=14;
        }
        if($i==4){
            $porcentaje=11;
        }
        if($i==5){
            $porcentaje=9;
        }
        if($i==6){
            $porcentaje=3;
        }
        if($i==7){
            $porcentaje=1;
        }
      
         echo "<tr>";
        echo "<td>". $re['contador']."</td>";
        echo "<td>". $i."</td>";
        echo "<td>". $porcentaje."</td>";
        echo "</tr>";
        
        $i=$i+1;
        
    }

	break;
	case 'buscar_id_group_json':
	    		$n_ramas  = new ramas();
		session_start();
	    $resultado = $n_ramas  -> get_group_id($_SESSION['id_usuario']);
        $datos = [];
            $i = 1;
	      foreach($resultado as $re){
        if($i==8){
            exit;
        }
        if($i==1){
            $porcentaje=18;
        }
        if($i==2){
            $porcentaje=16;
        }
        if($i==3){
            $porcentaje=14;
        }
        if($i==4){
            $porcentaje=11;
        }
        if($i==5){
            $porcentaje=9;
        }
        if($i==6){
            $porcentaje=3;
        }
        if($i==7){
            $porcentaje=1;
        }
      
        $datos[] = [
            'name'     => "Nivel ".$i,
            'y'  => $re['contador']
        ];
        
        $i=$i+1;
        
    }
    
        // Convertir el array en formato JSON al final del bucle
    $jsonDatos = json_encode($datos);
    
    // Imprimir el JSON resultante (puedes guardar esto en un archivo si lo prefieres)
    echo $jsonDatos;
	break;
	
	case 'mi_porcentaje':
		$n_ramas  = new ramas();
		session_start();
		$resultado = $n_ramas  -> mi_porcentaje($_SESSION['id_usuario']);
		echo $resultado;

	break;
	case 'mi_saldo':
		$n_ramas  = new ramas();
		session_start();
		$resultado = $n_ramas  -> mi_saldo($_SESSION['id_usuario']);
		echo $resultado;

	break;
	case 'diagram':
		$n_ramas  = new ramas();
		$resultado = $n_ramas  -> buscar_red();
		$datos_json = json_encode($resultado);
		echo $datos_json;

	break;
	case 'diagram_id':
		$n_ramas  = new ramas();
		session_start();
		$resultado = $n_ramas  -> buscar_red_id($_SESSION['id_usuario']);
		$datos_json = json_encode($resultado);
		echo $datos_json;

	break;
	case 'eliminar':
		$n_ramas  = new ramas();
		$resultado = $n_ramas  -> eliminar_ramas($id);
		echo 1;
	break;
	case 'buscar_select':
		$n_ramas  = new ramas();
		$resultado = $n_ramas  -> buscar_ramas();
		foreach ($resultado as $key) {
		?>
			<option value="<?php echo $key['id']; ?>"><?php echo $key['descripcion']; ?></option>;
		<?php
		}
	break;
	case 'buscar_json':
		$n_ramas  = new ramas();
		$resultado = $n_ramas  -> buscar_json_ramas($id);
		echo $resultado;
	break;
	case 'modificar':
		$n_ramas  = new ramas();
		$resultado = $n_ramas  -> modificar_ramas($id,$id_usuarios,$nivel,$archo,$porcentaje);
		echo 1;
	break;
	case 'estadistica':
		$n_ramas  = new ramas();
		$resultado = $n_ramas  -> estadistica($id,$nivel,$archo,$porcentaje,$estado);
	break;
	default:
	break;
}
