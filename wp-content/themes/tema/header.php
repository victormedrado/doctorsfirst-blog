<!doctype html>
<html class="no-js" lang="pt-br" xmlns:fb="http://ogp.me/ns/fb#">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title><?php wp_title(''); ?></title>
		<meta name="viewport" content="width=device-width, user-scalable=no" />
		<meta name="distribution" content="global" />
		<meta name="rating" content="general" />
		<meta name="robots" content="ALL" />
		<meta name="robots" content="index,follow"/>
		<meta name="language" content="pt-br" />
		<meta name="doc-rights" content="Public" />
		<meta name="classification" content="Servicos" />
		<meta http-equiv="Content-Language" content="pt-br" />
		<link type="text/plain" rel="author" href="humans.txt" />
		<link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('template_directory'); ?>/images/favicon.webp" />
		<link rel="apple-touch-icon" sizes="72x72" href="<?php bloginfo('template_directory'); ?>/images/favicon.webp" />
		<link rel="apple-touch-icon" sizes="57x57" href="<?php bloginfo('template_directory'); ?>/images/favicon.webp" />
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php bloginfo('template_directory'); ?>/images/favicon.webp">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php bloginfo('template_directory'); ?>/images/favicon.webp">
		<link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?php bloginfo('template_directory'); ?>/images/favicon.webp">
		<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.ico" />
		<link rel="icon" type="image/vnd.microsoft.icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.webp" />
		<link rel="icon" type="image/png" href="<?php bloginfo('template_directory'); ?>/images/favicon.webp" />
		<link rel="canonical" href="http://<?php echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ?>" />
		<link rel='stylesheet' id='thinkup-google-fonts-css'  href='http://fonts.googleapis.com/css?family=Open+Sans%3A300%2C400%2C600%2C700&amp;subset=latin%2Clatin-ext' type='text/css' media='all' />
		<link rel='stylesheet' id='font-awesome-min-css'  href='<?php bloginfo('template_directory'); ?>/js/extentions/font-awesome/css/font-awesome.min.css' type='text/css' media='all' />
		<link rel='stylesheet' id='dashicons-css'  href='<?php bloginfo('template_directory'); ?>/css/dashicons.min.css' type='text/css' media='all' />
		<link rel='stylesheet' id='bootstrap-css'  href='<?php bloginfo('template_directory'); ?>/js/extentions/bootstrap/css/bootstrap.min.css' type='text/css' media='all' />
		<link rel='stylesheet' id='prettyPhoto-css'  href='<?php bloginfo('template_directory'); ?>/js/extentions/prettyPhoto/css/prettyPhoto.css' type='text/css' media='all' />
		<link rel='stylesheet' id='style-css'  href='<?php bloginfo('template_directory'); ?>/style.css' type='text/css' media='all' />
		<link rel='stylesheet' id='shortcodes-css'  href='<?php bloginfo('template_directory'); ?>/css/style-shortcodes.css' type='text/css' media='all' />
		<link rel='stylesheet' id='responsive-css'  href='<?php bloginfo('template_directory'); ?>/css/style-responsive.css' type='text/css' media='all' />
		<script type='text/javascript' src='<?php bloginfo('template_directory'); ?>/js/jquery/jquery.js'></script>
		<script type='text/javascript' src='<?php bloginfo('template_directory'); ?>/js/jquery/jquery-migrate.min.js'></script>
		<?php wp_head(); ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
		<style type="text/css">
			#slider .rslides, #slider .rslides li { height: 350px; max-height: 350px; }
			#slider .rslides img { height: 100%; max-height: 350px; }
		</style>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-T53JRQ');</script>
<!-- End Google Tag Manager -->
	</head>
	<body class="home blog layout-responsive slider-full header-style1">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T53JRQ"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
		<div id="body-core" class="hfeed site">
			<header id="site-header">
				<div id="header">
					<div id="header-core">
						<div id="logo">
							<a rel="home" href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/logo-fmi.png"></a>
						</div>
						<div id="header-links" class="main-navigation">
							<div id="header-links-inner" class="header-links">
								<?php
								wp_nav_menu (
									array(
										'theme_location'  => 'menu_header',
										'menu'            => 'menu_header',
										'container'       => '',
										'container_class' => '',
										'container_id'    => '',
										'menu_class'      => '',
										'menu_id'         => '',
										'echo'            => true,
										'before'          => '',
										'after'           => '',
										'link_before'     => '',
										'link_after'      => '',
									'items_wrap'      => '<ul id="menu-all-pages" class="menu">%3$s</ul>',
									'depth'           => 2
									)
								);
							?>
						</div>
					</div>
					<!-- #header-links .main-navigation -->
					<div id="header-responsive">
						<a class="btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</a>
						<div id="header-responsive-inner" class="responsive-links nav-collapse collapse">
							<?php
							wp_nav_menu (
								array(
									'theme_location'  => 'menu_header',
									'menu'            => 'menu_header',
									'container'       => '',
									'container_class' => '',
									'container_id'    => '',
									'menu_class'      => '',
									'menu_id'         => '',
									'echo'            => true,
									//'fallback_cb'     => 'wp_page_menu',
									'before'          => '',
									'after'           => '',
									'link_before'     => '',
									'link_after'      => '',
								'items_wrap'      => '<ul id="menu-all-pages-1" class="menu">%3$s</ul>',
								'depth'           => 2
								)
							);
						?>
					</div>
					</div><!-- #header-responsive -->
				</div>
			</div>
			<!-- #header -->
		</header>
		<!-- header -->