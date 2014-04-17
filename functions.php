<?php
/*FILE: cord-network-functions.php
*DESCRIPTION: Core theme functions
*/

require 'cord-network-core/cord-network-taxonomies.php';
$current_user = wp_get_current_user();

function remove_menu_pages() {
	global $submenu;
	remove_menu_page('plugins.php'); 
	remove_menu_page('edit.php?post_type=features'); 
	remove_menu_page('edit.php?post_type=feedback'); 
	remove_menu_page('edit.php?post_type=topic');
	remove_menu_page('edit.php?post_type=reply'); 
	remove_submenu_page('index.php', 'my-sites.php');
}

function edit_admin_menus() {
	global $menu;
	$menu[15][0] = 'Partner Sites'; // Change Posts to Recipes
}

if (is_admin())
{
	add_action( 'admin_menu', 'edit_admin_menus');
}

function remove_menu_tabs() {
	global $current_user;
	if(1 != $current_user->ID)
	{
		remove_menu_page('jetpack'); //remove basic "post" type
		remove_menu_page('aiowpsec'); //remove basic "post" type
	}
	remove_submenu_page('index.php', 'bbp-update');	//remove "home" under dashboard
}
function custom_right_now() {
	global $wp_registered_sidebars;
	//custom "right now" dashboard widget
	$num_posts = wp_count_posts('publications');
	$num_pages = wp_count_posts('post');
	$num_tags = wp_count_posts('network-activities');
	$num_comm = wp_count_comments( );
	echo "\n\t".'<div class="table table_content">';
	echo "\n\t".'<p class="sub">' . __('Content') . '</p>'."\n\t".'<table>';
	echo "\n\t".'<tr class="first">';
	
	// Posts
	$num = number_format_i18n( $num_pages->publish );
	$text = _n('Post', 'Posts', $num);
	if (current_user_can('edit_pages') ) {
	$num = "<a href='edit.php?post_type=page'>$num</a>";
	$text = "<a href='edit.php?post_type=page'>$text</a>";
	}
	echo '<td class="first b b_pages">' . $num . '</td>';
	echo '<td class="t pages">' . $text . '</td>';
	
	echo '</tr><tr>';
	
	// Publications
	$num = number_format_i18n( $num_posts->publish );
	$text = _n('Publication', 'Publications', intval($num_posts->publish) );
	if ( current_user_can('edit_posts') ) {
	$num = "<a href='edit.php?post_type=publications'>$num</a>";
	$text = "<a href='edit.php?post_type=publications'>$text</a>";
	}
	echo '<td class="first b b-posts">' . $num . '</td>';
	echo '<td class="t posts">' . $text . '</td>';
	echo '</tr><tr>';
	
	// Network Activities
	$num = number_format_i18n( $num_tags ->publish );
	$text = _n('Network Activity', 'Network Activities', $num);
	if ( current_user_can('edit_pages') ) {
	$num = "<a href='edit.php?post_type=network-activities'>$num</a>";
	$text = "<a href='edit.php?post_type=network-activities'>$text</a>";
	}
	echo '<td class="first b b-tags">' . $num . '</td>';
	echo '<td class="t tags">' . $text . '</td>';
	echo "</tr>";
	do_action('right_now_content_table_end');
	echo "\n\t</table>\n\t</div>";
	echo "\n\t".'<div class="table table_discussion">';
	echo "\n\t".'<p class="sub">' . __('Discussion') . '</p>'."\n\t".'<table>';
	echo "\n\t".'<tr class="first">';
	
	// Total Comments
	$num = '<span class="total-count">' . number_format_i18n($num_comm->total_comments) . '</span>';
	$text = _n('Comment', 'Comments', $num_comm->total_comments );
	if ( current_user_can('moderate_comments') ) {
	$num = '<a href="edit-comments.php">' . $num . '</a>';
	$text = '<a href="edit-comments.php">' . $text . '</a>';
	}
	echo '<td class="b b-comments">' . $num . '</td>';
	echo '<td class="last t comments">' . $text . '</td>';
	
	echo '</tr><tr>';
	
	// Approved Comments
	$num = '<span class="approved-count">' . number_format_i18n($num_comm->approved) . '</span>';
	$text = _nx('Approved', 'Approved', $num_comm->approved, 'Right Now');
	if ( current_user_can('moderate_comments') ) {
	$num = "<a href='edit-comments.php?comment_status=approved'>$num</a>";
	$text = "<a class='approved' href='edit-comments.php?comment_status=approved'>$text</a>";
	}
	echo '<td class="b b_approved">' . $num . '</td>';
	echo '<td class="last t">' . $text . '</td>';
	
	echo "</tr>\n\t<tr>";
	
	// Spam Comments
	$num = number_format_i18n($num_comm->spam);
	$text = _nx('Spam', 'Spam', $num_comm->spam, 'comment');
	if ( current_user_can('moderate_comments') ) {
	$num = "<a href='edit-comments.php?comment_status=spam'><span class='spam-count'>$num</span></a>";
	$text = "<a class='spam' href='edit-comments.php?comment_status=spam'>$text</a>";
	}
	echo '<td class="b b-spam">' . $num . '</td>';
	echo '<td class="last t">' . $text . '</td>';
	echo "</tr>";
	do_action('right_now_table_end');
	do_action('right_now_discussion_table_end');
	echo "\n\t</table>\n\t</div>";
	echo "\n\t".'<div class="versions">';
	echo "\n\t".'<br class="clear" /></div>';
}
function custom_right_now_css(){
	echo '<style>/* Right Now */
		#custom_right_now td.b {font-family: Georgia, "Times New Roman", "Bitstream Charter", Times, serif;}
		#custom_right_now p.sub, #custom_right_now .table, #dashboard_right_now .versions {margin: -12px;}
		#custom_right_now .inside {font-size: 12px;padding-top: 20px;}
		#custom_right_now p.sub {padding: 5px 0 15px;color: #8f8f8f;font-size: 14px;position: absolute;top: -17px;left: 15px;}
		#custom_right_now .table {margin: 0;padding: 0;position: relative;}
		#custom_right_now .table_content {float: left;border-top-width: 1px;border-top-style: solid;width: 45%;border-top-color:#ececec;}
		#custom_right_now .table_discussion {float: right;border-top-width: 1px;border-top-style: solid;width: 45%;;border-top-color:#ececec;}
		#custom_right_now table td {padding: 3px 0;white-space: nowrap;}
		#custom_right_now table tr.first td {border-top: none;}
		#custom_right_now td.b {padding-right: 6px;text-align: right;font-size: 14px;width: 1%;}
		#custom_right_now td.b a {font-size: 18px;}
		#custom_right_now td.b a:hover {color: #d54e21;}
		#custom_right_now .t {font-size: 12px;padding-right: 12px;padding-top: 6px;color: #777;}
		#custom_right_now .t a {white-space: nowrap;}
		#custom_right_now .spam {color: red;}
		#custom_right_now .approved {color: green;}
		#custom_right_now a.button {float: right;clear: right;position: relative;top: -5px;}
		#wp-admin-bar-user-actions {padding-bottom:20px!important;}
		#menu-appearance ul li:nth-child(2), #menu-appearance ul li:nth-child(3), #menu-appearance ul li:last-child{display:none!important;}
	</style>';
}

