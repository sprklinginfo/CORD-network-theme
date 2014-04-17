# CORD Network Theme (CBOX Child) Wordpress
Child theme for the Commons in a Box default theme. 
Originaly developed by mstumpf @ http://mikestumpf.com/ for The Collaboration for Research on Democracy (CORD) Network.




wp-content/plugins/bbpress/includes/forums/functions.php

DELETED:

		// Forum is a category
		if ( bbp_is_forum_category( $forum_parent_id ) ) {
			bbp_add_error( 'bbp_new_forum_forum_category', __( '<strong>ERROR</strong>: This forum is a category. No forums can be created in this forum.', 'bbpress' ) );
		}

----------------------------------------------------------------------
wp-includes/bookmark-template.php

CHANGED:

	'categorize' => 1, 'title_li' => __('Bookmarks'),

TO

	'categorize' => 1, 'title_li' => __('Partner Sites'),
	
