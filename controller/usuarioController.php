<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/tmp'));
include '../model/usuario.php';

if(isset($_POST['id'])){
   $id =  $_POST['id'];
}

if(isset($_POST['rol'])){
   $rol =  $_POST['rol'];
}

if(isset($_POST['nombre'])){
   $nombre =  $_POST['nombre'];
}

if(isset($_POST['apellido'])){
   $apellido =  $_POST['apellido'];
}



if(isset($_POST['usuario'])){
    $usuario =  $_POST['usuario'];
 }

 if(isset($_POST['contrasena'])){
    $contrasena =  $_POST['contrasena'];
 }

 if(isset($_POST['estado'])){
    $estado =  $_POST['estado'];
 }

 if(isset($_POST['op'])){
    $op =  $_POST['op'];
 }



 switch ($op) {
     case 'login':
       $n_usuario  = new usuario();


        $resultado = $n_usuario -> login( $usuario, $contrasena);
         if($resultado ==TRUE){
            $n_usuario -> obtener_rol();
         }
         echo $resultado;

        
         break;
         case 'registrar':
            $n_usuario  = new usuario();
     
             $resultado = $n_usuario -> registrar_usuario($rol, $nombre, $apellido, $usuario, $contrasena);
           
              echo $resultado;
     
             
              break;
     
         default:
         case 'buscar':

            $n_usuario  = new usuario();
            $resultado = $n_usuario -> buscar_usuarios();
        
   
            foreach ($resultado as $key) {
               if($key['estado']=="1"){
                  $st = " checked";
               }else{
                  $st = "";
               }
   
               ?>
                   <tr>
                                               <td><?php echo $key['id']; ?></td>
                                               <td><?php echo $key['nombre']; ?></td>
                                               <td><?php echo $key['email']; ?></td>
                                  
                                               <td><?php echo $key['fecha_registro']; ?></td>
                                               <td>   
                                                     <?php include '../view/static/bt_estado.php';  ?>
                                               </td>
                                               <td>
                                               <div class="dropdown">
                                                      <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                      Acciones
                                                         <i class="mdi mdi-chevron-down"></i>
                                                      </button>
                                                
                                                </div>
                                               </td>
                                  
                   </tr>
   
   
               <?php
   
    
         
   
           }
               
          break;  
          case 'buscar_select':

            $n_usuario  = new usuario();
            $resultado = $n_usuario -> buscar_usuarios_afiliado();
        
   
            foreach ($resultado as $key) {

               ?>
               <option value="<?php echo $key['codigo']; ?>"><?php echo $key['email']; ?></option>
               <?php

           }
               
          break; 
          case 'cambiar_estado':

            $n_usuario  = new usuario();
            $resultado = $n_usuario -> cambiar_estado_usuario($id, $estado);
            echo 1;
               
          break;  
          case 'eliminar':
            
         
            $n_usuario  = new usuario();
            $resultado = $n_usuario -> eliminar_usuario($id);
           echo 1;
            
          break;
          case 'buscar_modificar':
   
            $n_usuario  = new usuario();
            $resultado = $n_usuario -> buscar_usuario_json($id);
            echo $resultado;
          
          break;    
          case 'modificar':
   
            $n_usuario  = new usuario();
            $resultado = $n_usuario -> modificar_usuario($id,$nombre, $apellido, $usuario, $contrasena, $rol);
            echo $resultado;
          
          break;   
        
 }


?>