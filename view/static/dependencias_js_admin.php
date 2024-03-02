<?php

if(isset($_GET['view'])){

    if($_GET['view']=="agregar_categoria"){
        echo "<script src='../assets/js/functions/administrador/agregar_categoria.js'></script>";
   
    }
  


	if($_GET['view']=="categoria"){
		echo "<script src='../assets/js/functions/administrador/categoria.js'></script>";
	}
	if($_GET['view']=="colores"){
		echo "<script src='../assets/js/functions/administrador/colores.js'></script>";
	}
	if($_GET['view']=="medidas"){
		echo "<script src='../assets/js/functions/administrador/medidas.js'></script>";
	}
	

	if($_GET['view']=="producto"){
		echo "<script src='../assets/js/functions/administrador/producto.js'></script>";
	}
	if($_GET['view']=="afiliado"){
		echo "<script src='../assets/js/functions/administrador/afiliado.js'></script>";
	}
	if($_GET['view']=="monedero"){
		echo "<script src='../assets/js/functions/administrador/monedero.js'></script>";
	}
	if($_GET['view']=="transacciones"){
		echo "<script src='../assets/js/functions/administrador/transacciones.js'></script>";
	}
	if($_GET['view']=="transaccionesretiro"){
		echo "<script src='../assets/js/functions/administrador/transaccionesretiro.js'></script>";
	}
	if($_GET['view']=="ramas"){
		echo "<script src='../assets/js/functions/administrador/ramas.js'></script>";
	}
	if($_GET['view']=="async"){
		echo "<script src='../assets/js/functions/administrador/async.js'></script>";
	}
	if($_GET['view']=="usuarios"){
		echo "<script src='../assets/js/functions/administrador/usuario.js'></script>";
	}
	if($_GET['view']=="info_afiliado"){
		echo "<script src='../assets/js/functions/administrador/info_afiliado.js'></script>";
	}
/*construir*/
    
    
}else{
    echo "<script src='../assets/js/functions/administrador/dashboard.js'></script>";
}
    
    


?>