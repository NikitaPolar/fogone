<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package newsfront
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

    <head itemscope itemtype="https://schema.org/WebSite">
        <meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="yandex-verification" content="74c25ce8a116f1fe" />
	<meta name="wpscanio-1687" content="mc6yAXcwCjohxr9yb2-jyr1ZJeHmyPvs" />
	<meta name='wmail-verification' content='1072dc0ff79f077457a0aa1f4210a10a' />
	<meta name="google-site-verification" content="yjHbnzlPT6kyib1wN1ikD1NQ0f1fJOMs3obcw-th-sY" />
    <link rel="shortcut icon" href="https://cdn.news-front.info/themes/news-front/images/favicon.png" type="image/x-icon">
    <link rel="apple-touch-icon" href="https://cdn.news-front.info/themes/news-front/images/favicon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="https://cdn.news-front.info/themes/news-front/images/favicon.png">
    <link rel="apple-touch-icon" sizes="114x114" href="https://cdn.news-front.info/themes/news-front/images/favicon.png">
    <link rel="alternate" hreflang="ru" href="https://news-front.info/" />
    <link rel="alternate" hreflang="bg" href="https://bgr.news-front.info/" />
    <link rel="alternate" hreflang="de" href="https://de.news-front.info/" />
    <link rel="alternate" hreflang="en" href="https://en.news-front.info/" />
    <link rel="alternate" hreflang="es" href="https://es.news-front.info/" />
    <link rel="alternate" hreflang="fr" href="https://fr.news-front.info/" />
    <link rel="alternate" hreflang="sr" href="https://srb.news-front.info/" />
	<link rel="alternate" hreflang="hu" href="https://hu.news-front.info/" />
	<link rel="alternate" hreflang="ge" href="https://ge.news-front.info/" />
	<script charset="UTF-8" src="//cdn.sendpulse.com/js/push/14f8970082921712907c3259adf803f9_1.js" async></script>

	<script async src="https://news-front.info/tear_v1.js?v=33"></script>

	<script src="https://cdn.jsdelivr.net/npm/hls.js"></script>
	<script src="https://unpkg.com/plyr@3"></script>
	<script src="https://releases.flowplayer.org/7.2.4/flowplayer.min.js"></script>
	<script src="https://releases.flowplayer.org/hlsjs/flowplayer.hlsjs.min.js"></script>

	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<link rel="stylesheet" href="https://unpkg.com/plyr@3/dist/plyr.css">

	


	<!-- Global site tag (gtag.js) - Google Analytics -->
	<!-- hypercomments-3gs0ZnLkpE4dKVwE -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-99990201-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-99990201-3');
