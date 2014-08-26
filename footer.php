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
	
	<footer id="colophon" role="contentinfo">

		<div id="footerwidgets"> 
			<div id="footer-left"> 
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widgets Left') ) : ?> <?php endif; ?> 
			</div> 
			<div id="footer-middle"> 
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widgets Center') ) : ?> <?php endif; ?> 
			</div> 
			<div id="footer-right"> 
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widgets Right') ) : ?> <?php endif; ?> 
			</div> 
		</div> 
	
		<nav id="site-navigation" class="main-navigation" role="navigation">
			<h3 class="menu-toggle"><?php _e( 'Menu', 'twentytwelve' ); ?></h3>
			<a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentytwelve' ); ?>"><?php _e( 'Skip to content', 'twentytwelve' ); ?></a>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu',  'depth'           => 1 ) ); ?>
		</nav><!-- #site-navigation -->
		
		<div class="credits">
			<span class="copyright">&copy; 2014 Community Answers. All Rights Reserved.</span>
			<span class="designer">site by <a href="http://www.juicetank.com">JuiceTank Digital</a></span>
		</div>
		
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>