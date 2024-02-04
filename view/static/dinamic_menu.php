<?php 
if(isset($_SESSION['rol'])){
    $rol = $_SESSION['rol'];
}else{
    $rol = "";
}


if($rol=="Usuario Nivel 1"){

    include 'menu_usuario1.php';

}elseif($rol=="Usuario Nivel 2"){
    
    include 'menu_usuario2.php';

}elseif($rol=="Usuario Nivel 3"){

    include 'menu_usuario3.php';

}elseif($rol=="afiliado"){

    include 'menu_afiliado.php';

}elseif($rol=="administrador"){
  
    include 'menu.php';

}else{}





?>