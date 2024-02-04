<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/tmp'));
include '../model/usuario.php';
include '../framework/phpmailer/para_pruebas.php';

if(isset($_POST['id'])){
   $id =  $_POST['id'];
}

if(isset($_POST['rol'])){
   $rol =  $_POST['rol'];
}

if(isset($_POST['email'])){
   $email =  $_POST['email'];
}

 if(isset($_POST['op'])){
    $op =  $_POST['op'];
 }



 switch ($op) {
     case 'password_recovery':
       $n_usuario  = new usuario();


        $resultado = $n_usuario -> buscar_contrasena( $email);
         if($resultado){
            foreach($resultado as $result){
                emails($email, $result['contrasena'],$result['nombre']);
            }
            
         }
         echo 1;

        
         break;
       
        
 }


?>