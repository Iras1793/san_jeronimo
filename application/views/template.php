<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="es">

<head> 
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title><?php echo $title; ?></title>
	<meta content="Desarrollo de sitios web" name="description">
	<meta content="Web development" name="keywords">
	<link href="<?php #echo base_url('assets/img/icon.png') ?>" rel="icon">
	<link href="<?php #echo base_url('assets/img/icon.png') ?>" rel="apple-touch-icon">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

	<!-- Vendor CSS Files -->
	<?php foreach ($estilos as $key => $css): ?>
		<link rel="stylesheet" href="<?php echo base_url($css) ?>">
	<?php endforeach ?>

</head>

<body>


	<?php echo $content; ?>




	<!-- Vendor JS Files -->
	<?php foreach ($javascript as $key => $js): ?>
		<script src="<?php echo base_url($js) ?>"></script>
	<?php endforeach ?>
	<script>
		window.onload = function(){
			if (window.jQuery) {
				//code
			}
		};
	</script>
</body>

</html>