</script>
	<?php if(is_front_page()) { // if(is_page(13)) { ?>
		<meta property="og:title" content="Новостной Фронт. Новости ДНР, ЛНР, Мира и Украины. "/>
		<meta property="og:description" content="Последние новости ЛНР, ДНР, Украины, Сербии, России и Сирии. Фронтовые новости. Репортаж с линии фронта. Видео. Аналитика. Интервью. Новости сегодня."/>
		<meta property="og:image" content="https://news-front.info/wp-content/themes/newsfront/img/biglogo.png" />
		<meta property="og:url" content="https://news-front.info/" />
	<?php } else { ?>
	<?
		$my_postid = get_the_ID();//This is page id or post id
		$content_post = get_post($my_postid);
		$content = $content_post->post_content;
		preg_match_all('/\/embed\/(.*)" width/', $content, $output_array);
		if (isset($output_array[1][0])) {
			echo '<meta property="og:image" content="'.'https://i3.ytimg.com/vi/'.$output_array[1][0].'/maxresdefault.jpg'.'" />'."\n";
			echo '<meta property="og:image:type" content="image/jpeg" />';
			echo '<meta property="og:image:width" content="600" />'."\n";
			echo '<meta property="og:image:height" content="300" />'."\n";
			echo '<meta property="og:image:secure_url" content="'.'https://i3.ytimg.com/vi/'.$output_array[1][0].'/maxresdefault.jpg'.'" />'."\n";
			echo '<meta name="twitter:image" content="'.$output_array[1][0].'" />';
		} else {
			preg_match_all('/<img.*src="(.*?)"/', $content, $output_array);
			if (isset($output_array[1][0])) {
				echo '<meta property="og:image" content="'.$output_array[1][0].'" />'."\n";
				echo '<meta property="og:image:type" content="image/jpeg" />';
				echo '<meta property="og:image:width" content="600" />'."\n";
				echo '<meta property="og:image:height" content="300" />'."\n";
				echo '<meta property="og:image:secure_url" content="'.$output_array[1][0].'" />'."\n";
				echo '<meta name="twitter:image" content="'.$output_array[1][0].'" />';
			} else {
				if (has_post_thumbnail($my_postid)) {
					$image = wp_get_attachment_image_src( get_post_thumbnail_id($my_postid), 'single-post-thumbnail' ); 
					echo '<meta property="og:image" content="'.$image[0].'" />'."\n";
					echo '<meta property="og:image:type" content="image/jpeg" />';
					echo '<meta property="og:image:width" content="600" />'."\n";
					echo '<meta property="og:image:height" content="300" />'."\n";
					echo '<meta property="og:image:secure_url" content="'.$image[0].'" />'."\n";
					echo '<meta name="twitter:image" content="'.$image[0].'" />';
				}
			}
		}
	?>
	<? } ?>
	<script src="https://cdn.jsdelivr.net/npm/js-cookie@2.2.1/src/js.cookie.js"></script>




	<?php if(is_page(267863)) { ?>
	
			<meta property="og:title" content="News Front TV [Test]"/>
		<meta property="og:description" content="Телеканал NewsFrontTV — новый проект нашей команды!"/>
		<meta property="og:image" content="https://cdn.news-front.info/themes/news-front/images/fcvjhdsadcsd21.jpg" />
		
		    
	<?php } ?>	
		<?php wp_head(); ?>
		<script type="text/javascript">
      jQuery('document').ready(function () {
        jQuery("body").on('click','.upPage',function(){
          $("html, body").animate({ scrollTop: 0 }, 600);
        });
      });
	</script>
    </head>

