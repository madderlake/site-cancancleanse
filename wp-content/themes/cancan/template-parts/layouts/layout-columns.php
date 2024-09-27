<?php     /*-------------------- Up to Four Column Layout --------------*/?>

<?php //if (get_row_layout() == 'columns') : ?>

<section class="columns <?php echo $sectionClass ?>">
        <?php
                //echo "Section Type: " . $sectionType;

            $container = get_sub_field('container');

            $numCol = get_sub_field('num_columns');

        ?>

        <div class="<?php echo($sectionType == 'in-grid' || $container == true ? ' container col-wrap ' . the_sub_field('col_container_classes') : ' container-fluid col-wrap'. the_sub_field('col_container_classes'))?>">
            <?php if (get_sub_field('section_title') ) : ?>

            <h2 class="col-sm-12 <?php the_sub_field('section_title_class');?>"><?php the_sub_field('section_title'); ?>
            </h2>

            <?php endif;?>

            <?php if (have_rows('col_group')) :

             while(have_rows('col_group')) : the_row();

             if(have_rows('column_1') && $numCol >= 1) :

                 while(have_rows('column_1')) : the_row();

                  if(get_row_layout() == 'content'):

                     $class = get_sub_field('class');
                     $width = get_sub_field('width');
                     $mobile = $width['mobile'];
                     $tablet = $width['tablet'];
                     $desktop = $width['desktop'];

        	?>


            <div
                class="col-<?php echo $mobile;?> col-sm-<?php echo $tablet?> col-md-<?php echo $desktop?> <?php echo(!empty($class) ? $class : '')?> ">

                <?php
                    if(get_sub_field('content')):

                        the_sub_field('content');

                    endif;
                ?>
            </div>



            <?php 	 endif;
                         endwhile;
                              endif;
        	?>

            <?php

                 if(have_rows('column_2') && $numCol >= 2) :

                 while(have_rows('column_2')) : the_row();

                  if(get_row_layout() == 'content'):

                     $class = get_sub_field('class');
                     $width = get_sub_field('width');
                     $mobile = $width['mobile'];
                     $tablet = $width['tablet'];
                     $desktop = $width['desktop'];

            ?>
            <div
                class="col col-<?php echo $mobile;?> col-sm-<?php echo $tablet?> col-md-<?php echo $desktop?> <?php echo(!empty($class) ? $class : '')?> ">

                <?php
                    if(get_sub_field('content')):

                        the_sub_field('content');

                    endif;
                ?>
            </div>



                  <?php endif;
                 endwhile;
                 endif;?>



            <?php

                if(have_rows('column_3') && $numCol >= 3) :

                 while(have_rows('column_3')) : the_row();

                  if(get_row_layout() == 'content'):

                     $class = get_sub_field('class');
                     $width = get_sub_field('width');
                     $mobile = $width['mobile'];
                     $tablet = $width['tablet'];
                     $desktop = $width['desktop'];

            ?>


            <div
                class="col  col-<?php echo $mobile;?> col-sm-<?php echo $tablet?> col-md-<?php echo $desktop?> <?php echo(!empty($class) ? $class : '')?> ">

                <?php
                    if(get_sub_field('content')):

                        the_sub_field('content');

                    endif;
                ?>
            </div>



                  <?php endif;
                 endwhile;
                endif;?>


            <?php

                if(have_rows('column_4') && $numCol >= 4) :

                 while(have_rows('column_4')) : the_row();

                  if(get_row_layout() == 'content'):

                     $class = get_sub_field('class');
                     $width = get_sub_field('width');
                     $mobile = $width['mobile'];
                     $tablet = $width['tablet'];
                     $desktop = $width['desktop'];

            ?>


            <div
                class="col col-<?php echo $mobile;?> col-sm-<?php echo $tablet?> col-md-<?php echo $desktop?> <?php echo(!empty($class) ? $class : '')?> ">

                <?php
                    // if(get_sub_field('content')):

                        the_sub_field('content');

                    //endif;
                ?>
            </div>



                  <?php endif;
                 endwhile;
                endif;?>
             <?php endwhile;
            endif;?>

        </div>
</section>

<?php //endif;
