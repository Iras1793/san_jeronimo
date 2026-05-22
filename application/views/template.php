<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="es">

<head> 
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	
	<title><?php echo $title; ?></title>
	<meta content="Unión San Jerónimo - Bilbao" name="description">
	<meta name="theme-color" content="#ffffff">

	<link href="<?php #echo base_url('assets/img/icon.png') ?>" rel="icon">
	<link href="<?php #echo base_url('assets/img/icon.png') ?>" rel="apple-touch-icon">

    <link rel="stylesheet" href="<?php echo base_url('assets/css/simplebar.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/simplebar_2.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css') ?>">

    <script src="<?php echo base_url('assets/js/config.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/color-modes.js') ?>"></script>
</head>

<body>


	<?php echo $content; ?>





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
</body>

</html>
