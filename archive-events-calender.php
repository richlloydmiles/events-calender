<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package _tk
 */

get_header(); ?>
<style>
	.nav-pills>li>a.active {
		background: black;
		color: white;
	}
</style>
<div class="container">
	<div id="content" class="main-content-inner col-md-8">

		<?php // add the class "panel" below here to wrap the content-padder in Bootstrap style ;) ?>
		<div class="content-padder">

			<header>
				<h1 class="page-title">
					Events Calender
				</h1>
				<?php 
				if (empty($wp_query->query_vars['month']) || !isset($wp_query->query_vars['month'])) {
					$wp_query->query_vars['month'] = date("F");

				}
				if (empty($wp_query->query_vars['year']) || !isset($wp_query->query_vars['year'])) {
					$wp_query->query_vars['year'] = date("Y");
				}
				?>
				<h2>
					All exhibition events in <?php echo ucfirst($wp_query->query_vars['month']) . ' ' . $wp_query->query_vars['year'];  ?>
				</h2>
				<?php


				$term_description = term_description();
				if ( ! empty( $term_description ) ) :
					printf( '<div class="taxonomy-description">%s</div>', $term_description );
				endif;
				?>
			</header><!-- .page-header -->

			<ul class="nav nav-pills">
				<?php 
				$number_of_months = 8;
				for ($i=0; $i < $number_of_months; $i++) { 
					?>
					<li role="presentation">
						<a class="<?php if (strtolower(date("F" , strtotime("+".$i." month" ))) == strtolower(date("F" , strtotime($wp_query->query_vars['month'])))) {
							echo 'active';
						} ?>" href="<?php echo get_site_url() . '/events-calendar/year/'.date("Y").'/month/' . strtolower(date("F" , strtotime("+".$i." month" ))); ?>">
						<?php echo substr(date("F" , strtotime("+".$i." month")), 0, 3); ?>
					</a>
				</li>
				<?php
			}
			?>
		</ul>

		<?php
		global $wp_query; 	
		wp_reset_postdata();
		$date_start = new DateTime($wp_query->query_vars['year'] . "-".date("m" , strtotime($wp_query->query_vars['month']))."-01");
		$date_end;

				// echo $temp->getTimestamp();
		if ($wp_query->query_vars['month'] == 'december') {
			$new_date = (string) date('Y') + 1;
			$date_end = new DateTime($wp_query->query_vars['year'] . "-".date("m" , strtotime("+1 month" , strtotime($wp_query->query_vars['month']))) ."-01");
		} else {
			$date_end = new DateTime($wp_query->query_vars['year'] . "-".date("m" , strtotime("+1 month" , strtotime($wp_query->query_vars['month']))) ."-01");
		}

		$range = array( $date_start->getTimestamp(), $date_end->getTimestamp() );
		$args = array(
			'post_type' => 'events-calendar',
			'showposts' => '-1' ,
			'meta_query' => array(
				'relation' => 'AND',
				array(
					'key'   => '_events_calendar_post_event_date_start_field', 
					'value' => $date_end->getTimestamp(),
					'compare' => '<=',
					'type' => 'numeric'
					),
				array(
					'key'   => '_events_calendar_post_event_date_start_field', 
					'value' => $date_start->getTimestamp(),
					'compare' => '>=',
					'type' => 'numeric' 
					),
				)   
			); 
		$query = new WP_Query( $args );
		?>
		<?php /* Start the Loop */ ?>
		<?php if (  $query->have_posts() ) { ?>
		<?php while ( $query->have_posts() ) { $query->the_post(); ?>
		<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );
						
						?>
						<?php } ?>

						<?php _tk_content_nav( 'nav-below' ); ?>

						<?php } else { ?>

						<?php get_template_part( 'no-results', 'archive' ); ?>

						<?php } ?>

					</div><!-- .content-padder -->
				</div><!-- close .*-inner (main-content or sidebar, depending if sidebar is used) --> 

				<?php get_sidebar(); ?>
			</div>
			<?php get_footer(); ?>
