<?php
if(isset($conect)){if($conect==1){}else{include 'db.php';$conect =1;}}else{include 'db.php';$conect =1;}
class monedero {
	public $conexion;
	private $valor;


	public function __construct(){
		$this->conexion = new Conexion();
	}


	public function registrar_monedero($id='204',$id_usuarios,$valor,$estado){
	$estado_defaul = 1;
	$sql = "INSERT INTO `monedero`(`estado`,`valor`,`id_usuarios`) VALUES (:estado,:valor,:id_usuarios)";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':estado' => $estado_defaul,':valor' => $valor,':id_usuarios' => $id_usuarios));
	return 1;
	}
	public function buscar_monedero(){$sql = "SELECT  * FROM monedero ";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$consulta =$reg->fetchAll();
	if ($consulta) {
		return $consulta;
	}else{
		return 0;
	} }
	public function buscar_monedero_id($id){$sql = "SELECT  * FROM monedero where monedero.id_usuarios=$id";
		$reg = $this->conexion->prepare($sql);
		$reg->execute();
		$consulta =$reg->fetchAll();
		if ($consulta) {
			return $consulta;
		}else{
			return 0;
		} }
	public function cambiar_estado_monedero($id, $estado){$sql = "UPDATE `monedero` SET `estado`=:estado WHERE id_monedero=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id, ':estado' => $estado));
	}
	
	public function eliminar_monedero($id){$sql = "DELETE FROM `monedero`  WHERE id_monedero=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id));
	}
	public function modificar_monedero($id, $estado,$id_usuarios,$valor){
	$sql = "UPDATE `monedero` SET `estado`=:estado ,`valor`=:valor,`id_usuarios`=:id_usuarios WHERE id_monedero=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id, ':estado' => $estado,':valor' => $valor,':id_usuarios' => $id_usuarios));
	}
	public function buscar_json_monedero($id){$sql = "SELECT  * FROM rol where id=".$id."";
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