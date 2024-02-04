<?php
if(isset($conect)){if($conect==1){}else{include 'db.php';$conect =1;}}else{include 'db.php';$conect =1;}
class afiliado {
	public $conexion;


	public function __construct(){
		$this->conexion = new Conexion();
	}
	
	public function relacion($id, $includeDescendientes = false){
		$sql = "SELECT usuarios.id as id_ramas, ramas.referido_padre as referido_padre, usuarios.nombre as name FROM ramas
				INNER JOIN usuarios ON ramas.id_usuarios = usuarios.id
				WHERE ramas.referido_padre = :id";
	
		$reg = $this->conexion->prepare($sql);
		$reg->bindParam(':id', $id, PDO::PARAM_INT);
		$reg->execute();
	
		$consulta = $reg->fetchAll(PDO::FETCH_ASSOC);
	
		if ($includeDescendientes && $consulta) {
			foreach ($consulta as $row) {
				$descendientes = $this->relacion($row['id_ramas'], true);
				$consulta = array_merge($consulta, $descendientes);
			}
		}
	
		return $consulta ?: [];
	}
	
	public function buscar_red_id($id){
		$data = $this->relacion($id, true);
		var_dump($data);
	}

}

$data = new afiliado;
$data-> buscar_red_id(21);
?>