<body <?php body_class(); ?>>
<?php $cur_type = 2; ?>
	<script>
	jQuery('document').ready(function () {
		window.addEventListener('scroll', function() {
		  if (document.querySelector('.header__middle').getBoundingClientRect().bottom < 0) {
			$('.header__bottom').css('position','fixed');
			$('.header__bottom').css('top','0px');
			$('.header__bottom').css('width','100%');
			$('.header__bottom').css('z-index','9999');
		  } else {
			$('.header__bottom').css('position','static');
		  }
		});
		
		window.addEventListener('DOMContentLoaded', (event) => {
			var heigg = document.querySelector('.video-list').offsetHeight;
			document.querySelector('.swiper-container').setAttribute('style','height: '+heigg+'px !important');
		});

		$( ".top-news__main" ).mouseenter(function() {
			$( ".video-yt-icon--big .icon" ).css('opacity','1')
		});
		$( ".top-news__main" ).mouseout(function() {
			$( ".video-yt-icon--big .icon" ).css('opacity','0.37')

		});

		/*diffse = ($('.article-link.article-link-2-col').position().top + $('.article-link.article-link-2-col').height()) - 
		($('.sidebar-news-block.sidebar-news-block--h1835').position().top + $('.sidebar-news-block.sidebar-news-block--h1835').height());
		console.log(diffse);
		if (diffse > 25) {
			let k = diffse/10;

			var kk = 0;
			jQuery.fn.reverse = [].reverse;
			$('.sidebar-news + .sidebar-news').reverse().each(function(i,elem) {
				kk++;
				console.log('fix1');
				if (kk >= k) {
					return false;
				}
				$(this).css('padding-top','+=6.5');
			});
		}*/
	});
	</script>
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="header__top-inner">
                    <ul class="language">
	                    <?php
	                    if ( have_rows( 'multiyazychnost', 'option' ) ):
		                    $lang_count = 0;
		                    while ( have_rows( 'multiyazychnost', 'option' ) ) : the_row();
			                    $image = get_sub_field('flag');
			                    $size = 'full';
			                    $lang_count ++ ?>
			                    <?php if ( $lang_count == 1 ) { ?>
			                    <?php } else { ?>
                                    <li>
                                        <a href="<?php the_sub_field( 'ssylka' ); ?>">
                                        <?php echo wp_get_attachment_image( $image, $size, false, array( "class" => "no-lazzy" ) ); ?>
                                        </a>
                                    </li>
			                    <?php } ?>
		                    <?php
		                    endwhile;
	                    else :
	                    endif;
	                    ?>
                    </ul>
					<?php get_search_form(); ?>
                    <ul class="social-list header-social">
						<?php
						$socials = get_field( 'soczialnye_seti', 'option' );
						if ( $socials['facebook'] == 1 ) { ?>
                            <li>
                                <a href="<?php echo $socials['fb_link']; ?>" target="_blank">
                                    <svg viewBox="0 0 100 100" class="icon">
                                        <use xlink:href="#icon-fb"></use>
                                    </svg>
                                </a>
                            </li>
						<?php } ?>
						<?php if ( $socials['vkontakte'] == 1 ) { ?>
                            <li>
                                <a href="<?php echo $socials['vk_link']; ?>" target="_blank">
                                    <svg viewBox="0 0 100 100" class="icon">
                                        <use xlink:href="#icon-vk"></use>
                                    </svg>
                                </a>
                            </li>
						<?php } ?>
	                    <?php if ( $socials['odniklasniki'] == 1 ) { ?>
                            <li>
                                <a href="<?php echo $socials['odn_link']; ?>" target="_blank">
                                    <svg viewBox="0 0 100 100" class="icon">
                                        <use xlink:href="#icon-ok"></use>
                                    </svg>
                                </a>
                            </li>
	                    <?php } ?>
	                    <?php if ( $socials['twinner'] == 1 ) { ?>
                            <li>
                                <a href="<?php echo $socials['tw_link']; ?>" target="_blank">
                                    <svg viewBox="0 0 100 100" class="icon">
                                        <use xlink:href="#icon-tw"></use>
                                    </svg>
                                </a>
                            </li>
	                    <?php } ?>
	                    <?php if ( $socials['youtube'] == 1 and false) { ?>
                            <li>
                                <a href="<?php echo $socials['yt_link']; ?>" target="_blank">
                                    <svg viewBox="0 0 100 100" class="icon">
                                        <use xlink:href="#icon-yt"></use>
                                    </svg>
                                </a>
                            </li>
	                    <?php } ?>
							<!--<li>
                                <a href="https://instagram.com/news.front" target="_blank">
                                    <svg viewBox="0 0 100 100" class="icon">
                                        <use xlink:href="#icon-inst"></use>
                                    </svg>
                                </a>
                            </li>-->
							<li>
                                <a href="https://t.me/newsfrontnotes" target="_blank">
									<img src="https://cdn.news-front.info/uploads/tg.png" height="16" width="16">
                                </a>
                            </li>
                    </ul>

                    <div class="mobile-language">
                        <select class="select"
                                onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
							<?php
							if ( have_rows( 'multiyazychnost', 'option' ) ):
								$lang_count = 0;
								while ( have_rows( 'multiyazychnost', 'option' ) ) : the_row();
									$lang_count ++ ?>
									<?php if ( $lang_count == 1 ) { ?>
                                        <option value=""><?php the_sub_field( 'lang_slag' ); ?></option>
									<?php } else { ?>
                                        <option value="<?php the_sub_field( 'ssylka' ); ?>"><?php the_sub_field( 'lang_slag' ); ?></option>
									<?php } ?>
								<?php
								endwhile;
							else :
							endif;
							?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="header__middle">
            <div class="container">
                <div class="header__middle-inner">
                    <div class="header-menu-block">
                        <div class="btn-header-menu show-header-menu">
                            <div class="btn-header-menu--inner">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                        <div class="header-menu">
                            <div class="header-menu__inner">
                                <div class="header-menu__item">
                                    <div class="header-menu__nav-title mobile-arrow btn-menu-list active">РАЗДЕЛЫ</div>
									<?php wp_nav_menu( [
										'theme_location' => 'head_menu_1',
										'container'      => false,
										'menu_class'     => 'header-menu__nav',
										'items_wrap'     => '<ul class="%2$s">%3$s</ul>'
									] ); ?>
                                </div>
                                <div class="header-menu__separator"></div>
                                <div class="header-menu__item">
                                    <div class="header-menu__nav-title mobile-arrow btn-menu-list active">РЕГИОН</div>
									<?php wp_nav_menu( [
										'theme_location' => 'head_menu_2',
										'container'      => false,
										'menu_class'     => 'header-menu__nav header-menu__nav--2column',
										'items_wrap'     => '<ul class="%2$s">%3$s</ul>'
									] ); ?>
                                </div>
                                <div class="header-menu__separator"></div>
                                <div class="header-menu__item">
                                    <div class="header-menu__nav-title mobile-arrow btn-menu-list active">О НАС</div>
									<?php wp_nav_menu( [
										'theme_location' => 'head_menu_3',
										'container'      => false,
										'menu_class'     => 'header-menu__nav',
										'items_wrap'     => '<ul class="%2$s">%3$s</ul>'
									] ); ?>
                                </div>
                                <div class="header-menu__separator"></div>
                                <div class="header-menu__item">
                                    <div class="header-menu__social">
                                        <div class="header-menu__social-item">
                                            <div class="header-menu__social-title">Мы в социальных сетях:</div>
                                            <ul class="social-list">
		                                        <?php
		                                        $socials = get_field( 'soczialnye_seti', 'option' );
		                                        if ( $socials['facebook'] == 1 ) { ?>
                                                    <li>
                                                        <a href="<?php echo $socials['fb_link']; ?>" target="_blank">
                                                            <svg viewBox="0 0 100 100" class="icon">
                                                                <use xlink:href="#icon-fb"></use>
                                                            </svg>
                                                        </a>
                                                    </li>
		                                        <?php } ?>
		                                        <?php if ( $socials['vkontakte'] == 1 ) { ?>
                                                    <li>
                                                        <a href="<?php echo $socials['vk_link']; ?>" target="_blank">
                                                            <svg viewBox="0 0 100 100" class="icon">
                                                                <use xlink:href="#icon-vk"></use>
                                                            </svg>
                                                        </a>
                                                    </li>
		                                        <?php } ?>
		                                        <?php if ( $socials['odniklasniki'] == 1 ) { ?>
                                                    <li>
                                                        <a href="<?php echo $socials['odn_link']; ?>" target="_blank">
                                                            <svg viewBox="0 0 100 100" class="icon">
                                                                <use xlink:href="#icon-ok"></use>
                                                            </svg>
                                                        </a>
                                                    </li>
		                                        <?php } ?>
		                                        <?php if ( $socials['twinner'] == 1 ) { ?>
                                                    <li>
                                                        <a href="<?php echo $socials['tw_link']; ?>" target="_blank">
                                                            <svg viewBox="0 0 100 100" class="icon">
                                                                <use xlink:href="#icon-tw"></use>
                                                            </svg>
                                                        </a>
                                                    </li>
		                                        <?php } ?>
		                                        <?php if ( $socials['youtube'] == 1 and false) { ?>
                                                    <li>
                                                        <a href="<?php echo $socials['yt_link']; ?>" target="_blank">
                                                            <svg viewBox="0 0 100 100" class="icon">
                                                                <use xlink:href="#icon-yt"></use>
                                                            </svg>
                                                        </a>
                                                    </li>
		                                        <?php } ?>
                                            </ul>
                                        </div>
                                        <a href="#" class="front-tv tv_toggle">
											<?
												$imaget = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAC5UlEQVRYR9WWP0xTQRzHv7/XYol/2jgYkcE4GHVhYPTPAAL3KrU4QB0YdDJODiwiiVGMiYqDccbB6MJQMdia9L17EF3UwURiXHRwMhHcaEQD0r6fOXKvttC075GSxlte3t39vr/Pfe8u9yM0uVGT88MvAAkhjre2tn7KZDI/a0EPDAzsWVlZ6ZBSvgPA9RboC6Cvr+8qEU0AWATQLaX8XE1YCHEMwCsAbcw86jjO/YYAmKY5ysz3tNiiYRhdlmV9KRcvT676ieiabdsKumbz5UAqldqxtLT0nIgSWm3BMIxuDyIejx91Xfe1WrkefxmLxQbT6fSfhgAoEQWRz+enAZz1IIrFYldLSwu5rqtsP6D7s7FYbMhP8nWn6hGWj2uIZwCSuv+7/rZr2zPRaDTlN3lVgN7eXjMUCl1n5k4Au4IA1pj7i4jmXde97TiOLJ9X4YBpmheY+UmDklaVIaKLtm0/9QZLAMlkcufq6uoCgKgeLABQBysfAOgIgI468/ORSKQ9m83+rtgCIcQJAG908LJhGKcty3ofIPm6nhDiBoDxOnEnpZRvNwIMAUjrwHEp5a2AyUuuCiE+ek4Q0RVmfgxAHd64npSSUqr/f7dACFECYObzjuN4MIE5hBBKfFAHHpRSfhNCjAB44AtAXXuPMHB2ABsAXjDzDBHdBHCoGQDV1lB7CxrsQNMBmr4FzT2E3jUkomlmNv+PQ8jMw47jTG3lCqoYIcQMgHM14mvfAiKasm17eCsAiURi79ramqqW9ul4VcZ9UFwAwn63QM2767ruxOzsrO/HSJVlRPSImU958KFQ6HAul/sqhBgDcCcIwFYM2BTjG8A0zTgz5xqStVJk0xYQ0Rnbtq2Kx6i/v7+tUCioemDbW7FYbJubm/tRAaBP7ySAS9tMMCmlvFx6u8uT6aro4TZCTEYikRGvGtrkgAfT09OzPxwOdzLz7ka4QUTLhUJh3rO9XDNQWd4ImI0aTQf4CxmDazAzAYJWAAAAAElFTkSuQmCC';
											?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
					<style>
						.mainmbtn {
							border: none;
							font-family: inherit;
							font-size: inherit;
							color: inherit;
							background: none;
							cursor: pointer;
							padding: 9px;
							display: inline-block;
							margin: 0px;
							text-transform: uppercase;
							letter-spacing: 1px;
							font-weight: 700;
							outline: none;
							position: relative;
							-webkit-transition: all 0.3s;
							-moz-transition: all 0.3s;
							transition: all 0.3s;
							color: white;
						}
					.mainmbtn:after {
						content: '';
						position: absolute;
						z-index: -1;
						-webkit-transition: all 0.3s;
						-moz-transition: all 0.3s;
						transition: all 0.3s;
					}

					/* Button 8 */
					.perspective {
						-webkit-perspective: 800px;
						-moz-perspective: 800px;
						perspective: 800px;
						display: inline-block;
						margin-bottom: 15px;
						font-size: 9pt;
						margin-bottom:3px;
						opacity: 0.78;
					}

					.btn-8 {
						display: block;
						background: #263238;
						-webkit-transform-style: preserve-3d;
						-moz-transform-style: preserve-3d;
						transform-style: preserve-3d;
					}

					.btn-8:active {
						background: #55b7f3;
					}

					/* Button 8a */
					.btn-8a:after {
						width: 100%;
						height: 40%;
						left: 0;
						top: -40%;
						background: #69777d;
						-webkit-transform-origin: 0% 100%;
						-webkit-transform: rotateX(90deg);
						-moz-transform-origin: 0% 100%;
						-moz-transform: rotateX(90deg);
						transform-origin: 0% 100%;
						transform: rotateX(90deg);
					}

					.btn-8a:hover {
						-webkit-transform: rotateX(-15deg);
						-moz-transform: rotateX(-15deg);
						-ms-transform: rotateX(-15deg);
						transform: rotateX(-15deg);
					}

					/* Button 8b */
