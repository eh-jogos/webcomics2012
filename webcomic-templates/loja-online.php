<?php
/**
 * Template Name: Loja Online
 *
 * Description: Twenty Twelve loves the no-sidebar look as much as
 * you do. Use this page template to remove the sidebar from any page.
 *
 * Tip: to remove the sidebar from all posts and pages simply remove
 * any active widgets from the Main Sidebar area, and the sidebar will
 * disappear everywhere.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content full-width loja-online">
		<div id="content" role="main">
			
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'pageNoTitle' ); ?>
				<?php comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>
			
			<?php
			$catObj = get_category_by_slug("produto");
			$catID = $catObj->term_id;
			
			$args = array(
				'cat' => $catID,
				'posts_per_page' => 1,
				"meta_key" => "rdhqs_loja_online_destaque",
				"meta_value" => "sim"
			);
			$loja_destaque_query = new WP_Query( $args);
			if ( $loja_destaque_query->have_posts() ) { 
				while ( $loja_destaque_query->have_posts() ) { 
					$loja_destaque_query->the_post();
					get_template_part( 'content', "loja" );
				}
			}
			wp_reset_postdata(); 
			?>
			
			<?php
			
			$args = array(
				'posts_per_page' => -1,
				'paged' => $paged,
				'cat' => $catID,
				"meta_key" => "rdhqs_loja_online_destaque",
				"meta_value" => "não"
			);
			$loja_query = new WP_Query( $args);
			if ( $loja_query->have_posts() ) { 
				while ( $loja_query->have_posts() ) { 
					$loja_query->the_post();
					get_template_part( 'content', "loja" );
				}
			}
			wp_reset_postdata(); 

			?>
			<?php comments_template( '', true ); ?>
		</div><!-- #content -->
	</div><!-- #primary -->
	
	

<?php get_footer(); ?>