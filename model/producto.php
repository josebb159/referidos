<?php
if(isset($conect)){if($conect==1){}else{include 'db.php';$conect =1;}}else{include 'db.php';$conect =1;}
class producto {
	public $conexion;
	private $descripcion;
	private $valor;


	public function __construct(){
		$this->conexion = new Conexion();
	}


	public function registrar_producto($id='204',$id_categoria,$descripcion,$valor,$estado){
	$estado_defaul = 1;
	$sql = "INSERT INTO `producto`(`estado`,`descripcion`,`valor`,`id_categoria`) VALUES (:estado,:descripcion,:valor,:id_categoria)";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':estado' => $estado_defaul,':descripcion' => $descripcion,':valor' => $valor,':id_categoria' => $id_categoria));
	return 1;
	}
	public function buscar_producto(){$sql = "SELECT  * FROM producto ";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$consulta =$reg->fetchAll();
	if ($consulta) {
		return $consulta;
	}else{
		return 0;
	} }
	public function cambiar_estado_producto($id, $estado){$sql = "UPDATE `producto` SET `estado`=:estado WHERE id_producto=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id, ':estado' => $estado));
	}
	public function eliminar_producto($id){$sql = "DELETE FROM `producto`  WHERE id_producto=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id));
	}
	public function modificar_producto($id, $estado,$id_categoria,$descripcion,$valor){
	$sql = "UPDATE `producto` SET `estado`=:estado ,`descripcion`=:descripcion,`valor`=:valor,`id_categoria`=:id_categoria WHERE id_producto=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id, ':estado' => $estado,':descripcion' => $descripcion,':valor' => $valor,':id_categoria' => $id_categoria));
	}
	public function buscar_json_producto($id){$sql = "SELECT  * FROM rol where id=".$id."";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$results = $reg->fetchAll(PDO::FETCH_ASSOC);
	return json_encode($results);
	}
	public function rango() {
		// Código del método aquí
	}

}
?>