<!--- Sidemenu -->
<?php 

if(isset($_GET['view'])){
   $valor = $_GET['view'];

}else{
    $valor ="dashboard";
}



?>



<div id="sidebar-menu">
                    <!-- Left Menu Start -->
   <ul class="metismenu list-unstyled" id="side-menu">
   <li class="menu-title">Menu</li>
  
   <li>               
       <a href="home.php?" class="waves-effect  <?php if($valor=="dashboard"){ echo "active mm-active"; } ?>">
           <i class="mdi mdi-table-large"></i>
           <span>Panel Administrativo</span>
       </a>
   </li>

   <li>
       <a href="home.php?view=usuarios" class=" waves-effect <?php if($valor=="usuarios"){ echo "active mm-active"; } ?>">
           <i class="mdi mdi-account"></i>
           <span>Usuarios</span>
       </a>
   </li>


	<li>
		 <a href="home.php?view=afiliado" class=" waves-effect <?php if($valor=="afiliado"){ echo "active mm-active"; } ?>">
			<i class="mdi mdi-account-child"></i>
			<span>Afiliado</span>
		</a>
	</li>
	<li>
		 <a href="home.php?view=monedero" class=" waves-effect <?php if($valor=="monedero"){ echo "active mm-active"; } ?>">
			<i class="mdi mdi-wallet"></i>
			<span>Monedero</span>
		</a>
	</li>
	<li>
		 <a href="home.php?view=transacciones" class=" waves-effect <?php if($valor=="transacciones"){ echo "active mm-active"; } ?>">
			<i class="mdi mdi-swap-horizontal"></i>
			<span>Transacciones</span>
		</a>
	</li>
	<li>
		 <a href="home.php?view=transaccionesretiro" class=" waves-effect <?php if($valor=="transaccionesretiro"){ echo "active mm-active"; } ?>">
			<i class="mdi mdi-swap-horizontal"></i>
			<span>Transacciones Retiro</span>
		</a>
	</li>
	<li>
		 <a href="home.php?view=ramas" class=" waves-effect <?php if($valor=="ramas"){ echo "active mm-active"; } ?>">
			<i class="mdi mdi-source-branch"></i>
			<span>Red</span>
		</a>
	</li>
	<li>
		 <a href="home.php?view=async" class=" waves-effect <?php if($valor=="async"){ echo "active mm-active"; } ?>">
			<i class="mdi mdi-source-branch"></i>
			<span>Async</span>
		</a>
	</li>
<!--construir-->

                    </ul>
                </div>		
        
        