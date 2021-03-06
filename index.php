<?php
/**
 * Infinity Theme: index template
 *
 * @author Bowe Frankema <bowe@presscrew.com>
 * @link http://infinity.presscrew.com/
 * @copyright Copyright (C) 2010-2011 Bowe Frankema
 * @license http://www.gnu.org/licenses/gpl.html GPLv2 or later
 * @package Infinity
 * @subpackage templates
 * @since 1.0
 */

	infinity_get_header();
?>
	<div id="content-full" role="main" class="site-content">
		<h1 class="page-title">Blog</h1>
		<?php
			do_action( 'open_content' );
			do_action( 'open_home' );
		?>
			<?php
				infinity_get_template_part( 'templates/loops/loop', 'index' );
			?>
		<?php
			do_action( 'close_home' );
			do_action( 'close_content' );
		?>
	</div>
<?php
	infinity_get_footer();
?>