.btn-8b:after {
	width: 100%;
	height: 40%;
	left: 0;
	top: 100%;
	background: #69777d;
	-webkit-transform-origin: 0% 0%;
	-webkit-transform: rotateX(-90deg);
	-moz-transform-origin: 0% 0%;
	-moz-transform: rotateX(-90deg);
	-ms-transform-origin: 0% 0%;
	-ms-transform: rotateX(-90deg);
	transform-origin: 0% 0%;
	transform: rotateX(-90deg);
}

.btn-8b:hover {
	-webkit-transform: rotateX(15deg);
	-moz-transform: rotateX(15deg);
	-ms-transform: rotateX(15deg);
	transform: rotateX(15deg);
}

/* Button 8c */
.btn-8c:after {
	width: 20%;
	height: 100%;
	left: -20%;
	top: 0;
	background: #69777d;
	-webkit-transform-origin: 100% 0%;
	-webkit-transform: rotateY(-90deg);
	-moz-transform-origin: 100% 0%;
	-moz-transform: rotateY(-90deg);
	-ms-transform-origin: 100% 0%;
	-ms-transform: rotateY(-90deg);
	transform-origin: 100% 0%;
	transform: rotateY(-90deg);
}

.btn-8c:hover {
	-webkit-transform: rotateY(15deg);
	-moz-transform: rotateY(15deg);
	-ms-transform: rotateY(15deg);
	transform: rotateY(15deg);
}

