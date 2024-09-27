<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package StrapPress
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="post-thumbnail">
			<?php the_post_thumbnail('full', array('class' => 'rounded')); ?>
		</div><!--  .post-thumbnail -->
	<?php endif; ?>
<!--
<section>
	<header class="entry-header container">
		<h1 class="entry-title <?php echo get_field('title_classes') ?>"><?php the_title()?></h1>
	</header><!-- .entry-header -->
<!--</section>
-->
<section>
	<div class="entry-content container">

		<?php
			the_content();

/*
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'cstudio' ),
				'after'  => '</div>',
			) );
*/
		?>
	</div><!-- .entry-content -->
</section>

	<?php if ( get_edit_post_link() ) : ?>
<!--
		<footer class="entry-footer">
			<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'cstudio' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer>
--><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-## -->
