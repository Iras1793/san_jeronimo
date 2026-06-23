<?php #foreach ($estilos as $key => $css): ?>
	<!--<link rel="stylesheet" href="<?php #echo base_url($css) ?>">-->
<?php #endforeach ?>
<style>
  .error{height: 30px;}
  label[class='error']{background-color:#ffa29c;margin-top: 5px;color: #ff0f00;border-radius: 5px;padding: 5px 15px 5px 15px;}
</style>

<div class="wrapper d-flex flex-column min-vh-100">

	<?php echo $menu_superior; ?>

	

	<!-- Comienza contenido -->
	<div class="body flex-grow-1">
		<div class="container-lg px-4">
			<?php echo _print_messages(); ?>
			<a href="<?php echo site_url('proveedores') ?>" class="btn btn-primary mb-3">Regresar</a>
			<div class="card mb-4">
				<div class="card-header">
					<string>Ingrese la información solicitada</string>
				</div>
				<div class="card-body">


					<div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1003">
						<?php echo form_open("proveedores/$action/$id", array('id'=>'form-validate','class'=>'row g-3 ')) ?>
							<div class="col-md-6">
							<label class="form-label" for="inputEmail4">Razón Social</label>
							<input type="text" name="razon_social" class="form-control" id="txtRazon" value="<?php echo $fields['razon_social']['value'] ?>">
							</div>
							<div class="col-md-6">
							<label class="form-label" for="inputPassword4">Nombre comercial</label>
							<input type="text" name="nombre_comercial" class="form-control" id="txtNombreComercial" value="<?php echo $fields['nombre_comercial']['value'] ?>">
							</div>
							<div class="col-md-6">
							<label class="form-label" for="inputZip">Correo electrónico</label>
							<input type="text" name="email" class="form-control" id="txtEmail" value="<?php echo $fields['email']['value'] ?>">
							</div>
							<div class="col-md-6">
							<label class="form-label" for="inputZip">Sitio web</label>
							<input type="text" name="sitio_web" class="form-control" id="txtSitio" value="<?php echo $fields['sitio_web']['value'] ?>">
							</div>
							<div class="col-md-6">
							<label class="form-label" for="inputZip">Teléfono 1</label>
							<input type="text" name="telefono_1" class="form-control" id="txtTel1" value="<?php echo $fields['telefono_1']['value'] ?>">
							</div>							
							<div class="col-md-6">
							<label class="form-label" for="inputZip">Teléfono 2</label>
							<input type="text" name="telefono_2" class="form-control" id="txtTel2" value="<?php echo $fields['telefono_2']['value'] ?>">
							</div>
							<div class="col-md-12">
							<label class="form-label" for="inputZip">Dirección física</label>
							<input type="text" name="direccion_fisica" class="form-control" id="txtDireccion" value="<?php echo $fields['direccion_fisica']['value'] ?>">
							</div>
							<div class="col-md-6">
							<label class="form-label" for="inputZip">RFC</label>
							<input type="text" name="rfc" class="form-control" id="txtRFC" value="<?php echo $fields['rfc']['value'] ?>">
							</div>
							<div class="col-12">
							<input type="submit" class="btn btn-primary" value="Guardar">
							</div>
						</form>
                      </div>



				</div>
			</div>	
		</div>
	</div>



<?php echo $footer; ?>

<?php foreach ($javascript as $key => $js): ?>
	<script src="<?php echo base_url($js) ?>"></script>
<?php endforeach ?>

<script>
	
  
	window.onload = function(){
		if (window.jQuery) {
			$("#form-validate").validate({
				rules: {
					razon_social: {
						required : true,
						minlength: 3
					},
					nombre_comercial: {
						required : true,
						minlength: 3
					},
					telefono_1: {
						required : true,
						minlength: 3
					},
					email: {
						required : true,
						minlength: 3
					}

				},

			});

    setTimeout(function () {
        $('#alert-success').removeClass('show');
        setTimeout(function () {
            $('#alert-success').remove();
        }, 500);
    }, 3000);


	}//end if



	}//end window onload	
</script>

</div>