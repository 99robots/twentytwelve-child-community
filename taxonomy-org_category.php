<?php
/**
 * The template for displaying Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Twenty Twelve already
 * has tag.php for Tag archives, category.php for Category archives, and
 * author.php for Author archives.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>
	


	<div class="more-listings">
			
		<?php if ( have_posts() ) : ?>

			<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<div id="breadcrumb"><p>','</p></div>'); } ?>

			<!-- %% 	Get the taxonomy name, rss feed link 	%% -->
			<?php 
				// Global query variable
				global $wp_query; 
				// Get taxonomy query object
				$taxonomy_archive_query_obj = $wp_query->get_queried_object();
				// Taxonomy term name
				$taxonomy_term_nice_name = $taxonomy_archive_query_obj->name;
				// Taxonomy term id
				$term_id = $taxonomy_archive_query_obj->term_id;
				// Get taxonomy object
				$taxonomy_short_name = $taxonomy_archive_query_obj->taxonomy;
				$taxonomy_raw_obj = get_taxonomy($taxonomy_short_name);
				// You can alternate between these labels: name, singular_name
				$taxonomy_full_name = $taxonomy_raw_obj->labels->name;
			?>
			
            <span class="catheader">
            	<span class="fl cattitle"><h1 class="archive-title">Organizations | <?php echo $taxonomy_term_nice_name;?></h1></span>
            	<span class="fr catrss"><a href="<?php echo get_term_feed_link( $term_id, $taxonomy_short_name, ''); ?>"><?php _e("RSS feed for this section", "woothemes"); ?></a></span>
            </span>

			<!-- %%	Display Child Categories on Parent Taxonomy Archive Page  (i.e., org_category)
			Reference1: http://codex.wordpress.org/Template_Tags/wp_list_categories 
			Reference2: http://www.wpbeginner.com/wp-tutorials/how-to-display-child-taxonomy-on-parent-taxonomys-archive-page/ -->
	
			<?php 
				$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 
				if ($term->parent == 0) {  ?>
				<div class="col-full" id="cat-search">
					<div class="search_module">
						<div class="search_title"><h3>Filter your selection further:</h3></div>	
						<ul>
							<?php wp_list_categories('taxonomy=org_category&depth=1&show_count=1&title_li=&child_of=' . $term->term_id); ?>
						</ul>
					</div>
				</div>
			<?php } else { ?>
				<div class="col-full" id="cat-search">
					<div class="search_module">
						<div class="search_title"><h3>Filter your selection further:</h3></div>	
						<ul>
							<?php wp_list_categories('taxonomy=org_category&depth=1&show_count=1&title_li=&child_of=' . $term->parent); ?>
						</ul>
					</div>
				</div>
			<?php 	} ?>


<!--
			<header class="archive-header">
				<h1 class="archive-title"><?php
					if ( is_day() ) :
						printf( __( 'Daily Archives: %s', 'twentytwelve' ), '<span>' . get_the_date() . '</span>' );
					elseif ( is_month() ) :
						printf( __( 'Monthly Archives: %s', 'twentytwelve' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'twentytwelve' ) ) . '</span>' );
					elseif ( is_year() ) :
						printf( __( 'Yearly Archives: %s', 'twentytwelve' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'twentytwelve' ) ) . '</span>' );
					else :
						_e( 'Archives', 'twentytwelve' );
					endif;
				?></h1>
			</header>
-->	<!-- .archive-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();?>

				<div class="block">                                
	                <h2 class="cufon"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>       		
	        		<p><?php the_excerpt(); ?></p>        		
	        		<span class="more"><a href="<?php the_permalink(); ?>">More Info</a></span>       	
	            </div>

			<?php endwhile; ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

	</div><!-- .more-listings -->


	<!-- Paging Start -->
	<!-- Reference: http://codex.wordpress.org/Function_Reference/paginate_links
	http://www.codeproject.com/Articles/541717/wordpress-numbered-page-navigation-without-any-plu  -->
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


<?php get_footer(); ?>