<?php
require "../framework/phpmailer/index.php";
if(isset($conect)){if($conect==1){}else{include 'db.php';$conect =1;}}else{include 'db.php';$conect =1;}
class api{

    public function login($uid){

        $conexion = new Conexion();
     

        $sql = "SELECT  * FROM usuarios where  uid='".$uid."' and estado=1";
      // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
        $reg = $conexion->prepare($sql);

        $reg->execute();
        $consulta =$reg->fetchAll();
        
      
        if ($consulta) {
            $result=["user"=>$consulta];
            
            $responseBody = '{"status_code": 200, "message": "OK"}';
          
           $data = array_merge(json_decode($responseBody, true),$result);

            echo json_encode($data);
            //echo json_encode($consulta);
          
        }else{
            return http_response_code(404);
        }
                        
    }

public function get_code($email) {
    $conexion = new Conexion();
    
    // Usar consultas preparadas con un marcador de posición
    $sql = "SELECT afiliado.* FROM usuarios, afiliado WHERE usuarios.id=afiliado.id_usuarios AND email=:email";
    $reg = $conexion->prepare($sql);

    // Vincular el valor a la variable
    $reg->bindParam(':email', $email, PDO::PARAM_STR);

    // Ejecutar la consulta
    $reg->execute();
    $consulta = $reg->fetchAll();

    // Verificar si se encontró el usuario
    if ($consulta) {
        return $consulta[0]['codigo'];
    } else {
        // Enviar una respuesta de error en formato JSON
        return json_encode(['error' => 'Usuario no encontrado'], JSON_UNESCAPED_UNICODE);
    }
}
  
    public function save_fmc($uid,$fmc){

        $conexion = new Conexion();
     

        $sql = "UPDATE usuarios SET token_fcm='".$fmc."' where  uid='".$uid."' ";
        $reg = $conexion->prepare($sql);

        $reg->execute();
   

                        
    }



