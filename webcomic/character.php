<?php
/**
 * Webcomic Character archive template.
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
	
	<div id="anual-archive" class="webcomic-archive">
		
		<ul class="webcomic-terms">	
		<?php
			$characterFilter = get_query_var("term");
			
			$postTypeList = get_webcomic_collections();
			rsort($postTypeList);
			
			$storylineObj = array();
			foreach ($postTypeList as $x){
				$args = get_taxonomies(array("name"=> $x."_storyline"));
				$storylineObj[$x] = get_terms($args);
				rsort($storylineObj[$x]);
			}
			//var_dump($storylineObj);
			
			
		?>	
			<?php foreach($storylineObj as $postType => $x){ ?>
				<?php foreach($x as $storyline){ ?>
					<?php 
					$slug = $storyline->slug;
					$name = $storyline->name;
					$description = $storyline->description;
					$image = $storyline->webcomic_image;
					?>
					<?php $args = array(
						'posts_per_page' => -1,
						'post_type' => $postType,
						'order' => "DESC",
						"tax_query" => array("relation" => "AND"),
						$postType."_character" => $characterFilter,
						$postType."_storyline" => $slug,
						);
					?>	
					<?php $Storyline_query = new WP_Query( $args);?>
					<?php if ( $Storyline_query->have_posts() ) { ?>
						<li class="webcomic-term">
							<a href="<?php echo get_term_link($slug,$postType."_storyline"); ?>" class="webcomic-term-link"><?php echo $name;?>
								<div class="webcomic-term-name"><?php echo $name; ?></div>
								<?php if ($image) : ?>
								<div class="webcomic-term-image"><?php  echo  wp_get_attachment_image($image,"full");  ?></div>
								<?php endif; ?>
							</a>
							<?php if ($description) : ?>
							<div class="webcomic-term-description"><?php echo $description;?></div>
							<?php endif; ?>
							<ul class="webcomics">
						<?php while ( $Storyline_query->have_posts() ) { ?>						
								<?php $Storyline_query->the_post(); ?>
								<?php get_template_part('webcomic/content',"thumbailList", get_post_type()); ?>
						<?php } ?>
						</ul>
						</li>
					<?php }
					wp_reset_postdata();
				}
			}
		?>	
		</ul>
		
	</div>
	
</div>

<?php get_footer(); ?>