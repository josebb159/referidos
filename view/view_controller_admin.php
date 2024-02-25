<?php 


if(isset($_GET['view'])){

    if($_GET['view']=="usuarios"){
	
        include 'dinamic/administrador/usuario.php';
	
    }

	elseif($_GET['view']=="colores"){
		include 'dinamic/administrador/colores.php';
	}
	elseif($_GET['view']=="medidas"){
		include 'dinamic/administrador/medidas.php';
	}
	
	elseif($_GET['view']=="categoria"){
		include 'dinamic/administrador/categoria.php';
	}

	elseif($_GET['view']=="producto"){
		include 'dinamic/administrador/producto.php';
	}
	elseif($_GET['view']=="afiliado"){
		include 'dinamic/administrador/afiliado.php';
	}
	elseif($_GET['view']=="monedero"){
		include 'dinamic/administrador/monedero.php';
	}
	elseif($_GET['view']=="transacciones"){
		include 'dinamic/administrador/transacciones.php';
	}
	elseif($_GET['view']=="transaccionesretiro"){
		include 'dinamic/administrador/transaccionesRetiro.php';
	}
	elseif($_GET['view']=="ramas"){
		include 'dinamic/administrador/ramas.php';
	}
		elseif($_GET['view']=="async"){
		include 'dinamic/administrador/async.php';
	}
/*construir*/

    elseif($_GET['view']=="logout"){
        include 'logout.php';
    }
    

}else{
    include 'dinamic/administrador/index.php';
}
    
    



?>
