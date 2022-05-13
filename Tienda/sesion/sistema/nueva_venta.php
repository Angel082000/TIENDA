<?php include_once "includes/header.php"; ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <h4 class="text-center">AGREGA PRODUCTOS A TU CARRITO DE COMPRAS</h4>
                              
                            </div>
                            
                            
                <div class="row">
		<div class="col-lg-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered" id="table">
					<thead class="thead-dark">
						<tr>
							<th>CÓDIGO</th>
							<th>PRODUCTO</th>
							<th>PRECIO</th>
							<th>STOCK</th>
							<?php if ($_SESSION['rol'] == 1) { ?>
							<th>ACCIONES</th>
							<?php } ?>
						</tr>
					</thead>
					<tbody>
						<?php
						include "../conexion.php";

						$query = mysqli_query($conexion, "SELECT * FROM producto");
						$result = mysqli_num_rows($query);
						if ($result > 0) {
							while ($data = mysqli_fetch_assoc($query)) { ?>
								<tr>
									<td><?php echo $data['codproducto']; ?></td>
									<td><?php echo $data['descripcion']; ?></td>
									<td><?php echo $data['precio']; ?></td>
									<td><?php echo $data['existencia']; ?></td>
										<?php if ($_SESSION['rol'] == 1) { ?>
									<td>
										<a href="agregar_producto.php?id=<?php echo $data['codproducto']; ?>" class="btn btn-primary"><i class='fas fa-audio-description'></i></a>

										<a href="editar_producto.php?id=<?php echo $data['codproducto']; ?>" class="btn btn-success"><i class='fas fa-edit'></i></a>

										<form action="eliminar_producto.php?id=<?php echo $data['codproducto']; ?>" method="post" class="confirmar d-inline">
											<button class="btn btn-danger" type="submit"><i class='fas fa-trash-alt'></i> </button>
										</form>
									</td>
										<?php } ?>
								</tr>
						<?php }
						} ?>
					</tbody>

				</table>
			</div>

		</div>
	</div>            
                            
                            
                            
                            
                            <div class="card">
                           
                                        
                                        <?php $cod = $_SESSION['idUser'];?>
                                        
                                        
                                        <input type="hidden" id="idcliente" value="<?php echo $cod; ?>" name="idcliente" required>
                       
                            </div>
                            <h4 class="text-center">CARRITO DE COMPRAS</h4>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label><i class="fas fa-user"></i> CLIENTE</label>
                                        <p style="font-size: 16px; text-transform: uppercase; color: blue;"><?php echo $_SESSION['nombre']; ?></p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label>Acciones</label>
                                    <div id="acciones_venta" class="form-group">
                                        <a href="#" class="btn btn-danger" id="btn_anular_venta">Anular</a>
                                        <a href="#" class="btn btn-primary" id="btn_facturar_venta"><i class="fas fa-save"></i> Generar Compra</a>
                                    </div>
                                </div>
                            </div>
                              <div class="table-responsive">
                                  Ingresa el código del producto que quieres
                                <table class="table table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th width="100px">CÓDIGO</th>
                                            <th>Des.</th>
                                            <th>Stock</th>
                                            <th width="100px">Cantidad</th>
                                            <th class="textright">Precio</th>
                                            <th class="textright">Precio Total</th>
                                            <th>Acciones</th>
                                        </tr>
                                        <tr>
                                            <td><input type="number" name="txt_cod_producto" id="txt_cod_producto"></td>
                                            <td id="txt_descripcion">-</td>
                                            <td id="txt_existencia">-</td>
                                            <td><input type="text" name="txt_cant_producto" id="txt_cant_producto"value="0" min="1" disabled></td>
                                            <td id="txt_precio" class="textright">0.00</td>
                                            <td id="txt_precio_total" class="txtright">0.00</td>
                                            <td><a href="#" id="add_product_venta" class="btn btn-dark" style="display: none;">Agregar</a></td>
                                        </tr>
                                        <tr>
                                            <th>CÓDIGO</th>
                                            <th colspan="2">Descripción</th>
                                            <th>Cantidad</th>
                                            <th class="textright">Precio</th>
                                            <th class="textright">Precio Total</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="detalle_venta">
                                        <!-- Contenido ajax -->

                                    </tbody>

                                    <tfoot id="detalle_totales">
                                        <!-- Contenido ajax -->
                                    </tfoot>
                                </table>

                              </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->


            <?php include_once "includes/footer.php"; ?>
