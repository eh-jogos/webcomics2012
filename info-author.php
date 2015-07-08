<?php
/**
 * The default template for displaying author information on single, archive, and authors page
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

<?php if ( is_archive() )  : //No border top and border bottom ?>

	<?php if ( get_the_author_meta( 'description' ) ) : ?>
		<div class="author-info clear ">
			<h2 class="author-title-archive"><?php printf( __( '%s', 'twentytwelve' ), get_the_author() ); ?></h2>
			<div class="author-avatar">
					<?php
					/**
					 * Filter the author bio avatar size.
					 *
					 * @since Twenty Twelve 1.0
					 *
					 * @param int $size The height and width of the avatar in pixels.
					 */
					$author_bio_avatar_size = apply_filters( 'twentytwelve_author_bio_avatar_size', 150 );
					echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
					?>
				</div><!-- .author-avatar -->
			<div class="author-description">
				<p><?php the_author_meta( 'description' ); ?></p>
			</div><!-- .author-description	-->
		</div><!-- .author-info -->
	<?php endif; ?>

<?php elseif ( is_single() )  : // border top ?>

	<?php if ( get_the_author_meta( 'description' ) ) : ?>
		<div class="author-info-border-top clear ">
			<h2 class="author-title-single"><?php printf( __( '%s', 'twentytwelve' ), get_the_author() ); ?></h2>
			<div class="author-avatar">
					<?php
					/**
					 * Filter the author bio avatar size.
					 *
					 * @since Twenty Twelve 1.0
					 *
					 * @param int $size The height and width of the avatar in pixels.
					 */
					$author_bio_avatar_size = apply_filters( 'twentytwelve_author_bio_avatar_size', 150 );
					echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
					?>
				</div><!-- .author-avatar -->
			<div class="author-description">
				<p><?php the_author_meta( 'description' ); ?></p>
			</div><!-- .author-description	-->
		</div><!-- .author-info -->
	<?php endif; ?>

