<?php
/**
 * The template for displaying Tag pages
 *
 * Used to display archive-type pages for posts in a tag.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<section id="primary" class="site-content">
		<div id="content" role="main">

		<?php if ( have_posts() ) : ?>
			<header class="archive-header">
				<h1 class="archive-title"><?php printf( __( 'Tag Archives: %s', 'twentytwelve' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?></h1>

			<?php if ( tag_description() ) : // Show an optional tag description ?>
				<div class="archive-meta"><?php echo tag_description(); ?></div>
			<?php endif; ?>
			</header><!-- .archive-header -->

			<?php
			/* Start the Loop */
				$catObj = get_category_by_slug("produto");
				$catID = $catObj->term_id;
			
				$args = array(
					'posts_per_page' => get_query_var("posts_per_page"),
					'paged' => $paged,
					'cat' => -$catID,
					'tag' =>  get_query_var( 'tag' )
				);
				$wp_query = new WP_Query( $args);
				if ( $wp_query->have_posts() ) { 
					while ( $wp_query->have_posts() ) { 
						$wp_query->the_post();
						get_template_part( 'content', get_post_format() );
					}
				}
				wp_reset_postdata(); 

			twentytwelve_content_nav( 'nav-below' );
			?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
