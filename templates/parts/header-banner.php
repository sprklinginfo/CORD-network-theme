<?php 
/**
 * Infinity Theme: Header Content
 *
 * This template contains the Header Content. Fork this in your Child THeme
 * if you want to change the markup but don't want to mess around doctypes/meta etc!
 *
 * @author Bowe Frankema <bowe@presscrew.com>
 * @link http://infinity.presscrew.com/
 * @copyright Copyright (C) 2010-2011 Bowe Frankema
 * @license http://www.gnu.org/licenses/gpl.html GPLv2 or later
 * @package Infinity
 * @subpackage templates
 * @since 1.0
 */
?>
<div class="top-wrap row">
	<!-- header -->
	<header id="header" role="banner">
		<div id="logo-menu-wrap">
			<div id="logo-menu-wrap">
				<?php // Load Main Menu only if it's enabled
				if ( current_theme_supports( 'infinity-main-menu-setup' ) ) :
				infinity_get_template_part( 'templates/parts/main-menu', 'header' );
				endif;
				?>
				<div class="social-media-icons">
					<a href="<?php echo twitter_url();?>">
						<img id="twitter-logo" src="<?php echo get_stylesheet_directory_uri();?>/images/twitter-logo.png">
					</a>
					<a href="<?php echo facebook_url();?>">
						<img id="facebook-logo" src="<?php echo get_stylesheet_directory_uri();?>/images/facebook-logo.png">
					</a>
				</div>
				<a href="<?php echo network_site_url();?>">
					<img id="logo-image" src="<?php echo get_stylesheet_directory_uri();?>/images/logo.png">
				</a>
			</div>
		</div>
	</header><!-- end header -->
</div><!-- end top wrap -->
