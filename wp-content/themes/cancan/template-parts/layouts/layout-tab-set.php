
<section class="section tabset <?php echo the_sub_field('tabset_class')?>">
	<div class="content-wrap <?php echo($section_type !== 'in-grid' ? 'container-fluid' : 'container')?>">

		 	<ul id="tabs" class="nav nav-tabs" role="tablist">
			 	<?php $i = 0;
			 	    while ( have_rows('tab') ) : the_row();
			 			if(get_sub_field('active')) :?>
			 		<?php
				 		$i++;
				 		if($i == 1){
					 		$active = 'active';
					 	}else{
						 	$active = '';
					 	}

				?>
			<li class="nav-item">
				<a href="#pane-<?php echo $i?>" class="nav-link <?php echo $active?>"  rel="#collapse-<?php echo $i?>" data-toggle="tab" role="tab" ><?php the_sub_field('tab_title'); ?></a></li>

			 <?php endif;endwhile;?>
		 	</ul>

      <div id="tab-accordion" class="tab-content <?php the_sub_field('tab_class')?>">

	      <?php $i = 0;
		        while ( have_rows('tab') ) : the_row();

		  			if(get_sub_field('active')) :

		      			$i++;
				 		if($i == 1){
					 		$active = 'active';
					 		$show = 'show';
					 	}else{
						 	$active = '';
						 	$show = '';
					 	}
			?>

			<div id="pane-<?php echo $i?>" class="card tab-pane fade show <?php echo $active?>"  role="tab-panel">

				<div class="card-header" role="tab" id="heading-<?php echo $i?>">
					 	 <h3 class="mb-0">
						 	 <a class="collapsed" data-toggle="collapse" href="#collapse-<?php echo $i?>" data-target="#collapse-<?php echo $i?>" rel="#pane-<?php echo $i?>">
							 	 <?php the_sub_field('tab_title')?></a>
						 </h3>
				</div>

				<div id="collapse-<?php echo $i?>" class="collapse <?php echo $show?>">
					<div class="card-body">
	  				 <?php wpautop(the_sub_field('tab_content'));?>
					</div>
				</div>
			</div>

<?php endif;endwhile;?>

		</div>
	</div>

</section>