/* Button 8d */
.btn-8d:after {
	width: 20%;
	height: 100%;
	left: 100%;
	top: 0;
	background: #69777d;
	-webkit-transform-origin: 0% 0%;
	-webkit-transform: rotateY(90deg);
	-moz-transform-origin: 0% 0%;
	-moz-transform: rotateY(90deg);
	-ms-transform-origin: 0% 0%;
	-ms-transform: rotateY(90deg);
	transform-origin: 0% 0%;
	transform: rotateY(90deg);
}

.btn-8d:hover {
	-webkit-transform: rotateY(-15deg);
	-moz-transform: rotateY(-15deg);
	-ms-transform: rotateY(-15deg);
	transform: rotateY(-15deg);
}
					</style>
                    <a href="/" class="header-logo"><img class="no-lazzy" src="/wp-content/themes/newsfront/img/logo.png" alt=""></a>
					<?php /*wp_nav_menu( [
						'theme_location' => 'top_menu',
						'container'      => false,
						'menu_class'     => 'header-nav',
						'items_wrap'     => '<ul class="%2$s">%3$s<li style="padding: 9px;color: white;"><a class="tv_toggle" href="#" ><button href="#" class="btn btn-primary btn3d" type="button">Смотреть ТВ</button></a></li></ul>'
					] );*/ ?>

					<ul class="header-nav">
					<li onclick="javascript:document.location.href='/category/actualnie-novosti/'"><p class="perspective"><button style="width: 150px;background-image: linear-gradient( 114.2deg,  rgba(121,194,243,0.4) 22.6%, rgba(255,180,239,0.4) 67.7% );" class="mainmbtn btn-8 btn-8a">Новости</button></p></li>
					<li onclick="javascript:document.location.href='/category/covid-19/'"><p  class="perspective"><button style="width: 150px;background-image: linear-gradient( 109.6deg,  rgba(177,173,219,0.4) 11.2%, rgba(245,226,226,0.4) 91.1% );" class="mainmbtn btn-8 btn-8c">COVID</button></p></li>
					<li onclick="javascript:document.location.href='/category/articles/'"><p  class="perspective"><button style="width: 150px;background-image: linear-gradient( 109.6deg,  rgba(177,173,219,0.4) 11.2%, rgba(245,226,226,0.4) 91.1% );" class="mainmbtn btn-8 btn-8b">Статьи</button></p></li>
					<li onclick="javascript:document.location.href='/category/video/'"><p  class="perspective"><button style="width: 150px;background-image: radial-gradient( circle farthest-corner at 1.5% 1.4%,  rgba(159,227,255,0.4) 0%, rgba(255,177,219,0.4) 100.2% );" class="mainmbtn btn-8 btn-8d">Видео</button></p></li>
					</ul>		


					
					<form role="search" method="get" action="https://news-front.info/">
						<div class="header-search header-search--mobile">
								<input class="header-search__input" type="text" name="s">
								<input class="header-search__btn show-search-field" value="">
							
						</div>
					</form>
                </div>
            </div>
        </div>
        <div class="header__bottom">
            <div class="container">
				<?php wp_nav_menu( [
					'theme_location' => 'main_menu',
					'container'      => false,
					'menu_class'     => 'bottom-nav',
					'items_wrap'     => '<ul class="%2$s">%3$s</ul>'
				] ); ?>
            </div>
        </div>
		<?php do_action( 'show_tv' ); ?>
    </header>

