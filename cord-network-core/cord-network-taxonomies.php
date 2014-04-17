<?php
/*FILE: cord-netPublication-taxonomies.php
 * DESCRIPTION: Create a custom taxonomies and a custom post types
 */
 
/* Create custom taxonomy */
function wpcn_custom_tax() {
	$labels = array(
		'name' => __('Author/s'),
		'singular_name' => __('Author'),
		'search_items' => __('Search Authors'),
		'all_items' => __('All Authors'),
		'edit_item' => __('Edit Author'), 
		'update_item' => __('Update Author'),
		'add_new_item' => __('Add New Author'),
		'new_item_name' => __('New Author Name'),
		'separate_items_with_commas' => __('Separate authors with commas'),
		'choose_from_most_used' => __('Choose from the most used authors'),
		'menu_name' => __('Authors'),
	); 	
		
	register_taxonomy('publication-author', array('publications'), array(
		'hierarchical' => false,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'publication-author'),
	));
	
	$labels2 = array(
		'name' => __('Publication Type'),
		'singular_name' => __('Publication Type'),
		'search_items' => __('Search Publication Types'),
		'all_items' => __('All Publication Types'),
		'edit_item' => __('Edit Publication Type'), 
		'update_item' => __('Update Publication Type'),
		'add_new_item' => __('Add New Publication Type'),
		'new_item_name' => __('New Publication Type'),
		'separate_items_with_commas' => __('Separate publication types with commas'),
		'choose_from_most_used' => __('Choose from the most used publication types'),
		'menu_name' => __('Publication Types'),
	); 	
		
	register_taxonomy('publication-type', array('publications'), array(
		'hierarchical' => false,
		'labels' => $labels2,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'publication-type'),
	));
}
add_action('init', 'wpcn_custom_tax');

/* Create custom post types */
function wpcn_custom_post() {
	$labels = array(
		'name' => __('Publications'),
		'singular_name' => __('Publication'),
		'menu_name' => __('Publications'),
		'all_items' => __('All Publications'),
		'add_new_item' => __('Add New Publication'),
		'edit_item' => __('Edit Publication'),
		'new_item' => __('New Publication'),
		'view_item' => __('View Publication'),
		'search_items' => __('Search Publications'),
		'not_found' => __('No Publications Found'),
		'not_found_in_trash' => __('No Publications in Trash'),
		'update_item' => __('Update Publication')
	);
	
	$args = array (
		'labels' => $labels,
		'description' => 'Holds publication information',
		'public' => true,
		'exclude_from_search' => false,
		'menu_position' => 5,
		'supports' => array('title', 'thumbnail', 'editor' , 'revisions'),
		'has_archive' => true,
		'rewrite' => array('slug' => 'publications')
	);
	register_post_type('publications', $args);
	
		$labels2 = array(
		'name' => __('Network Activity'),
		'singular_name' => __('Network Activity'),
		'menu_name' => __('Network Acts.'),
		'all_items' => __('All Network Activities'),
		'add_new_item' => __('Add New Network Activity'),
		'edit_item' => __('Edit Network Activity'),
		'new_item' => __('New Network Activity'),
		'view_item' => __('View Network Activity'),
		'search_items' => __('Search Network Activities'),
		'not_found' => __('No Network Activities Found'),
		'not_found_in_trash' => __('No Network Activities in Trash'),
		'update_item' => __('Update Network Activity')
	);
	
	$args2 = array (
		'labels' => $labels2,
		'description' => 'Holds Network Activity information',
		'public' => true,
		'exclude_from_search' => false,
		'menu_position' => 5,
		'supports' => array('title', 'thumbnail', 'editor' , 'revisions'),
		'has_archive' => true,
		'rewrite' => array('slug' => 'network-activities')
	);
	register_post_type('network-activities', $args2);
}
add_action('init', 'wpcn_custom_post');

/* Customize admin messages related to the wpcn custom post types */
function wpcn_custom_messages($messages) {
	 global $post, $post_ID;

	 $messages['publications'] = array(
			0 => '', /* Unused. Messages start at index 1. */
			1 => sprintf( __('Publication updated. <a href="%s">View Publication</a>'), esc_url( get_permalink($post_ID) ) ),
			2 => __('Custom field updated.'),
			3 => __('Custom field deleted.'),
			4 => __('Publication updated.'),
			5 => isset($_GET['revision']) ? sprintf( __('Publication restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6 => sprintf( __('Publication published. <a href="%s">View Publication</a>'), esc_url( get_permalink($post_ID) ) ),
			7 => __('Publication saved.'),
			8 => sprintf( __('Publication submitted. <a target="_blank" href="%s">Preview Publication</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
			9 => sprintf( __('Scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Publication</a>'),
			date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
			10 => sprintf( __('Draft updated. <a target="_blank" href="%s">Preview Publication</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	  );
	  $messages['network-activities'] = array(
			0 => '', /* Unused. Messages start at index 1. */
			1 => sprintf( __('Network Activity updated. <a href="%s">View Network Activity</a>'), esc_url( get_permalink($post_ID) ) ),
			2 => __('Custom field updated.'),
			3 => __('Custom field deleted.'),
			4 => __('Network Activity updated.'),
			5 => isset($_GET['revision']) ? sprintf( __('Network Activity restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6 => sprintf( __('Network Activity published. <a href="%s">View Network Activity</a>'), esc_url( get_permalink($post_ID) ) ),
			7 => __('Publication saved.'),
			8 => sprintf( __('Network Activity submitted. <a target="_blank" href="%s">Preview Network Activity</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
			9 => sprintf( __('Scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Network Activity</a>'),
			date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
			10 => sprintf( __('Draft updated. <a target="_blank" href="%s">Preview Network Activity</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	  );
	return $messages;
}
add_filter('post_updated_messages', 'wpcn_custom_messages');

/*
*End of File
*/