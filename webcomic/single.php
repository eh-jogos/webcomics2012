<?php
/**
 * The Template for displaying all Webcomic single posts
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(webcomic); ?>

<div id="webcomic-display" class="webcomic-display-wrapper">

	<?php 
		if ( ! get_theme_mod('webcomic_content', false)) :
			while (have_posts()) : the_post();
				$compassus = get_post_meta(get_the_ID(),"is_compassus_webcomic",true);
				//var_dump($compassus);
				if ( $compassus == true ){
					get_template_part('webcomic/display', "compassus"); 
				} else{
					get_template_part('webcomic/display', get_post_type()); 
				}
			endwhile;
			
			rewind_posts();
		endif;		
	?>

</div>

<div id="page" class="hfeed site">
	<div id="main" class="wrapper">
	
	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php
				if (get_theme_mod('webcomic_content', false)) :
					$compassus = get_post_meta(get_the_ID(),"is_compassus_webcomic",true);
					//var_dump($compassus);
					if ( $compassus == true ){
						get_template_part('webcomic/display', "compassus"); 
					} else{
						get_template_part('webcomic/display', get_post_type()); 
					}
				endif;
				?> 
				
				<?php 
					get_template_part( 'webcomic/content', get_post_format() );
					webcomic_transcripts_template();
				?>

				<nav class="nav-single">
					<h3 class="assistive-text"><?php _e( 'Post navigation', 'twentytwelve' ); ?></h3>
				</nav><!-- .nav-single -->

				<?php comments_template( '', true ); ?>

			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>