<?php if(is_category(108700)) { ?>
	<h2 style="text-align: center;">
		Карта распространения COVID-2019
	</h2>
	<iframe src="https://covidworld.ru/ajax/map_kita.html" frameborder="0" height="300" style="width: 100%;"></iframe>
	<!--	<h2 style="text-align: center;">
		График распространения COVID-2019
	</h2>
	<div id="chartdiv" style="width: 100%; height: 300px; background-color: rgb(255, 255, 255); margin-bottom: 10px;"></div>-->
	<!-- amCharts javascript sources -->
<script type="text/javascript" src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script type="text/javascript" src="https://www.amcharts.com/lib/3/serial.js"></script>
<script type="text/javascript" src="https://www.amcharts.com/lib/3/lang/ru.js"></script>

<script type="text/javascript">
	jQuery(document).ready(function ($) {
		$.get("https://news-front.info/data/graphdata.txt?t="+Date.now(), function( data ) {
			var datajson = data;
			
			AmCharts.makeChart("chartdiv", {
			"type": "serial",
			"language": "ru",
			"categoryField": "date",
			"dataDateFormat": "DD.MM.YYYY",
			"categoryAxis": {
				"parseDates": true,
				"position": "top"
			},
			"chartCursor": {
				"enabled": true
			},
			"chartScrollbar": {
				"enabled": true
			},
			"trendLines": [],
			"graphs": [
				{
					"balloonText": "[[value]] заразилось",
					"bullet": "round",
					"id": "AmGraph-1",
					"title": "graph 1",
					"lineThickness": 2.5,
					"type": "smoothedLine",
					"valueField": "column-1"
				},
				{
					"balloonText": "[[value]] на подозрении",
					"id": "AmGraph-2",
					"bullet": "round",
					"title": "graph 2",
					"lineThickness": 2.5,
					"type": "smoothedLine",
					"valueField": "column-2"
				},
				{
					"balloonText": "[[value]] излечилось",
					"id": "AmGraph-3",
					"bullet": "round",
					"title": "graph 3",
					"lineThickness": 2.5,
					"type": "smoothedLine",
					"valueField": "column-3"
				}
				,
				{
					"balloonText": "[[value]] погибли",
					"id": "AmGraph-4",
					"bullet": "round",
					"title": "graph 4",
					"lineThickness": 2.5,
					"type": "smoothedLine",
					"valueField": "column-4"
				}
				,
				{
					"balloonText": "[[value]] в тяжелом состоянии",
					"id": "AmGraph-5",
					"bullet": "round",
					"title": "graph 5",
					"lineThickness": 2.5,
					"type": "smoothedLine",
					"valueField": "column-5"
				}
			],
			"guides": [],
			"valueAxes": [
				{
					"id": "ValueAxis-1",
					"title": ""
				}
			],
			"allLabels": [],
			"balloon": {},
			"titles": [],
			"dataProvider": JSON.parse(datajson)
		}
	);
		});
		
		var checkExist = setInterval(function() {
			 if ($( ".amcharts-chart-div" ).length) {
				 $( ".amcharts-chart-div a").remove();
				 $( ".amcharts-chart-div").append( "<a href=\"https://news-front.info\" title=\"JavaScript charts\" style=\"position: absolute;text-decoration: none;color: #000000;font-family: Verdana;font-size: 11px;display: block;left: 90px;top: 32px;\">news-front.info</a>" );
				clearInterval(checkExist);
			 }
		}, 100);

	});
</script>
<?php }?>

<div class="container">
<?php if ( is_single() or is_category()) { ?>
	<div class="breadcrumbs">
	<?php
	if(function_exists('bcn_display')) {
		bcn_display();
	}
	?>
	</div>
	<?php /*if ( function_exists( 'kama_breadcrumbs' ) ) {
		kama_breadcrumbs( ' > ' );
	}*/ ?>
<?php } ?>