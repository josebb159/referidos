<?php

include '../model/sync_data.php';
include '../model/afiliado.php';


$users = new afiliado();
$users2 = new afiliado();

$users->expire_afiliado();

$users = $users->buscar_afiliado_email_inactivo();
$arrayCorreos = [];


foreach($users as $user){
   $arrayCorreos[]=  $user['email'];
 
}

// Crear la parte IN de la consulta
$correosIN = implode("','", $arrayCorreos);
$data = new sync_data();
$re=$data->get_data($correosIN);


$users = new afiliado();
$users2 = new afiliado();





if($re!=0){
foreach($re as $user){
    $pay = $data->get_data_to_pay($user['user_email']);    
    if($pay==1){
        continue;
    }
    
    
    $result = $users->buscar_afiliado_from_email($user['user_email']);
 
    $users2->validar_afiliado($result[0]['id']);
}    
}


?>