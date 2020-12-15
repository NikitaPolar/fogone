<div class="slider-news">
				<span class="slider-news__icon">
					<img src="/wp-content/themes/newsfront/img/icon-star.png" alt="">
				</span>
            <div class="slider-news__title">
                Главное
                <div>за сегодня</div>
            </div>
            <div class="slider-news__inner">
                <div class="swiper-container slider-news-container">
                    <div class="swiper-wrapper">
						<?php
						$args  = array(
							'posts_per_page'      => 5,
							'orderby'             => 'meta_value_num',
							'meta_key'            => 'views',
							'ignore_sticky_posts' => true,
							'date_query'          => array(
								'after' => '1 day ago',
							),
						);
						$query = new WP_Query( $args );

						// Цикл
						if ( $query->have_posts() ) {
							while ( $query->have_posts() ) {
								$query->the_post();
								?>
                                <div class="swiper-slide">
                                    <div class="news-slide">
                                        <a href="<?php the_permalink(); ?>" class="news-slide__title">
											<?php the_title(); ?>
                                        </a>
                                        <div class="news-slide__bottom">											
                                            <span class="date-style date-style--dark">
											        <?php the_time( 'H:i' ); ?>
										        </span>
                                        </div>
                                    </div>
                                </div>
								<?php
							}
						} else {
						}
						wp_reset_postdata();
						?>
                    </div>
                </div>
                <div class="slider-btn slider-btn-next slider-news-next"></div>
                <div class="slider-btn slider-btn-prev slider-news-prev"></div>
            </div>
        </div>