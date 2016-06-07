<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php wp_title('«', true, 'right'); ?> <?php bloginfo('name'); ?></title>
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div class="wrapper">
		<header class="header">
			<div class="container">
				<span class="mobile-nav-opener"><span></span></span>
				<nav class="navigation">
					<span class="mobile-nav-opener"><strong></strong></span>
					<div class="navigation-inner">
						<? wp_nav_menu(array('menu' => 'top-menu', 'menu_class' => 'top-menu')); ?>
					</div>
				</nav>
				<a href="/" class="logo"><img src="<?php bloginfo('template_url'); ?>/images/logo.png" alt="love2venice"></a>
			</div>
		</header>