function remove_dashboard_widgets(){
	global $wp_meta_boxes;
	remove_meta_box('dashboard_right_now', 'dashboard', 'normal');   // Right Now
	remove_meta_box('bbp-dashboard-right-now', 'dashboard', 'normal');   // buddypress right now
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal'); // Recent Comments
	remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');  // Incoming Links
	remove_meta_box('dashboard_plugins', 'dashboard', 'normal');   // Plugins
	remove_meta_box('dashboard_quick_press', 'dashboard', 'side');  // Quick Press
	remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side');  // Recent Drafts
	remove_meta_box('dashboard_primary', 'dashboard', 'side');   // WordPress blog
	remove_meta_box('dashboard_secondary', 'dashboard', 'side');   // Other WordPress News
	update_user_meta(get_current_user_id(), 'show_welcome_panel', false);//hide Welcome panel
	wp_add_dashboard_widget('custom_right_now', 'Right Now', 'custom_right_now');
	add_meta_box('dashboard_recent_comments', 'Recent Comments', 'wp_dashboard_recent_comments'); // places Recent Comments after custom "right now"
}

function remove_toolbar_links($wp_admin_bar) {
	global $current_user;
	$wp_admin_bar->remove_node('wp-logo');
	$wp_admin_bar->remove_node('search');
	$wp_admin_bar->remove_node('stats');
	$wp_admin_bar->remove_node('edit');
	$wp_admin_bar->remove_node('customize');
	$wp_admin_bar->remove_node('new-features');
	$wp_admin_bar->remove_node('new-topic');
	$wp_admin_bar->remove_node('new-reply');
	$wp_admin_bar->remove_node('edit-profile');
	$wp_admin_bar->remove_node('edit-site');
	$wp_admin_bar->remove_node('new-user');
	$wp_admin_bar->remove_node('my-account-buddypress');
	$wp_admin_bar->remove_node('site-name');
	$wp_admin_bar->remove_node('comments');
	$wp_admin_bar->remove_node('new-content');
	if(1 != $current_user->ID)
	{
		$wp_admin_bar->remove_node('my-sites');
	}
}

