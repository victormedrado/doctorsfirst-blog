<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title><?php
      if ( is_single() ) { single_post_title(); }
      elseif ( is_home() || is_front_page() ) { bloginfo('name'); print ' | '; bloginfo('description'); }
      elseif ( is_page() ) { single_post_title(''); }
      elseif ( is_search() ) { bloginfo('name'); print ' |  ' . wp_specialchars($s); }
      elseif ( is_404() ) { bloginfo('name'); print ' | Nada encontrado'; }
      else { bloginfo('name'); wp_title('|');  }
  ?></title>
		<meta charset="UTF-8"/>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory');?>/assets/css/style.css">
		<link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,600,700&display=swap" rel="stylesheet">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
  <?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); wp_head(); ?>
	</head>
	<body>
		<header>
			
			<div class="container py-3">
				<div class="header d-flex align-items-center justify-content-between">
					<h1>
						<a href="<?php bloginfo('siteurl'); ?>">
						<img src="<?php bloginfo('template_directory');?>/assets/img/logo.png" alt="logo" class="img-fluid mr-5 d-xl-block d-none">
						<img src="<?php bloginfo('template_directory');?>/assets/img/logo.png" alt="logo" class="img-fluid mr-5 d-xl-none w-75">	
					</a></h1>
					<form action="<?php bloginfo('siteurl') ?>" method="get" class="busca ml-2 d-none d-md-block">
						<input type="search" name="s" placeholder="Pesquisar" class="form-control">
						<button><i class="fas fa-search"></i></button>						
					</form>
					<div class="social">
						<p class="mb-2">Siga-nos</p>
						<div class="d-flex">
							<a href="https://www.facebook.com/fmiligrama/" target="_blank" class="mx-1">
								<img src="<?php bloginfo('template_directory');?>/assets/img/facebook.png" alt="facebook">
							</a>
							<a href="https://www.instagram.com/fmiligrama/?hl=pt-br" target="_blank" class="mx-1">
								<img src="<?php bloginfo('template_directory');?>/assets/img/instagram.png" alt="instagram">
							</a>
						</div>
					</div>
				</div>
				<div class="row">
				<div class="col-lg-12">
					<form action="<?php bloginfo('siteurl') ?>" method="get" class="busca py-2 d-md-none">
						<input type="search" name="s" placeholder="Pesquisar" class="form-control">
						<button><i class="fas fa-search mt-2 mt-lg-0"></i></button>						
					</form>
					</div>	
				</div>
			</div>
			
				
			
			<nav class="navbar navbar-expand-lg">
				<div class="container">
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#NavBarSite">
					<div class="box">
						<div class="ham not-active">
							<span></span>
							<span></span>
							<span></span>
						</div>
					</div>
					</button>
					<div class="collapse navbar-collapse" id="NavBarSite">
						
						<ul class="navbar-nav d-flex justify-content-between align-items-center w-100">
							<li class="nav-item">
								<h2 style="font-size: 1rem !important;"><a href="<?php bloginfo('siteurl') ?>/categorias/miligrama/" class="nav-link">Institucional</a></h2>
							</li>
							<li class="nav-item">
								<h2 style="font-size: 1rem !important;"><a href="<?php bloginfo('siteurl') ?>/categorias/qualidade-de-vida/" class="nav-link">Qualidade de Vida</a></h2>
							</li>
							<li class="nav-item">
								<h2 style="font-size: 1rem !important;"><a href="<?php bloginfo('siteurl') ?>/categorias/beleza-e-estetica/" class="nav-link">Beleza e Estética</a></h2>
							</li>
							<li class="nav-item">
								<h2 style="font-size: 1rem !important;"><a href="<?php bloginfo('siteurl') ?>/categorias/desempenhofisico/" class="nav-link">Desempenho Físico</a></h2>
							</li>
							<li class="nav-item">
								<h2 style="font-size: 1rem !important;"><a href="<?php bloginfo('siteurl') ?>/categorias/homens/" class="nav-link">Homens</a></h2>
							</li>
						</ul>
					</div>
				</div>
			</nav>
		</header>
		