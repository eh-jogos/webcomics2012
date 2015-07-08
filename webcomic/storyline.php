<?php
/**
 * Webcomic Storyline archive template.
 * 
 * @package Webcomic 2012
 * @see github.com/mgsisk/webcomic/wiki/Templates
 */

get_header();

if ('ASC' === get_theme_mod('webcomic_archive_order', 'ASC')) :
	global $wp_query;
	
	query_posts(array_merge($wp_query->query_vars, array(
		'order' => get_theme_mod('webcomic_archive_order', 'ASC')
	)));
endif; ?>

<div id="primary" class="site-content full-width">
	<div id="content" role="main">
		<?php get_template_part( 'webcomic/content', 'webcomicArchive' ); ?>
	</div><!-- #content -->
	
	<div id="storyline-archive" class="webcomic-archive">
		<?php
			//tests to get useful info about the current query when developing
			/*
			$queried_object = get_queried_object();
			$test1 = get_query_var("term");
			var_dump( $queried_object, $test1 );
			*/
		?>
		<ul class="webcomics">	
		<?php 
			$args = array(
				'posts_per_page' => -1,
				'post_type' => get_post_type(),
				'order' => "ASC",
				get_post_type()."_storyline" => get_query_var("term"),
			);
				$Storyline_query = new WP_Query( $args);
				if ( $Storyline_query->have_posts() ) { 
					while ( $Storyline_query->have_posts() ) { 
						$Storyline_query->the_post();
						get_template_part('webcomic/content',"thumbailList", get_post_type());
					}
				}
				wp_reset_postdata(); ?>
		</ul>
	</div>
	
</div>

<?php get_footer(); ?>