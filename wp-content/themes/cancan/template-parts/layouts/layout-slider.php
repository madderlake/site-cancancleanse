<?php
/* Using Bootstrap native slider - could be adapted to any (e.g. Slick Slider)*/


	$slider = get_post($id);
	$slider_g = get_field('slider_group');
							$slider = $slider_g['slider'];
							$slider_class = $slider_g['slider_class'];
							$slider_options = $slider_g['slider_options'];
	$data_options = null;
	$options = $slider_options;

	$options['infinite_loop'] == 'Off' ? $data_options = 'infiniteWrap: false;' : '';
	$options['auto_play'] == 'Carousel' ? $data_options .= 'ride: Carousel;' : 'false';
	$options['bullets'] == 'On' ? $data_options .= 'bullets: On;' : 'Off';
	//$options['use_animation'] == 'Off' ? $data_options .= 'useMUI: false;' : '';
	$options['timer_delay'] !== '5000' ? $data_options .= 'timerDelay:'.$options['timer_delay'] : '';
	isset($data_options) ? $data_options = 'data-options="'. $data_options . '"' : $data_options = '';

	//print_r($slider_options);
?>

<div id="carouselExampleIndicators" class="carousel slide <?php echo(!empty($slider_class) ? $slider_class : 'noclass')?>" role="region" aria-label="{TITLE}" data-ride =<?php echo $options['auto_play']?>>

	<div class="carousel-inner">

    <?php if ( have_rows('slide', $id) ) :
			$counter = 0;


	    	while ( have_rows('slide' , $id) ) : the_row();

			    $counter++;

				$type = get_sub_field('type');

					if($type == 'bg-img') :


					$bgImg = get_sub_field('bg_img');
					$bgUrl = $bgImg['bg_image'];
					$style = "background-image: url('. $bgUrl. ');height:100%";


					endif;


				?>

				<div class="carousel-item <?php echo $type?> <?php echo($counter == 1 ? ' active ' : $counter )?> " <?php echo ($type == 'bg-img' && !empty($style) ? 'style="'. $style .'"' : '');?>>
					<div class="slide-inner d-flex align-items-center">
				       <?php

					   if($type == 'text' ) :

					  	the_sub_field('slide_content', $id);

					    elseif($type == 'post') :

				   		$postobj = get_sub_field('post', $id);

/*
				   		foreach($postobj as $post) :
					   		setup_postdata($post);
					   		$postcontent = apply_filters('the_content', $post->post_content);
					   		echo $postcontent;
					   		wp_reset_postdata($post);
				   		endforeach;
*/
						elseif($type == 'image') :
			   				$img = get_sub_field('img');
			   				$img_id =  $img['image']['id'];
			   				$url = $img['image']['url'];
			   				$alt = $img['image']['alt'];

			   				endif;
				   		?>
			          <img class="w-100" <?php echo ar_responsive_image( $img_id, 'full', '' );?>  alt="<?php echo $alt?>">
<!-- 			          <img src="<?php echo $url?>" alt="<?php echo $alt?>" /> -->
<!--

			          	<?php if(get_sub_field('caption')) : ?>
					  		<div class="carousel-caption d-none d-md-block"><?php the_sub_field('caption')?></div>
					  	<?php endif; ?>
-->
					</div><!-- slide-inner-->
				</div><!--carousel-item-->
				<?php endwhile;endif; ?>
		</div><!--carousel-inner-->

		<?php if($options['prev_next'] == 'true') : ?>


       		<a class="carousel-control-prev <?php echo 'class'?> href="#carouselExampleIndicators" role="button" data-slide="prev">
	   			<span class="icon icon-angle-left" aria-hidden="true"></span>
	   			<span class="sr-only">Previous</span>
  			</a>
	        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
				<span class="icon icon-angle-right" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
  			</a>
  		<?php endif; ?>

  			<?php
		  if($options['bullets'] == 'On'): ?>
			<ol class="carousel-indicators">
					<?php for($i=0;$i< $counter;$i++) { ?>
				    <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i?>" class="<?php echo($i == 0 ? ' active ' : '' )?>"></li>
				    <?php } ?>
			</ol>
	<?php endif; ?>

 </div>


