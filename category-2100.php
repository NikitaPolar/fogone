<?php
get_header();
?>
    <h2 class="main-head main-head--big main-head--filter main-head--mb25">
			<span class="main-head__side-w">
			            Видео новости
			                  </span>

    </h2>

    <div class="all-news">
		<?php get_sidebar(); ?>
        <div class="all-news__inner">
            <div class="top-news top-news--mb30 top-news--video-hide">
				<?php
				$args  = array(
					'posts_per_page' => 1,
					'cat'            => 2100,
				);
				$query = new WP_Query( $args );

				// Цикл
				if ( $query->have_posts() ) {
					while ( $query->have_posts() ) {
						$query->the_post();
						?>
                        <div class="top-news__left">
                            <a class="top-news__main" href="<?php the_permalink(); ?>">
							<img src="<?php //video_thumbnail(); 

$image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail' ); 
echo $image[0];
?>" alt="">
                                <span class="video-yt-icon video-yt-icon--big">
									<svg viewBox="0 0 100 100" class="icon">
										<use xlink:href="#icon-yt2"></use>
									</svg>
								</span>
                            </a>
                            <span class="date-style date-style--separator date-style--dark">
								<?php the_time( 'H:i' ) ?>
								<span class="date-style__separator"></span>
							</span>

                            <div class="top-news__main-title" href="#">
                                <div class="top-news__main-title-inner">
                                    <a href="<?php the_permalink(); ?>">
										<?php the_title(); ?>
                                    </a>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="btn-read">
                                    Смотреть
                                    <svg viewBox="0 0 100 100" class="icon">
                                        <use xlink:href="#right-arrow"></use>
                                    </svg>
                                </a>
                            </div>
                        </div>
						<?php
					}
				} else {
				}
				wp_reset_postdata();
				?>
                <div class="top-news__right">
                    <h2 class="main-head main-head--mb15">
                        <img class="main-head__icon" src="/wp-content/themes/newsfront/img/icon-yt.png" alt="">
                        Видеоновости
                    </h2>
                    <div class="video-list">
						<?php
						$args  = array(
							'posts_per_page' => 3,
							'cat'            => 2100,
							'offset'         => 1
						);
						$query = new WP_Query( $args );

						// Цикл
						if ( $query->have_posts() ) {
							while ( $query->have_posts() ) {
								$query->the_post();
								?>
                                <div class="video-list__item">
                                    <a href="<?php the_permalink(); ?>" class="video-list__img">
										<img src="<?php //video_thumbnail(); 

										$image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail' ); 
										echo $image[0];
										?>" alt="">
                                        <span class="video-yt-icon">
												<svg viewBox="0 0 100 100" class="icon">
													<use xlink:href="#icon-yt"></use>
												</svg>
											</span>
                                    </a>
                                    <a href="<?php the_permalink(); ?>" class="video-list__item-title">
										<?php the_title(); ?>
                                    </a>
                                    <span class="date-style date-style--separator">
											Сегодня <?php the_time( 'H:i' ) ?>
											<span class="date-style__separator"></span>
										</span>
                                    <a href="<?php the_permalink(); ?>" class="btn-read">
                                        Смотреть
                                        <svg viewBox="0 0 100 100" class="icon">
                                            <use xlink:href="#right-arrow"></use>
                                        </svg>
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
            </div>

            <div class="articles-list articles-list--mb10">
				<?php
				$count = 0;
				if (wp_is_mobile()) {
					$args  = array(
						'posts_per_page' => 6,
						'cat'            => 2100,
						'offset'         => 1
					);
				} else {
					$args  = array(
						'posts_per_page' => 12,
						'cat'            => 2100,
						'offset'         => 4
					);
				}
				$query = new WP_Query( $args );

				// Цикл
				if ( $query->have_posts() ) {
					while ( $query->have_posts() ) {
						$query->the_post();
						$count++;
						?>
                        <div class="article-link <?php if ($count == 15) { echo 'last_video_in_row'; } ?>">
                            <a href="<?php the_permalink(); ?>" class="article-link__img">
							<img src="<?php //video_thumbnail(); 

								$image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail' ); 
								echo $image[0];
								?>" alt="">
                                <span class="video-yt-icon video-yt-icon--big">
								<svg viewBox="0 0 100 100" class="icon">
									<use xlink:href="#icon-yt2"></use>
								</svg>
							</span>
                            </a>
                            <a href="<?php the_permalink(); ?>" class="article-link__title">
								<?php the_title(); ?>
                            </a>
                            <div class="article-link__row">
                                <span class="date-style date-style--dark"><?php the_time( 'd.m.Y H:i' ); ?></span>
                            </div>
                        </div>
						<?php
					}
				} else {
				}
				wp_reset_postdata();
				?>				
                
            </div>
			<div class="btn-center">
					<form action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="filter_video">
                   		<button class="btn btn--center btn-load-more" rel="next">Показать ещё</button>
						<input type="hidden" name="action" value="myfilter_video">
						<input type="hidden" name="offset" value="16">
					</form>
					<script>
					jQuery(function($){
						$('#filter_video .btn-load-more').click(function(){
							var filter = $('#filter_video');
							$.ajax({
								url:filter.attr('action'),
								data:filter.serialize(), // form data
								type:filter.attr('method'), // POST
								beforeSend:function(xhr){
									filter.find('button').text('Загружаем...'); // changing the button label
									let prev_val_offset = parseInt($('input[name=offset]').val(), 10);
									let next_val_offset = prev_val_offset + 12;
									filter.find('input[name=offset]').val(next_val_offset);
								},
								success:function(data){
									filter.find('button').text('Показать ещё'); // changing the button label back
									$('.articles-list .article-link:last-child').after(data); // insert data
								}
							});
							return false;
						});
					});
					</script>
                </div>
        </div>
    </div>
<?php
get_footer();