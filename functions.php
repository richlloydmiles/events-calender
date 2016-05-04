<?php 

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