function add_toolbar_links($wp_admin_bar) {
	$args = array(
		'id'    => 'cord-network',
		'title' => 'Cord Network',
		'href'  => network_home_url(),
	);
	$wp_admin_bar->add_node( $args );
}

function alter_admin_toolbar_links($wp_admin_bar) {
	$args = array(
		'id'    => 'my-account',
		'href'  => network_site_url('members-listing/'),
	);
	$wp_admin_bar->add_node( $args );
	$args = array(
		'id'    => 'user-info',
		'href'  => network_site_url('members-listing/'),
	);
	$wp_admin_bar->add_node( $args );
}

if (is_admin())
{
	add_action('admin_bar_menu', 'alter_admin_toolbar_links', 999);
}
	add_action('admin_menu', 'remove_menu_pages');//remove links on side admin menu
	add_action('admin_init', 'remove_menu_tabs');
	add_action('admin_head','custom_right_now_css');  //css for custom "right now" widget
	add_action('wp_dashboard_setup', 'remove_dashboard_widgets');//remove widgets in dashboard screen
	add_action('admin_bar_menu', 'add_toolbar_links');
	add_action('admin_bar_menu', 'remove_toolbar_links', 999);
	add_filter('pre_option_link_manager_enabled', '__return_true');

	
if(is_admin() && !current_user_can('manage_options'))
{
	if (!is_user_logged_in())//redirect logged out or non-users to main screen
	{
		wp_redirect(network_site_url()."login"); exit;
	}
	else
	{
		wp_redirect(home_url('403-forbidden')); exit;
	}
}


function mycustom_breadcrumb_options() {
	// Home - default = true
	$args['include_home']    = false;
	// Forum root - default = true
	$args['include_root']    = false;
	// Current - default = true
	$args['include_current'] = true;

	return $args;
}

add_filter('bbp_before_get_breadcrumb_parse_args', 'mycustom_breadcrumb_options' );

function after_forum_loop(){
	if(is_single('520'))
	{
	echo '<p class="new-forum-button"><a href="http://mikestumpf.com/cord/new-forum/">New Forum</a></p>';
	}
}

add_action( 'bbp_template_after_forums_loop', 'after_forum_loop');
	
function cordScripts() {
	wp_enqueue_script( 'template', get_stylesheet_directory_uri().'/js/template.js');
}

if(!is_admin())
{
	add_action( 'wp_enqueue_scripts', 'cordScripts' );
}

