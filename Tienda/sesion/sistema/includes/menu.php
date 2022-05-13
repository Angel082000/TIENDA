<!-- Sidebar -->

 <?php if ($_SESSION['rol'] == 1) { ?>
                                <ul class="navbar-nav  sidebar sidebar-dark accordion"  style="background-color: #9B0A0A;" id="accordionSidebar">
                            <?php }else{ ?> 
                             <ul class="navbar-nav  sidebar sidebar-dark accordion"  style="background-color: #00198A;" id="accordionSidebar">
                                
                                <?php }?>


	<!-- Sidebar - Brand -->
	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
		<div class="sidebar-brand-icon ">
			<img src="img/venta.png" class="img-thumbnail">
		</div>
           
		<div class="sidebar-brand-text mx-3">TIENDA ONLINE</div>
                
	</a>

	<!-- Divider -->
	<hr class="sidebar-divider my-0">

	<!-- Divider -->
	<hr class="sidebar-divider">

	<!-- Heading -->
	<div class="sidebar-heading">
		OPCIONES
	</div>

	<!-- Nav Item - Pages Collapse Menu -->
        
        <?php if ($_SESSION['rol'] == 1) { ?>

<li class="nav-item">
		<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
			<i class="fas fa-fw fa-cog"></i>
			<span>Ventas</span>
		</a>
		<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				
				<a class="collapse-item" href="ventas.php">Ventas</a>
			</div>
		</div>
	</li>
        
        <?php }else{?>
        	<li class="nav-item">
		<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
			<i class="fas fa-fw fa-cog"></i>
			<span>MIS COMPRAS</span>
		</a>
		<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item" href="nueva_venta.php">Nueva Compra</a>
				<a class="collapse-item" href="ventas.php">Mis compras</a>
			</div>
		</div>
	</li>
        
        
        <?php }?>
        
        


	<!-- Nav Item - Productos Collapse Menu -->
        
           <?php if ($_SESSION['rol'] == 1) { ?>
	<li class="nav-item">
		<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
			<i class="fas fa-fw fa-wrench"></i>
			<span>Productos</span>
		</a>
		<div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item" href="registro_producto.php">Nuevo Producto</a>
				<a class="collapse-item" href="lista_productos.php">Productos</a>
			</div>
		</div>
	</li>
        <?php }else{?>
     	<li class="nav-item">
		<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
			<i class="fas fa-fw fa-wrench"></i>
			<span>Productos</span>
		</a>
		<div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				
				<a class="collapse-item" href="lista_productos.php">Productos</a>
			</div>
		</div>
	</li>
        <?php }?>
        
      
        
        
        
        
        
   
	<!-- Nav Item - Clientes Collapse Menu -->
          
        <?php if ($_SESSION['rol'] == 1) { ?>
<li class="nav-item">
		<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseClientes" aria-expanded="true" aria-controls="collapseUtilities">
			<i class="fas fa-users"></i>
			<span>Clientes</span>
		</a>
		<div id="collapseClientes" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				
				<a class="collapse-item" href="lista_cliente.php">Clientes</a>
			</div>
		</div>
	</li>
        <?php }?>

        
        
        
	<!-- Nav Item - Utilities Collapse Menu -->
        
        
        
        
        
        
        
        
         <?php if ($_SESSION['rol'] == 1) { ?>
    
	<li class="nav-item">
		<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProveedor" aria-expanded="true" aria-controls="collapseUtilities">
			<i class="fas fa-hospital"></i>
			<span>Proveedor</span>
		</a>
		<div id="collapseProveedor" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item" href="registro_proveedor.php">Nuevo Proveedor</a>
				<a class="collapse-item" href="lista_proveedor.php">Proveedores</a>
			</div>
		</div>
	</li>
        <?php }?>
        
        
        
        
        
    
        
        
        
        
	<?php if ($_SESSION['rol'] == 1) { ?>
		<!-- Nav Item - Usuarios Collapse Menu -->
		<li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsuarios" aria-expanded="true" aria-controls="collapseUtilities">
				<i class="fas fa-user"></i>
				<span>Usuarios</span>
			</a>
			<div id="collapseUsuarios" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
				<div class="bg-white py-2 collapse-inner rounded">
					<a class="collapse-item" href="registro_usuario.php">Nuevo Usuario</a>
					<a class="collapse-item" href="lista_usuarios.php">Usuarios</a>
				</div>
			</div>
		</li>
	<?php } ?>

</ul>