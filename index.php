<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package newsfront
 */

get_header();
?>

    <!--<div class="main-banner">
    </div>
	<div id="content_rb_119478" class="content_rb" data-id="119478"></div>
	<script>
		window.noAdBlock = false;
	</script>
	<script src="https://news-front.info/wp-content/themes/newsfront/js/ads.js"></script>
	<script>
		if (!noAdBlock) { 
			var link = document.getElementById('content_rb_119478');
				link.style.display = 'none';
		}
	</script>-->
    <div class="main-content">




	
	<script>
	const defaultOptions = {};
	//defaultOptions.autoplay = true;
	defaultOptions.muted = true;
	defaultOptions.autopause = true;
	defaultOptions.displayDuration = false;
	defaultOptions.debug = true;
	defaultOptions.clickToPlay = true;
	defaultOptions.controls = ['play','volume','fullscreen'];
	
	function initplayer() {
		if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|BB|PlayBook|IEMobile|Windows Phone|Kindle|Silk|Opera Mini/i.test(navigator.userAgent)) {
			return 1;
		}

		const video = document.querySelector("video");
		const source = video.getElementsByTagName("source")[0].src;

		if (Hls.isSupported()) {
			const hls = new Hls();
			hls.loadSource(source);
			hls.on(Hls.Events.MANIFEST_PARSED, function (event, data) {
				const availableQualities = hls.levels.map((l) => l.height)
				// Add new qualities to option
				defaultOptions.quality = {
					default: availableQualities[0],
					options: availableQualities,
					// this ensures Plyr to use Hls to update quality level
					forced: true,
					onChange: (e) => updateQuality(e)
				}
				const player = new Plyr(video, defaultOptions);
				window.player = player;

				player.on('ready', event => {
				console.log('---');
				console.log(event.detail.plyr);
				//window.player.play();
				//window.player.volume=0;
			});
				});
			hls.attachMedia(video);
			window.hls = hls;

			
		} else {
		    const player = new Plyr(video, defaultOptions);
			window.player = player;

			player.on('ready', event => {
			console.log('---');
			console.log(event.detail.plyr);
			//window.player.play();
			//window.player.volume=0;
		});
		}
		function updateQuality(newQuality) {
			window.hls.levels.forEach((level, levelIndex) => {
			if (level.height === newQuality) {
				console.log("Found quality match with " + newQuality);
				window.hls.currentLevel = levelIndex;
			}
			});
		}
		jQuery('#vesos').css('display','block');

		
	}
	initplayer();
	
	</script>
        <div class="sidebar sidebar--f-l">
		<div id="vesos" style="width: 100%;padding-bottom: 10px;display:none">
		<div style="
    POSITION: ABSOLUTE;
    background: #d21703;
    z-index: 999;
    top: 5px;
    left: 5px;
    padding: 5px;
    font-weight: 800;
    color: white;
