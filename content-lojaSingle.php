<?php
/**
 * The default template for displaying content
 *
 * Used for single product pages
 *
 * @package WordPress
 * @subpackage Twenty_Twelve Child - Webcomic_2012	
 * @since Twenty Twelve 1.0
 */
?>

	<?php 
		$destaqueProduto = get_post_meta(get_the_ID(),"rdhqs_loja_online_destaque",true);
		$autorProduto = get_post_meta(get_the_ID(),"rdhqs_loja_online_autor",true);
		$precoProduto = get_post_meta(get_the_ID(),"rdhqs_loja_online_preco",true);
		$descontoProduto = get_post_meta(get_the_ID(),"rdhqs_loja_online_preco_descontado",true);
		$carrinho1 = get_post_meta(get_the_ID(),"rdhqs_loja_online_botao_moip",true);
		$carrinho2 = get_post_meta(get_the_ID(),"rdhqs_loja_online_botao_moip_carrinho",true);
	?>


	<article id="post-<?php the_ID(); ?>" <?php post_class("loja-single"); ?>>
		<header class="entry-header">
		
		<a href="<?php echo esc_url(__(get_permalink(882),"twentytwelve")); ?>"	title="Loja Online" class="loja-online-link" >Loja Online &gt </a>	
		<h1 class="entry-title"><?php the_title(); ?></h1>	
		<?php if ( $autorProduto ) : ?>
			<h2 class="autor-produto">
				Por: <?php echo $autorProduto ; ?>
			</h2>
		<?php endif ?>

		<?php if ( comments_open() ) : ?>
			<div class="comments-link">
				<?php comments_popup_link( '<span class="leave-reply">' . __( 'Deixe um comentário!', 'twentytwelve' ) . '</span>', __( '1 comentário', 'twentytwelve' ), __( '% comentários', 'twentytwelve' ) ); ?>
			</div><!-- .comments-link -->
		<?php endif; // comments_open() ?>
		</header><!-- .entry-header -->
	
		<div class="entry-content clear">
			<?php the_post_thumbnail(array(400,612),array("class"=>"blog-featured")); ?>
			<?php if ( function_exists( 'sharing_display' ) ) remove_filter( 'the_content', 'sharing_display', 19 ); ?>
			<?php //if ( function_exists( 'sharing_display' ) ) remove_filter( 'the_excerpt', 'sharing_display', 19 ); ?>
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) ); ?>
			
			<div class="elementos-loja-wrapper clear">
				<?php if ( $destaqueProduto == "sim" && $descontoProduto ) : ?>
					<p id="product-<?php the_ID(); ?>-preco" class="produto-preco-cortado"><?php echo "De <span class='preco-cortado'>R$ ".$precoProduto."</span> por <br><span class='produto-preco-promo-destaque'>R$ ".$descontoProduto ; ?></span></p>
				<?php elseif ( $destaqueProduto == "não" && $descontoProduto ) : ?>
					<p id="product-<?php the_ID(); ?>-preco" class="produto-preco-cortado"><?php echo "De <span class='preco-cortado'>R$ ".$precoProduto."</span> por <span class='produto-preco-promo'>R$ ".$descontoProduto ; ?></span></p>
				<?php else : ?>
					<p id="product-<?php the_ID(); ?>-preco" ><span class="produto-preco"><?php echo "R$ ".$precoProduto ; ?></span></p>
				<?php endif ?>
				<?php 
					echo $carrinho1;
					echo $carrinho2;
				?>
			</div>
			
			<?php if ( function_exists( 'sharing_display' ) ) echo sharing_display(); ?>
			
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->

		<footer class="entry-meta">
			<p id="title-meta" class="title-meta-text"><?php webcomic2012_loja_meta(); ?></p>
			<?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>

		</footer><!-- .entry-meta -->
	</article><!-- #post -->
