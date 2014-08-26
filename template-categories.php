<?php
/*
Template Name: Categories
*/
?>
<?php get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				
				<header class="entry-header">
					<h1 class="entry-title"><?php the_title(); ?></h1>
				</header>
				
				<div class="fl list-categories">												  	    
		            <ul>
	    	            <?php wp_list_categories(array('taxonomy' => 'org_category', 'title_li' => '')); ?>	
	        	    </ul>
	        	</div>
								
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
