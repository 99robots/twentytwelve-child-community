<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

<?php // get # of search results found for later use
	$array_counter = $wp_query->found_posts;
?>

	<section id="primary" class="site-content">
		<div id="content" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'twentytwelve' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				<span class="results_header"><?php echo "This search found " . $array_counter . " results."; ?></span>
			</header>

			<?php //twentytwelve_content_nav( 'nav-above' ); ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>

			<?php // twentytwelve_content_nav( 'nav-below' ); ?>
			
			<div class="paging">
			    <?php
			        global $wp_query;
			        $big = 999999999; // need an unlikely integer
			        $args = array(
			            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			            'format' => '?page=%#%',
			            'total' => $wp_query->max_num_pages,
			            'current' => max( 1, get_query_var( 'paged') ),
			            'show_all' => false,
			            'end_size' => 3,
			            'mid_size' => 2,
			            'prev_next' => True,
			            'prev_text' => __('&laquo; Previous'),
			            'next_text' => __('Next &raquo;'),
			            'type' => 'list',
			            );
			    ?>
			    <?php echo paginate_links($args); ?>
			</div>
			<!-- // Paging End -->		



		<?php else : ?>

			<article id="post-0" class="post no-results not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Nothing Found', 'twentytwelve' ); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'twentytwelve' ); ?></p>

						<?php get_search_form(); ?>
					
					<div class="extra-info">
						<h3>Need more help?</h3>
						<p>You can re-try your search by:</p>
						<ul>
							<li>Checking spelling errors</li>
							<li>Using fewer words to start search and filtering down</li>
							<li>Trying alternative words or alternate spellings. For example: if you search for <em>Elderly Housing</em> you may get fewer results, so try <em>Senior Housing</em>.</li>
							<li>Drill down using the <strong><a href="/full-category-list/">Parent Categories</a></strong> on our home page</li>
						</ul>
						<p>If you still do not get results, Community Answers would like to help. Please fill out the <a href="/feedback/"><strong>HELP FORM</strong></a> and we will contact you within 1 business day.</p>
					</div>
										
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

		<?php endif; ?>

		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>