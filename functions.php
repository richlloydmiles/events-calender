<?php 

/*******************************************
Custom Post Types for Events
********************************************/
$singular_name = 'Event';
$plural_name = 'Events';
$labels = array(
	'name'               => _x( "$plural_name", "post type general name", "wobble" ),
	"singular_name"      => _x( "$singular_name", "post type singular name", "wobble" ),
	"menu_name"          => _x( "$plural_name", "admin menu", "wobble" ),
	"name_admin_bar"     => _x( "$singular_name", "add new on admin bar", "wobble" ),
	"add_new"            => _x( "Add New", "$singular_name", "wobble" ),
	"add_new_item"       => __( "Add New $singular_name", "wobble" ),
	"new_item"           => __( "New $singular_name", "wobble" ),
	"edit_item"          => __( "Edit $singular_name", "wobble" ),
	"view_item"          => __( "View $singular_name", "wobble" ),
	"all_items"          => __( "All $plural_name", "wobble" ),
	"search_items"       => __( "Search $plural_name", "wobble" ),
	"parent_item_colon"  => __( "Parent $plural_name:", "wobble" ),
	"not_found"          => __( "No $plural_name found.", "wobble" ),
	"not_found_in_trash" => __( "No $plural_name found in Trash.", "wobble" )
	);

$args = array(
	'labels'             => $labels, 
	'public'             => true,
	'publicly_queryable' => true,
	'show_ui'            => true,
	'show_in_menu'       => true,
	'query_var'          => true,
	'capability_type'    => 'post',
	'has_archive'        => true,
	'hierarchical'       => false,
	'menu_position'      => null, 
	'supports'           => array( 'title', 'thumbnail', 'editor' ),
	'menu_icon'			 => 'dashicons-index-card'
	);
//	https://developer.wordpress.org/resource/dashicons/

register_post_type( 'events-calendar', $args ); 



/**************************** Requires CMB2 ****************************/

/**************************************************************
Extend Events Calendar Custom Post type
***************************************************************/
function extend_events_calendar_post_type() {
	// Start with an underscore to hide fields from custom fields list
	$prefix = '_events_calendar_post_';
	/**
	 * Sample metabox to demonstrate each field type included
	 */


	
	$cmb_event_date = new_cmb2_box( array(
		'id'            => $prefix . 'event_date',
		'title'         => __( 'Event Details', 'cmb2' ),
		'object_types'  => array( 'events-calendar', ), // Post type
		//'show_on'      => array( 'key' => 'id', 'value' => 100 ),
		// 'context'    => 'normal',
		// 'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'cmb_styles' => true, // false to disable the CMB stylesheet
		'closed'     => true, // true to keep the metabox closed by default
		) );


	$cmb_event_date->add_field( array(
		'name'       => __( 'Start Date', 'cmb2' ),
		//'desc'       => __( 'Add your content', 'cmb2' ),
		'id'         => $prefix . 'event_date_start_field',
		'type'       => 'text_datetime_timestamp',
		//'repeatable' => 'false' , 
	   'sortable'      => true, // beta
		'show_on_cb' => 'yourprefix_hide_if_no_cats', // function should return a bool value
		// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
		// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
		// 'on_front'        => false, // Optionally designate a field to wp-admin only
		) );

	$cmb_event_date->add_field( array(
		'name'       => __( 'End Date', 'cmb2' ),
		//'desc'       => __( 'Add your content', 'cmb2' ),
		'id'         => $prefix . 'event_date_end_field',
		'type'       => 'text_datetime_timestamp',
		//'repeatable' => 'false' , 
	   'sortable'      => true, // beta
		'show_on_cb' => 'yourprefix_hide_if_no_cats', // function should return a bool value
		// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
		// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
		// 'on_front'        => false, // Optionally designate a field to wp-admin only
		) );

	$cmb_event_date->add_field( array(
		'name'       => __( 'Location', 'cmb2' ),
		//'desc'       => __( 'Add your content', 'cmb2' ),
		'id'         => $prefix . 'event_location_field',
		'type'       => 'text',
		//'repeatable' => 'false' , 
	   'sortable'      => true, // beta
		'show_on_cb' => 'yourprefix_hide_if_no_cats', // function should return a bool value
		// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
		// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
		// 'on_front'        => false, // Optionally designate a field to wp-admin only
		) );

	$cmb_event_date->add_field( array(
		'name'       => __( 'Venue', 'cmb2' ),
		//'desc'       => __( 'Add your content', 'cmb2' ),
		'id'         => $prefix . 'event_venue_field',
		'type'       => 'text',
		//'repeatable' => 'false' , 
	   'sortable'      => true, // beta
		'show_on_cb' => 'yourprefix_hide_if_no_cats', // function should return a bool value
		// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
		// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
		// 'on_front'        => false, // Optionally designate a field to wp-admin only
		) );

	$cmb_event_date->add_field( array(
		'name'       => __( 'Contact Number', 'cmb2' ),
		//'desc'       => __( 'Add your content', 'cmb2' ),
		'id'         => $prefix . 'event_contact_number_field',
		'type'       => 'text',
		//'repeatable' => 'false' , 
	   'sortable'      => true, // beta
		'show_on_cb' => 'yourprefix_hide_if_no_cats', // function should return a bool value
		// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
		// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
		// 'on_front'        => false, // Optionally designate a field to wp-admin only
		) );

	$cmb_event_date->add_field( array(
		'name'       => __( 'Contact Name', 'cmb2' ),
		//'desc'       => __( 'Add your content', 'cmb2' ),
		'id'         => $prefix . 'event_contact_name_field',
		'type'       => 'text',
		//'repeatable' => 'false' , 
	   'sortable'      => true, // beta
		'show_on_cb' => 'yourprefix_hide_if_no_cats', // function should return a bool value
		// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
		// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
		// 'on_front'        => false, // Optionally designate a field to wp-admin only
		) );


	$cmb_event_date->add_field( array(
		'name'       => __( 'Email', 'cmb2' ),
		//'desc'       => __( 'Add your content', 'cmb2' ),
		'id'         => $prefix . 'event_email_field',
		'type'       => 'text',
		//'repeatable' => 'false' , 
	   'sortable'      => true, // beta
		'show_on_cb' => 'yourprefix_hide_if_no_cats', // function should return a bool value
		// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
		// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
		// 'on_front'        => false, // Optionally designate a field to wp-admin only
		) );


	$cmb_event_date->add_field( array(
		'name'       => __( 'Website', 'cmb2' ),
		//'desc'       => __( 'Add your content', 'cmb2' ),
		'id'         => $prefix . 'event_website_field',
		'type'       => 'text',
		//'repeatable' => 'false' , 
	   'sortable'      => true, // beta
		'show_on_cb' => 'yourprefix_hide_if_no_cats', // function should return a bool value
		// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
		// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
		// 'on_front'        => false, // Optionally designate a field to wp-admin only
		) );


}
add_action( 'cmb2_admin_init', 'extend_events_calendar_post_type' );

add_action('init','add_event_month');
function add_event_month() {
	global $wp,$wp_rewrite;
	$wp->add_query_var('month'); 
	$wp->add_query_var('year'); 
	add_rewrite_rule(
		'events-calendar/year/([^/]+)/month/([^/]+)?$',
		'index.php?post_type=events-calendar&month=$matches[2]&year=$matches[1]',
		'top'
		);
}
?>