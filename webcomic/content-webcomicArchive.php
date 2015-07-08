<?php
/**
 * The default template for displaying content
 *
 * Used for my custom Webcomic Archives from Webcomic 20-12 and Webcomic 20-15 child Themes
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

	<article id="post-<?php get_post_meta(get_the_ID(), 'webcomic_collection'); ?>" class="webcomic-archive-content">
		<header class="archive-header">
			<h1 class="archive-title"><?php
				if ( is_webcomic_archive()) :
					post_type_archive_title(sprintf('%s', __('Arquivo: ', 'twentytwelve')));
				elseif ( is_webcomic_storyline() ) :
					webcomic_storyline_title(sprintf('%s', __('Arquivo: ', 'twentytwelve')));
				elseif ( is_webcomic_character()) :
					webcomic_character_title(sprintf('%s', __('Arquivo: ', 'twentytwelve')));
				else :
					_e( 'Archives', 'twentytwelve' );
				endif;
			?></h1>
		</header><!-- .archive-header -->

		
		<div class="entry-content">
			
			<?php if ( is_webcomic_archive()) : ?>
				<?php if (WebcomicTag::webcomic_collection_image()) : ?>

					<div class="page-image"><?php webcomic_collection_poster(); ?></div><!-- .page-image -->

				<?php endif; ?>

				<?php if (WebcomicTag::webcomic_collection_description()) : ?>

					<div class="page-content"><?php webcomic_collection_description(); ?></div><!-- .page-content -->

				<?php endif; ?>
					
			<?php elseif ( is_webcomic_storyline() ) : ?>
				<?php if (WebcomicTag::webcomic_term_image()) : ?>

					<div class="page-image"><?php webcomic_storyline_cover(); ?></div><!-- .page-image -->

				<?php endif; ?>

				<?php if (WebcomicTag::webcomic_term_description()) : ?>

					<div class="page-content"><?php webcomic_storyline_description(); ?></div><!-- .page-content -->

				<?php endif; ?>
			<?php elseif ( is_webcomic_character()) : ?>
				<?php get_template_part('info',"author", get_post_type()); ?>
			<?php endif; ?>
			
		</div><!-- .entry-content -->
	</article><!-- #post -->
