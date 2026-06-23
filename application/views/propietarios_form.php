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
			<a href="<?php echo site_url('propietarios') ?>" class="btn btn-primary mb-3">Regresar</a>
			<div class="card mb-4">
				<div class="card-header">
					<string>Ingrese la información solicitada</string>
				</div>
				<div class="card-body">


					<div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1003">
						<?php echo form_open("propietarios/$action/$id", array('id'=>'form-validate','class'=>'row g-3 ')) ?>
							<div class="col-md-4">
								<label class="form-label" for="inputEmail4">Nombres</label>
								<input type="text" name="nombres" class="form-control" id="txtNombre" value="<?php echo $fields['nombres']['value'] ?>">
							</div>
							<div class="col-md-4">
								<label class="form-label" for="inputPassword4">Apellido Paterno</label>
								<input type="text" name="apellido_paterno" class="form-control" id="txtPaterno" value="<?php echo $fields['apellido_paterno']['value'] ?>">
							</div>
							<div class="col-md-4">
								<label class="form-label" for="inputPassword4">Apellido Materno</label>
								<input type="text" name="apellido_materno" class="form-control" id="txtMaterno" value="<?php echo $fields['apellido_materno']['value'] ?>">
							</div>							
							<div class="col-md-6">
								<label class="form-label" for="inputPassword4">Número de celular 1</label>
								<input type="text" name="numero_celular_1" class="form-control" id="txtCel1" value="<?php echo $fields['numero_celular_1']['value'] ?>">
							</div>
							<div class="col-md-6">
								<label class="form-label" for="inputPassword4">Número de celular 1</label>
								<input type="text" name="numero_celular_2" class="form-control" id="txtCel2" value="<?php echo $fields['numero_celular_2']['value'] ?>">
							</div>
							<div class="col-md-6">
								<label class="form-label" for="inputPassword4">RFC</label>
								<input type="text" name="rfc" class="form-control" id="txtRFC" value="<?php echo $fields['rfc']['value'] ?>">
							</div>
							<div class="col-md-6">
								<label class="form-label" for="inputPassword4">CURP</label>
								<input type="text" name="curp" class="form-control" id="txtCURP" value="<?php echo $fields['curp']['value'] ?>">
							</div>
							<div class="col-md-6">
								<label class="form-label" for="inputPassword4">Correo electrónico</label>
								<input type="email" name="email" class="form-control" id="txtEmail" value="<?php echo $fields['email']['value'] ?>">
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
					nombres: {
						required : true,
						minlength: 3
					},
					apellido_paterno: {
						required : true,
						minlength: 3
					},
					apellido_materno: {
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