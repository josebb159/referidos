<?php
if(isset($conect)){if($conect==1){}else{include 'db.php';$conect =1;}}else{include 'db.php';$conect =1;}
class transacciones {
	public $conexion;
	private $entrada;
	private $salida;
	private $valor;
	private $porcentaje;


	public function __construct(){
		$this->conexion = new Conexion();
	}


	public function registrar_transacciones($id='204',$id_usuarios,$entrada,$salida,$valor,$porcentaje,$estado){
	$estado_defaul = 1;
	$sql = "INSERT INTO `transacciones`(`estado`,`entrada`,`salida`,`valor`,`porcentaje`,`id_usuarios`) VALUES (:estado,:entrada,:salida,:valor,:porcentaje,:id_usuarios)";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':estado' => $estado_defaul,':entrada' => $entrada,':salida' => $salida,':valor' => $valor,':porcentaje' => $porcentaje,':id_usuarios' => $id_usuarios));
	return 1;
	}
	public function registrar_retiro($id_usuarios,$valor){
	$estado_defaul = 2;
	$sql = "INSERT INTO `transacciones`(`estado`,`entrada`,`salida`,`valor`,`porcentaje`,`id_usuarios`) VALUES (:estado,:entrada,:salida,:valor,:porcentaje,:id_usuarios)";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':estado' => $estado_defaul,':entrada' => 0,':salida' => 2,':valor' => $valor,':porcentaje' => 0,':id_usuarios' => $id_usuarios));
	return 1;
	}
	public function buscar_transacciones(){$sql = "SELECT  * FROM transacciones ";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$consulta =$reg->fetchAll();
	if ($consulta) {
		return $consulta;
	}else{
		return 0;
	} }
	public function buscar_transacciones_id($id){$sql = "SELECT  * FROM transacciones where id_usuarios=$id ";
		$reg = $this->conexion->prepare($sql);
		$reg->execute();
		$consulta =$reg->fetchAll();
		if ($consulta) {
			return $consulta;
		}else{
			return 0;
		} }
		
	public function descontar($id, $id_transaccion, $valor){
	    $sql = "UPDATE `monedero` SET valor=valor-:valor WHERE id_usuarios=:id";
	    $reg = $this->conexion->prepare($sql);
	    $reg->execute(array(':id' => $id, ':valor' => $valor));
	    
	    $sql = "UPDATE `transacciones` SET estado=1 WHERE id_transacciones=:id";
	    $reg = $this->conexion->prepare($sql);
	    $reg->execute(array(':id' => $id_transaccion));
	}
	public function cambiar_estado_transacciones($id, $estado){$sql = "UPDATE `transacciones` SET `estado`=:estado WHERE id_transacciones=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id, ':estado' => $estado));
	}
	public function eliminar_transacciones($id){$sql = "DELETE FROM `transacciones`  WHERE id_transacciones=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id));
	}
	public function modificar_transacciones($id, $estado,$id_usuarios,$entrada,$salida,$valor,$porcentaje){
	$sql = "UPDATE `transacciones` SET `estado`=:estado ,`entrada`=:entrada,`salida`=:salida,`valor`=:valor,`porcentaje`=:porcentaje,`id_usuarios`=:id_usuarios WHERE id_transacciones=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id, ':estado' => $estado,':entrada' => $entrada,':salida' => $salida,':valor' => $valor,':porcentaje' => $porcentaje,':id_usuarios' => $id_usuarios));
	}
	public function buscar_json_transacciones($id){$sql = "SELECT  * FROM rol where id=".$id."";
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