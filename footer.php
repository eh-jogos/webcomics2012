<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
	</div><!-- #main .wrapper -->
</div><!-- #page -->

<footer id="colophon" role="contentinfo">
	<?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'menu_class' => 'nav-menu' ) ); ?>
	<div id="redes-sociais-footer" class="redes-sociais-wrapper">
		<ul id="redes-sociais-lista" class="redes-sociais-icons-list"><p><strong>Nossas Redes Sociais</strong></p>
			<li id="email-btn" class="social-icons-btn flat"><a href="<?php echo esc_url(__(get_page_link(1434),"twentytwelve")); ?>" title="Nosso Email">Mande-nos um e-mail</a></li>
			<li id="facebook-btn" class="social-icons-btn flat"><a href="<?php echo esc_url( __( 'http://www.facebook.com/redoorhqs', 'twentytwelve' ) ); ?>" title="Siga-nos no Facebook" target="_blank">Siga-nos no Facebook</a></li>
			<li id="youtube-btn" class="social-icons-btn flat"><a href="<?php echo esc_url( __( 'https://www.youtube.com/channel/UCHpWWsAn8RGbAjZMouS34QQ', 'twentytwelve' ) ); ?>" title="Siga-nos no Youtube" target="_blank">Siga-nos no Youtube</a></li>
			<li id="pinterest-btn" class="social-icons-btn flat"><a href="<?php echo esc_url( __( 'https://br.pinterest.com/redoorhqs/', 'twentytwelve' ) ); ?>" title="Siga-nos no Pinterest" target="_blank">Siga-nos no Pinterest</a></li>
		</ul>
	</div>
	
	<div class="site-info clear">
		<?php do_action( 'twentytwelve_credits' ); ?>
		<p>
		<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'twentytwelve' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'twentytwelve' ); ?>" target="_blank"><?php printf( __( 'Site feito com a plataforma %s', 'twentytwelve' ), 'WordPress' ); ?></a> | Theme: Webcomics 20-12 por Daniel Queiroz Porto.
		</p> 
		<p>
		Webcomics 20-12  é um child theme do tema <a href="https://wordpress.org/themes/twentytwelve/" title="TwentyTwelve theme page" target="_blank">TwentyTwelve</a> customizado para o nosso site e modificado para integrar o plugin <a href="https://wordpress.org/plugins/webcomic/" title="Webcomics plugin page" target="_blank">Webcomics</a>. 
		</p>
		<p>
		&copy 2013-<?php echo date("Y")?> <a href="<?php echo esc_url(__(bloginfo(url),"twentytwelve")); ?>" title="Red Door HQs Site"><?php echo bloginfo(name) ?></a>, todos os direitos reservados. Para entrar em contato, nos mande uma mensagem em nosso <a href="<?php echo esc_url( __( 'http://www.facebook.com/redoorhqs', 'twentytwelve' ) ); ?>" title="Nossa página no Facebook" target="_blank">facebook</a> ou por <a href="<?php echo esc_url(__(get_permalink(1434),"twentytwelve")); ?>" title="Nossa página de Contato">e-mail</a> 
		</p>
	</div><!-- .site-info -->
</footer><!-- #colophon -->

<?php wp_footer(); ?>
</body>
</html>