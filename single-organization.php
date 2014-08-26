<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<header class="entry-header">
					<h1 class="entry-title"><?php the_title(); ?></h1>
		
					<?php 
					if ( function_exists( 'sharing_display' ) ) {
					    echo sharing_display();
					}
					?>		
				</header>

				<div class="entry-content">
					<!-- GET THE CUSTOM FIELDS FOR ORGANIZATION -->
					<div id="tribe-events-event-meta">
						<dl class="column">
		
							<?php if(get_field('acronym')) : ?>
								<dt><?php _e('Acronym:', 'tribe-events-calendar') ?></dt> 
								<dd itemprop="telephone"><?php echo get_field('acronym'); ?></dd>
							<?php endif; ?>
			
							<?php if(get_field('phone')) : ?>
								<dt><?php _e('Phone:', 'tribe-events-calendar') ?></dt> 
								<dd itemprop="telephone"><?php echo get_field('phone'); ?></dd>
							<?php endif; ?>
			
							<?php if ( get_field('fax') ) : ?>
								<dt><?php _e('Fax:', 'tribe-events-calendar') ?></dt>
								<dd itemprop="telephone"><?php echo get_field('fax'); ?></dd>
							<?php endif; ?>
							
							<?php if ( get_field('email') ) : ?>
								<dt><?php _e('Email:', 'tribe-events-calendar') ?></dt>
								<dd itemprop="telephone"><a href="mailto:<?php echo get_field('email');?>"><?php echo get_field('email'); ?></a></dd>
							<?php endif; ?>
				
							<?php if ( get_field('website') ) : ?>
								<dt><?php _e('Website:', 'tribe-events-calendar') ?></dt>
								<dd itemprop="telephone"><a href="<?php echo get_field('website'); ?>" target="_blank"><?php echo get_field('website'); ?></a></dd>
							<?php endif; ?>
			
							<dt><?php _e('Updated:', 'tribe-events-calendar') ?></dt>
							<dd><span class="date updated"><?php echo get_the_modified_date(); ?></span></dd>
		
						</dl>
						
						<dl class="column" itemprop="location" itemscope itemtype="http://schema.org/Place">
												
							<?php if ( get_field('postal_address') ) : ?>
								<dt><?php _e('Postal Address:', 'tribe-events-calendar') ?></dt>
								<dd itemprop="telephone"><?php echo get_field('postal_address'); ?></dd>
							<?php endif; ?>
							
							<?php $physical = trim(get_field('street')) . ' ' . trim(get_field('city')) . ' ' . trim(get_field('province')) . ' ' . trim(get_field('postal_code')); ?>
							
							<?php if ( $physical ) : ?>
								<dt><?php _e('Physical Address:', 'tribe-events-calendar') ?></dt>
								<dd itemprop="address"><?php echo $physical; ?>
								<?php
								$output = str_replace(' ','+',$physical);
								$output2 = 'https://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q=' . $output;
								$output2 = esc_url($output2);
								echo '<a class="gmap" itemprop="maps" href="' . $output2 . '" title="Click to view a Google Map" target="_blank">Google Map</a>';
								?>
								</dd>
								
							<?php endif; ?>
					
							<?php if ( get_field('open_hours') ) : ?>
								<dt><?php _e('Open Hours:', 'tribe-events-calendar') ?></dt>
								<dd itemprop="telephone"><?php echo get_field('open_hours'); ?></dd>
							<?php endif; ?>	
							
							<?php if ( get_field('square_footage') ) : ?>
								<dt><?php _e('Meeting Space:', 'tribe-events-calendar') ?></dt>
								<dd itemprop="telephone"><?php echo get_field('square_footage'); ?></dd>
							<?php endif; ?>
												
						</dl>
					</div>	<!-- .tribe-events-event-meta -->


					<!-- get the contacts for this organization -->
					<?php if ( get_field('contacts_multi') ) : ?>
						<?php $count = 0; ?>
						<div id="tribe-contacts-event-meta">
						<p><strong>Contacts:</strong></p>
						<?php while(the_repeater_field('contacts_multi')) : ?>
													
							<?php $contacts = get_field('contacts_multi'); $count++; ?>
							
							<dl class="column">
							<?php if (get_sub_field('contact_name')) : ?>
								<dt><?php _e('Name:', 'tribe-events-calendar') ?></dt>
								<dd itemprop="telephone"><?php the_sub_field('contact_name'); ?></dd>
							<?php endif; ?>
							
							<?php if (get_sub_field('contact-number')) : ?>
								<dt><?php _e('Phone:', 'tribe-events-calendar') ?></dt>
								<dd itemprop="telephone"><?php the_sub_field('contact-number'); ?></dd>
							<?php endif; ?>
							
							<?php if (get_sub_field('contact-email')) : ?>
								<dt><?php _e('Email:', 'tribe-events-calendar') ?></dt>
								<dd itemprop="telephone"><a href="mailto:<?php the_sub_field('contact-email'); ?>"><?php the_sub_field('contact-email'); ?></a> </dd>
							<?php endif; ?>
							
							<?php if (get_sub_field('contact-position')) : ?>
								<dt><?php _e('Position:', 'tribe-events-calendar') ?></dt>
								<dd itemprop="telephone"><?php the_sub_field('contact-position'); ?></dd>
							<?php endif; ?>
							</dl>
							<?php if ( $count % 2 == 0 ) { ?>
            					<div class="fix"></div>
            				<?php } // End IF Statement ?>
									
						<?php endwhile; ?>
						
						<?php if ( get_field('contacts-name') ) : ?>
							<?php echo get_field('contact-name'); ?>
						<?php endif; ?>
						</div>
					
					<?php endif; ?>	

					<?php /* get_template_part( 'content', get_post_format() );  */?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<header class="entry-header">
							<?php the_post_thumbnail(); ?>
						</header>
						<p><strong>Description:</strong></p>
						<div class="entry-content">
							<?php remove_filter( 'the_content', 'sharing_display',19 ); the_content(); ?>

							<?php if ( get_field('notes') ) : ?>
								<strong><?php _e('Notes:', 'tribe-events-calendar') ?></strong>
								<p><?php echo get_field('notes'); ?></p>
							<?php endif; ?>	
							<?php if ( get_field('programs') ) : ?>
								<strong><?php _e('Programs:', 'tribe-events-calendar') ?></strong>
								<p><?php echo get_field('programs'); ?></p>
							<?php endif; ?>
							<?php if ( get_field('annual_events') ) : ?>
								<strong><?php _e('Annual Events:', 'tribe-events-calendar') ?></strong>
								<p><?php echo get_field('annual_events'); ?></p>
							<?php endif; ?>	
							
							<?php $terms = get_the_terms( get_the_ID(), 'org_category' );?>
								
							<p><strong><?php _e('Categories:', 'tribe-events-calendar') ?></strong>
							<?php echo get_the_term_list( get_the_ID(), 'org_category', '', ', ', '' ); ?></p>
							
							<?php if ( get_the_tags() ) : ?>
								<p><strong><?php _e('Tags:', 'tribe-events-calendar') ?></strong>
								<?php the_tags('',', ',''); ?></p>
							<?php endif; ?>					

						</div><!-- .entry-content -->

					</article><!-- #post -->

				</div><!-- .entry-content -->

				<?php /* comments_template( '', false ); */ ?>

			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>