<?php
include 'db_wp.php';

class sync_data{



	public function __construct(){
		$this->conexion = new Conexion_wp();
	}


	public function registrar_transacciones($id='204',$id_usuarios,$entrada,$salida,$valor,$porcentaje,$estado){
	$estado_defaul = 1;
	$sql = "INSERT INTO `transacciones`(`estado`,`entrada`,`salida`,`valor`,`porcentaje`,`id_usuarios`) VALUES (:estado,:entrada,:salida,:valor,:porcentaje,:id_usuarios)";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':estado' => $estado_defaul,':entrada' => $entrada,':salida' => $salida,':valor' => $valor,':porcentaje' => $porcentaje,':id_usuarios' => $id_usuarios));
	return 1;
	}
	public function get_data($correos){
	    $sql = "SELECT wp_users.user_email 
        FROM wp_ihc_orders, wp_users 
        WHERE wp_ihc_orders.uid = wp_users.id 
        AND wp_ihc_orders.status = 'Completed' 
        AND wp_users.user_email IN ('$correos')";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$consulta =$reg->fetchAll();
	if ($consulta) {
		return $consulta;
	}else{
		return 0;
	} }
	
	public function get_data_to_pay($correos){
	    $sql = "SELECT wp_users.user_email 
        FROM wp_ihc_orders, wp_users 
        WHERE wp_ihc_orders.uid = wp_users.id 
        AND wp_ihc_orders.status = 'pending' 
        AND wp_users.user_email='$correos'";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$consulta =$reg->fetchAll();
	if ($consulta) {
		return 1;
	}else{
		return 0;
	} }
	
		public function get_data2($correos){
	    $sql = "SELECT wp_users.user_email 
        FROM wp_ihc_orders, wp_users 
        WHERE wp_ihc_orders.uid = wp_users.id 
        AND wp_ihc_orders.status = 'Completed' 
        AND wp_users.user_email IN ('$correosIN')";
    	$reg = $this->conexion->prepare($sql);
    	$reg->execute();
    	$consulta =$reg->fetchAll();
    	if ($consulta) {
    		return $consulta;
    	}else{
    		return 0;
    	} }



}


?>