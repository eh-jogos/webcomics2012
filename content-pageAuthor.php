<?php
/**
 * The template used for displaying page content in NO Titles page templates.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php if (  has_post_thumbnail( )  ) : ?>
		<header class="entry-header">
			<?php if ( ! is_page_template( 'page-templates/front-page.php' ) ) : ?>
			<?php the_post_thumbnail("full",array("class"=>"blog-featured")); ?>
			<?php endif; ?>
		</header>
		<?php endif; ?>

		<div class="entry-content">
			<?php 
			//ESPAÇO DE TESTES
			
			//$autor1 = get_user_by("slug","reddoordaniel")->ID;
			//$autor = get_cimyFieldValue( $autor1,false);
			
			//var_dump($autor, $autor1, get_cimyFieldValue( $autor1,"SHOW_WEBSITE") == "YES");
			?>
			<?php get_template_part('info',"author", get_post_type()); ?>
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
		<footer class="entry-meta">
			<?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post -->
