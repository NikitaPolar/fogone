<?php
/*
Template Name: Эксперты
*/
?>
<?php
get_header();
?>
    <h2 class="main-head main-head--big main-head--mb25">
        Мнения экспертов
    </h2>

    <div class="all-news">
	    <?php get_sidebar(); ?>
        <div class="all-news__inner">
            <div class="experts">
	            <?php
	            if( have_rows('experts') ):
		            while ( have_rows('experts') ) : the_row(); ?>

                        <div class="expert">
                            <div class="expert__img">
                                <?php
                                    $image = get_sub_field('experts_foto');
                                    $size = 'full'; // (thumbnail, medium, large, full or custom size)
                                    if( $image ) {
                                        echo wp_get_attachment_image( $image, $size );
                                    }
                                ?>
                            </div>
                            <div class="expert__title">
                                <?php the_sub_field('ex_name'); ?>
                            </div>
                            <div class="expert__date">
							<span class="date-style date-style--separator date-style--s12">
								<?php the_sub_field('ex_data'); ?>
								<span class="date-style__separator"></span>
							</span>
                            </div>
                            <div class="expert__text">
	                            <?php the_sub_field('ex_cit'); ?>
                            </div>
                        </div>
                    <?php
		            endwhile;
	            else :
	            endif;
	            ?>
            </div>
        </div>
    </div>


<?php
get_footer();
