<?php include_once "includes/header.php"; ?>

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">INICIO</h1>
	</div>

	<!-- Content Row -->
	<div class="row">

		<!-- Earnings (Monthly) Card Example -->
		

		<!-- Earnings (Monthly) Card Example -->
	

		<!-- Earnings (Monthly) Card Example -->
		<a class="col-xl-3 col-md-6 mb-4" href="lista_productos.php">
			<div class="card border-left-info shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-info text-uppercase mb-1">Productos</div>
							<div class="row no-gutters align-items-center">
								<div class="col-auto">
									<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"></div>
								</div>
								<div class="col">
									<div class="progress progress-sm mr-2">
										<div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</a>

		<!-- Pending Requests Card Example -->
                
                
                 
               
                
                
              <?php if ($_SESSION['rol'] == 2) { ?> 
                
                
                
                 <a class="col-xl-3 col-md-6 mb-4" href="ventas.php">
			<div class="card border-left-danger shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div  class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                            <h3>
                                                            MIS COMPRAS
                                                            </h3><!-- comment --></div>
						
						</div>
						<div class="col-auto">
							<i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</a>
		<a class="col-xl-3 col-md-6 mb-4" href="nueva_venta.php">
			<div class="card border-left-warning shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div  class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                            <h3>
                                                            VER MI CARRITO
                                                            </h3><!-- comment --></div>
						
						</div>
						<div class="col-auto">
							<i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</a>
                
                
               
                
                
              <?php }?> 
                
                
                
                
	</div>
	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Configuraci??n</h1>
	</div>
	<div class="row">
		<div class="col-lg-6">
			<div class="card">
				<div class="card-header bg-primary text-white">
					Informaci??n Personal
				</div>
				<div class="card-body">
					<div class="form-group">
						<label>Nombre: <strong><?php echo $_SESSION['nombre']; ?></strong></label>
					</div>
					<div class="form-group">
						<label>Correo: <strong><?php echo $_SESSION['email']; ?></strong></label>
					</div>
					<div class="form-group">
						<label>Rol: <strong><?php echo $_SESSION['rol_name']; ?></strong></label>
					</div>
					<div class="form-group">
						<label>Usuario: <strong><?php echo $_SESSION['user']; ?></strong></label>
					</div>
					<ul class="list-group">
						<li class="list-group-item active">Cambiar Contrase??a</li>
						<form action="" method=" post" name="frmChangePass" id="frmChangePass" class="p-3">
							<div class="form-group">
								<label>Contrase??a Actual</label>
								<input type="password" name="actual" id="actual" placeholder="Clave Actual" required class="form-control">
							</div>
							<div class="form-group">
								<label>Nueva Contrase??a</label>
								<input type="password" name="nueva" id="nueva" placeholder="Nueva Clave" required class="form-control">
							</div>
							<div class="form-group">
								<label>Confirmar Contrase??a</label>
								<input type="password" name="confirmar" id="confirmar" placeholder="Confirmar clave" required class="form-control">
							</div>
							<div class="alertChangePass" style="display:none;">
							</div>
							<div>
								<button type="submit" class="btn btn-primary btnChangePass">Cambiar Contrase??a</button>
							</div>
						</form>
					</ul>
				</div>
			</div>
		</div>
		<?php if ($_SESSION['rol'] == 1) { ?>
			<div class="col-lg-6">
				<div class="card">
					<div class="card-header bg-primary text-white">
						Datos de la Empresa
					</div>
					<div class="card-body">
						<form action="empresa.php" method="post" id="frmEmpresa" class="p-3">
							<div class="form-group">
								<label>Ruc:</label>
								<input type="number" name="txtDni" value="<?php echo $dni; ?>" id="txtDni" placeholder="Dni de la Empresa" required class="form-control">
							</div>
							<div class="form-group">
								<label>Nombre:</label>
								<input type="text" name="txtNombre" class="form-control" value="<?php echo $nombre_empresa; ?>" id="txtNombre" placeholder="Nombre de la Empresa" required class="form-control">
							</div>
							<div class="form-group">
								<label>Razon Social:</label>
								<input type="text" name="txtRSocial" class="form-control" value="<?php echo $razonSocial; ?>" id="txtRSocial" placeholder="Razon Social de la Empresa">
							</div>
							<div class="form-group">
								<label>Tel??fono:</label>
								<input type="number" name="txtTelEmpresa" class="form-control" value="<?php echo $telEmpresa; ?>" id="txtTelEmpresa" placeholder="tel??fono de la Empresa" required>
							</div>
							<div class="form-group">
								<label>Correo Electr??nico:</label>
								<input type="email" name="txtEmailEmpresa" class="form-control" value="<?php echo $emailEmpresa; ?>" id="txtEmailEmpresa" placeholder="Correo de la Empresa" required>
							</div>
							<div class="form-group">
								<label>Direcci??n:</label>
								<input type="text" name="txtDirEmpresa" class="form-control" value="<?php echo $dirEmpresa; ?>" id="txtDirEmpresa" placeholder="Dirreci??n de la Empresa" required>
							</div>
							<div class="form-group">
								<label>IGV (%):</label>
								<input type="text" name="txtIgv" class="form-control" value="<?php echo $igv; ?>" id="txtIgv" placeholder="IGV de la Empresa" required>
							</div>
							<?php echo isset($alert) ? $alert : ''; ?>
							<div>
								<button type="submit" class="btn btn-primary btnChangePass"><i class="fas fa-save"></i> Guardar Datos</button>
							</div>

						</form>
					</div>
				</div>
			</div>
		<?php } else { ?>
			<div class="col-lg-6">
				<div class="card">
					<div class="card-header bg-primary text-white">
						Datos de la Empresa
					</div>
					<div class="card-body">
						<div class="p-3">
							<div class="form-group">
								<strong>Ruc:</strong>
								<h6><?php echo $dni; ?></h6>
							</div>
							<div class="form-group">
								<strong>Nombre:</strong>
								<h6><?php echo $nombre_empresa; ?></h6>
							</div>
							<div class="form-group">
								<strong>Razon Social:</strong>
								<h6><?php echo $razonSocial; ?></h6>
							</div>
							<div class="form-group">
								<strong>Tel??fono:</strong>
								<?php echo $telEmpresa; ?>
							</div>
							<div class="form-group">
								<strong>Correo Electr??nico:</strong>
								<h6><?php echo $emailEmpresa; ?></h6>
							</div>
							<div class="form-group">
								<strong>Direcci??n:</strong>
								<h6><?php echo $dirEmpresa; ?></h6>
							</div>
							<div class="form-group">
								<strong>IGV (%):</strong>
								<h6><?php echo $igv; ?></h6>
							</div>

						</div>
					</div>
				</div>
			</div>

		<?php } ?>
	</div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<?php include_once "includes/footer.php"; ?>