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
		 <a href="home.php?view=async" class=" waves-effect <?php if($valor=="async"){ echo "active mm-active"; } ?>">
			<i class="mdi mdi-source-branch"></i>
			<span>Async</span>
		</a>
	</li>
<!--construir-->

                    </ul>
                </div>		
        
        