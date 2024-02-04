<?php
if(isset($conect)){if($conect==1){}else{include 'db.php';$conect =1;}}else{include 'db.php';$conect =1;}
class afiliado {
	public $conexion;
	private $nombre;
	private $apellido;
	private $codigo;
	private $img;
	private $telefono;


	public function __construct(){
		$this->conexion = new Conexion();
	}
 
	public function buscar_afiliado_from_email($email){
		$sql = "SELECT usuarios.id,usuarios.email from usuarios,afiliado WHERE usuarios.id=afiliado.id_usuarios and afiliado.estado=1 and usuarios.email='".$email."'; ";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$consulta =$reg->fetchAll();
	if ($consulta) {
		return $consulta;
	}else{
		return 0;
	} }
	public function registrar_afiliado($id='204',$id_usuarios,$nombre,$apellido,$codigo,$img,$telefono,$estado){
	$estado_defaul = 1;
	$sql = "INSERT INTO `afiliado`(`estado`,`nombre`,`apellido`,`codigo`,`img`,`telefono`,`id_usuarios`) VALUES (:estado,:nombre,:apellido,:codigo,:img,:telefono,:id_usuarios)";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':estado' => $estado_defaul,':nombre' => $nombre,':apellido' => $apellido,':codigo' => $codigo,':img' => $img,':telefono' => $telefono,':id_usuarios' => $id_usuarios));
	return 1;
	}
	public function buscar_afiliado(){
		$sql = "SELECT  * FROM afiliado ";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$consulta =$reg->fetchAll();
	if ($consulta) {
		return $consulta;
	}else{
		return 0;
	} }
	
public function expire_afiliado(){
    $sql = "SELECT * FROM afiliado WHERE estado = 2";
    $reg = $this->conexion->prepare($sql);
    $reg->execute();
    $consulta = $reg->fetchAll();
    
    $fecha_actual = date("Y-m-d");

    foreach($consulta as $afiliado){
        $fecha_afiliacion = $afiliado['date_afiliate'];

        // Calcula la diferencia en segundos entre la fecha actual y la fecha de afiliación
        $diferencia_en_segundos = strtotime($fecha_actual) - strtotime($fecha_afiliacion);

        // Calcula la diferencia en meses
        $diferencia_en_meses = floor($diferencia_en_segundos / (60 * 60 * 24 * 30));

        if($diferencia_en_meses > 1){
            // La fecha de afiliación es mayor a un mes, cambia el estado a 1
            $id_afiliado = $afiliado['id_afiliado']; // Ajusta esto según la estructura de tu tabla
            $this->update_status($id_afiliado);
        }
    }
}

private function update_status($id_afiliado){
    $sql = "UPDATE afiliado SET estado = 1 WHERE id_afiliado = :id_afiliado";
    $reg = $this->conexion->prepare($sql);
    $reg->bindParam(':id_afiliado', $id_afiliado, PDO::PARAM_INT);
    $reg->execute();
}

		public function buscar_afiliado_email_inactivo(){
		$sql = "SELECT usuarios.id,usuarios.email from usuarios,afiliado WHERE usuarios.id=afiliado.id_usuarios and afiliado.estado=1; ";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$consulta =$reg->fetchAll();
	if ($consulta) {
		return $consulta;
	}else{
		return 0;
	} }
	

	public function cambiar_estado_afiliado($id, $estado){$sql = "UPDATE `afiliado` SET `estado`=:estado WHERE id_afiliado=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id, ':estado' => $estado));
	}

	public function get_rama($id){
		
		$sql = "SELECT  * FROM ramas where ramas.id_usuarios=$id";
		
		$reg = $this->conexion->prepare($sql);
		$reg->execute();
		$consulta =$reg->fetchAll();
		if ($consulta) {
			
		  	if($consulta[0]['referido_padre']!=NULL){
				return $consulta[0]['referido_padre'];
			}else{
				return 0;
			}
		}else{
			return 0;
		}
	}
public function validar_afiliado($id){
    		$sql = "UPDATE `afiliado` SET `estado`=:estado, `date_afiliate`=:date WHERE id_usuarios=:id";
$fecha_actual = date("Y-m-d");

		$reg = $this->conexion->prepare($sql);
		$reg->execute(array(':id' => $id, ':estado' => 2, ':date' => $fecha_actual));
   
		$n=1;
		$idActual=$id;
		while ($idActual !== 0) {
			
			$idActual = $this->get_rama($idActual);
			if ($idActual === 0) {
				break;
			}

			if ($n == 1) {
				$porcentaje= 18;
			}elseif($n == 2){
				$porcentaje= 16;
			}elseif($n == 3){
				$porcentaje= 14;
			}elseif($n == 4){
				$porcentaje= 11;
			}elseif($n == 5){
				$porcentaje= 9;
			}elseif($n == 6){
				$porcentaje= 3;
			}elseif($n == 7){
				$porcentaje= 1;
			}else{
				break;
			}


		
			// Puedes realizar acciones adicionales aquí si es necesario

			$sql = "SELECT  * FROM ramas where ramas.id_usuarios=$idActual";
		
			$reg = $this->conexion->prepare($sql);
			$reg->execute();
			$consulta =$reg->fetchAll();
			
			//$porcentaje= $consulta[0]['porcentaje'];
			$monto= 1;
			$valor=0;
			$valor = $monto * ($porcentaje / 100);
			$valor = round($valor, 2);
			$sql = "UPDATE `monedero` SET valor=valor+".$valor." WHERE `id_usuarios`=".$idActual.";";

			$reg = $this->conexion->prepare($sql);
			$reg->execute();


			$estado_defaul = 1;
			$sql = "INSERT INTO `transacciones`(`estado`,`entrada`,`salida`,`valor`,`porcentaje`,`id_usuarios`) VALUES (:estado,:entrada,:salida,:valor,:porcentaje,:id_usuarios)";
			$reg = $this->conexion->prepare($sql);
			$reg->execute(array(':estado' => $estado_defaul,':entrada' => 0,':salida' => 1,':valor' => $valor,':porcentaje' => $porcentaje,':id_usuarios' => $idActual));
	
			// Rompe el bucle si $idActual es 0
			$n++;
		}
		

	}

	public function cancelar_afiliado($id){
		
		$sql = "UPDATE `afiliado` SET `estado`=:estado WHERE id_usuarios=:id";
		$reg = $this->conexion->prepare($sql);
		$reg->execute(array(':id' => $id, ':estado' => 3));
	}

	public function eliminar_afiliado($id){$sql = "DELETE FROM `afiliado`  WHERE id_afiliado=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id));
	}
	public function modificar_afiliado($id, $estado,$id_usuarios,$nombre,$apellido,$codigo,$img,$telefono){
	$sql = "UPDATE `afiliado` SET `estado`=:estado ,`nombre`=:nombre,`apellido`=:apellido,`codigo`=:codigo,`img`=:img,`telefono`=:telefono,`id_usuarios`=:id_usuarios WHERE id_afiliado=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id, ':estado' => $estado,':nombre' => $nombre,':apellido' => $apellido,':codigo' => $codigo,':img' => $img,':telefono' => $telefono,':id_usuarios' => $id_usuarios));
	}
	public function buscar_json_afiliado($id){$sql = "SELECT  * FROM rol where id=".$id."";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$results = $reg->fetchAll(PDO::FETCH_ASSOC);
	return json_encode($results);
	}
	public function estadistica() {
		// C�digo del m�todo aqu�
	}

}
?>