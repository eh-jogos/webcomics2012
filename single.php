<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<?php 
	$category = get_the_category();
	
	$categoryProduct = false;
	foreach ( $category as $category ){
		if ($category->slug == "produto"){
			$categoryProduct = true;
		}
	}
	
	//var_dump($categoryProduct);
	?>
	
	<?php if ($categoryProduct) : ?>
		<div id="primary" class="site-content full-width loja-single-produto">
	<?php else : ?>
		<div id="primary" class="site-content">
	<?php endif ?>

		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					if ($categoryProduct) : 
						get_template_part( 'content', "lojaSingle" );
					else : 
						get_template_part( 'content', get_post_format() );
					endif
				?>

				<nav class="nav-single">
					<h3 class="assistive-text"><?php _e( 'Post navigation', 'twentytwelve' ); ?></h3>
					<span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'twentytwelve' ) . '</span> %title' ); ?></span>
					<span class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'twentytwelve' ) . '</span>' ); ?></span>
				</nav><!-- .nav-single -->

				<?php comments_template( '', true ); ?>

			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php 
	if ($categoryProduct) : 

	else : 
		get_sidebar(); 
	endif 
?>

<?php get_footer(); ?>