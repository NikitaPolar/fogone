<?php 
/*
YARPP Template: Simple
Author: mitcho (Michael Yoshitaka Erlewine)
Description: A simple example YARPP template.
*/
?>
<?php if (have_posts()):?>
<h3 class="main-head main-head--mb15 noinfscroll">
                            Читайте также
                        </h3>
<div class="single_relevant articles-list articles-list--mb10 articles-list  articles-list--column-4 noinfscroll">
	<?php while (have_posts()) : the_post(); ?>
	<div class="article-link">
                                        <a href="<?php the_permalink(); ?>" class="article-link__img">
											<?php 
												$cur_id_img = get_post_thumbnail_id($post->ID); 
												echo wp_get_attachment_image( $cur_id_img, 'medium', false, array( "class" => "no-lazzy" ));
											?>
                                        </a>
                                        <a href="<?php the_permalink(); ?>" class="article-link__title">
						                    <?php echo  kama_excerpt(array('maxchar' => 60, 'text' => get_the_title()))?>
                                        </a>
                                        <div class="article-link__row">
                                            <span class="date-style date-style--dark">
                                    <?php the_time('d.m.Y H:i');?>
                                </span>
                                        </div>
                                    </div>
	
	<?php endwhile; ?>
</div>
<?php else: ?>
<p>Похожих записей нету.</p>
<?php endif; ?>