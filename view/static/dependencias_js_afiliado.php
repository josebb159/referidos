<?php

if(isset($_GET['view'])){

    if($_GET['view']=="agregar_categoria"){
        echo "<script src='../assets/js/functions/afiliado/agregar_categoria.js'></script>";
   
    }
  
	if($_GET['view']=="usuario"){
		echo "<script src='../assets/js/functions/afiliado/usuario.js'></script>";
	}

	if($_GET['view']=="categoria"){
		echo "<script src='../assets/js/functions/afiliado/categoria.js'></script>";
	}
	if($_GET['view']=="colores"){
		echo "<script src='../assets/js/functions/afiliado/colores.js'></script>";
	}
	if($_GET['view']=="medidas"){
		echo "<script src='../assets/js/functions/afiliado/medidas.js'></script>";
	}
	

	if($_GET['view']=="producto"){
		echo "<script src='../assets/js/functions/afiliado/producto.js'></script>";
	}
	if($_GET['view']=="afiliado"){
		echo "<script src='../assets/js/functions/afiliado/afiliado.js'></script>";
	}
	if($_GET['view']=="monedero"){
		echo "<script src='../assets/js/functions/afiliado/monedero.js'></script>";
	}
	if($_GET['view']=="transacciones"){
		echo "<script src='../assets/js/functions/afiliado/transacciones.js'></script>";
	}
	if($_GET['view']=="ramas"){
		echo "<script src='../assets/js/functions/afiliado/ramas.js'></script>";
	}
/*construir*/
    
    
}else{
   // echo "<script src='../assets/js/functions/afiliado/dashboard.js'></script>";
	echo "<script src='../assets/js/functions/afiliado/index.js'></script>";
}
    
    


?>