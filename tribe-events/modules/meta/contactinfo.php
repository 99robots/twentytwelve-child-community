<?php
/**
 * Single Event Meta (Details) Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe-events/modules/meta/details.php
 *
 * @package TribeEventsCalendar
 */
?>

<div class="tribe-events-meta-group tribe-events-meta-group-details">
	<h3 class="tribe-events-single-section-title"> <?php _e('Contact Info', 'tribe-events-calendar' ) ?> </h3>
	<dl>

		<?php if ( get_field('telephone') ) : ?>
			<dt><?php _e('Phone:', 'tribe-events-calendar') ?></dt>
			<dd itemprop="telephone"><?php echo get_field('telephone'); ?></dd>
		<?php endif; ?>

		<?php if ( get_field('fax') ) : ?>
			<dt><?php _e('Fax:', 'tribe-events-calendar') ?></dt>
			<dd itemprop="telephone"><?php echo get_field('fax'); ?></dd>
		<?php endif; ?>

		<?php if ( get_field('email_address') ) : ?>
			<dt><?php _e('Email:', 'tribe-events-calendar') ?></dt>
			<dd itemprop="telephone"><?php echo '<a href="mailto:' . get_field('email_address') . '">' . get_field('email_address') . '</a>'; ?></dd>
		<?php endif; ?>

		<?php if ( get_field('web_address') ) : ?>
			<dt><?php _e('Event Information:', 'tribe-events-calendar') ?></dt>
			<dd itemprop="telephone"><a href="<?php echo get_field('web_address'); ?> " target="_blank"><?php echo get_field('web_address'); ?></a></dd>
		<?php endif; ?>

		<?php if (get_field('registered_sponsors') || get_field('unregistered_sponsors')) : ?>
			<dt><?php _e('Sponsors:', 'tribe-events-calendar') ?></dt>
			<?php if (get_field('registered_sponsors')) : ?>
				<?php $sponsors = explode(",", get_field('registered_sponsors')); ?>
				<?php foreach($sponsors as $sponsor):
					$post_object = get_post($sponsor); ?>
		    		<dd><a href="<?php echo get_permalink($post_object->ID); ?>"><?php echo get_the_title($post_object->ID) ?></a></dd>
				<?php endforeach; ?>
				<div class="fix"></div>
			<?php endif; ?>
			<?php if (get_field('unregistered_sponsors')) : ?>
				<dd><?php echo get_field('unregistered_sponsors'); ?></dd>
			<?php endif; ?>
		<?php endif; ?>

		<?php do_action( 'tribe_events_single_meta_details_section_end' ) ?>
	</dl>
</div>