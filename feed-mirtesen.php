<?php
/**
 * Template Name: Custom RSS Template - Feedname
 */
$postCount = 30; // количество записей для отображения в фиде
$posts = query_posts('showposts=' . $postCount);
header('Content-Type: ' . feed_content_type('rss') . '; charset=' . get_option('blog_charset'), true);
echo '<?xml version="1.0" encoding="'.get_option('blog_charset').'"?>';
?>
<rss xmlns:yandex="http://news.yandex.ru" xmlns:media="http://search.yahoo.com/mrss/" version="2.0">
	<channel>
		<title><![CDATA[<?php echo bloginfo_rss('name'); ?>]]> - Feed</title>
		<link><?php bloginfo_rss('url') ?></link>
		<description><![CDATA[<?php bloginfo_rss('description') ?>]]></description>
		<image>
			<url>https://news-front.info/wp-content/themes/news-front/images/imgo4.png</url>
			<title><?php bloginfo_rss('name'); ?></title>
			<link><?php echo home_url();?> </link>
		</image>
<?php	
	$gmt_offset = get_option('gmt_offset');
	$gmt_offset = ($gmt_offset > 9) ? $gmt_offset.'00' : ('0'.$gmt_offset.'00');
?>
			<lastBuildDate><?php echo mysql2date('D, d M Y H:i:s +'.$gmt_offset, get_date_from_gmt(get_post_time('Y-m-d H:i:s', true)), false); ?></lastBuildDate>
			<?php do_action('rss2_head'); ?>
			<?php while(have_posts()) : the_post(); ?>
			<item>
				<title><![CDATA[<?php the_title_rss(); ?>]]></title>
				<link><?php the_permalink_rss(); ?></link>
				<description><![CDATA[<?php echo get_the_content_for_feed(); ?>]]></description>
				<?php echo get_the_category_rss();?>
				<author><![CDATA[<?php the_author(); ?>]]></author>
<?php
	$gmt_offset = get_option('gmt_offset');
	$gmt_offset = ($gmt_offset > 9) ? $gmt_offset.'00' : ('0'.$gmt_offset.'00');
?>
<pubDate><?php echo mysql2date('D, d M Y H:i:s +'.$gmt_offset, get_date_from_gmt(get_post_time('Y-m-d H:i:s', true)), false); ?></pubDate>
				<guid isPermaLink="false"><?php the_guid(); ?></guid>
				<?php rss_enclosure();?>
				<?php atom_enclosure();?>
				<?php
				$media = get_item_media();
				if(!empty($media)):?>
					<?php foreach($media as $media_obj):?>
							<enclosure url="<?php echo esc_url($media_obj['url']);?>" />
							<?php if(!empty($media_obj['thumb'])) { ?>
								<enclosure url="<?php echo esc_url($media_obj['thumb']);?>" />
							<?php }?>
					<?php endforeach; ?>
				<?php endif;?>
				<?php do_action('rss2_item'); ?>
			 </item>
			<?php endwhile; ?>
	</channel>
</rss>
