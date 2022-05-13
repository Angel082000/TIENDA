

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->

		<h1 class="h3 mb-0 text-gray-800">Contactos</h1>
                <br>
        
                <h2 style="color: #00145A; font-family:'Carter One', cursive;">A continuación se muestra una lista con los contactos que usted puede recurrir para hacer sus compras</h2>


	<div class="row">
		<div class="col-lg-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered" id="table">
					<thead class="thead-dark">
						<tr>
							
							<th>NOMBRE</th>
							<th>CORREO</th>
						
							<th>CARGO</th>
						
						</tr>
					</thead>
					<tbody>
						<?php
						include "conexion.php";

						$query = mysqli_query($conexion, "SELECT u.idusuario, u.nombre, u.correo, u.usuario, r.rol FROM usuario u INNER JOIN rol r ON u.rol = r.idrol");
						$result = mysqli_num_rows($query);
						if ($result > 0) {
							while ($data = mysqli_fetch_assoc($query)) { ?>
								<tr>
								
									<td><?php echo $data['nombre']; ?></td>
									<td><?php echo $data['correo']; ?></td>
								
									<td><?php echo $data['rol']; ?></td>
									
								</tr>
						<?php }
						} ?>
					</tbody>

				</table>
			</div>

		</div>
	</div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


