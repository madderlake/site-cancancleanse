<?php
/* Using Bootstrap native slider - could be adapted to any (e.g. Slick Slider)*/


$slider = get_post($id);
$data_options = null;

	$options = get_field('slider_options', $id);
	$options['infinite_loop'] == 'Off' ? $data_options = 'infiniteWrap: false;' : '';
	$options['auto_play'] == 'Carousel' ? $data_options .= 'ride: Carousel;' : '';
	$options['bullets'] == 'On' ? $data_options .= 'bullets: On;' : 'Off';
	//$options['use_animation'] == 'Off' ? $data_options .= 'useMUI: false;' : '';
	$options['timer_delay'] !== '5000' ? $data_options .= 'timerDelay:'.$options['timer_delay'] : '';
	isset($data_options) ? $data_options = 'data-options="'. $data_options . '"' : $data_options = '';

?>

<div id="carouselExampleIndicators" class="carousel slide" role="region" aria-label="{TITLE}" data-ride =<?php echo $options['auto_play']?>>

	<div class="carousel-inner">

    <?php if ( have_rows('slide', $id) ) :
			$counter = 0;
	    	while ( have_rows('slide' , $id) ) : the_row();

				$counter++;
				$type = get_sub_field('type');
				$img = get_sub_field('image');

				?>

				<div class="carousel-item <?php echo $type?> <?php echo($counter == 1 ? ' active ' : $counter )?> ">

				  <?php
					  if($type == 'text' ) :

					  	the_sub_field('slide_content', $id);

					  elseif($type == 'post') :


				   		$postobj = get_sub_field('post', $id);

				   		foreach($postobj as $post) :
					   		setup_postdata($post);
					   		$postcontent = apply_filters('the_content', $post->post_content);
					   		echo $postcontent;
					   		wp_reset_postdata($post);
				   		endforeach;

				   		elseif($type == 'image') :

				   		$url = $img['url'];
				   		$alt = $img['alt'];
				   		//$size = $img['size'];
				   		?>
			          <img class="d-block w-100" src="<?php echo $url?>" alt="<?php echo $alt?>">
			          	<?php if(get_sub_field('caption')) : ?>
					  		<div class="carousel-caption d-none d-md-block"><?php the_sub_field('caption')?></div>
					  	<?php endif; ?>
				</div>
				<?php endif;endwhile;endif ?>
		</div>



       		<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
	   			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
	   			<span class="sr-only">Previous</span>
  			</a>
	        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
  			</a>

  			<?php
		  if($options['bullets'] == 'On'): ?>
			<ol class="carousel-indicators">
					<?php for($i=0;$i< $counter;$i++) { ?>
				    <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i?>" class="<?php echo($i == 0 ? ' active ' : '' )?>"></li>
				    <?php } ?>
			</ol>
	<?php endif; ?>

 </div>