function domainCheck($path){
	global $current_site;
	static $count = 0;
	if (domain_exists($current_site->domain, $current_site->path.$path.'/'))
	{
	$count++;
	if ($count > 1)
	{
		$path = substr($path, 0, strlen($path)-2);
	}
	$path = $path.'-'.$count;
	domainCheck($path);
	}
	else
	{
		return $path;
	}
}
	
function new_workspace(){
	global $current_site;


	//var_dump($current_site->id);
	//die();
	$title = sanitize_text_field($_POST["title"]);
	$workspaceTitle = sanitize_title_with_dashes($_POST["title"]);
	$description = sanitize_text_field($_POST["description"]);
	$path = domainCheck($workspaceTitle).'/';
	$current_user = wp_get_current_user();
	$new_blog = wpmu_create_blog($current_site->domain, $current_site->path.$path, $title, $current_user->ID, array( 'public' => 1 ), $current_site->id );
	switch_to_blog($new_blog);
	$updates=array(
		'default_pingback_flag'=>0,
		'default_ping_status'=>'closed',
		'default_comment_status'=>'open',
		'comments_notify'=>1,
		'moderation_notify'=>1,
		'comment_moderation'=>0,
		'require_name_email' => 1,
		'comment_whitelist'=>0,
		'show_avatars'=> 1,
		'blogdescription' => $description,
		'comment_registration' => 1,
		'timezone_string' => 'America/Toronto',
		'date_format' => __('F j, Y'),
		'time_format' => __('H:i'),
		'use_smilies' => 0,
		'use_balanceTags' => 1,
		'rss_use_excerpt' => 1,
		'blog_charset' => 'UTF-8',
		'blog_public' => '0',
		'permalink_structure' => '/%year%/%monthnum%/%day%/%postname%/',
		'close_comments_for_old_posts' => 0,
		'thread_comments' => 1,
		'thread_comments_depth' => 3,
		'page_comments' => 0,
		'default_comments_page' => 'newest',
		'template' => 'commentpress-theme',
		'stylesheet' => 'commentpress-theme',
		'gzipcompression' => '1',
		'admin_email' => $current_user->user_email,
		'show_on_front' => 'page',
		'page_on_front' => 1,
		'commentpress_show_on_front' => 'pages',
	);
	foreach($updates as $option=>$value)
	{
		update_option($option, $value);
	}
	wp_delete_comment(1, true);
	
	$title_page = array();
	$title_page['ID'] = 1;
	$title_page['post_title'] = 'Home';
	$title_page['post_name'] = 'home';
	$title_page['post_type'] = 'page';
	$title_page['comment_status'] = 'closed';
	$title_page['menu_order'] = -1;
	$title_page['post_content'] = 
	"Welcome to your new CommentPress-enabled Workspace!  CommentPress allows you and your group members to collaborate in the margins of a text. Annotate, gloss, workshop, debate: with CommentPress you can do all of these things on a finer-grained level, turning a document into a conversation.

	This is the workspace\'s homepage. Edit it to suit your needs.

	If you would like to make a new \"page\", visit the workspace\'s \"Dashboard\".

	For more information about CommentPress, please refer to the <a href='http://www.futureofthebook.org/commentpress/'>CommentPress website</a>.";
	
	$sample_chapter = array();
	$sample_chapter['ID'] = 2;
	$sample_chapter['post_title'] = 'Chapter 1';
	$sample_chapter['post_name'] = 'chapter-1';
	$sample_chapter['post_content'] = 'This is where you can start writing and discussing your text.  Go to the dashboard to edit this page and create new ones.';
	$sample_chapter['post_type'] = 'page';
	
	$sample_subsection1 = array();
	$sample_subsection1['post_title'] = 'Subsection 1';
	$sample_subsection1['post_name'] = 'subsection-1';
	$sample_subsection1['post_type'] = 'page';
	$sample_subsection1['post_parent'] = 2;
	$sample_subsection1['post_status'] = 'publish';
	$sample_subsection1['post_content'] = 'Here is a subsection in your content';
	
	$sample_subsection2 = array();
	$sample_subsection2['post_title'] = 'Subsection 2';
	$sample_subsection2['post_name'] = 'subsection-2';
	$sample_subsection2['post_type'] = 'page';
	$sample_subsection2['post_parent'] = 2;
	$sample_subsection2['post_status'] = 'publish';
	$sample_subsection2['post_content'] = 'Here is another subsection in your content';
	
	wp_delete_post(3, true);
	wp_update_post($title_page);
	wp_update_post($sample_chapter);
	wp_insert_post($sample_subsection1);
	wp_insert_post($sample_subsection2);
	
	$blogusers = get_users('blog_id=1');
 	foreach ($blogusers as $user) 
 	{
 		$blogid = $new_blog->id;
		$role = 'editor';
		add_user_to_blog($blogid, $user->ID, $role );
	}
  
	wp_redirect($current_site->path.$path);
}

