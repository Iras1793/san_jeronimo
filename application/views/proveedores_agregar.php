<?php #foreach ($estilos as $key => $css): ?>
	<!--<link rel="stylesheet" href="<?php #echo base_url($css) ?>">-->
<?php #endforeach ?>


<div class="wrapper d-flex flex-column min-vh-100">

	<?php echo $menu_superior; ?>

	

	<!-- Comienza contenido -->
	<div class="body flex-grow-1">
		<div class="container-lg px-4">
			<a href="<?php echo site_url('proveedores') ?>" class="btn btn-primary mb-3">Regresar</a>
			<div class="card mb-4">
				<div class="card-header">
					<string>Ingrese la información solicitada</string>
				</div>
				<div class="card-body">


					<div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1003">
						<form class="row g-3">
							<div class="col-md-6">
							<label class="form-label" for="inputEmail4">Email</label>
							<input class="form-control" id="inputEmail4" type="email">
							</div>
							<div class="col-md-6">
							<label class="form-label" for="inputPassword4">Password</label>
							<input class="form-control" id="inputPassword4" type="password">
							</div>
							<div class="col-12">
							<label class="form-label" for="inputAddress">Address</label>
							<input class="form-control" id="inputAddress" type="text" placeholder="1234 Main St">
							</div>
							<div class="col-12">
							<label class="form-label" for="inputAddress2">Address 2</label>
							<input class="form-control" id="inputAddress2" type="text" placeholder="Apartment, studio, or floor">
							</div>
							<div class="col-md-6">
							<label class="form-label" for="inputCity">City</label>
							<input class="form-control" id="inputCity" type="text">
							</div>
							<div class="col-md-4">
							<label class="form-label" for="inputState">State</label>
							<select class="form-select" id="inputState">
							<option selected="">Choose...</option>
							<option>...</option>
							</select>
							</div>
							<div class="col-md-2">
							<label class="form-label" for="inputZip">Zip</label>
							<input class="form-control" id="inputZip" type="text">
							</div>
							<div class="col-12">
							<div class="form-check">
							<input class="form-check-input" id="gridCheck" type="checkbox">
							<label class="form-check-label" for="gridCheck">Check me out</label>
							</div>
							</div>
							<div class="col-12">
							<a class="btn btn-primary" href="#">Guardar</a>
							</div>
						</form>
                      </div>



				</div>
			</div>	
		</div>
	</div>



<?php echo $footer; ?>

<?php #foreach ($javascript as $key => $js): ?>
	<!--<script src="<?php #echo base_url($js) ?>"></script>-->
<?php #endforeach ?>



</div>