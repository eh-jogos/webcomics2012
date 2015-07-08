<?php
/**
 * Template Name: Arquivo Anual
 
 * Template base para o arquivo anual da Red Door HQs 
 
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content full-width">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
				<?php comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
		
		<div id="anual-archive" class="webcomic-archive">
			<?php 
			
				$webcomic_group = "storyline";
				$webcomic_arguments = array(
					'collection' => get_post_meta(get_the_ID(), 'webcomic_collection', true),
					'webcomics' => true,
					'order' => get_post_meta(get_the_ID(), 'inkblot_webcomic_term_order', true),
					'target' => "archive",
					'webcomic_order' => "ASC",
					'webcomic_image' => "thumbnail",
					'show_image' => true,
					'show_description' => true
				);
				
				if ('character' === $webcomic_group) :
					webcomic_list_characters($webcomic_arguments);
				elseif ('storyline' === $webcomic_group) :
					webcomic_list_storylines($webcomic_arguments);
				else :
					webcomic_list_collections($webcomic_arguments);
				endif;
				
			?>
		</div>
		
	</div><!-- #primary -->

<?php get_footer(); ?>