<?php elseif ( is_page_template("webcomic-templates/authors-page.php") )  : // no borders ?>
	<?php $autor = array(get_user_by("slug","reddoormutt")->ID,get_user_by("slug","reddoordaniel")->ID,get_user_by("slug","reddoorrafael")->ID); ?>
	
	<?php foreach ($autor as $autor ) { ?>
	<?php if ( get_the_author_meta( 'description',$autor ) ) : ?>
		<div class="author-info-page clear ">
			<h2 class="author-title-archive"><?php printf( __( '%s', 'twentytwelve' ), get_the_author_meta( 'display_name',$autor )); ?></h2>
			<div class="author-avatar">
					<?php
					/**
					 * Filter the author bio avatar size.
					 *
					 * @since Twenty Twelve 1.0
					 *
					 * @param int $size The height and width of the avatar in pixels.
					 */
					$author_bio_avatar_size = apply_filters( 'twentytwelve_author_bio_avatar_size', 150 );
					echo get_avatar( $autor, $author_bio_avatar_size );
					?>
				</div><!-- .author-avatar -->
			<div class="author-description-page clear">
				<p><?php the_author_meta( 'description',$autor ); ?></p>
			</div><!-- .author-description	-->
			
			<div id="redes-sociais-<?php echo $autor ?>" class="redes-sociais-wrapper-autor clear"> 
				
				<ul id="redes-sociais-lista<?php echo $autor ?>" class="redes-sociais-icons-list clear"><p class="author-list-title"><strong>Links, portifólios e redes sociais:</strong></p>
					<?php if (get_cimyFieldValue( $autor,"SHOW_BLOG_ARCHIVE") == "YES") : ?>
						<li id="blog-archive-<?php echo $autor ?>" class="website-link">
							<a href="<?php echo get_author_posts_url( $autor ); ?>">Veja todos os posts do <?php echo get_the_author_meta( 'display_name',$autor ) ?>no blog</a>
						</li>
					<?php endif; ?>
					<?php if ( get_cimyFieldValue( $autor,"SHOW_HQ_ARCHIVE") == "YES") : ?>
						<?php if ($autor == 2): ?>
						<li id="hq-archive-<?php echo $autor ?>" class="website-link">
							<a href="<?php echo home_url("/reddoorhqs-character/bruno-arruda/") ; ?>">Veja todas as páginas de HQs do <?php echo get_the_author_meta( 'display_name',$autor ) ?></a>
						</li>
						<?php elseif ($autor == 5): ?>
						<li id="hq-archive-<?php echo $autor ?>" class="website-link">
							<a href="<?php echo home_url("/reddoorhqs-character/daniel-queiroz-porto/") ; ?>">Veja todas as páginas de HQs do <?php echo get_the_author_meta( 'display_name',$autor ) ?></a>
						</li>
						<?php elseif ($autor == 3): ?>
						<li id="hq-archive-<?php echo $autor ?>" class="website-link">
							<a href="<?php echo home_url("/reddoorhqs-character/rafael-oliveira/") ; ?>">Veja todas as páginas de HQs do <?php echo get_the_author_meta( 'display_name',$autor ) ?></a>
						</li>
						<?php else : ?>
						<?php endif; ?>
					<?php endif; ?>
					
					<?php if ( get_the_author_meta( 'user_url',$autor ) && get_cimyFieldValue( $autor,"SHOW_WEBSITE") == "YES") : ?>
						<li id="website-link-<?php echo $autor ?>" class="website-link">
							<a href="<?php echo get_the_author_meta( 'user_url',$autor ); ?>" title="Site Pessoal">Portfólio Online</a>
						</li>
					<?php endif; ?>
					
					<?php if ( get_the_author_meta( 'user_email',$autor ) && get_cimyFieldValue( $autor,"SHOW_EMAIL")== "YES") : ?>
					<li id="email-btn" class="social-icons-btn">
						<a href="mailto:<?php echo get_the_author_meta( 'user_email',$autor ); ?>" title="Nosso Email">Mande-nos um e-mail</a>
					</li>
					<?php endif; ?>
					
					<?php if ( get_the_author_meta( 'facebook',$autor ) && get_cimyFieldValue( $autor,"SHOW_FACEBOOK")== "YES") : ?>
					<li id="facebook-btn" class="social-icons-btn">
						<a href="<?php echo get_the_author_meta( 'facebook',$autor ); ?>" title="Facebook do <?php echo get_the_author_meta( 'display_name',$autor ) ?> " >Facebook do <?php echo get_the_author_meta( 'display_name',$autor ) ?></a>
					</li>
					<?php endif; ?>
					
					<?php if ( get_the_author_meta( 'twitter',$autor ) && get_cimyFieldValue( $autor,"SHOW_TWITTER")== "YES") : ?>
					<li id="twitter-btn" class="social-icons-btn">
						<a href=" http://www.twitter.com/<?php echo get_the_author_meta( 'twitter',$autor ); ?>" title="Twitter do <?php echo get_the_author_meta( 'display_name',$autor ) ?> " >Twitter do <?php echo get_the_author_meta( 'display_name',$autor ) ?></a>
					</li>
					<?php endif; ?>
					
					<?php if ( get_cimyFieldValue( $autor,"LINKEDIN")) : ?>
					<li id="linkedin-btn" class="social-icons-btn">
						<a href="<?php echo cimy_uef_sanitize_content(get_cimyFieldValue( $autor,"LINKEDIN")); ?>" title="Linkedin do <?php echo get_the_author_meta( 'display_name',$autor ) ?> " >Linkedin do <?php echo get_the_author_meta( 'display_name',$autor ) ?></a>
					</li>
					<?php endif; ?>
					
					<?php if ( get_cimyFieldValue( $autor,"BEHANCE")) : ?>
					<li id="behance-btn" class="social-icons-btn">
						<a href="<?php echo cimy_uef_sanitize_content(get_cimyFieldValue( $autor,"BEHANCE")); ?>" title="Behance do <?php echo get_the_author_meta( 'display_name',$autor ) ?> " >Behance do <?php echo get_the_author_meta( 'display_name',$autor ) ?></a>
					</li>
					<?php endif; ?>
					
					<?php if ( get_cimyFieldValue( $autor,"DEVIANTART")) : ?>
					<li id="deviantart-btn" class="social-icons-btn">
						<a href="<?php echo cimy_uef_sanitize_content(get_cimyFieldValue( $autor,"DEVIANTART")); ?>" title="DeviantArt do <?php echo get_the_author_meta( 'display_name',$autor ) ?> " >DeviantArt do <?php echo get_the_author_meta( 'display_name',$autor ) ?></a>
					</li>
					<?php endif; ?>
					
					<?php if ( get_cimyFieldValue( $autor,"BLOGSPOT")) : ?>
					<li id="blogspot-btn" class="social-icons-btn">
						<a href="<?php echo cimy_uef_sanitize_content(get_cimyFieldValue( $autor,"BLOGSPOT")); ?>" title="Blogspot do <?php echo get_the_author_meta( 'display_name',$autor ) ?> " >Blogspot do <?php echo get_the_author_meta( 'display_name',$autor ) ?></a>
					</li>
					<?php endif; ?>
					
					<?php if ( get_cimyFieldValue( $autor,"TUMBLR")) : ?>
					<li id="tumblr-btn" class="social-icons-btn">
						<a href="<?php echo cimy_uef_sanitize_content(get_cimyFieldValue( $autor,"TUMBLR")); ?>" title="Tumblr do <?php echo get_the_author_meta( 'display_name',$autor ) ?> " >Tumblr do <?php echo get_the_author_meta( 'display_name',$autor ) ?></a>
					</li>
					<?php endif; ?>
					
					<?php if ( get_cimyFieldValue( $autor,"INSTAGRAM")) : ?>
					<li id="instagram-btn" class="social-icons-btn">
						<a href="<?php echo cimy_uef_sanitize_content(get_cimyFieldValue( $autor,"INSTAGRAM")); ?>" title="Instagram do <?php echo get_the_author_meta( 'display_name',$autor ) ?> " >Instagram do <?php echo get_the_author_meta( 'display_name',$autor ) ?></a>
					</li>
					<?php endif; ?>
					
					<?php if ( get_cimyFieldValue( $autor,"PINTEREST")) : ?>
					<li id="pinterest-btn" class="social-icons-btn">
						<a href="<?php echo cimy_uef_sanitize_content(get_cimyFieldValue( $autor,"PINTEREST")); ?>" title="Pinterest do <?php echo get_the_author_meta( 'display_name',$autor ) ?> " >Pinterest do <?php echo get_the_author_meta( 'display_name',$autor ) ?></a>
					</li>
					<?php endif; ?>
					
					<?php if ( get_cimyFieldValue( $autor,"FLICKR")) : ?>
					<li id="flickr-btn" class="social-icons-btn">
						<a href="<?php echo cimy_uef_sanitize_content(get_cimyFieldValue( $autor,"FLICKR")); ?>" title="Flickr do <?php echo get_the_author_meta( 'display_name',$autor ) ?> " >Flickr do <?php echo get_the_author_meta( 'display_name',$autor ) ?></a>
					</li>
					<?php endif; ?>
					
					<?php if ( get_cimyFieldValue( $autor,"YOUTUBE")) : ?>
					<li id="youtube-btn" class="social-icons-btn">
						<a href="<?php echo cimy_uef_sanitize_content(get_cimyFieldValue( $autor,"YOUTUBE")); ?>" title="Youtube do <?php echo get_the_author_meta( 'display_name',$autor ) ?> " >Youtube do <?php echo get_the_author_meta( 'display_name',$autor ) ?></a>
					</li>
					<?php endif; ?>
					
				</ul>
			</div><!-- .redes-sociais-wrapper -->
		
		</div><!-- .author-info -->
	<?php endif; ?>
	<?php }; ?>
<?php endif; ?>
	