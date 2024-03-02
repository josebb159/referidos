<?php
if(isset($conect)){if($conect==1){}else{include 'db.php';$conect =1;}}else{include 'db.php';$conect =1;}
class userCompare {
	public $conexion;


	public function __construct(){
		$this->conexion = new Conexion();
	}
 
	public function gerUserCompare(){
$sql = "SELECT id, correo, nombre FROM user_compare WHERE user_compare.estado=1 and correo COLLATE utf8mb4_unicode_ci NOT IN (SELECT email COLLATE utf8mb4_unicode_ci FROM usuarios);";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$consulta =$reg->fetchAll();
	if ($consulta) {
		return $consulta;
	}else{
		return 0;
	} }

	public function uptateUser($email){
		$sql = "UPDATE `user_compare` SET estado=2 WHERE correo=:email";
	    $reg = $this->conexion->prepare($sql);
	    $reg->execute(array(':email' => $email));
	    
	}

	public function eliminar($id){
		$sql = "UPDATE `user_compare` SET estado=2 WHERE id=:id";
	    $reg = $this->conexion->prepare($sql);
	    $reg->execute(array(':id' => $id));
	    
	}
		

}
?>