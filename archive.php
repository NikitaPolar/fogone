<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package newsfront
 */

get_header();
?>

    <h1 class="main-head main-head--big main-head--filter main-head--mb25">
	    <span class="main-head__side-w">
				<?php single_cat_title(''); ?>
	    </span>
        <?php
        $cat_ID = get_query_var('cat');
        ?>
        
    </h1>
    
    <div class="all-news">
		<?php get_sidebar(); ?>
        <div class="all-news__inner">
			<?php if ( have_posts() ) :
				$count_post = 0; ?>
	        <?php do_action('show_beautiful_filters'); ?>
	        <?php do_action('show_beautiful_filters_info'); ?>
				<?php while ( have_posts() ) :
				the_post();
				$count_post ++; 
				$first_4_posts_for_mobile; //первые 4 новости для вывода на мобильных в виде таблицы
				$cur_video_icon = '';
				?>

				<?php if ( $count_post == 1 ) { ?>
				<?php					
					if ( ( $video_thumbnail = get_video_thumbnail() ) != null ) { $cur_video_icon = 'article-link--video'; }
					$first_4_posts_for_mobile .= '<div class="hide_pc article-link '.$cur_video_icon.'">';
					$first_4_posts_for_mobile .= '<a href="'. get_permalink() .'" class="article-link__img">';
					$first_4_posts_for_mobile .= get_the_post_thumbnail('medium');;
					if ( ( $video_thumbnail = get_video_thumbnail() ) != null ) {
					$first_4_posts_for_mobile .= '<span class="video-yt-icon video-yt-icon--big"><svg viewBox="0 0 100 100" class="icon"><use xlink:href="#icon-yt2"></use></svg></span>';
					}
					$first_4_posts_for_mobile .= '</a>';
					$first_4_posts_for_mobile .= '<a href="'.get_permalink().'" class="article-link__title">'.get_the_title().'</a>';
					$first_4_posts_for_mobile .= '<div class="article-link__row"><span class="date-style date-style--dark">'. get_the_time("d.m.Y, H:i").'</span></div>';
					$first_4_posts_for_mobile .= '</div>';
?>
				
				
                <div class="top-news top-news--mb30 top-news--video-hide mobile-hide719">

                <div class="top-news__left">
                    <a class="top-news__main" href="<?php the_permalink(); ?>">
						<?php if ( ( $video_thumbnail = get_video_thumbnail() ) != null ) {
							the_post_thumbnail('medium'); ?>
                            <span class="video-yt-icon video-yt-icon--big">
								<svg viewBox="0 0 100 100" class="icon">
									<use xlink:href="#icon-yt2"></use>
								</svg>
							</span>
							<?php
						} else {
							the_post_thumbnail('medium');
						} ?>
                    </a>
                    <span class="date-style date-style--separator date-style--dark">
							<?php the_time( 'H:i' ); ?>
							<span class="date-style__separator"></span>
						</span>

                    <div class="top-news__main-title" href="<?php the_permalink(); ?>">
                        <div class="top-news__main-title-inner">
                            <a href="<?php the_permalink(); ?>">
								<?php the_title(); ?>
                            </a>
                        </div>
                        <a href="<?php the_permalink(); ?>" class="btn-read">
                            Читать
                            <svg viewBox="0 0 100 100" class="icon">
                                <use xlink:href="#right-arrow"></use>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="top-news__right">                
                <div class="video-list">
			<?php } else if ( $count_post > 1 && $count_post < 5 ) { ?>
					<?php
						if ( ( $video_thumbnail = get_video_thumbnail() ) != null ) { $cur_video_icon = 'article-link--video'; }
						$first_4_posts_for_mobile .= '<div class="hide_pc article-link '.$cur_video_icon.'">';
						$first_4_posts_for_mobile .= '<a href="'. get_permalink() .'" class="article-link__img">';
						$first_4_posts_for_mobile .= get_the_post_thumbnail('medium');;
						if ( ( $video_thumbnail = get_video_thumbnail() ) != null ) {
							$first_4_posts_for_mobile .= '<span class="video-yt-icon video-yt-icon--big"><svg viewBox="0 0 100 100" class="icon"><use xlink:href="#icon-yt2"></use></svg></span>';
						}
						$first_4_posts_for_mobile .= '</a>';
						$first_4_posts_for_mobile .= '<a href="'.get_permalink().'" class="article-link__title">'.get_the_title().'</a>';
						$first_4_posts_for_mobile .= '<div class="article-link__row"><span class="date-style date-style--dark">'. get_the_time("d.m.Y, H:i").'</span></div>';
						$first_4_posts_for_mobile .= '</div>';
					?>
                <div class="video-list__item">
                    <a href="<?php the_permalink(); ?>" class="video-list__img">
						<?php if ( ( $video_thumbnail = get_video_thumbnail() ) != null ) {
							the_post_thumbnail('medium'); ?>
                            <span class="video-yt-icon">
										<svg viewBox="0 0 100 100" class="icon">
											<use xlink:href="#icon-yt"></use>
										</svg>
									</span>
							<?php
						} else {
							the_post_thumbnail('medium');
						} ?>
                    </a>
                    <a href="<?php the_permalink(); ?>" class="video-list__item-title">
						<?php the_title(); ?>
                    </a>
                    <span class="date-style date-style--separator">
									<?php the_time( 'H:i' ); ?>
									<span class="date-style__separator"></span>
								</span>
                    <a href="<?php the_permalink(); ?>" class="btn-read">
                        Читать
                        <svg viewBox="0 0 100 100" class="icon">
                            <use xlink:href="#right-arrow"></use>
                        </svg>
                    </a>
                </div>
			    <?php if ( $count_post == 4) { ?>
                    </div>
                    </div>
                    </div>
                    <div class="articles-list articles-list--mb10 articles-list--mobile-table">
						<?php echo $first_4_posts_for_mobile; ?>
			    <?php } ?>

			<?php } else { ?>
                <div class="article-link <?php if ( ( $video_thumbnail = get_video_thumbnail() ) != null ) { echo 'article-link--video'; } ?>">
                    <a href="<?php the_permalink(); ?>" class="article-link__img">

	                    <?php if ( ( $video_thumbnail = get_video_thumbnail() ) != null ) {
		                    the_post_thumbnail('medium'); ?>
                            <span class="video-yt-icon video-yt-icon--big">
								<svg viewBox="0 0 100 100" class="icon">
									<use xlink:href="#icon-yt2"></use>
								</svg>
							</span>
		                    <?php
	                    } else {
		                    the_post_thumbnail('medium');
	                    } ?>
                    </a>
                    <a href="<?php the_permalink(); ?>" class="article-link__title">
	                    <?php the_title(); ?>
                    </a>
                    <div class="article-link__row">
                        <span class="date-style date-style--dark">
								<?php the_time('d.m.Y, H:i'); ?>
							</span>
                    </div>
                </div>
            <?php } ?>

			<?php
			endwhile;
			else :
			endif;
			?>
                <div class="btn-center">
	                <?php if (is_category()) {
		                $cat = get_category( get_query_var( 'cat' ) );
		                $category = $cat->slug;
		                echo do_shortcode('
                                 [ajax_load_more id="1949621532" container_type="div" post_type="post" pause="true"
                                 category="'.$category.'" posts_per_page="12" offset="16" 
                                 scroll="false" transition_container_classes="articles-list articles-list--mb10 articles-list--mobile-table" button_label="Показать ещё" button_loading_label="Загружаем..."]
                            ');
	                }
	                if (is_tag()) {
		                $tag = get_query_var('tag');
		                echo do_shortcode('
                                 [ajax_load_more id="1949621532" container_type="div" post_type="post" pause="true"
                                 tag="'.$tag.'" posts_per_page="12" offset="16" 
                                 scroll="false" transition_container_classes="articles-list articles-list--mb10 articles-list--mobile-table" button_label="Показать ещё" button_loading_label="Загружаем..."]
                            ');
	                }
	                ?>
                </div>

                    </div>
        </div>
    </div>
<?php
get_footer();
