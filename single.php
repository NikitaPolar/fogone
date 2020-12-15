<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package newsfront
 */

get_header();
    ?>

		<?php
		while ( have_posts() ) :
			the_post(); ?>

            <div class="all-news">
                <?php get_sidebar(); ?>
                <div class="all-news__inner articles">
					<div nikitapolar-id="<?php the_id(); ?>" <?php post_class(); ?>>
						<div id="content_rb_119475" class="content_rb noinfscroll" data-id="119475" style="background: whitesmoke;"></div>
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                        <div class="article__statistic">
                            <div class="date-style article__date">
                                <?php the_time('d.m.Y H:i');?>
                            </div>
							
                            <div class="article__stat">
                                <img style="margin-right:5px;" src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTkiIGhlaWdodD0iMTIiIHZpZXdCb3g9IjAgMCAxOSAxMiIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZmlsbC1ydWxlPSJldmVub2RkIiBjbGlwLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik05LjQ5NzA5IDAuMDI3NTg3OUM1Ljg2ODA1IDAuMDI3NTg3OSAyLjU3NzA0IDEuOTc4MjQgMC4xNDg2MiA1LjE0NjYxQy0wLjA0OTUzOTkgNS40MDYxOCAtMC4wNDk1Mzk5IDUuNzY4ODMgMC4xNDg2MiA2LjAyODQxQzIuNTc3MDQgOS4yMDA1OSA1Ljg2ODA1IDExLjE1MTIgOS40OTcwOSAxMS4xNTEyQzEzLjEyNjEgMTEuMTUxMiAxNi40MTcxIDkuMjAwNTkgMTguODQ1NiA2LjAzMjIyQzE5LjA0MzcgNS43NzI2NSAxOS4wNDM3IDUuNDEgMTguODQ1NiA1LjE1MDQyQzE2LjQxNzEgMS45NzgyNCAxMy4xMjYxIDAuMDI3NTg3OSA5LjQ5NzA5IDAuMDI3NTg3OVpNOS43NTc0MSA5LjUwNTk4QzcuMzQ4NDEgOS42NTQ4NSA1LjM1OTA1IDcuNzA0MjEgNS41MTA1OCA1LjMzMzY1QzUuNjM0OTIgMy4zNzkxOSA3LjI0NzM5IDEuNzk1IDkuMjM2NzYgMS42NzI4NUMxMS42NDU4IDEuNTIzOTggMTMuNjM1MSAzLjQ3NDYyIDEzLjQ4MzYgNS44NDUxN0MxMy4zNTU0IDcuNzk1ODIgMTEuNzQyOSA5LjM4MDAxIDkuNzU3NDEgOS41MDU5OFpNNy4zNTIzIDUuNDUxOTlDNy4yNjY4MiA2LjcyNjk3IDguMzM5MjEgNy43NzY3NCA5LjYzNjk2IDcuNjk2NTdDMTAuNzA1NSA3LjYzMTY4IDExLjU3NTggNi43ODA0MiAxMS42NDU4IDUuNzIzMDJDMTEuNzMxMiA0LjQ0ODA0IDEwLjY1ODggMy4zOTgyOCA5LjM2MTA5IDMuNDc4NDRDOC4yODg3IDMuNTQ3MTUgNy40MTgzNSA0LjM5ODQxIDcuMzUyMyA1LjQ1MTk5WiIgZmlsbD0iIzlBOUE5QSIvPgo8L3N2Zz4K" alt="">
								<?php do_action( 'pageviews' ); ?>
							</div> 

                            <ul class="article__social social-list 000">
                                <li class="mobile_social">
                                    Поделиться
                                </li>
								<!--noindex-->
								<li>
									<script type="text/javascript">(function(w,doc) {
										if (!w.__utlWdgt ) {
											w.__utlWdgt = true;
											var d = doc, s = d.createElement('script'), g = 'getElementsByTagName';
											s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
											s.src = ('https:' == w.location.protocol ? 'https' : 'http')  + '://w.uptolike.com/widgets/v1/uptolike.js';
											var h=d[g]('body')[0];
											h.appendChild(s);
										}})(window,document);
									</script>
									<div data-mobile-view="false" data-share-size="30" data-like-text-enable="false" data-background-alpha="0.0" data-pid="1889003" data-mode="share" data-background-color="#ffffff" data-hover-effect="scale" data-share-shape="rectangle" data-share-counter-size="12" data-icon-color="#ffffff" data-mobile-sn-ids="fb.vk.tw.ok.wh.tm.vb." data-text-color="#000000" data-buttons-color="#ffffff" data-counter-background-color="#ffffff" data-share-counter-type="common" data-orientation="horizontal" data-following-enable="false" data-sn-ids="fb.vk.tw.ok.wh.tm.vb." data-preview-mobile="false" data-selection-enable="true" data-exclude-show-more="true" data-share-style="11" data-counter-background-alpha="1.0" data-top-button="false" class="uptolike-buttons" ></div>
								</li>
	                            <!--/noindex-->
                            </ul>
                        </div>
                        <div class="article__content">
                            <?php the_content(); ?>
                        </div>
                        <div class="article__tags">
	                        <?php
	                        $post_tags = get_the_tags();
	                        if ($post_tags) {
		                        foreach($post_tags as $tag) {
			                        echo '<a href="'.get_tag_link($tag->term_id).'" class="tag">' . $tag->name . '</a>';
		                        }
	                        }
	                        ?>
                        </div>
                        <ul class="article__social social-list 1111 noinfscroll">
                            <li class="mobile_social" style="line-height: 2.3;">
                                Поделиться
                            </li>
							<li>
								<script type="text/javascript">(function(w,doc) {
									if (!w.__utlWdgt ) {
										w.__utlWdgt = true;
										var d = doc, s = d.createElement('script'), g = 'getElementsByTagName';
										s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
										s.src = ('https:' == w.location.protocol ? 'https' : 'http')  + '://w.uptolike.com/widgets/v1/uptolike.js';
										var h=d[g]('body')[0];
										h.appendChild(s);
									}})(window,document);
								</script>
								<div data-mobile-view="false" data-share-size="30" data-like-text-enable="false" data-background-alpha="0.0" data-pid="1889003" data-mode="share" data-background-color="#ffffff" data-hover-effect="scale" data-share-shape="rectangle" data-share-counter-size="12" data-icon-color="#ffffff" data-mobile-sn-ids="fb.vk.tw.ok.wh.tm.vb." data-text-color="#000000" data-buttons-color="#ffffff" data-counter-background-color="#ffffff" data-share-counter-type="common" data-orientation="horizontal" data-following-enable="false" data-sn-ids="fb.vk.tw.ok.wh.tm.vb." data-preview-mobile="false" data-selection-enable="true" data-exclude-show-more="true" data-share-style="11" data-counter-background-alpha="1.0" data-top-button="false" class="uptolike-buttons" ></div>
							</li>
                        </ul>
						<style>
						.hc__messages {
							margin-top: 0px !important;
						}
						.hc__footer {
							display: none !important;
						}
						</style>
						<div id="hypercomments_widget"></div>
						<script type="text/javascript">
						_hcwp = window._hcwp || [];
						_hcwp.push({widget:"Stream", widget_id: 107082});
						(function() {
						if("HC_LOAD_INIT" in window)return;
						HC_LOAD_INIT = true;
						var lang = (navigator.language || navigator.systemLanguage || navigator.userLanguage || "en").substr(0, 2).toLowerCase();
						var hcc = document.createElement("script"); hcc.type = "text/javascript"; hcc.async = true;
						hcc.src = ("https:" == document.location.protocol ? "https" : "http")+"://w.hypercomments.com/widget/hc/107082/"+lang+"/widget.js";
						var s = document.getElementsByTagName("script")[0];
						s.parentNode.insertBefore(hcc, s.nextSibling);
						})();
						</script>

						<!--<div class="noinfscroll">-->
							<div id="unit_96242"><a href="http://smi2.ru/" >Новости СМИ2</a></div>
							<script type="text/javascript" charset="utf-8">
							(function() {
								var sc = document.createElement('script'); sc.type = 'text/javascript'; sc.async = true;
								sc.src = '//smi2.ru/data/js/96242.js'; sc.charset = 'utf-8';
								var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(sc, s);
							}());
							</script>
						<!--</div>-->

						<?php if ( function_exists( 'related_posts' ) ) : ?>
							<?php related_posts(); ?>
						<?php endif; ?>

						<div class="noinfscroll">
							<div class="pulse-widget" data-sid="partners_widget_horizontal_news_front_info"></div><script async src="https://news-front.info/pulse-widget.js"></script>
							<div id="unit_95822"><a href="http://mirtesen.ru/" >Новости МирТесен</a></div>
							<script type="text/javascript" charset="utf-8">
							(function() {
							var sc = document.createElement('script'); sc.type = 'text/javascript'; sc.async = true;
							sc.src = '//news.mirtesen.ru/data/js/95822.js'; sc.charset = 'utf-8';
							var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(sc, s);
							}());
							</script>	
						</div>
						<div class="noinfscroll">
						</div>
                    <nav class="post-navigation" style="visibility: hidden">
	                    <?php next_post_link( ); ?>
	                    <?php previous_post_link( ); ?>
                    </nav>

				</div>

				<div id="content_rb_126361" class="content_rb" data-id="126361" style="background: whitesmoke;"></div>
				<style>
				@media screen and (max-width: 700px) {
					.h3adult {
						left:0px !important;
					}
				}
				</style>
				<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/color-thief/2.3.0/color-thief.umd.js"></script>-->
	            <script>
		            jQuery( function ( $ ) {
						$('.article__content p img').each(function() {
							if ($(this).parent().attr('href') != "") {
								//$(this).parent().replaceWith($(this).parent().html());
								$(this).parent().removeAttr("href");
								//$(this).css("opacity","1");
							}
						});
/*
						$('.article__content figure img').each(function() {
							if ($(this).parent().attr('href') != "") {
								//$(this).parent().replaceWith($(this).parent().html());
								$(this).parent().removeAttr("href");
								//$(this).css("opacity","1");
							}
						});
							*/
						if ((jQuery(".entry-title").text().indexOf('18+') != -1) || (jQuery(".entry-title").text().indexOf('21+') != -1)) {
							console.log('content adult');
							$(".article__content img").wrap('<div class="adult" style="position:relative;"></div>');
							$(".article__content img").css("filter", "blur(15px)");
							$(".article__content img").after('<span class="h3adult" style="font-size: 14pt;left: 20%;background: black;padding: 9px;position: absolute;color: white;top: 50%;">Контент для взрослых, нажмите, чтобы посмотреть <b style="color:red;">18+</b></span>');
							$(".article__content img").click(function(){
								$(this).css("filter", "blur(0px)");
								$(this).parent().find('span').text(" ");
								$(this).parent().find('span').css("display","none");
							});
							$(".article__content span").click(function(){
								$(this).parent().find('img').css("filter", "blur(0px)");
								$(this).parent().find('span').text(" ");
								$(this).parent().find('span').css("display","none");
							});
						}
						function sectime(){
							return parseInt(new Date().getTime()/1000)
						}
						var lasttime = 0;
						var countarticles = 0;
						$( '.all-news__inner' ).on( 'append.infiniteScroll', function( event, response, path, items ) {
							if ($('.articles .post').length != countarticles) {
								countarticles = $('.articles .post').length;
								console.log('new');
								console.log( 'Loaded: ' + response );
								$(document).trigger('pageviews-update');
								$( document.body ).find( '.post:last' ).after('<div style="width:100%;text-align:center;"><div id="content_rb_119481" class="content_rb" data-id="119481" style="background: whitesmoke;"></div></div>');
								//$( document.body ).find( '.article__social.social-list.000:last' ).after(VK.Share.button(path, {type: 'link',text: 'поделиться'}));
								$( document.body ).find( '.article__social.social-list.000:last' ).after('<div class="share42init" data-url="'+path+'" data-title="<?php the_title() ?>"></div><script type="text/javascript" src="//news-front.info/data/share42.js"><\/script>');
							}
						});

			            $( '.all-news__inner' ).on( 'history.infiniteScroll', function( event, title, path ) {
							/*if ($('.articles .post').length != countarticles) {
								countarticles = $('.articles .post').length;
								console.log('new');
								$( document.body ).find( '.post:last' ).after('<div style="width:100%;text-align:center;"><div id="content_rb_119481" class="content_rb" data-id="119481" style="background: whitesmoke;"></div></div>');
								$( document.body ).find( '.article__social.social-list.000:last' ).after(VK.Share.button(path, {type: 'link',text: 'поделиться'}));
								//$( document.body ).find( '.article__social.social-list.000:last' ).after('<iframe src="https://www.facebook.com/plugins/share_button.php?href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&layout=button_count&size=small&width=145&height=20&appId" width="145" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>');
							}*/
			            	/*var cackle_id = $( document.body ).find( '.post:last' ).data( 'cackleId' );*/
			            	//addthis_ajax_init();
			            	/*cackle_ajax_init( cackle_id, path );*/
						});
		            });
	            </script>
            </div>
		</div>
		<?php
		endwhile; // End of the loop.
?>

<?php
get_footer();