">Прямой эфир</div>

			<video>
			<source 
				type="application/x-mpegURL" 
				src="https://tv.news-front.info/stream/index.m3u8"
			>
			</video>
		</div>
            <div class="sidebar-news-block sidebar-news-block--h1835 ">
                <h3 class="main-head main-head-margin">
                    <img class="main-head__icon" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAv0lEQVRIS+2UMQ7CMBAEJ+I9+QwVkMcAEh+B0FBQ8RTeg4SuMArGx9qy0yX1aSa3Xrtj5q+bmc8ikAm3jqgHnlNrS8EAnIETcAiSVoIAXwHH1oIdcAF+4LZF7QZ/4bWCLTB6f157Blnw1AaWozXhAdyckmfDU4I1cAdegDUjlhTBvTOwDu8Tkg1wVZnHW3stiiU2VwxXLZpKbDbZc/UYqXsQJMb5uqEKXFLT8K583pdcuIqohOPOqoiqJYtARvgGCOUlGaNu4fkAAAAASUVORK5CYII=" alt="">
                    <a href="/category/actualnie-novosti/">Новости дня</a>
                </h3>
                <div class="sidebar-news-block__inner">
					<?php
					$args  = array(
						'posts_per_page'      => 15,
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
        </div>
        <div class="top-news top-news--order top-news--only-video">
			<?php
			$args  = array(
				'posts_per_page' => 1,
				'cat'            => 2100,
				'no_found_rows' => true
			);
			$query = new WP_Query( $args );

			// Цикл
			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();
					?>
                    <div class="top-news__left">
                        <a class="top-news__main" href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail('medium'); ?>
							<?php if ( !has_post_thumbnail() ) : ?>
								<img src="https://cdn.news-front.info/uploads/zag.jpg">
							<?php endif; ?>
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

                        <div style="font-size:24pt;font-weight:600;text-align: center;" href="#">
							<a href="<?php the_permalink(); ?>">
								<?php the_title(); ?>
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
                    <a href="https://news-front.info/category/video/">Видеоновости</a>
                </h2>

                <div class="swiper-container swiper-video">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="video-list">
								<?php
									if (wp_is_mobile()) {
								$args  = array(
									'posts_per_page' => 3,
									'cat'            => 2100,
									'offset'         => 0,
									'no_found_rows' => true
								);
							} else {
								$args  = array(
									'posts_per_page' => 3,
									'cat'            => 2100,
									'offset'         => 1,
									'no_found_rows' => true
								);
							}
								$query = new WP_Query( $args );
								// Цикл
								$it = 0;
								$ik = 0;
								$icori = 80;
								if ( $query->have_posts() ) {
									while ( $query->have_posts() ) {
										$query->the_post();
										?>
										<div class="video-list__item" style="position:relative;" >
										<?
										$ik += 60;
										echo '<img id="cubbee" style="filter: hue-rotate('.$ik.'deg);pointer-events: none;vertical-align: top;max-width: 100%;width: 65px;opacity: 0.13;z-index: 1000;position: absolute;right: 5px;bottom:5px" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pjxzdmcgdmlld0JveD0iMCAwIDI0IDI0IiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPjx0aXRsZS8+PHBhdGggZD0iTTE2LDEyYTEsMSwwLDAsMS0uNS44N2wtNyw0QTEsMSwwLDAsMSw4LDE3YTEsMSwwLDAsMS0uNS0uMTNBMSwxLDAsMCwxLDcsMTZWOGExLDEsMCwwLDEsLjUtLjg3LDEsMSwwLDAsMSwxLDBsNyw0QTEsMSwwLDAsMSwxNiwxMloiIGZpbGw9IiM0NjQ2NDYiLz48cGF0aCBkPSJNMjEsOUgxN2ExLDEsMCwwLDEsMC0yaDRhMSwxLDAsMCwxLDAsMloiIGZpbGw9IiM0NjQ2NDYiLz48cGF0aCBkPSJNMjEsMTdIMTdhMSwxLDAsMCwxLDAtMmg0YTEsMSwwLDAsMSwwLDJaIiBmaWxsPSIjNDY0NjQ2Ii8+PHBhdGggZD0iTTIxLDVIM0ExLDEsMCwwLDEsMywzSDIxYTEsMSwwLDAsMSwwLDJaIiBmaWxsPSIjNDY0NjQ2Ii8+PHBhdGggZD0iTTIxLDIxSDNhMSwxLDAsMCwxLDAtMkgyMWExLDEsMCwwLDEsMCwyWiIgZmlsbD0iIzQ2NDY0NiIvPjxjaXJjbGUgY3g9IjMiIGN5PSI4IiBmaWxsPSIjNDY0NjQ2IiByPSIxIi8+PGNpcmNsZSBjeD0iMyIgY3k9IjEyIiBmaWxsPSIjNDY0NjQ2IiByPSIxIi8+PGNpcmNsZSBjeD0iMyIgY3k9IjE2IiBmaWxsPSIjNDY0NjQ2IiByPSIxIi8+PHBhdGggZD0iTTIxLDEzSDE5YTEsMSwwLDAsMSwwLTJoMmExLDEsMCwwLDEsMCwyWiIgZmlsbD0iIzQ2NDY0NiIvPjwvc3ZnPg==">';
										?>
										<a href="<?php the_permalink(); ?>" class="video-list__img">
												<?php the_post_thumbnail( 'medium' ); ?>
												<?php if ( !has_post_thumbnail() ) : ?>
													<img style="width:100%;background: wheat;" src="data:image/png;base64,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">
												<?php endif; ?>
                                            </a>
                                            <a href="<?php the_permalink(); ?>" class="video-list__item-title">
												<?php the_title(); ?>
											</a>
											
											<span class="date-style date-style--separator" style="background: #eceff1;color: #000;padding: 5px;position: absolute;top: 5px;left: 5px;border-radius: 5px;">
												<?php the_time( 'H:i' ) ?>
											</span>

                                        </div>
										<?php
									}
								} else {
								}
								wp_reset_postdata();
								?>

								<style>
									.arrow-circle {
    color: #337AB7;
    cursor: pointer;
    text-decoration: none;
    font-size: 18px;
    height: 18px;
    line-height: 18px;
    display: inline-block;
    margin: 20px;
}
.arrow-circle .arrow-circle-icon {
    position: relative;
    top: -1px;
    transition: transform 0.3s ease;
    vertical-align: middle;
}
.arrow-circle .arrow-circle-iconcircle {
    transition: stroke-dashoffset .3s ease;
    stroke-dasharray: 95;
    stroke-dashoffset: 95;
}
.arrow-circle:hover .arrow-circle-icon {
    transform: translate3d(5px, 0, 0);
}
.arrow-circle:hover .arrow-circle-iconcircle {
    stroke-dashoffset: 0;
}
								</style>
<div style="text-align:center;">
	<a class="arrow-circle" href="/category/video/">Смотреть все видеоновости
			<svg class="arrow-circle-icon" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
				<g fill="none" stroke="#337AB7" stroke-width="1.5" stroke-linejoin="round" stroke-miterlimit="10">
					<circle class="arrow-circle-iconcircle" cx="16" cy="16" r="15.12"></circle>
					<path class="arrow-circle-icon--arrow" d="M16.14 9.93L22.21 16l-6.07 6.07M8.23 16h13.98"></path>
				</g>
			</svg>
		</a>
	</div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="video-list">
								<?php
								$args  = array(
									'posts_per_page' => 3,
									'cat'            => 2100,
									'offset'         => 4,
									'no_found_rows' => true
								);
								$query = new WP_Query( $args );

								// Цикл
								if ( $query->have_posts() ) {
									while ( $query->have_posts() ) {
										$query->the_post();
										?>
                                        <div class="video-list__item">
                                            <a href="<?php the_permalink(); ?>" class="video-list__img">
                                                <?php the_post_thumbnail('medium'); ?>
                                            </a>
                                            <a href="<?php the_permalink(); ?>" class="video-list__item-title">
												<?php the_title(); ?>
                                            </a>
                                            <span class="date-style date-style--separator">
                                                    <?php the_time( 'H:i' ) ?>
                                                    <span class="date-style__separator"></span>
                                                </span>
                                            <a href="<?php the_permalink(); ?>" class="btn-read">
                                                Читать
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
                                <div class="video-list__all btn-read-all">
                                    <a href="/category/video/">
                                        Смотреть все видео новости
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="video-list">
								<?php
								$args  = array(
									'posts_per_page' => 3,
									'cat'            => 2100,
									'offset'         => 7,
									'no_found_rows' => true
								);
								$query = new WP_Query( $args );

								// Цикл
								if ( $query->have_posts() ) {
									while ( $query->have_posts() ) {
										$query->the_post();
										?>
                                        <div class="video-list__item">
                                            <a href="<?php the_permalink(); ?>" class="video-list__img">
                                                <?php the_post_thumbnail('medium'); ?>
                                            </a>
                                            <a href="<?php the_permalink(); ?>" class="video-list__item-title">
												<?php the_title(); ?>
                                            </a>
                                            <span class="date-style date-style--separator">
                                                    <?php the_time( 'H:i' ) ?>
                                                    <span class="date-style__separator"></span>
                                                </span>
                                            <a href="<?php the_permalink(); ?>" class="btn-read">
                                                Читать
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
                                <div class="video-list__all btn-read-all">
                                    <a href="/category/video/">
                                        Смотреть все видео новости
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Add Pagination -->
                    <div class="swiper-pagination"></div>
                </div>


            </div>
        </div>

        <div class="article-mostread article-mostread--order">
            <div class="articles">
                <h2 class="main-head main-head--mb15">
                    <img class="main-head__icon" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAgElEQVRIS2NkoDFgpLH5DHSzwJ2BgWEOAwODDJV89ISBgSGFgYFhJ8wHj6loOMyNIEtkYRb8h4oSE2QwtcR4lpHuFhDjKlLUYPiAFM3EqKV/ENE8konxNilq6B8HpLiOGLWjPiAYSsMoiGheXNO8wiEYW+QqIKbsIddssD6aWwAAnA0cGcDs1osAAAAASUVORK5CYII=" alt="">
                    <a href="/category/articles/">Статьи</a>
                </h2>

                <div class="swiper-container swiper-4article">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="articles-list articles-list--column-2">
								<?php
								$args          = array(
									'posts_per_page' => 6,
									'cat'            => 9,
									'no_found_rows' => true
								);
								$query         = new WP_Query( $args );
								$article_count = 0;

								// Цикл
								if ( $query->have_posts() ) {
									while ( $query->have_posts() ) {
										$query->the_post();
										$article_count ++;
										?>
                                        <div class="article-link">
                                            <a href="<?php the_permalink(); ?>" class="article-link__img">
												<?php if ( ( $video_thumbnail = get_video_thumbnail() ) != null ) {
													the_post_thumbnail('medium');
												} else {
													the_post_thumbnail('medium');
												} ?>
                                                    <span class="tag tag--green">Статья</span>
                                            </a>
                                            <div class="article-link__row">
                                                <span class="date-style date-style--dark">
                                                        <?php the_time( 'd.m.Y H:i' ); ?>
                                                    </span>
                                            </div>
                                            <a href="<?php the_permalink(); ?>" class="article-link__title">
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
                        <div class="swiper-slide">
                            <div class="articles-list articles-list--column-2">
								<?php
								$args          = array(
									'posts_per_page' => 4,
									'cat'            => 9,
									'offset'         => 4,
									'no_found_rows' => true
								);
								$query         = new WP_Query( $args );
								$article_count = 0;

								// Цикл
								if ( $query->have_posts() ) {
									while ( $query->have_posts() ) {
										$query->the_post();
										$article_count ++;
										?>
                                        <div class="article-link">
                                            <a href="<?php the_permalink(); ?>" class="article-link__img">
												<?php if ( ( $video_thumbnail = get_video_thumbnail() ) != null ) {
													the_post_thumbnail('medium');
												} else {
													the_post_thumbnail('medium');
												} ?>
                                                <span class="tag tag--green">Статья</span>
                                            </a>
                                            <div class="article-link__row">
                                                <span class="date-style date-style--dark">
                                                        <?php the_time( 'd.m.Y H:i' ); ?>
                                                    </span>
                                            </div>
                                            <a href="<?php the_permalink(); ?>" class="article-link__title">
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
                        <div class="swiper-slide">
                            <div class="articles-list articles-list--column-2">
								<?php
								$args          = array(
									'posts_per_page' => 4,
									'cat'            => 9,
									'offset'         => 8,
									'no_found_rows' => true
								);
								$query         = new WP_Query( $args );
								$article_count = 0;

								// Цикл
								if ( $query->have_posts() ) {
									while ( $query->have_posts() ) {
										$query->the_post();
										$article_count ++;
										?>
                                        <div class="article-link">
                                            <a href="<?php the_permalink(); ?>" class="article-link__img">
												<?php if ( ( $video_thumbnail = get_video_thumbnail() ) != null ) {
													the_post_thumbnail('medium');
												} else {
													the_post_thumbnail('medium');
												} ?>
                                                <span class="tag tag--green">Статья</span>
                                            </a>
                                            <div class="article-link__row">
                                                <span class="date-style date-style--dark">
                                                        <?php the_time( 'd.m.Y H:i' ); ?>
                                                    </span>
                                            </div>
                                            <a href="<?php the_permalink(); ?>" class="article-link__title">
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
                    </div>
                    <!-- Add Pagination -->
                    <!--<div class="swiper-pagination"></div>-->
                </div>
				<style>
					.afternewsbutton {
						padding-bottom: 10px;
					}
					@media screen and (max-width: 550px) {
						.afternewsbutton {
							#margin-top: -80px;
							padding-bottom: 0px;
						}
						.actual-news {
							margin-bottom: 0px;
						}
					}
				</style>
				<div style="text-align:center">
					<a class="arrow-circle" href="/category/articles/">Все статьи
						<svg class="arrow-circle-icon" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
							<g fill="none" stroke="#337AB7" stroke-width="1.5" stroke-linejoin="round" stroke-miterlimit="10">
								<circle class="arrow-circle-iconcircle" cx="16" cy="16" r="15.12"></circle>
								<path class="arrow-circle-icon--arrow" d="M16.14 9.93L22.21 16l-6.07 6.07M8.23 16h13.98"></path>
							</g>
						</svg>
					</a>
				</div>
                <!--<div class="btn-read-all afternewsbutton">
                    <a href="/category/articles/" style="width:100%;background: #f3f5f7;padding: 10px;border: 1px solid #cfd8dc;text-decoration: none;z-index: 999;position: relative;">
                        Показать ещё
                    </a>
                </div>-->


            </div>
            <div class="sidebar sidebar--mostread">
                <h3 class="main-head main-head--mb15">
                    <img class="main-head__icon" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAB20lEQVRIS7WVO0udQRCGnxOIlUHSSBQiKEhSpEu0tbEzEEVRYvAHiFUkGlAEC228lfkBgUQUr4hVKluVVAElhZAUKjaBaGVQ5JVZWdbdb3OKs7B8hzOz8+zOzL5bosKjVOH45ABVQKfNV0CdbegE2Ac2bF6mNloE6AZmgKbMKY+AUWA15hcDPADmgPdlpm/eQNf+uhhgoSD4LtymtSUBnzXInTkEKC0rBTsfMMDnAh/FWHN2H6CCHgKNicVnwFMD/AZqE36qyXPgn+w+oBdYKtjZFDBhdv0eL/DtA5ZDwFfgrS36A5wC2rWb04DaU6MeGLNT6CSaT4DHZlesdyHgJ9BsDt+AHuDvf3ZSjdWu3fwV61kIOAeqvYA/gA5A+S4aDcA28MJzugAe5QCyKyWvge8Jwktgy7vhzi0K8FPkx9sDWhMA2SQh4YimyC+yv+ATMJQAyDYYsUWLnGrTfmDRgrTZd8e+sn2JAKJtqot2EBE3Xa4rQFrj2lg7/AA8BH4FgORFk18oFccWeNJ1hRdMLaz/R4IiJ6XCrS0Su9y1yIqdAkiu5TicixbYJfEfgaxcu3XlPDhK052C+uDck6kidgFvrN+lQRqqjZ7MTWDdKWfsxDlAmVm6715xwA172FkZRHEddwAAAABJRU5ErkJggg==" alt="">
                    <a href="/category/vazhno/">Самое читаемое</a>
                </h3>


                <div class="sidebar-news-block">
                    <div class="sidebar-news-block__inner">
						<?php
						$args  = array(
							'posts_per_page'      => 3,
							'orderby'             => 'meta_value_num',
							'meta_key'            => 'views',
							'ignore_sticky_posts' => true,
							'date_query'          => array(
								'after' => '24 hour ago',
							),
							'no_found_rows' => true
						);
						$query = new WP_Query( $args );

						// Цикл
						if ( $query->have_posts() ) {
							while ( $query->have_posts() ) {
								$query->the_post();
								?>
                                <div class="sidebar-news">
                                    <a href="<?php the_permalink(); ?>" class="sidebar-news__inner">
										<?php the_title(); ?>
                                    </a>
                                    <div class="sidebar-news__row">									
                                        <span class="date-style"><?php the_time( 'd.m.Y H:i' ); ?></span>
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
				<h3 class="main-head main-head--mb15 actual-news-head" style="margin-top: 25px;">
				<img class="main-head__icon" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAoElEQVRIS+2VbQuAIAyET/rbvfe7ozhQCEO3aUFF+5JY3eOOcTrcXO5mfTwCMAHYAIwl3UodzAA6L8z1YIXkAAuANhLkXm+BpAA8aTh54wVX/ySEtqlKsogi9J+l+fYE1fz0XYCqsxqLfoA45pdZlCK9E2COEM2YxhYdEza8SyZtCYCiDLuQqlwn74pSACFBNHsR1QDEOS6OYJVyTcZbADt+KB8Z1Ws4ogAAAABJRU5ErkJggg==" alt="">
				<a href="/category/vazhno/">Партнёры</a>
				</h3>
				<div id="unit_97289" style="background: #f3f5f7;border: 1px solid #cfd8dc;" ><a href="https://smi2.net/" >Новости СМИ2</a></div>
					<script type="text/javascript" charset="utf-8">
					(function() {
						var sc = document.createElement('script'); sc.type = 'text/javascript'; sc.async = true;
						sc.src = '//smi2.ru/data/js/97289.js'; sc.charset = 'utf\u002D8';
						var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(sc, s);
					}());
					</script>
            </div>
        </div>     
		<style>
		.news-row {
			border: 1px solid #d4d4d4;
			border-top-style: none;
			border-right-style: solid;
			border-bottom-style: solid;
			border-left-style: solid;
		}
		.tableborder {
			border: 1px solid #d4d4d4 !important;
			border-top-style: none !important;
			border-right-style: solid !important;
			border-bottom-style: solid !important;
			border-left-style: solid !important;
		}
		.news-row:first-child {
			border-top-style: solid;
		}
		</style>
		<div class="actual-news actual-news--order hide_pc">
            <div class="actual-news-btns">
                <a href="/category/actualnie-novosti/" class="actual-news-btn active">Новости</a>                
            </div>
            
            <div class="table-list">
				<?php
				$args  = array(
					'posts_per_page' => 8,
					'cat'            => 2275
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
                        <div class="news-row">
                            <div class="news-row__icon">
								<?php
									$light = '';
									foreach ( array_keys( $categories ) as $key ) {
										$arr = get_object_vars($categories[ $key ]);
										if ($arr['term_id'] == 2948) {
											$light = '<img width="16" height="16" src="https://cdn.news-front.info/uploads/lightning.png">';
											break;
										}
									}
								
									if ($light != '') {
										echo $light;
									} elseif ( ( $video_thumbnail = get_video_thumbnail() ) != null ) {
										echo '<img src="/wp-content/themes/newsfront/img/icon-video.png" alt="">';
									} else {
										echo '<img src="/wp-content/themes/newsfront/img/icon-document2.png" alt="">';
									}
								?>
                            </div>
                            <div class="news-row__content">
                                <a href="<?php the_permalink(); ?>">
									<?php the_title(); ?>
                                </a>
                                <div class="news-row__bottom">
                                    <span class="date-style date-style--s12"><?php the_time( 'd.m.Y, H:i' ); ?></span>
                                </div>
                            </div>
                        </div>
						<?php
					}
				} else {
				}
				wp_reset_postdata();
				?>
				<div class="btn-center">
					<?php
		                echo do_shortcode('
                                 [ajax_load_more id="1949621532" container_type="div" post_type="post" pause="true"
                                 category="actualnie-novosti" posts_per_page="8" offset="8" 
                                 scroll="false" transition_container_classes="articles-list articles-list--mb10 articles-list--mobile-table" button_label="Показать ещё" button_loading_label="Загружаем..."]
                            ');
	                	                
	                ?>
                </div>
            </div>
			
        </div>
		<?php if ( is_active_sidebar( 'home_side' ) ) : ?>
            <div class="sidebar sidebar--banner sidebar--f-r">
				<?php dynamic_sidebar( 'home_side' ); ?>
            </div>
		<?php endif; ?>

	    <?php if (1) : ?>
			<h3 class="main-head main-head--mb15 actual-news-head">
	            <img class="main-head__icon" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAbElEQVRIS+2UQQ6AIAwEh2/In/St+if9hl41sSyk6UFTrjQdmC0UglcJ7s9/AWeHugocqs5S1ANYgC0SYPV+HNpzgwSo+Mz9zECqG1L0NsYzsDYwbsAE7JEA6eheoF6y+ztPgMzD7VgRvg+4AD8bFRnXy7q4AAAAAElFTkSuQmCC" alt="">
	            <a href="/category/vazhno/">Важно</a>
	        </h3>
			<div class="actual-news actual-news--order">
	            <div class="actual-news-btns">
					<a href="/category/vazhno/" class="actual-news-btn active">Важно</a>
	            </div>


	            <div class="articles-list articles-list--mb10 articles-list--column-2 articles-list--mobile-line mobile-order-4">
				<?php
				$args  = array(
					'posts_per_page' => 2,
					'cat'            => 2948,
					'no_found_rows' => true
				);
				$query = new WP_Query( $args );

				// Цикл
				if ( $query->have_posts() ) {
					while ( $query->have_posts() ) {
						$query->the_post();
						?>
	                    <div class="article-link article-link-2-col">
	                        <a href="<?php the_permalink(); ?>" class="article-link__img">
								<?php if ( ( $video_thumbnail = get_video_thumbnail() ) != null ) {
									the_post_thumbnail('medium');
								} else {
									the_post_thumbnail('medium');
								} ?>
								<span class="tag tag--red">Важно</span>
	                        </a>
	                        <a href="<?php the_permalink(); ?>" class="article-link__title">
								<?php the_title(); ?>
	                        </a>
	                        <div class="article-link__row">
	                            <span class="date-style date-style--dark">
	                                    <?php the_time( 'd.m.Y H:i' ); ?>
							        </span>
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
		<?php endif; ?>

		<?
		
		
			$babli = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAABuElEQVRIS73VOa9OURTG8d+VGAoKOlRuIlQaCtEraBBxTQ2CnsRQGTrzByDXUCDE2JD4AhoKFVHQ0VFQGBLkkfXenLzeew8373GS0+w1/Pfea+1njej4G+k4vzbALGysfxUW1obe4xke1P9tso1OBdiMMxhtOeUbHMbdQX6DADNwDgcq4CXmYAme8PvUa/EWX7G8/M4X6EcTNAhwoZJ/qYBreIfZWFGAF4h9MXbjdNnPVswEox+Qa7mDn9iOW9iLS7W+pSLjE9/YxrED18uW9Xs9QhOQgr6qqziBk+X0FKuxHo9rbR0eIbY1tRb/Y0hNcm3fs94EjNWOh9G5W3G7H3CjrmUYgOTa2Q94jaVIvz8vyj5cxBXs6SNfrgLvrxrFvLLeR3It6wd8wlwswMdKdgSn8Ed31Bs5hKPVRQmZjw/4jHn/HdD5FXVe5M7bNA8tuhNxm85DS8zxqR5aij5dqdiGm21S0WvzptilTa+2iN2uatMobqvYBRK5juPBIkafoqRtch2Jz4Za5bp3kn8ZOHlwEwraNg+a9pnYhA0lIYvKmPmQkfkQ93vK+bcTbRhiN+nAGWryJPsFCr96GaN5BocAAAAASUVORK5CYII=';
		
		?>		


        <h2 class="main-head main-head--mb15 mobile-order-4" style="clear: left">
            <img class="main-head__icon" src="<?= $babli ?>" alt="">
            <a href="/category/dnr-lnr/">ДНР и ЛНР</a>
        </h2>
        <div class="articles-list articles-list--mb10 articles-list--mobile-line mobile-order-4">
			<?php
			$args  = array(
				'posts_per_page' => 6,
				'cat'            => 2,
			);
			$query = new WP_Query( $args );

			// Цикл
			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();
					?>
                    <div class="article-link">
                        <a href="<?php the_permalink(); ?>" class="article-link__img">
							<?php if ( ( $video_thumbnail = get_video_thumbnail() ) != null ) {
								the_post_thumbnail('medium');
							} else {
								the_post_thumbnail('medium');
							} ?>
                        </a>
                        <a href="<?php the_permalink(); ?>" class="article-link__title">
							<?php the_title(); ?>
                        </a>
                        <div class="article-link__row">
                            <span class="date-style date-style--dark">
                                    <?php the_time( 'd.m.Y H:i' ); ?>
						        </span>
                        </div>
                    </div>
					<?php
				}
			} else {
			}
			wp_reset_postdata();
			?>
        </div>


        <h2 class="main-head main-head--mb15 mobile-order-5">
		<img class="main-head__icon" src="<?= $babli ?>" alt="">
            <a href="/category/news/world/">Мир</a>
        </h2>
        <div class="articles-list articles-list--mb10 articles-list--mobile-line mobile-order-5">
			<?php
			$args  = array(
				'posts_per_page' => 6,
				'cat'            => 11,
				'no_found_rows' => true
			);
			$query = new WP_Query( $args );

			// Цикл
			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();
					?>
                    <div class="article-link">
                        <a href="<?php the_permalink(); ?>" class="article-link__img">
							<?php if ( ( $video_thumbnail = get_video_thumbnail() ) != null ) {
								the_post_thumbnail('medium');
							} else {
								the_post_thumbnail('medium');
							} ?>
                        </a>
                        <a href="<?php the_permalink(); ?>" class="article-link__title">
							<?php the_title(); ?>
                        </a>
                        <div class="article-link__row">
                            <span class="date-style date-style--dark">
							<?php the_time( 'd.m.Y H:i' ); ?>
						</span>
                        </div>
                    </div>
					<?php
				}
			} else {
			}
			wp_reset_postdata();
			?>
        </div>

        <h2 class="main-head main-head--mb15 mobile-order-5">
		<img class="main-head__icon" src="<?= $babli ?>" alt="">
            <a href="/category/news/russia/">Россия</a>
        </h2>
        <div class="articles-list articles-list--mb10 articles-list--mobile-line mobile-order-5">
		    <?php
		    $args  = array(
			    'posts_per_page' => 6,
			    'cat'            => 3,
				'no_found_rows' => true
		    );
		    $query = new WP_Query( $args );

		    // Цикл
		    if ( $query->have_posts() ) {
			    while ( $query->have_posts() ) {
				    $query->the_post();
				    ?>
                    <div class="article-link">
                        <a href="<?php the_permalink(); ?>" class="article-link__img">
						    <?php if ( ( $video_thumbnail = get_video_thumbnail() ) != null ) {
							    the_post_thumbnail('medium');
						    } else {
							    the_post_thumbnail('medium');
						    } ?>
                        </a>
                        <a href="<?php the_permalink(); ?>" class="article-link__title">
						    <?php the_title(); ?>
                        </a>
                        <div class="article-link__row">
                            <span class="date-style date-style--dark">
							<?php the_time( 'd.m.Y H:i' ); ?>
						</span>
                        </div>
                    </div>
				    <?php
			    }
		    } else {
		    }
		    wp_reset_postdata();
		    ?>
        </div>
        <h2 class="main-head main-head--mb15 mobile-order-5">
		<img class="main-head__icon" src="<?= $babli ?>" alt="">
            <a href="/category/news/ukraine/">Украина</a>
        </h2>
        <div class="articles-list articles-list--mb10 articles-list--mobile-line mobile-order-5">
		    <?php
		    $args  = array(
			    'posts_per_page' => 6,
			    'cat'            => 4,
				'no_found_rows' => true
		    );
		    $query = new WP_Query( $args );

		    // Цикл
		    if ( $query->have_posts() ) {
			    while ( $query->have_posts() ) {
				    $query->the_post();
				    ?>
                    <div class="article-link">
                        <a href="<?php the_permalink(); ?>" class="article-link__img">
						    <?php if ( ( $video_thumbnail = get_video_thumbnail() ) != null ) {
							    the_post_thumbnail('medium');
						    } else {
							    the_post_thumbnail('medium');
						    } ?>
                        </a>
                        <a href="<?php the_permalink(); ?>" class="article-link__title">
						    <?php the_title(); ?>
                        </a>
                        <div class="article-link__row">
                            <span class="date-style date-style--dark">
							<?php the_time( 'd.m.Y H:i' ); ?>
						</span>
                        </div>
                    </div>
				    <?php
			    }
		    } else {
		    }
		    wp_reset_postdata();
		    ?>
        </div>
        <h2 class="main-head main-head--mb15 mobile-order-5">
		<img class="main-head__icon" src="<?= $babli ?>" alt="">
            <a href="/category/balkany/">Балканы</a>
        </h2>
        <div class="articles-list articles-list--mb10 articles-list--mobile-line mobile-order-5">
		    <?php
		    $args  = array(
			    'posts_per_page' => 6,
			    'cat'            => 15200,
				'no_found_rows' => true
		    );
		    $query = new WP_Query( $args );

		    // Цикл
		    if ( $query->have_posts() ) {
			    while ( $query->have_posts() ) {
				    $query->the_post();
				    ?>
                    <div class="article-link">
                        <a href="<?php the_permalink(); ?>" class="article-link__img">
						    <?php if ( ( $video_thumbnail = get_video_thumbnail() ) != null ) {
							    the_post_thumbnail('medium');
						    } else {
							    the_post_thumbnail('medium');
						    } ?>
                        </a>
                        <a href="<?php the_permalink(); ?>" class="article-link__title">
						    <?php the_title(); ?>
                        </a>
                        <div class="article-link__row">
                            <span class="date-style date-style--dark">
							<?php the_time( 'd.m.Y H:i' ); ?>
						</span>
                        </div>
                    </div>
				    <?php
			    }
		    } else {
		    }
		    wp_reset_postdata();
		    ?>
        </div>
        <h2 class="main-head main-head--mb15 mobile-order-5">
		<img class="main-head__icon" src="<?= $babli ?>" alt="">
            <a href="/category/moldaviya/">Молдавия</a>
        </h2>
        <div class="articles-list articles-list--mb10 articles-list--mobile-line mobile-order-5">
		    <?php
		    $args  = array(
			    'posts_per_page' => 6,
			    'cat'            => 56999,
				'no_found_rows' => true
		    );
		    $query = new WP_Query( $args );

		    // Цикл
		    if ( $query->have_posts() ) {
			    while ( $query->have_posts() ) {
				    $query->the_post();
				    ?>
                    <div class="article-link">
                        <a href="<?php the_permalink(); ?>" class="article-link__img">
						    <?php if ( ( $video_thumbnail = get_video_thumbnail() ) != null ) {
							    the_post_thumbnail('medium');
						    } else {
							    the_post_thumbnail('medium');
						    } ?>
                        </a>
                        <a href="<?php the_permalink(); ?>" class="article-link__title">
						    <?php the_title(); ?>
                        </a>
                        <div class="article-link__row">
                            <span class="date-style date-style--dark">
							<?php the_time( 'd.m.Y H:i' ); ?>
						</span>
                        </div>
                    </div>
				    <?php
			    }
		    } else {
		    }
		    wp_reset_postdata();
		    ?>
        </div>
        <h2 class="main-head main-head--mb15 mobile-order-5">
		<img class="main-head__icon" src="<?= $babli ?>" alt="">
            <a href="/category/belorussiya/">Белоруссия</a>
        </h2>
        <div class="articles-list articles-list--mb10 articles-list--mobile-line mobile-order-5">
		    <?php
		    $args  = array(
			    'posts_per_page' => 6,
			    'cat'            => 105212,
				'no_found_rows' => true
		    );
		    $query = new WP_Query( $args );

		    // Цикл
		    if ( $query->have_posts() ) {
			    while ( $query->have_posts() ) {
				    $query->the_post();
				    ?>
                    <div class="article-link">
                        <a href="<?php the_permalink(); ?>" class="article-link__img">
						    <?php if ( ( $video_thumbnail = get_video_thumbnail() ) != null ) {
							    the_post_thumbnail('medium');
						    } else {
							    the_post_thumbnail('medium');
						    } ?>
                        </a>
                        <a href="<?php the_permalink(); ?>" class="article-link__title">
						    <?php the_title(); ?>
                        </a>
                        <div class="article-link__row">
                            <span class="date-style date-style--dark">
							<?php the_time( 'd.m.Y H:i' ); ?>
						</span>
                        </div>
                    </div>
				    <?php
			    }
		    } else {
		    }
		    wp_reset_postdata();
		    ?>
        </div>
        <h2 class="main-head main-head--mb15 mobile-order-5">
		<img class="main-head__icon" src="<?= $babli ?>" alt="">
            <a href="/category/central-asia/">Центральная Азия </a>
        </h2>
        <div class="articles-list articles-list--mb10 articles-list--mobile-line mobile-order-5">
		    <?php
		    $args  = array(
			    'posts_per_page' => 6,
			    'cat'            => 106766,
				'no_found_rows' => true
		    );
		    $query = new WP_Query( $args );

		    // Цикл
		    if ( $query->have_posts() ) {
			    while ( $query->have_posts() ) {
				    $query->the_post();
				    ?>
                    <div class="article-link">
                        <a href="<?php the_permalink(); ?>" class="article-link__img">
						    <?php if ( ( $video_thumbnail = get_video_thumbnail() ) != null ) {
							    the_post_thumbnail('medium');
						    } else {
							    the_post_thumbnail('medium');
						    } ?>
                        </a>
                        <a href="<?php the_permalink(); ?>" class="article-link__title">
						    <?php the_title(); ?>
                        </a>
                        <div class="article-link__row">
                            <span class="date-style date-style--dark">
							<?php the_time( 'd.m.Y H:i' ); ?>
						</span>
                        </div>
                    </div>
				    <?php
			    }
		    } else {
		    }
		    wp_reset_postdata();
		    ?>
        </div>

        <?php
        $main_blocks = get_field( 'main_blocks', 'option' );
        if ( $main_blocks['eksperty'] == 1 ) { ?>
        <h2 class="main-head main-head--mb15 mobile-order-6">
            <img class="main-head__icon" src="/wp-content/themes/newsfront/img/icon-briefcase.png" alt="">
            Мнения экспертов
        </h2>
        <div class="expert-list mobile-order-6">
	        <?php
	        $args  = array(
		        'page_id'  => 591732
	        );
	        $query = new WP_Query( $args );

	        // Цикл
	        if ( $query->have_posts() ) {
		        $i = 0;
		        while ( $query->have_posts() ) {
			        $query->the_post();
			        ?>
				        <?php
				        if( have_rows('experts') ):
					        while ( have_rows('experts') ) : the_row(); ?>
						        <?php $i++; ?>
						        <?php if( $i > 4 ): ?>
							        <?php break; ?>
		                        <?php endif; ?>

                                <div class="expert">
                                    <div class="expert__img">
								        <?php
								        $image = get_sub_field('experts_foto');
								        $size = 'medium'; // (thumbnail, medium, large, full or custom size)
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
			        <?php
		        }
	        } else {
	        }
	        wp_reset_postdata();
	        ?>
        </div>
        <?php } ?>
    </div>

<?php
get_footer();
