<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package newsfront
 */

?>


<div class="sidebar">    

    <div class="sidebar-news-block sidebar-news-block--mb20">
        <h3 class="main-head main-head-margin">
            <img class="main-head__icon" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAv0lEQVRIS+2UMQ7CMBAEJ+I9+QwVkMcAEh+B0FBQ8RTeg4SuMArGx9qy0yX1aSa3Xrtj5q+bmc8ikAm3jqgHnlNrS8EAnIETcAiSVoIAXwHH1oIdcAF+4LZF7QZ/4bWCLTB6f157Blnw1AaWozXhAdyckmfDU4I1cAdegDUjlhTBvTOwDu8Tkg1wVZnHW3stiiU2VwxXLZpKbDbZc/UYqXsQJMb5uqEKXFLT8K583pdcuIqohOPOqoiqJYtARvgGCOUlGaNu4fkAAAAASUVORK5CYII=" alt="">
            <a href="/category/actualnie-novosti/">Новости дня</a>
        </h3>
        <div class="sidebar-news-block__inner">
		    <?php
		    $args  = array(
						'posts_per_page'      => 13,
						'ignore_sticky_posts' => 1,
						'cat' => 2275,
						'date_query'          => array(
							'after' => '2 day ago',
						),
						'no_found_rows' => true
					);
		    $query = new WP_Query( $args );

		    // Цикл
		    if ( $query->have_posts() ) {
			    while ( $query->have_posts() ) {
				    $query->the_post();
				    $categories = get_the_terms( get_the_ID() , 'category' );
							if ( ! $categories || is_wp_error( $categories ) ) {
								$categories = array();
							}
							$categories = array_values( $categories );
							?>
                            <div class="sidebar-news">
                                <a href="<?php the_permalink(); ?>" class="sidebar-news__inner">
									<?
									foreach ( array_keys( $categories ) as $key ) {
										$arr = get_object_vars($categories[ $key ]);
										if ($arr['term_id'] == 2948) {
											echo '<img width="16" height="16" src="https://cdn.news-front.info/uploads/lightning.png">';
											break;
										}
									}
									?>
                                    <span class="date-style"><?php the_time( 'H:i' ) ?></span>
									<?php the_title(); ?>
                                </a>
                            </div>
							<?php
			    }
		    } else {
		    }
		    wp_reset_postdata();
		    ?>
        </div>
    </div>
	<div class="sidebar_inner">
	</div>
	
	<?php if ( is_active_sidebar( 'inner_side' ) ) : ?>
    <div class="sidebar_inner">
			<?php dynamic_sidebar( 'inner_side' ); ?>
    </div>
	<?php endif; ?>

</div>

