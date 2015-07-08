<?php
/**
 * Webcomic collection archive template.
 * 
 * @package Inkblot
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
	
</div>

<?php get_footer(); ?>