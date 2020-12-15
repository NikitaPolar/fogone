<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package newsfront
 */

get_header();
?>
<?php
		while ( have_posts() ) :
			the_post(); ?>
    <h2 class="main-head main-head--big main-head--mb25">
        <?php the_title(); ?>
    </h2>

    <div class="all-news">
	    <?php get_sidebar(); ?>
        <div class="all-news__inner">
            <div class="about">
                <?php the_content(); ?>
            </div>
        </div>
    </div>

<?php endwhile; ?>



<?php
get_footer();
