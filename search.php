<?php get_header(); ?>
	<h2 class="main-head main-head--big main-head--filter main-head--mb25">
		Результаты поиска для: <?php echo get_search_query(); ?>
	</h2>
	<div class="all-news">
		<?php get_sidebar(); ?>
		<div class="all-news__inner">
			<?php if ( have_posts() ) : $count_post = 0; ?>
				<div class="articles-list articles-list--mb10 articles-list--mobile-table">
					<?php //do_action( 'show_beautiful_filters' ); ?>
					<?php //do_action( 'show_beautiful_filters_info' ); ?>
					<?php while ( have_posts() ) : the_post(); $count_post ++; ?>
						<div class="article-link article-link--video <?= $count_post; ?>">
							<a href="<?php the_permalink(); ?>" class="article-link__img">

								<?php if ( ( $video_thumbnail = get_video_thumbnail() ) != null ) {
									the_post_thumbnail( 'medium' ); ?>
									<span class="video-yt-icon video-yt-icon--big">
										<svg viewBox="0 0 100 100" class="icon">
											<use xlink:href="#icon-yt2"></use>
										</svg>
									</span>
									<?php
								} else {
									the_post_thumbnail( 'medium' );
								} ?>
							</a>
							<a href="<?php the_permalink(); ?>" class="article-link__title">
								<?php the_title(); ?>
							</a>
							<div class="article-link__row">
								<?php
								$posttags = get_the_tags();
								if ( $posttags ) { ?>
									<span class="tag">
					                            <?php echo kama_excerpt( array(
						                            'maxchar' => 10,
						                            'text'    => $posttags[0]->name
					                            ) ); ?>
				                            </span>
								<?php } ?>
								<span class="date-style date-style--dark">
										<?php the_time( 'd.m.Y, H:i' ); ?>
									</span>
							</div>
						</div>
					<?php endwhile; ?>
				</div>
			<?php else : ?>
				<p>Извините, результатов не найдено.</p>
			<?php endif; ?>
		</div>
	</div>
<?php get_footer(); ?>