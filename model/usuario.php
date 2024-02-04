<?php
session_start();
if(isset($conect)){

    if($conect==1){

    }else{
        include 'db.php';
        $conect =1;
    }
    
 
}else{
    include 'db.php';
    $conect =1;
}
class usuario {
    public $rol; 


    public function registrar_usuario($rol, $nombre, $apellido, $usuario, $contrasena ){
   
        $conexion = new Conexion();
        $estado_defaul = 1;
    
        $sql = "INSERT INTO `usuarios`(`id_rol`, `nombre`, `apellido`, `usuario`,  `contrasena`, `estado`) VALUES (:rol,:nombre,:apellido,:usuario,:contrasena,:estado)";
        $reg = $conexion->prepare($sql);
    
        $reg->execute(array(':rol' => $rol, ':nombre' => $nombre, ':apellido' => $apellido, ':usuario' => $usuario,  ':contrasena' => $contrasena, ':estado' => $estado_defaul));
     
        return 1;
    
    }


    public function buscar_usuarios(){
   
        $conexion = new Conexion();
    
        $sql = "SELECT usuarios.id as id, rol.descripcion as rol, usuarios.nombre,  rol.id as rol_id, `apellido`, `usuario`, `contrasena`, usuarios.estado as estado, usuarios.fecha_registro FROM usuarios, rol WHERE rol.id=usuarios.id_rol; ";
        $reg = $conexion->prepare($sql);
    
        $reg->execute();
        $consulta =$reg->fetchAll();
      
        if ($consulta) {
    
            return $consulta;
    
        }else{
            return 0;
        }
    }
    
        public function buscar_contrasena($email){
   
        $conexion = new Conexion();
    
        $sql = "SELECT  usuarios.nombre, `contrasena` FROM usuarios, rol WHERE rol.id=usuarios.id_rol and usuarios.email='".$email."'; ";
        $reg = $conexion->prepare($sql);
    
        $reg->execute();
        $consulta =$reg->fetchAll();
      
        if ($consulta) {
    
            return $consulta;
    
        }else{
            return 0;
        }
    }
    
    
    


    public function login($usuario, $contrasena){

        $conexion = new Conexion();


        $sql = "SELECT  usuarios.* , afiliado.codigo FROM usuarios,afiliado where usuarios.id=afiliado.id_usuarios and email='".$usuario."' and contrasena='".$contrasena."' and usuarios.estado=1";
        
        $reg = $conexion->prepare($sql);

        $reg->execute();
        $consulta =$reg->fetchAll();
        
      
        if ($consulta) {
            foreach ($consulta as $key) {
        
                $_SESSION['nombre'] =  $key['nombre'];
           
                $_SESSION['id_usuario'] =  $key['id'];
                $_SESSION['codigo'] =  $key['codigo'];
                $this->rol = $key['id_rol'];
    
            }
            
            return true;
        }else{
            return false;
        }
                        
    }


    public function obtener_rol(){


        $conexion = new Conexion();


        $sql = "SELECT  * FROM rol where id='".$this->rol."' ";
        $reg = $conexion->prepare($sql);

        $reg->execute();
        $consulta =$reg->fetchAll();
      
        if ($consulta) {
            foreach ($consulta as $key) {

                $_SESSION['rol'] =  $key['nombre'];
    
            }
            
    
        }
        
    }



    
public function cambiar_estado_usuario($id, $estado){
   
    $conexion = new Conexion();
    $estado_defaul = 1;

    $sql = "UPDATE `usuarios` SET `estado`=:estado WHERE id=:id";
    $reg = $conexion->prepare($sql);

    $reg->execute(array(':id' => $id, ':estado' => $estado));


}

public function eliminar_usuario($id){
   
    $conexion = new Conexion();
    $estado_defaul = 1;

    $sql = "DELETE FROM `usuarios`  WHERE id=:id";
    $reg = $conexion->prepare($sql);

    $reg->execute(array(':id' => $id));


}

public function modificar_usuario($id,$nombre,$apellido, $usuario, $contrasena, $rol ){
   
    $conexion = new Conexion();
  

    $sql = "UPDATE `usuarios` SET `nombre`=:nombre, `apellido`=:apellido, `usuario`=:usuario, `contrasena`=:contrasena,  `id_rol`=:rol  WHERE id=:id";
    $reg = $conexion->prepare($sql);

    $reg->execute(array(':id' => $id ,':nombre' => $nombre,':apellido' => $apellido,':usuario' => $usuario,':contrasena' => $contrasena,':rol' => $rol));

    return 1;
}

 

public function buscar_usuario_json($id){
   
    $conexion = new Conexion();

    $sql = "SELECT  * FROM usuarios where id=".$id."";
    $reg = $conexion->prepare($sql);

    $reg->execute();

    $results = $reg->fetchAll(PDO::FETCH_ASSOC);
    return $json = json_encode($results);

}


    




}

?>