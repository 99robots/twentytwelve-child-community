<?php
/**
 * Functions and definitions for the Twenty Twelve child theme
 * User: CA
 */


function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );



if ( function_exists('register_sidebar') )
register_sidebar(array(
'name' => 'Footer Widgets Left',
'id' => 'left-footer',
'before_widget' => '',
'after_widget' => '',
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>'
));

if ( function_exists('register_sidebar') )
register_sidebar(array(
'name' => 'Footer Widgets Center',
'id' => 'center-footer',
'before_widget' => '',
'after_widget' => '',
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>'
));

if ( function_exists('register_sidebar') )
register_sidebar(array(
'name' => 'Footer Widgets Right',
'id' => 'right-footer',
'before_widget' => '',
'after_widget' => '',
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>'
));


// 1. Remove the Organizer Dropdown that shows up inside the Edit Events screen.

remove_action( 'tribe_organizer_table_top', array('TribeEventsPro', 'displayEventOrganizerDropdown'),100 );


// 2. Remove any Organizer related tabs from under the Events Parent tab
add_action('admin_menu', 'siq_register_organization_menu');
function siq_register_organization_menu() {

	// Remove Organizations Submenu

	remove_menu_page('edit.php?post_type=tribe_organizer');
	remove_submenu_page('edit.php?post_type=tribe_events', 'edit.php?post_type=tribe_organizer');
	remove_submenu_page('edit.php?post_type=tribe_organizer', 'post-new.php?post_type=tribe_organizer');

	remove_meta_box( 'tribe_events_organizer_details', 'tribe_organizers', 'normal');
	remove_meta_box('slugdiv', 'tribe_organizers', 'core');
}


// 3. Remove the Organizer Dropdown that shows up inside the Edit Events screen.
add_action('admin_footer', 'siq_remove_event_organizer_dropdown');

function siq_remove_event_organizer_dropdown() {
	?>
	<script type="text/javascript">
		jQuery(document).ready(function($){
			$("#event_organizer").hide();
		});
	</script>
	<?php
}


// 4. Create our own Organization Post Type and taxonomies Org Category, Org Type, and Tags by following WP guidelines

add_action( 'init', 'siq_create_organization_category', 0);
function siq_create_organization_category() {

	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name' => _x( 'Organization Type', 'taxonomy general name' ),
		'singular_name' => _x( 'Organization Type', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Organization Types' ),
		'all_items' => __( 'All Organization Types' ),
		'parent_item' => __( 'Parent Organization Type' ),
		'parent_item_colon' => __( 'Parent Organization Type:' ),
		'edit_item' => __( 'Edit Organization Type' ),
		'update_item' => __( 'Update Organization Type' ),
		'add_new_item' => __( 'Add New Organization Type' ),
		'new_item_name' => __( 'New Organization Type Name' ),
		'menu_name' => __( 'Organization Type' ),
	);

	register_taxonomy('org_type',array('organization'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'menu_position' => 3,
		'rewrite' => array( 'slug' => 'org_type' ),
	));

	$labels = array(
		'name' => _x( 'Organization Category', 'taxonomy general name' ),
		'singular_name' => _x( 'Organization Category', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Organization Categories' ),
		'all_items' => __( 'All Organization Categories' ),
		'parent_item' => __( 'Parent Organization Category' ),
		'parent_item_colon' => __( 'Parent Organization Category:' ),
		'edit_item' => __( 'Edit Organization Category' ),
		'update_item' => __( 'Update Organization Category' ),
		'add_new_item' => __( 'Add New Organization Category' ),
		'new_item_name' => __( 'New Organization Category Name' ),
		'menu_name' => __( 'Organization Category' ),
	);

	register_taxonomy('org_category',array('organization'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'menu_position' => 2,
		'rewrite' => array( 'slug' => 'org_category' ),
	));

	$labels = array(
		'name'                => _x( 'Organizations', 'Post Type General Name'),
		'singular_name'       => _x( 'Organization', 'Post Type Singular Name'),
		'menu_name'           => __( 'Organizations'),
		'parent_item_colon'   => __( 'Parent Organization:'),
		'all_items'           => __( 'All Organizations'),
		'view_item'           => __( 'View Organization'),
		'add_new_item'        => __( 'Add New Organization'),
		'add_new'             => __( 'Add New'),
		'edit_item'           => __( 'Edit Organization'),
		'update_item'         => __( 'Update Organization'),
		'search_items'        => __( 'Search Organizations'),
		'not_found'           => __( 'Not found'),
		'not_found_in_trash'  => __( 'Not found in Trash'),
	);
	$args = array(
		'label'               => __( 'organization'),
		'description'         => __( 'Post Type Description'),
		'labels'              => $labels,
		'supports'            => array('title','editor','author','thumbnail','excerpt','custom_fields'),  // Charlie added all fields for support  - 07/23/14
		'taxonomies'          => array('post_tag'),
		'query_var'           => true,
		'rewrite'             => array( 'slug' => 'organization' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
	);
	register_post_type('organization', $args );
}

// 5. Remove the regular Posts from wp admin
// Reference; http://codex.wordpress.org/Function_Reference/remove_menu_page

function stratiq_remove_menus(){
 remove_menu_page( 'edit.php' );                   //Posts
}
add_action( 'admin_menu', 'stratiq_remove_menus' );

// 6. Apply post filters for the search form
//    a) Exclude old event posts

add_action('pre_get_posts', 'siq_search_filter');
function siq_search_filter($query) {
	if ( !is_admin() && $query->is_main_query() ) {
		if ($query->is_search) {
			$query->set('meta_query', array(
				array(
					'key'     => '_EventEndDate',
					'value'   => date('Y-m-d'),
					'type'	  => 'DATE',
					'compare' => '>=',
				)
			));
		}
	}
}