if(isset($_POST['new_blog']))
{
   new_workspace();
} 


/**
 * On an early action hook, check if the hook is scheduled - if not, schedule it.
 */
function setup_email_schedule() {
	if (!wp_next_scheduled('daily_update_event')) 
	{
		wp_schedule_event(time(), 'daily', 'daily_update_event');
	}
}
add_action('wp', 'setup_email_schedule');


/**
 * On the scheduled action hook, run a function.
 */
function email_users_updates() {
	//maybe use $wpdb object for forums
	$blogusers = get_users('blog_id=1');
	$from = "admin@mikestumpf.com";
	$subject = "Cord Network Updates";
	$headers = "From:" . $from;
	$from = "admin@mikestumpf.com";
	$message = "Hello,\n\nThere has been recent activity in the Cord Network forums. Please see the following forums: \n\n";
	$reply_args = array(
		'post_type' => array('reply'),
		'date_query' => array(
			array(
				'year' => date('Y'),
				'week' => date('W'),
			),
		),
	);
	$reply_query = new WP_Query($reply_args);
		
	if ( $reply_query->have_posts() ) {
		while ($reply_query->have_posts()) {
			$reply_query->the_post();
			$message .= get_permalink()." \n";
		}
		$to = 'mike.a.stumpf@gmail.com';
	}
	$topic_args = array(
		'post_type' => array('topic'),
		'date_query' => array(
			array(
				'year' => date('Y'),
				'week' => date('W'),
			),
		),
	);
	$topic_query = new WP_Query($topic_args);
		
	if ($topic_query->have_posts() ) {
		while ($topic_query->have_posts()) {
			$topic_query->the_post();
			$message .= get_permalink()." \n";
		}
		$to = 'mike.a.stumpf@gmail.com';
	}
	//mail($to,$subject,$message,$headers);
	foreach ($blogusers as $user) {
		$to = $user->user_email;
		//mail($to,$subject,$message,$headers);
	}
}
add_action('daily_update_event', 'email_users_updates');

function excerpt_length($length) {
	return 75;
}

add_filter('excerpt_length', 'excerpt_length', 999);

function custom_login_css() {
	echo '<link rel="stylesheet" type="text/css" href="'.get_stylesheet_directory_uri().'/custom_styles.css" />';
}

add_action('login_head', 'custom_login_css');

/*-------------------------------------*/

function custom_login_header_url($url) {
	return home_url();
}

function twitter_url() {
	return "https://twitter.com/CORD_network";
}

function facebook_url() {
	return "https://www.facebook.com/cordnetwork";
}

function twitter_share_url() {
	return "http://twitter.com/share?text=".get_the_title()."%20%20%23CORD_network,%20%40CORD_network&url=".get_permalink();
}

function facebook_share_url() {
	return "http://www.facebook.com/sharer.php?u=".get_permalink();
}

function remove_xprofile_links() {
	remove_filter('bp_get_the_profile_field_value', 'xprofile_filter_link_profile_data', 9, 2 );
}
add_action( 'bp_init', 'remove_xprofile_links');
