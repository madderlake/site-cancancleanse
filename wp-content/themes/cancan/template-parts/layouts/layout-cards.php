<section class="section card-layout <?php the_sub_field('section_class')?>">

	<?php $size = get_sub_field('num_col');
		  $small = $size['phone'];
		  $medium = $size['tablet'];
		  $large = $size['desktop'];
	?>
	<div class="content-wrap <?php echo($section_type !== 'in-grid' ? 'container-fluid' : 'container')?>">
			 <?php if (get_sub_field('section_title') ) : ?>
			 	<h2 class="<?php the_sub_field('title_class')?>"><?php the_sub_field('section_title')?></h2>
			 <?php endif;?>

			   <?php get_sub_field('section_content') ? the_sub_field('section_content') : the_sub_field('section_markup');?>
		<div class="row">

			 		<?php if( have_rows('card') ):

				 		while ( have_rows('card') ) : the_row();

				 		$img = get_sub_field('image');
				 		$btn =   get_sub_field('button');
	    			?>
			<div class="col-xs-<?php echo $small ?> col-sm-<?php echo $medium ?> col-md-<?php echo $large ?>">
			  <div class="card">
<!-- 				  <div class="img-wrap"> -->
				  	<img class="card-img-top" <?php echo ar_responsive_image( $img['id'], 'full', '' );?>  alt="<?php echo $img['alt']?>">
<!-- 				  </div> -->
				  <div class="card-body">
					  <h5 class="card-title"><?php the_sub_field('card_title')?></h5>
					  <p class="card-text"><?php the_sub_field('card_content')?></p>
					  <a href="<?php echo $btn['button_link']?>" class="btn <?php echo $btn['button_class']?>"><?php echo $btn['button_text']?></a>
			  	 </div>
			  </div>
			  </div>
		<?php endwhile;endif?>

		 </div>
	</div>
</section>