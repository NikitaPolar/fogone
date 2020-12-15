<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package newsfront
 */

get_header();
?>

	<div id="primary" class="content-area" style="padding-top: 20px;">
		<main id="main" class="site-main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title">Данная страница не найдена!</h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p>Мы не нашли страницу по данному адресу, попробуйте перейти по ссылкам или воспользуйтесь поиском.</p>

					<?php
						the_widget( 'WP_Widget_Recent_Posts' );
					?>
					<div style="padding-top: 20px;"></div>
					<?php
					/* translators: %1$s: smiley */
					$newsfront_archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'newsfront' ), convert_smilies( ':)' ) ) . '</p>';
					the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$newsfront_archive_content" );

					the_widget( 'WP_Widget_Tag_Cloud' );
					?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
