<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve Child - Twenty_Twelve 
 * @since Twenty Twelve 1.0
 */

get_header(webcomic); ?>

<div id="webcomic-display" class="webcomic-display-wrapper">
	<?php 
		
		$webcomics = false;
		
		if (get_theme_mod('webcomic_home_order', 'DESC') and ! is_paged()) :
			$webcomics = new WP_Query(array(
				'order' => get_theme_mod('webcomic_home_order', 'DESC'),
				'post_type' => get_theme_mod('webcomic_home_collection', '') ? get_theme_mod('webcomic_home_collection', '') : get_webcomic_collections(),
				'posts_per_page' => 1
			));
		endif;	
		
		if ($webcomics and ! get_theme_mod('webcomic_content', false) and $webcomics->have_posts()) :
			while ($webcomics->have_posts()) : $webcomics->the_post();
				$compassus = get_post_meta(get_the_ID(),"is_compassus_webcomic",true);
				//var_dump($compassus);
				if ( $compassus == true ){
					get_template_part('webcomic/display', "compassus"); 
				} else{
					get_template_part('webcomic/display', get_post_type()); 
				}
	?>
				
				<div id="webcomic-display-article" class="webcomic-display-article-wrapper">
				<?php get_template_part('webcomic/content', get_post_type()); ?>
				</div> <!-- webcomic-display-article -->
			<?php
			endwhile;
				
			if (get_theme_mod('webcomic_front_page_transcripts', false)) :
				webcomic_transcripts_template();
			endif;
		
			if (get_theme_mod('webcomic_front_page_comments', false)) :
				$withcomments = true;
				
				comments_template();
				
				$withcomments = false;
			endif;
			$webcomics->rewind_posts();
		endif;
	
	?>
</div>
	
<div id="page" class="hfeed site">
	<div id="main" class="wrapper">
			
	<div id="primary" class="site-content">
		<div id="content" role="main">
		
		<?php
		
			if ($webcomics and get_theme_mod('webcomic_home_order', 'DESC') and $webcomics->have_posts()) :
				while ($webcomics->have_posts()) : $webcomics->the_post();
					if (get_theme_mod('webcomic_content', false)) :
						get_template_part('webcomic/display', get_post_type());
						get_template_part('webcomic/content', get_post_type());
					endif;
				endwhile;
			
				if (get_theme_mod('webcomic_front_page_transcripts', false)) :
					webcomic_transcripts_template();
				endif;
			
				if (get_theme_mod('webcomic_front_page_comments', false)) :
					$withcomments = true;
					
					comments_template();
					
					$withcomments = false;
				endif;
			endif;
		
		?>
		
		<?php
			$catObj = get_category_by_slug("produto");
			$catID = $catObj->term_id;
			
			$args = array(
				'cat' => -$catID,
				  'posts_per_page' => get_query_var("posts_per_page"),
				  'paged' => $paged,
				);
				$wp_query = new WP_Query( $args);
		?>
		
		<?php if ( $wp_query->have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			
			
			
			<?php
				if ( $wp_query->have_posts() ) { 
					while ( $wp_query->have_posts() ) { 
						$wp_query->the_post();
						get_template_part( 'content', get_post_format() );
					}
				}
				wp_reset_postdata(); 
			?>

			<?php twentytwelve_content_nav( 'nav-below' ); ?>

		<?php else : ?>

			<article id="post-0" class="post no-results not-found">

			<?php if ( current_user_can( 'edit_posts' ) ) :
				// Show a different message to a logged-in user who can add posts.
			?>
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'No posts to display', 'twentytwelve' ); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php printf( __( 'Ready to publish your first post? <a href="%s">Get started here</a>.', 'twentytwelve' ), admin_url( 'post-new.php' ) ); ?></p>
				</div><!-- .entry-content -->

			<?php else :
				// Show the default message to everyone else.
			?>
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Nothing Found', 'twentytwelve' ); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php _e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'twentytwelve' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			<?php endif; // end current_user_can() check ?>

			</article><!-- #post-0 -->

		<?php endif; // end have_posts() check ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
