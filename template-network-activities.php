<?php
/*
Template Name: Network Activities Template
*/

get_header(); ?>
	<div id="primary" class="content-area">
		<div id="content-full" class="site-content" role="main">
			<?php $post_id = 56;
			$queried_post = get_post($post_id);
			?>
			<article id="post-<?php the_ID(); ?>" class="template-header">
				<h1 class="page-title">
					<?php _e($queried_post->post_title);?>
				</h1>
				<div class="entry-content">
					<?php _e($queried_post->post_content); ?>
				</div><!-- .entry-content -->
			</article><!-- #post-<?php the_ID();?> -->
			<?php $query = new WP_Query( 'post_type=network-activities' );
			if ($query->have_posts()) 
			{
				while ($query->have_posts())
				{ 
					$query->the_post(); 
					$worklink = get_post_meta($post->ID, "wprl_link", true);
					?>
					<div class="post-content">
						<article id="post-<?php the_ID(); ?>">
							<header class="entry-header">
								<h2 class="post-title">
									<a href="<?php _e(the_permalink());?>">
										<?php _e(the_title());?>
									</a>
								</h2>
							</header>
							<div class="post-meta-data post-top">
								<span class="time-posted"><?php _e(get_the_date(get_option('date_format')));?></span>
							</div>
							<div class="entry-content">
								<?php the_excerpt(); ?>
							</div><!-- .entry-content -->
						</article><!-- #post-<?php the_ID();?> -->
					</div>
				<?php } ?>
				<nav class="navigation paging-navigation" role="navigation">
					<div class="links nav-links">
						<?php posts_nav_link(); ?>			
					</div><!-- .nav-links -->
				</nav>
		<?php } 
		else{ ?>
			<h3 class="entry-header">Nothing Yet</h3>
		<?php } ?>
	</div><!-- #content -->
</div><!-- #primary -->
<?php get_footer(); ?>