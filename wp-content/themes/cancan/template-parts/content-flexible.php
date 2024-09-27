<?php
/**
 * The default template for displaying ACF Flexible content
 *
 * @package WordPress
 */
?>

<?php if ( have_rows('content') ) : ?>

<?php while ( have_rows('content') ) : the_row(); ?>

<?php if (get_row_layout()  == 'section') :

		$sectionType = get_sub_field('sectionType');
		$bgImgGroup= get_sub_field('section_bg_img_group');
		$bgImg = $bgImgGroup['section_bg_img'];
		$bgImgClasses = $bgImgGroup['bg_img_classes'] . ' bg-image';

?>

      <section class="section <?php echo get_sub_field('section_class') . $bgImgClasses?>"

				  <?php if($bgImg): ?>
	  					style="background-image: url(<?php echo $bgImg?>)"

			      <?php endif;?>

				  <?php if (get_sub_field('section_anchor') ) : ?>
					 id = "<?php the_sub_field('section_anchor') ?>"
					<?php endif; ?>>

			  <div class="content-wrap <?php echo($sectionType !== 'in-grid' ? 'container-fluid' : 'container')?>">

		      <?php if (get_sub_field('section_title') ) : ?>

			  	<h2 class="col-sm-12 <?php the_sub_field('section_title_class');?>"><?php the_sub_field('section_title'); ?></h2>

			  <?php endif;?>

			    <?php if($markUp == true):

				     echo get_sub_field('section_code');
				     	else:
					 echo get_sub_field('section_content');

					 endif; ?>
			  </div>
	    </section>


    <?php endif;?>

	<?php if (get_row_layout() == 'block_grid' ) :?>

			<?php $sectionType = get_sub_field('sectionType'); ?>

<?php // Block Grid ?>

	<?php include(locate_template('template-parts/layouts/layout-block-grid.php'));

		endif; ?>

			<?php if (get_row_layout() == 'card_layout' ) :?>

			<?php $sectionType = get_sub_field('sectionType'); ?>

<?php // Card Layout ?>

	<?php include(locate_template('template-parts/layouts/layout-cards.php'));

		endif; ?>


	<?php if (get_row_layout() == 'tab_set' ) :?>

	<?php $sectionType = get_sub_field('sectionType'); ?>

<?php // Tabs ?>

	<?php include(locate_template('template-parts/layouts/layout-tab-set.php'));

		endif; ?>

		<?php if (get_row_layout() == 'columns' ) :?>

	<?php $sectionType = get_sub_field('sectionType'); ?>
	<?php $sectionClass = get_sub_field('section_classes'); ?>

<?php // Columns ?>

	<?php include(locate_template('template-parts/layouts/layout-columns.php'));

		endif; ?>

<?php endwhile; endif; ?>
