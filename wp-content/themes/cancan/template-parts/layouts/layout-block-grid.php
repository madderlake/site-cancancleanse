<section class="section block-grid <?php the_sub_field('section_class')?>">

	<?php $size = get_sub_field('num_col');
		  $small = $size['phone'];
		  $medium = $size['tablet'];
		  $large = $size['desktop'];
		 ?>
		  <div class="content-wrap <?php echo($section_type !== 'in-grid' ? 'container-fluid' : 'container')?>">
<!-- 		 	<div class="small-12 columns"> -->
			 <?php if (get_sub_field('section_title') ) : ?>
			 	<h2 class="<?php the_sub_field('title_class')?>"><?php the_sub_field('section_title')?></h2>
			 <?php endif;?>

			   <?php get_sub_field('section_content') ? the_sub_field('section_content') : the_sub_field('section_markup');?>
			   	<div class="block-grid-xs-<?php echo $small ?> block-grid-sm-<?php echo $medium ?> block-grid-md-<?php echo $large ?>">
			 				<?php if( have_rows('item') ):
		  // get the number of columns for each size
		  ?>

	    <?php while ( have_rows('item') ) : the_row();

		    $img = get_sub_field('image');
	    ?>


			  <div class="column">
				  <div class="img-wrap">
			    <img <?php echo ar_responsive_image( $img['id'], 'full', '' );?> class="block-img" alt="<?php echo $img['alt']?>">
				  </div>
			  </div>

		<?php endwhile;?>
		 </div>
<!-- 	 </div> -->
</div>
			<?php endif; ?>

</section>
