<?php #foreach ($estilos as $key => $css): ?>
	<!--<link rel="stylesheet" href="<?php #echo base_url($css) ?>">-->
<?php #endforeach ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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
			<a href="<?php echo site_url('viviendas') ?>" class="btn btn-primary mb-3">Regresar</a>
			<div class="card mb-4">
				<div class="card-header">
					<string>Ingrese la información solicitada</string>
				</div>
				<div class="card-body">


					<div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1003">
						<?php echo form_open("viviendas/$action/$id", array('id'=>'form-validate','class'=>'row g-3 ')) ?>
							<div class="col-md-3">
								<label class="form-label" for="inputEmail4">Calle</label>
								<input type="text" name="calle" class="form-control" id="" value="<?php echo $fields['calle']['value'] ?>">
							</div>
							<div class="col-md-3">
								<label class="form-label" for="inputPassword4">Número</label>
								<input type="number" name="numero" min="1" max="500" class="form-control" id="" value="<?php echo $fields['numero']['value'] ?>">
							</div>
							<div class="col-md-3">
								<label class="form-label" for="inputPassword4">Lote</label>
								<input type="number" name="lote" min="1" max="500" class="form-control" id="" value="<?php echo $fields['lote']['value'] ?>">
							</div>							
							<div class="col-md-3">
								<label class="form-label" for="inputPassword4">Manzana</label>
								<input type="number" name="mz"  min="1" max="500" class="form-control" id="" value="<?php echo $fields['mz']['value'] ?>">
							</div>
							<div class="col-md-3">
								<label class="form-label" for="inputPassword4">Prototipo</label>
								<select name="prototipo" class="form-select">
									<option value="">Selecciona una opción</option>
									<option value="Alcala" <?php echo ($fields['prototipo']['value']=='Alcala') ? 'selected':''  ?>>Alcalá</option>
									<option value="Alcala-Ampliada" <?php echo ($fields['prototipo']['value']=='Alcala-Ampliada') ? 'selected':''  ?>>Alcalá - Ampliada</option>
									<option value="Cataluña" <?php echo ($fields['prototipo']['value']=='Cataluña') ? 'selected':''  ?>>Cataluña</option>
									<option value="Seneca" <?php echo ($fields['prototipo']['value']=='Seneca') ? 'selected':''  ?>>Séneca</option>
									<option value="Montalvo" <?php echo ($fields['prototipo']['value']=='Montalvo') ? 'selected':''  ?>>Montalvo</option>

								</select>
							</div>
							<div class="col-md-3">
								<label class="form-label" for="inputPassword4">Código identificador</label>
								<input type="text" name="codigo_identificador" class="form-control" id="" value="<?php echo $fields['codigo_identificador']['value'] ?>">
							</div>
							<div class="col-md-3">
								<label class="form-label" for="inputPassword4">Número de marbetes autorizados</label>
								<input type="number" name="numero_marbetes_autorizados" min="1" max="3" class="form-control" id="" value="<?php echo $fields['numero_marbetes_autorizados']['value'] ?>">
							</div>
							<div class="col-md-3">
								<label class="form-label" for="inputPassword4">Fecha de entrega</label>
								<input type="text" name="fecha_entrega" class="form-control" id="fechaEntrega" value="<?php echo $fields['fecha_entrega']['value'] ?>">
							</div>
							<div class="col-md-3">
								<label class="form-label" for="inputPassword4">Propietario</label>
								<!--<input type="text" name="propietario" class="form-control" id="" value="<?php #echo $fields['propietario']['value'] ?>">-->
								<select name="propietario" class="form-select" name="propietario" id="">
									<option value="">Seleccionar propietario</option>
									<?php foreach($lista_propietarios as $key=>$data): ?>
										<?php if ($data->id==$fields['propietario']['value']): ?>
											<option value="<?php echo $data->id ?>" selected><?php echo "$data->nombres $data->apellido_paterno $data->apellido_materno" ?></option>
										<?php else: ?>
											<option value="<?php echo $data->id ?>"><?php echo "$data->nombres $data->apellido_paterno $data->apellido_materno" ?></option>
										<?php endif ?>
									<?php endforeach; ?>
								</select>
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

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/es.js"></script>
<script>
	
  
	window.onload = function(){
		if (window.jQuery) {
			flatpickr("#fechaEntrega", {
				dateFormat: "Y-m-d",
				locale: "es",
			    disable: [
			        {
			            from: "1900-01-01",
			            to: "2019-12-31"
			        }
			    ]				
			});			
			$("#form-validate").validate({
				rules: {
					calle: {
						required : true,
						minlength: 1
					},
					numero: {
						required : true,
						minlength: 1,
						min:1,
						max:500						
					},
					lote: {
						required : true,
						minlength: 1,
						min:1,
						max:500						
					},
					mz: {
						required : true,
						minlength: 1,
						min:1,
						max:500
					},
					prototipo: {
						required : true,
						minlength: 1
					},
					codigo_identificador: {
						required : true,
						minlength: 1
					},
					numero_marbetes_autorizados: {
						required : true,
						minlength: 1,
						min:1,
						max:3
					},
					fecha_entrega: {
						required : true,
						minlength: 3
					},
					propietario: {
						required : true,
						minlength: 1
					},

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