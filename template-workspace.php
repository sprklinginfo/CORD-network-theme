<?php
/*
Template Name: Workspace Template
*/

get_header(); ?>
	<div id="primary" class="content-area">
		<div id="content-full" class="site-content" role="main">
			<?php $post_id = 516;
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
			<?php if(is_user_logged_in())
			{
				global $wpdb;

				// Query all blogs from multi-site install
				$blogs = $wpdb->get_results("SELECT blog_id,domain,path FROM cd_blogs where blog_id > 1 ORDER BY blog_id DESC");
				if (!empty($blogs)) 
				{
					foreach ($blogs as $blog)
					{ ?>
						<div class="blog-content workspace-content">
							<article id="blog-<?php _e($blog->blog_id); ?>">
								<?php
								switch_to_blog($blog->blog_id);
								$comments_count = wp_count_comments();
								?>
								<header class="blog-header">
									<h2 class="blog-title">
										<a href="http://<?php 
										_e($blog->domain);
										_e($blog->path);
										?>">
										<?php _e(get_bloginfo('name')); ?>
										</a>
									</h2>
								</header>
								<div class="blog-description">
									<?php _e(get_bloginfo('description')); ?>
								</div><!-- .blog-content -->
								<div class="blog-comments post-top">
									<?php _e($comments_count->total_comments. ' Comments'); ?>
								</div>
							</article><!-- #blog-<?php _e($blog->blog_id); ?> -->
						</div>
					<?php restore_current_blog();	
					} 
				} 
				else{ ?>
					<h4 class="blog-header workspace-content">Nothing Yet</h4>
				<?php } ?>
				<h3>Create New Workspace</h3>
				<div id="new-blog-div">
					<form method="post" action="new_blog()">
						<input type="hidden" value="1" id="cpmu-new-blog" name="cpmu-new-blog" />
						<label for="title">Workspace Title:</label><input type="text" id="title" name="title" onchange="checkTitle()"><br/>
						<label for="description">Description:</label><input type="text" id="description" name="description" onchange="checkDescription()"><br/>
						<label id="urllabel" for="url">URL:</label><span id="url"><?php echo network_home_url();?></span><span id="url-title"></span><br/>
						<input type="submit" name="new_blog" id="workspace-submit" value="Submit" onclick="clickCheck()">
					</form> 
				</div>
			<?php }
			else
			{ ?>
				<div class="blog-content not-logged-in">
					<p>
						Sorry, but only registered users of this site can see items in the Workspace.  If you would like to become a member of the site, please contact us using the form available on the <a href="<?php _e(network_site_url('/contact/'));?>">Contact</a> page.
					</p>
				</div>
			<?php } ?>
		</div><!-- #content -->
	</div><!-- #primary -->
<?php get_footer(); ?>