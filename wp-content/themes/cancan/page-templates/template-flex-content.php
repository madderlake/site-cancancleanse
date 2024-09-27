<?php

/**
 * The template for displaying flexible content
 *
 * Template Name: Flexible Content
 * Template Post Type: page
 *
 * @package cancan
 */

get_header();
$scripts = get_field('js_file_include');
//print_r($scripts);

//$script_src = $scripts['js_file_url'];
//echo $script_src;



 ?>
    <div class="flex-content w-100 <?php the_field('page_class')?>"  role="main">

            <?php while ( have_posts() ) : the_post();

                $pageTitle = get_field('pageTitle_group');
                $title = $pageTitle['pageTitle'];
                $titleClass = $pageTitle['pageTitle_class'];
             ?>


        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <?php if($title) : ?>
                <section class="section title py-0">
                <div class="container content-wrap">
                    <h1 class="page-title <?php echo $titleClass?>"><?php echo(null !== $title ? $title : the_title())?></h1>
                </div>
                </section>
            <?php endif; ?>
            <?php get_template_part('template-parts/content', 'flexible'); ?>

        </article>
            <?php endwhile; // end of the loop. ?>
    </div><!-- #content -->
<?php
    get_footer();
