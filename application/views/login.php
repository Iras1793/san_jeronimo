<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
		<title><?php echo $title; ?></title>
		<meta name="theme-color" content="#ffffff">

		<link href="<?php echo base_url('assets/favicon.png') ?>" rel="icon">
		<link href="<?php echo base_url('assets/favicon.png') ?>" rel="apple-touch-icon">

		<link rel="stylesheet" href="<?php echo base_url('assets/css/simplebar.css') ?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/css/simplebar_2.css') ?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css') ?>">

		<script src="<?php echo base_url('assets/js/config.js') ?>"></script>
		<script src="<?php echo base_url('assets/js/color-modes.js') ?>"></script>
	</head>
	<body>

	<div class="bg-body-tertiary min-vh-100 d-flex flex-row align-items-center">
		<div class="container" style="max-width: 32rem">
			<div class="d-flex flex-column gap-4">
				<img src="<?php echo base_url('assets/favicon.png') ?>" alt="Logo">
				<div class="card p-4">
					<div class="card-body d-flex flex-column gap-4">
						<h2 class="h5 text-center">Bienvenido</h2>
						<form class="row gap-3" action="./" method="get" autocomplete="off" novalidate>
							<div>
								<label class="form-label" for="email">Correo</label>
								<input class="form-control" id="email" type="email" placeholder="ejemplo@email.com" autocomplete="off">
							</div>
							<div>
								<div class="d-flex justify-content-between">
									<label class="form-label" for="password">Contraseña</label>
								</div>
								<div class="input-group">
									<input class="form-control" id="password" type="password" placeholder="123456" autocomplete="off">
								</div>
							</div>
							<div>
								<button class="btn btn-primary w-100" type="submit">Ingresar</button>
							</div>
						</form>
          
					</div>
				</div>
      
			</div>
		</div>
	</div>

	<script src="<?php echo base_url('assets/js/coreui.bundle.min.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/simplebar.min.js') ?>"></script>
	<script>
		const header = document.querySelector("header.header");
		document.addEventListener("scroll", () => {
			if (header) {
				header.classList.toggle("shadow-sm", document.documentElement.scrollTop > 0);
			}
		});
	</script>
    <script>
		const tooltipTriggerList = document.querySelectorAll('[data-coreui-toggle="tooltip"]');
		const tooltipList = [...tooltipTriggerList].map((tooltipTriggerEl) => new coreui.Tooltip(tooltipTriggerEl));
    </script>
	</body>
</html>
