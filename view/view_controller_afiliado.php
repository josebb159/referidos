<?php 


if(isset($_GET['view'])){

    if($_GET['view']=="usuarios"){
	
        include 'dinamic/afiliado/usuario.php';
	
    }

	elseif($_GET['view']=="colores"){
		include 'dinamic/afiliado/colores.php';
	}
	elseif($_GET['view']=="medidas"){
		include 'dinamic/afiliado/medidas.php';
	}
	
	elseif($_GET['view']=="categoria"){
		include 'dinamic/afiliado/categoria.php';
	}

	elseif($_GET['view']=="producto"){
		include 'dinamic/afiliado/producto.php';
	}
	elseif($_GET['view']=="afiliado"){
		include 'dinamic/afiliado/afiliado.php';
	}
	elseif($_GET['view']=="monedero"){
		include 'dinamic/afiliado/monedero.php';
	}
	elseif($_GET['view']=="transacciones"){
		include 'dinamic/afiliado/transacciones.php';
	}
	elseif($_GET['view']=="ramas"){
		include 'dinamic/afiliado/ramas.php';
	}
/*construir*/

    elseif($_GET['view']=="logout"){
        include 'logout.php';
    }
    

}else{
    include 'dinamic/afiliado/index.php';
}
    
    



?>
