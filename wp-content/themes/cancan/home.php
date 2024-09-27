<?php
/**
 * The template for displaying the blog with intro content
 *
 * @package cancan
 */

get_header(); ?>
    <main id="main" class="site-main" role="main">
        <div id="primary" class="content-area">

<?php
    global $post;

    $page_for_posts_id = get_option('page_for_posts');

    if ( $page_for_posts_id ) :

        $post = get_page($page_for_posts_id);
        setup_postdata($post);
        ?>

        <div id="post-<?php the_ID(); ?>">
            <header>
            <h1 class="page-title"><?php the_title(); ?></h1>
            </header><!-- .entry-header -->
            <div>
                <?php the_content(); ?>
                <?php edit_post_link('Edit', '', '', $page_for_posts_id); ?>
            </div>
        </div>

        <?php
        rewind_posts();
    endif;

            if ( have_posts() ) :

                get_template_part('loop');

            else :

                get_template_part('content', 'none');

            endif;
            ?>


        </div><!-- #primary -->
        <?php do_action('storefront_sidebar')?>
    </main><!-- #main -->
<?php
get_footer();
