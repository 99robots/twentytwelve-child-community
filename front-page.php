<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">
		
		<?php get_template_part( 'content', 'home-orgcats' ); ?>

		<!-- Reference: http://www.advancedcustomfields.com/resources/how-to/how-to-query-posts-filtered-by-custom-field-values/ -->
		<?php 
				 
			// args
			$args = array(
				'numberposts' => 4,
				'post_type' => 'organization',   // seems only org is required, but still shows tribe_events post type
				'tag' => 'featured'
				//'meta_key' => 'frontpagepost',
				//'meta_value' => '1'
			);
		 
		// get results
		$the_query = new WP_Query( $args );
		 
		// The Loop
		?>
		
		<?php if( $the_query->have_posts() ): ?>

			<div class="featuredpost-container">
				<h2 class="heading">Featured</h2>
				<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					<div class="featuredpost">
						<?php if ( has_post_thumbnail()) : ?>
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
								<?php the_post_thumbnail('medium', array('class' => 'alignleft')); ?>
							</a>
						<?php endif; ?>
						<div class="featext">
							<h2 class="posttitle">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h2>
							<?php the_content(); ?>
						</div>
					</div>
				<?php endwhile; ?>
			</div>
						
		<?php endif; ?>
		 
		<?php wp_reset_query();  // Restore global post data stomped by the_post(). ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>