    public function register_afiliato($usuario,$correo,$nombre,$codigo,$telefono,$password){
   
        $conexion = new Conexion();


		$sql = "SELECT usuarios.id,ramas.referido_padre, ramas.nivel, ramas.ancho, ramas.porcentaje, (SELECT count(ramas.id_ramas) from ramas, afiliado WHERE afiliado.id_usuarios=ramas.id_usuarios and usuarios.id=ramas.referido_padre) as total FROM usuarios, afiliado,ramas WHERE afiliado.id_usuarios=usuarios.id and ramas.id_usuarios=usuarios.id and afiliado.codigo='$codigo';";
		// $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
		  $reg = $conexion->prepare($sql);
  
		  $reg->execute();
		  $consulta =$reg->fetchAll();
		  
		
		  if ($consulta) {
			$consulta=$consulta[0];
			$estado_defaul =1;
			$contrasena = $password;
			$cod = $this->generarContraseña(5);

			//* usuario 
			$rol = 2;
			$sql = "INSERT INTO `usuarios`(`id_rol`, `nombre`, `email`, `telefono`,  `contrasena`, `estado`) VALUES (:rol,:nombre,:correo,:telefono,:contrasena,:estado)";
			$reg = $conexion->prepare($sql);
		
			$reg->execute(array(':rol' => $rol,':nombre' => $nombre, ':correo' => $correo, ':telefono' => $telefono,   ':contrasena' => $contrasena, ':estado' => $estado_defaul));
		 
			$id_insertado = $conexion->lastInsertId();
			//dato afiliado
		

			$sql2 = "INSERT INTO `afiliado`(`id_usuarios`,`nombre`, `apellido`, `codigo`, `img`,  `telefono`, `estado`) VALUES (:id_usuarios,:nombre,:apellido,:codigo,:img,:telefono,:estado)";
			$reg2 = $conexion->prepare($sql2);
		
			$reg2->execute(array(':id_usuarios' => $id_insertado,
								':nombre' => $nombre,
								':apellido' => '',
								':codigo' => $cod,
								':img' => '',
									':telefono' => $telefono,
									':estado' => $estado_defaul));
		 


			//monedero

			$sql3 = "INSERT INTO `monedero`(`id_usuarios`,`valor`,`estado`)  VALUES (:id_usuarios,:valor,:estado)";
			$reg3 = $conexion->prepare($sql3);
		
			$reg3->execute(array(':id_usuarios' => $id_insertado,':valor' => '0', ':estado' => $estado_defaul));
		 

			//rama

			$nivel = $consulta['nivel'] + 1;
			$ancho = $consulta['total'] + 1;

			if($nivel==2){
				$porcentaje= 16;
			}elseif($nivel==3){
				$porcentaje= 14;
			}elseif($nivel==4){
				$porcentaje= 11;
			}elseif($nivel==5){
				$porcentaje= 9;
			}elseif($nivel==6){
				$porcentaje= 3;
			}elseif($nivel==7){
				$porcentaje= 1;
			}

			$sql4 = "INSERT INTO `ramas`(`id_usuarios`,`nivel`, `referido_padre`,`ancho`, `porcentaje`,`estado`)  VALUES (:id_usuarios,:nivel,:referido_padre,:ancho,:porcentaje,:estado)";
			$reg4 = $conexion->prepare($sql4);
		
			$reg4->execute(array(':id_usuarios' =>  $id_insertado, ':nivel' => $nivel, ':referido_padre' => $consulta['id'], ':ancho' => $ancho, ':porcentaje' => $porcentaje, ':estado' => $estado_defaul));
		//	emails($correo, $contrasena, $nombre);
			
			
		  }else{
		/*	$estado_defaul = 1;
			$rol = 2;
			$sql = "INSERT INTO `usuarios`(`uid`,`id_rol`, `nombre`, `email`, `telefono`,  `contrasena`,`fecha`, `estado`) VALUES (:uid,:rol,:nombre,:correo,:telefono,:contrasena,:fecha,:estado)";
			$reg = $conexion->prepare($sql);
		
			$reg->execute(array(':rol' => $rol,':uid' => $uid, ':nombre' => $nombre, ':correo' => $correo, ':telefono' => $telefono, ':fecha' => $nuevaFecha,  ':contrasena' => $contrasena, ':estado' => $estado_defaul));
		 */
		  }

		
        return 1;
    
    }
    
    
        public function register_afiliato_no_referido($usuario,$correo,$nombre,$codigo,$telefono,$password){
   
        $conexion = new Conexion();

		
		
			$estado_defaul =1;
			$contrasena = $password;
			$cod = $this->generarContraseña(5);

			//* usuario 
			$rol = 2;
			$sql = "INSERT INTO `usuarios`(`id_rol`, `nombre`, `email`, `telefono`,  `contrasena`, `estado`) VALUES (:rol,:nombre,:correo,:telefono,:contrasena,:estado)";
			$reg = $conexion->prepare($sql);
		
			$reg->execute(array(':rol' => $rol,':nombre' => $nombre, ':correo' => $correo, ':telefono' => $telefono,   ':contrasena' => $contrasena, ':estado' => $estado_defaul));
		 
			$id_insertado = $conexion->lastInsertId();
			//dato afiliado
		

			$sql2 = "INSERT INTO `afiliado`(`id_usuarios`,`nombre`, `apellido`, `codigo`, `img`,  `telefono`, `estado`) VALUES (:id_usuarios,:nombre,:apellido,:codigo,:img,:telefono,:estado)";
			$reg2 = $conexion->prepare($sql2);
		
			$reg2->execute(array(':id_usuarios' => $id_insertado,
								':nombre' => $nombre,
								':apellido' => '',
								':codigo' => $cod,
								':img' => '',
									':telefono' => $telefono,
									':estado' => $estado_defaul));
		 


			//monedero

			$sql3 = "INSERT INTO `monedero`(`id_usuarios`,`valor`,`estado`)  VALUES (:id_usuarios,:valor,:estado)";
			$reg3 = $conexion->prepare($sql3);
		
			$reg3->execute(array(':id_usuarios' => $id_insertado,':valor' => '0', ':estado' => $estado_defaul));
		 

			//rama

			$nivel =  1;
			$ancho = 1;

	
			$sql4 = "INSERT INTO `ramas`(`id_usuarios`,`nivel`, `referido_padre`,`ancho`, `porcentaje`,`estado`)  VALUES (:id_usuarios,:nivel,:referido_padre,:ancho,:porcentaje,:estado)";
			$reg4 = $conexion->prepare($sql4);
		
			$reg4->execute(array(':id_usuarios' =>  $id_insertado, ':nivel' => $nivel, ':referido_padre' => NULL, ':ancho' => $ancho, ':porcentaje' => $porcentaje, ':estado' => $estado_defaul));
		//	emails($correo, $contrasena, $nombre);
			
	
		
        return 1;
    
    }





	function generarContraseña($longitud) {
		// Caracteres permitidos
		$caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
	
		// Obtener la longitud total de la cadena de caracteres
		$longitudCaracteres = strlen($caracteres);
	
		// Inicializar la contraseña
		$contraseña = '';
	
		// Generar la contraseña
		for ($i = 0; $i < $longitud; $i++) {
			// Obtener un carácter aleatorio de la cadena de caracteres
			$caracterAleatorio = $caracteres[rand(0, $longitudCaracteres - 1)];
	
			// Agregar el carácter a la contraseña
			$contraseña .= $caracterAleatorio;
		}
	
		// Devolver la contraseña generada
		return $contraseña;
	}

}

?>