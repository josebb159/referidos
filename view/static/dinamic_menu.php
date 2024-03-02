<?php 
if(isset($_SESSION['rol'])){
    $rol = $_SESSION['rol'];
}else{
    $rol = "";
}


if($rol=="Usuario Nivel 1"){

    include 'menu_usuario1.php';

}elseif($rol=="subadm2"){
    
    include 'menu_sub2.php';

}elseif($rol=="subadm1"){

    include 'menu_sub1.php';

}elseif($rol=="afiliado"){

    include 'menu_afiliado.php';

}elseif($rol=="administrador"){
  
    include 'menu.php';

}else{}





?>