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
 
	<link href="<?php echo base_url('assets/favicon.png') ?>" rel="icon">
	<link href="<?php echo base_url('assets/favicon.png') ?>" rel="apple-touch-icon">

    <link rel="stylesheet" href="<?php echo base_url('assets/css/simplebar.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/simplebar_2.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css') ?>">

    <script src="<?php echo base_url('assets/js/config.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/color-modes.js') ?>"></script>
</head>
 
<body>

	<div class="sidebar sidebar-dark sidebar-fixed border-end" id="sidebar">
		<div class="sidebar-header border-bottom">
			<div class="sidebar-brand me-auto">
				<!--
				<svg role="img" aria-label="CoreUI Logo Full" class="sidebar-brand-full" width="88" height="32" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 312 115">
					<g style="fill: currentColor">
						<path d="M96 24.124 57 1.608a12 12 0 0 0-12 0L6 24.124a12.034 12.034 0 0 0-6 10.393V79.55a12.033 12.033 0 0 0 6 10.392l39 22.517a12 12 0 0 0 12 0l39-22.517a12.033 12.033 0 0 0 6-10.392V34.517a12.034 12.034 0 0 0-6-10.393ZM94 79.55a4 4 0 0 1-2 3.464l-39 22.517a4 4 0 0 1-4 0L10 83.014a4 4 0 0 1-2-3.464V34.517a4 4 0 0 1 2-3.464L49 8.536a4 4 0 0 1 4 0l39 22.517a4 4 0 0 1 2 3.464V79.55Z" />
						<path d="M74.022 70.071h-2.866a4 4 0 0 0-1.925.494L51.95 80.05 32 68.531V45.554l19.95-11.519 17.29 9.455a4 4 0 0 0 1.919.49h2.863a2 2 0 0 0 2-2v-2.71a2 2 0 0 0-1.04-1.756L55.793 27.02a8.04 8.04 0 0 0-7.843.09L28 38.626a8.025 8.025 0 0 0-4 6.929V68.53a8 8 0 0 0 4 6.928l19.95 11.519a8.043 8.043 0 0 0 7.843.088l19.19-10.532a2 2 0 0 0 1.038-1.753v-2.71a2 2 0 0 0-2-2Z" />
						<g transform="translate(118 33)">
							<path d="M50.745.428c-8.28.01-14.99 6.72-15 15v17.277c0 8.285 6.715 15 15 15 8.284 0 15-6.715 15-15V15.428c-.01-8.28-6.72-14.99-15-15Zm7 32.277a7 7 0 0 1-14 0V15.428a7 7 0 0 1 14 0v17.277ZM14.079 8.488a7.01 7.01 0 0 1 7.868 6.075.99.99 0 0 0 .984.865h6.03a1.01 1.01 0 0 0 1-1.097C29.354 6.206 22.38.046 14.243.447 6.161 1-.086 7.762 0 15.864V32.27c-.087 8.101 6.161 14.864 14.244 15.416 8.137.401 15.11-5.759 15.716-13.883a1.01 1.01 0 0 0-.999-1.098h-6.03a.99.99 0 0 0-.985.865 7.01 7.01 0 0 1-7.868 6.076A7.164 7.164 0 0 1 8 32.461V15.672a7.164 7.164 0 0 1 6.079-7.184ZM96.922 27.994a12.158 12.158 0 0 0 7.184-11.077v-3.7c0-6.71-5.44-12.15-12.149-12.15H75a1 1 0 0 0-1 1v44a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-17h6.621l7.916 17.413a1 1 0 0 0 .91.587h6.591a1 1 0 0 0 .91-1.414l-8.026-17.659Zm-.816-11.077a4.154 4.154 0 0 1-4.148 4.15h-9.852v-12h9.852a4.154 4.154 0 0 1 4.148 4.15v3.7ZM139 1.067h-26a1 1 0 0 0-1 1v44a1 1 0 0 0 1 1h26a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1h-19v-12h13a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1h-13v-10h19a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1ZM177 1.067h-6a1 1 0 0 0-1 1v22.647a7.007 7.007 0 1 1-14 0V2.067a1 1 0 0 0-1-1h-6a1 1 0 0 0-1 1v22.647a15.003 15.003 0 1 0 30 0V2.067a1 1 0 0 0-1-1Z" />
							<rect width="8" height="38" x="186" y="1.067" rx="1" />
					  	</g>
					</g>
				</svg>
				<svg role="img" aria-label="CoreUI Logo Signet" class="sidebar-brand-narrow" width="88" height="32" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 102 115">
					<g style="fill: currentColor">
						<path d="M96 24.124 57 1.608a12 12 0 0 0-12 0L6 24.124a12.034 12.034 0 0 0-6 10.393V79.55a12.033 12.033 0 0 0 6 10.392l39 22.517a12 12 0 0 0 12 0l39-22.517a12.033 12.033 0 0 0 6-10.392V34.517a12.034 12.034 0 0 0-6-10.393ZM94 79.55a4 4 0 0 1-2 3.464l-39 22.517a4 4 0 0 1-4 0L10 83.014a4 4 0 0 1-2-3.464V34.517a4 4 0 0 1 2-3.464L49 8.536a4 4 0 0 1 4 0l39 22.517a4 4 0 0 1 2 3.464V79.55Z" />
						<path d="M74.022 70.071h-2.866a4 4 0 0 0-1.925.494L51.95 80.05 32 68.531V45.554l19.95-11.519 17.29 9.455a4 4 0 0 0 1.919.49h2.863a2 2 0 0 0 2-2v-2.71a2 2 0 0 0-1.04-1.756L55.793 27.02a8.04 8.04 0 0 0-7.843.09L28 38.626a8.025 8.025 0 0 0-4 6.929V68.53a8 8 0 0 0 4 6.928l19.95 11.519a8.043 8.043 0 0 0 7.843.088l19.19-10.532a2 2 0 0 0 1.038-1.753v-2.71a2 2 0 0 0-2-2Z" />
					</g>
				</svg>
				-->
				<h3>San Jerónimo</h3>
			</div>
			<button class="btn-close d-lg-none" type="button" data-coreui-theme="dark" aria-label="Close" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()"></button>
		</div>

		<ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
			<li class="nav-item">
				<a class="nav-link" href="index.html">
					<svg class="nav-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
						<path fill="var(--ci-primary-color, currentcolor)" d="M425.706 142.294A240 240 0 0 0 16 312v88h144v-32H48v-56c0-114.691 93.309-208 208-208s208 93.309 208 208v56H352v32h144v-88a238.43 238.43 0 0 0-70.294-169.706" class="ci-primary" />
						<path fill="var(--ci-primary-color, currentcolor)" d="M80 264h32v32H80zm160-136h32v32h-32zm-104 40h32v32h-32zm264 96h32v32h-32zm-102.778 71.1 69.2-144.173-28.85-13.848-69.183 144.135a64.141 64.141 0 1 0 28.833 13.886M256 416a32 32 0 1 1 32-32 32.036 32.036 0 0 1-32 32" class="ci-primary" />
					</svg>
					Inicio
					<span class="badge badge-sm bg-warning ms-auto"> </span>
				</a>
			</li>
			<li class="nav-group">
				<a class="nav-link nav-group-toggle" href="#">
					<svg class="nav-icon" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1.5 0.5V0C1.22386 0 1 0.223858 1 0.5H1.5ZM1.5 13.5H1C1 13.7761 1.22386 14 1.5 14V13.5ZM4 0V15H5V0H4ZM1.5 1H11.5V0H1.5V1ZM13 2.5V11.5H14V2.5H13ZM11.5 13H1.5V14H11.5V13ZM2 13.5V0.5H1V13.5H2ZM13 11.5C13 12.3284 12.3284 13 11.5 13V14C12.8807 14 14 12.8807 14 11.5H13ZM11.5 1C12.3284 1 13 1.67157 13 2.5H14C14 1.11929 12.8807 0 11.5 0V1ZM7 5H11V4H7V5Z" fill="#FFF"/>
					</svg>            
					Proveedores
				</a>
				<ul class="nav-group-items compact">
					<li class="nav-item">
						<a class="nav-link" href="components/accordion.html">
							<span class="nav-icon"><span class="nav-icon-bullet"></span></span>
							Registrados
						</a>
					</li>
				</ul>
			</li>
		</ul>
		<div class="sidebar-footer border-top d-none d-md-flex"></div>
	</div>

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
