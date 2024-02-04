<?php
if(isset($conect)){if($conect==1){}else{include 'db.php';$conect =1;}}else{include 'db.php';$conect =1;}
class ramas {
	public $conexion;
	private $nivel;
	private $archo;
	private $porcentaje;


	public function __construct(){
		$this->conexion = new Conexion();
	}


	public function registrar_ramas($id='204',$id_usuarios,$nivel,$archo,$porcentaje,$estado){
	$estado_defaul = 1;
	$sql = "INSERT INTO `ramas`(`estado`,`nivel`,`ancho`,`porcentaje`,`id_usuarios`) VALUES (:estado,:nivel,:archo,:porcentaje,:id_usuarios)";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':estado' => $estado_defaul,':nivel' => $nivel,':archo' => $archo,':porcentaje' => $porcentaje,':id_usuarios' => $id_usuarios));
	return 1;
	}
	
	public function get_group_id($id_user){

	$sql = "WITH RECURSIVE ArbolUsuarios AS ( SELECT id_ramas, id_usuarios, referido_padre, nivel, ancho, porcentaje, fecha_registro, fecha_actualizacion, estado FROM ramas WHERE id_usuarios = ".$id_user." UNION SELECT r.id_ramas, r.id_usuarios, r.referido_padre, r.nivel, r.ancho, r.porcentaje, r.fecha_registro, r.fecha_actualizacion, r.estado FROM ramas r INNER JOIN ArbolUsuarios a ON r.referido_padre = a.id_usuarios ) SELECT nivel, porcentaje, COUNT(*) as contador FROM ArbolUsuarios WHERE id_usuarios !=  ".$id_user."  GROUP BY nivel, porcentaje;";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$consulta =$reg->fetchAll();
	if ($consulta) {
		return $consulta;
	}else{
		return 0;
	} }

	


	public function get_group($array){
	    $idsString = implode(',', $array);
	$sql = "SELECT count(id_usuarios) as cantidad, nivel, porcentaje 
FROM ramas
WHERE id_usuarios IN ($idsString)  group by nivel,porcentaje";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$consulta =$reg->fetchAll();
	if ($consulta) {
		return $consulta;
	}else{
		return 0;
	} }

	public function buscar_red(){
		$sql = "SELECT usuarios.id as id_ramas, ramas.referido_padre as referido_padre , usuarios.nombre as name FROM `ramas`, usuarios WHERE ramas.id_usuarios=usuarios.id;";
		$reg = $this->conexion->prepare($sql);
		$reg->execute();
		$consulta = $reg->fetchAll(PDO::FETCH_ASSOC); 
		if ($consulta) {
			return $consulta;
		}else{
			return 0;
		} }


		public function relacion($id, $includeDescendientes = false){
			$sql = "SELECT CONVERT(usuarios.id, CHAR) AS id, CONVERT(ramas.referido_padre, CHAR) as parent, usuarios.nombre as name FROM ramas
					INNER JOIN usuarios ON ramas.id_usuarios = usuarios.id
					WHERE ramas.referido_padre = :id";
		
			$reg = $this->conexion->prepare($sql);
			$reg->bindParam(':id', $id, PDO::PARAM_INT);
			$reg->execute();
		
			$consulta = $reg->fetchAll(PDO::FETCH_ASSOC);
		
			if ($includeDescendientes && $consulta) {
				foreach ($consulta as $row) {
					$descendientes = $this->relacion($row['id'], true);
					$consulta = array_merge($consulta, $descendientes);
				}
			}
		
			return $consulta ?: [];
		}
		
				public function relacion3($id, $includeDescendientes = false){
			$sql = "SELECT usuarios.id,  ramas.nivel, ramas.porcentaje FROM ramas
					INNER JOIN usuarios ON ramas.id_usuarios = usuarios.id
					WHERE ramas.referido_padre = :id";
		
			$reg = $this->conexion->prepare($sql);
			$reg->bindParam(':id', $id, PDO::PARAM_INT);
			$reg->execute();
		
			$consulta = $reg->fetchAll(PDO::FETCH_ASSOC);
		
			if ($includeDescendientes && $consulta) {
				foreach ($consulta as $row) {
					$descendientes = $this->relacion3($row['id'], true);
					$consulta = array_merge($consulta, $descendientes);
				}
			}
		
			return $consulta ?: [];
		}

		public function relacion2($id, $includeDescendientes = false){
			$sql = "SELECT   usuarios.id as id_ramass, ramas.referido_padre as referido_padre, usuarios.nombre as name, ramas.* FROM ramas
					INNER JOIN usuarios ON ramas.id_usuarios = usuarios.id
					WHERE ramas.referido_padre = :id";
		
			$reg = $this->conexion->prepare($sql);
			$reg->bindParam(':id', $id, PDO::PARAM_INT);
			$reg->execute();
		
			$consulta = $reg->fetchAll(PDO::FETCH_ASSOC);
		
			if ($includeDescendientes && $consulta) {
				foreach ($consulta as $row) {
					$descendientes = $this->relacion2($row['id_ramass'], true);
					$consulta = array_merge($consulta, $descendientes);
				}
			}
		
			return $consulta ?: [];
		}

		public function buscar_ramas_id($id){
			$data = $this->relacion2($id, true);


			// Filtrar los elementos null del array
			$tuArrayFiltrado = array_filter($data, function ($value) {
				return $value !== null;
			});


			return $tuArrayFiltrado;
		}


		public function mis_afiliados($id){
			$data = $this->relacion2($id, true);

			// Filtrar los elementos null del array
			$tuArrayFiltrado = array_filter($data, function ($value) {
				return $value !== null;
			});

			$numRegistros = count($tuArrayFiltrado);

			return $numRegistros;
		}
		
		public function mi_porcentaje($id){
			$sql = "SELECT  * FROM ramas  where id_usuarios=$id";
				$reg = $this->conexion->prepare($sql);
				$reg->execute();
				$consulta =$reg->fetchAll();
				if ($consulta) {
					return $consulta[0]['porcentaje'];
				}else{
					return 0;
				}

		
		}

		public function mi_saldo($id){
			$sql = "SELECT  * FROM monedero  where id_usuarios=$id";
				$reg = $this->conexion->prepare($sql);
				$reg->execute();
				$consulta =$reg->fetchAll();
				if ($consulta) {
					return $consulta[0]['valor'];
				}else{
					return 0;
				}

		
		}
		


		public function buscar_red_id($id){
			$data = $this->relacion($id, true);

 /*
			$sql = "SELECT usuarios.id as id_ramas, null as referido_padre, 'Yo' as name FROM ramas
					INNER JOIN usuarios ON ramas.id_usuarios = usuarios.id
					WHERE ramas.id_usuarios = :id";
					*/
					
						$sql = "SELECT CONVERT(usuarios.id, CHAR) AS id, null as parent, 'Yo' as name FROM ramas
					INNER JOIN usuarios ON ramas.id_usuarios = usuarios.id
					WHERE ramas.id_usuarios = :id";
		
			$reg = $this->conexion->prepare($sql);
			$reg->bindParam(':id', $id, PDO::PARAM_INT);
			$reg->execute();
			$consulta = $reg->fetchAll(PDO::FETCH_ASSOC);
		
			$data = array_merge($consulta, $data);

		

			// Filtrar los elementos null del array
			$tuArrayFiltrado = array_filter($data, function ($value) {
				return $value !== null;
			});


			return $tuArrayFiltrado;
		}
		
		
			public function buscar_red_id2($id){
			$data = $this->relacion3($id, true);

 /*
			$sql = "SELECT usuarios.id as id_ramas, null as referido_padre, 'Yo' as name FROM ramas
					INNER JOIN usuarios ON ramas.id_usuarios = usuarios.id
					WHERE ramas.id_usuarios = :id";
					*/
					
						$sql = "SELECT ramas.nivel, ramas.porcentaje FROM ramas
					INNER JOIN usuarios ON ramas.id_usuarios = usuarios.id
					WHERE ramas.id_usuarios = :id";
		
			$reg = $this->conexion->prepare($sql);
			$reg->bindParam(':id', $id, PDO::PARAM_INT);
			$reg->execute();
			$consulta = $reg->fetchAll(PDO::FETCH_ASSOC);
		
			$data = array_merge($consulta, $data);

		

			// Filtrar los elementos null del array
			$tuArrayFiltrado = array_filter($data, function ($value) {
				return $value !== null;
			});


			return $tuArrayFiltrado;
		}	
	public function cambiar_estado_ramas($id, $estado){$sql = "UPDATE `ramas` SET `estado`=:estado WHERE id_ramas=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id, ':estado' => $estado));
	}
	public function eliminar_ramas($id){$sql = "DELETE FROM `ramas`  WHERE id_ramas=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id));
	}
	public function modificar_ramas($id, $estado,$id_usuarios,$nivel,$archo,$porcentaje){
	$sql = "UPDATE `ramas` SET `estado`=:estado ,`nivel`=:nivel,`archo`=:archo,`porcentaje`=:porcentaje,`id_usuarios`=:id_usuarios WHERE id_ramas=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id, ':estado' => $estado,':nivel' => $nivel,':archo' => $archo,':porcentaje' => $porcentaje,':id_usuarios' => $id_usuarios));
	}
	public function buscar_json_ramas($id){$sql = "SELECT  * FROM rol where id=".$id."";
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