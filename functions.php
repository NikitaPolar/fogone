<?php
/**
 * newsfront functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package newsfront
 */



if ( ! function_exists( 'newsfront_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function newsfront_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on newsfront, use a find and replace
		 * to change 'newsfront' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'newsfront', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		if(function_exists('register_nav_menus')){
			register_nav_menus(
				array( // создаём любое количество областей
					'top_menu' => 'Верхнее меню',
				    'main_menu' => 'Главное меню',
				    'head_menu_1' => 'Первая колонка выпадающего меню',
				    'head_menu_2' => 'Вторая колонка выпадающего меню',
				    'head_menu_3' => 'Третья колонка выпадающего меню'
				)
			);
		}

		function atg_menu_classes($classes, $item, $args) {
			if($args->theme_location == 'main_menu') {
				$classes[] = 'bottom-nav__item';
			}
			return $classes;
		}
		add_filter('nav_menu_css_class', 'atg_menu_classes', 1, 3);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'newsfront_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'newsfront_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function newsfront_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'newsfront_content_width', 640 );
}
add_action( 'after_setup_theme', 'newsfront_content_width', 0 );

add_filter('the_content', 'my_filter_function');
function my_filter_function($content){
	$content = preg_replace("@<img@", '<img style="max-height: 400px;object-fit: cover;"', $content, 1);
	return $content;
}

/**
 * Enqueue scripts and styles.
 */
function newsfront_scripts() {

	wp_enqueue_style( 'newsfront-libs', get_template_directory_uri() . '/css/libs.min.css', '1.0.0', 'all' );
	wp_enqueue_style( 'newsfront-style', get_theme_file_uri( 'style.css' ), [], filemtime( get_theme_file_path( 'style.css' ) ) );
	wp_enqueue_style('font_roboto', 'https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700|Roboto:400,500,700&display=swap&subset=cyrillic');


    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js');
    wp_enqueue_script( 'jquery' );

	wp_enqueue_script( 'libs', get_template_directory_uri() . '/js/libs.min.js', array(), null, true );
	wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js', array(), '1.0.2', true );
	wp_enqueue_script( 'newsfront-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'newsfront_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
/**
 * Обрезка текста (excerpt). Шоткоды вырезаются. Минимальное значение maxchar может быть 22.
 *
 * @param string/array $args Параметры.
 *
 * @return string HTML
 *
 * @ver 2.6.4
 */
function kama_excerpt( $args = '' ){
    global $post;

    if( is_string($args) )
        parse_str( $args, $args );

    $rg = (object) array_merge( array(
        'maxchar'   => 350,   // Макс. количество символов.
        'text'      => '',    // Какой текст обрезать (по умолчанию post_excerpt, если нет post_content.
        // Если в тексте есть `<!--more-->`, то `maxchar` игнорируется и берется все до <!--more--> вместе с HTML.
        'autop'     => true,  // Заменить переносы строк на <p> и <br> или нет?
        'save_tags' => '',    // Теги, которые нужно оставить в тексте, например '<strong><b><a>'.
        'more_text' => 'Читать дальше...', // Текст ссылки `Читать дальше`.
    ), $args );

    $rg = apply_filters( 'kama_excerpt_args', $rg );

    if( ! $rg->text )
        $rg->text = $post->post_excerpt ?: $post->post_content;

    $text = $rg->text;
    $text = preg_replace( '~\[([a-z0-9_-]+)[^\]]*\](?!\().*?\[/\1\]~is', '', $text ); // убираем блочные шорткоды: [foo]some data[/foo]. Учитывает markdown
    $text = preg_replace( '~\[/?[^\]]*\](?!\()~', '', $text ); // убираем шоткоды: [singlepic id=3]. Учитывает markdown
    $text = trim( $text );

    // <!--more-->
    if( strpos( $text, '<!--more-->') ){
        preg_match('/(.*)<!--more-->/s', $text, $mm );

        $text = trim( $mm[1] );

        $text_append = ' <a href="'. get_permalink( $post ) .'#more-'. $post->ID .'">'. $rg->more_text .'</a>';
    }
    // text, excerpt, content
    else {
        $text = trim( strip_tags($text, $rg->save_tags) );

        // Обрезаем
        if( mb_strlen($text) > $rg->maxchar ){
            $text = mb_substr( $text, 0, $rg->maxchar );
            $text = preg_replace( '~(.*)\s[^\s]*$~s', '\\1...', $text ); // убираем последнее слово, оно 99% неполное
        }
    }

    // Сохраняем переносы строк. Упрощенный аналог wpautop()
    if( $rg->autop ){
        $text = preg_replace(
            array("/\r/", "/\n{2,}/", "/\n/",   '~</p><br ?/?>~'),
            array('',     '</p><p>',  '<br />', '</p>'),
            $text
        );
    }

    $text = apply_filters( 'kama_excerpt', $text, $rg );

    if( isset($text_append) )
        $text .= $text_append;

    return ( $rg->autop && $text ) ? "$text" : $text;
}
/* Сhangelog:
 * 2.6.4 - Убрал пробел между словом и многоточием
 * 2.6.3 - Рефакторинг
 * 2.6.2 - Добавил регулярку для удаления блочных шорткодов вида: [foo]some data[/foo]
 * 2.6   - Удалил параметр 'save_format' и заменил его на два параметра 'autop' и 'save_tags'.
 *       - Немного изменил логику кода.
 */

add_action( 'pre_get_posts', 'turn_off_sticky_on_homepage' );
function turn_off_sticky_on_homepage( $query ) {
    if ( !is_admin() && $query->is_main_query() ) {
        $query->set( 'ignore_sticky_posts', true );
    }
}

/* Подсчет количества посещений страниц
---------------------------------------------------------- */
add_action('wp_head', 'kama_postviews');
function kama_postviews() {

	/* ------------ Настройки -------------- */
	$meta_key       = 'views';  // Ключ мета поля, куда будет записываться количество просмотров.
	$who_count      = 0;            // Чьи посещения считать? 0 - Всех. 1 - Только гостей. 2 - Только зарегистрированных пользователей.
	$exclude_bots   = 0;            // Исключить ботов, роботов, пауков и прочую нечесть :)? 0 - нет, пусть тоже считаются. 1 - да, исключить из подсчета.

	global $user_ID, $post;
	if(is_singular()) {
		$id = (int)$post->ID;
		static $post_views = false;
		if($post_views) return true; // чтобы 1 раз за поток
		$post_views = (int)get_post_meta($id,$meta_key, true);
		$should_count = false;
		switch( (int)$who_count ) {
			case 0: $should_count = true;
				break;
			case 1:
				if( (int)$user_ID == 0 )
					$should_count = true;
				break;
			case 2:
				if( (int)$user_ID > 0 )
					$should_count = true;
				break;
		}
		if( (int)$exclude_bots==1 && $should_count ){
			$useragent = $_SERVER['HTTP_USER_AGENT'];
			$notbot = "Mozilla|Opera"; //Chrome|Safari|Firefox|Netscape - все равны Mozilla
			$bot = "Bot/|robot|Slurp/|yahoo"; //Яндекс иногда как Mozilla представляется
			if ( !preg_match("/$notbot/i", $useragent) || preg_match("!$bot!i", $useragent) )
				$should_count = false;
		}

		if($should_count)
			if( !update_post_meta($id, $meta_key, ($post_views+1)) ) add_post_meta($id, $meta_key, 1, true);
	}
	return true;
}
if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Настройки темы',
		'menu_title'	=> 'Настройки темы',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

}
function true_register_wp_sidebars() {

	register_sidebar(
		array(
			'id' => 'home_side', // уникальный id
			'name' => 'Сайдбар на главной', // название сайдбара
			'description' => 'Перетащите сюда виджеты, чтобы добавить их в сайдбар.', // описание
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		)
	);
	register_sidebar(
		array(
			'id' => 'inner_side', // уникальный id
			'name' => 'Сайдбар на внутренних', // название сайдбара
			'description' => 'Перетащите сюда виджеты, чтобы добавить их в сайдбар.', // описание
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		)
	);
	register_sidebar(
		array(
			'id' => 'footer_1', // уникальный id
			'name' => 'Футер (колонка 1)', // название сайдбара
			'description' => 'Перетащите сюда виджеты, чтобы добавить их в сайдбар.', // описание
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '<div class="footer__title footer-nav__title mobile-arrow btn-menu-list">',
			'after_title' => '</div>'
		)
	);
	register_sidebar(
		array(
			'id' => 'footer_2', // уникальный id
			'name' => 'Футер (колонка 2)', // название сайдбара
			'description' => 'Перетащите сюда виджеты, чтобы добавить их в сайдбар.', // описание
			'before_widget' => '<div class="footer-nav">',
			'after_widget' => '</div>',
			'before_title' => '<div class="footer__title footer-nav__title mobile-arrow btn-menu-list">',
			'after_title' => '</div>'
		)
	);
	register_sidebar(
		array(
			'id' => 'footer_3', // уникальный id
			'name' => 'Футер (колонка 3)', // название сайдбара
			'description' => 'Перетащите сюда виджеты, чтобы добавить их в сайдбар.', // описание
			'before_widget' => '<div class="footer-nav">',
			'after_widget' => '</div>',
			'before_title' => '<div class="footer__title footer-nav__title mobile-arrow btn-menu-list">',
			'after_title' => '</div>'
		)
	);
	register_sidebar(
		array(
			'id' => 'footer_4', // уникальный id
			'name' => 'Футер (колонка 4)', // название сайдбара
			'description' => 'Перетащите сюда виджеты, чтобы добавить их в сайдбар.', // описание
			'before_widget' => '<div class="footer-nav">',
			'after_widget' => '</div>',
			'before_title' => '<div class="footer__title footer-nav__title mobile-arrow btn-menu-list">',
			'after_title' => '</div>'
		)
	);
}
add_action( 'widgets_init', 'true_register_wp_sidebars' );


add_action( 'after_setup_theme', function() {
    add_theme_support( 'pageviews' );
});

/**
 * Хлебные крошки для WordPress (breadcrumbs)
 *
 * @param string [$sep  = '']      Разделитель. По умолчанию ' » '
 * @param array  [$l10n = array()] Для локализации. См. переменную $default_l10n.
 * @param array  [$args = array()] Опции. См. переменную $def_args
 *
 * @return string Выводит на экран HTML код
 *
 * version 3.3.2
 */
function kama_breadcrumbs( $sep = ' » ', $l10n = array(), $args = array() ) {
	$kb = new Kama_Breadcrumbs;
	echo $kb->get_crumbs( $sep, $l10n, $args );
}

class Kama_Breadcrumbs {

	public $arg;

	// Локализация
	static $l10n = array(
		'home'       => 'Главная',
		'paged'      => 'Страница %d',
		'_404'       => 'Ошибка 404',
		'search'     => 'Результаты поиска по запросу - <b>%s</b>',
		'author'     => 'Архив автора: <b>%s</b>',
		'year'       => 'Архив за <b>%d</b> год',
		'month'      => 'Архив за: <b>%s</b>',
		'day'        => '',
		'attachment' => 'Медиа: %s',
		'tag'        => 'Записи по метке: <b>%s</b>',
		'tax_tag'    => '%1$s из "%2$s" по тегу: <b>%3$s</b>',
		// tax_tag выведет: 'тип_записи из "название_таксы" по тегу: имя_термина'.
		// Если нужны отдельные холдеры, например только имя термина, пишем так: 'записи по тегу: %3$s'
	);

	// Параметры по умолчанию
	static $args = array(
		'on_front_page'   => true,
		// выводить крошки на главной странице
		'show_post_title' => true,
		// показывать ли название записи в конце (последний элемент). Для записей, страниц, вложений
		'show_term_title' => true,
		// показывать ли название элемента таксономии в конце (последний элемент). Для меток, рубрик и других такс
		'title_patt'      => '<span class="kb_title">%s</span>',
		// шаблон для последнего заголовка. Если включено: show_post_title или show_term_title
		'last_sep'        => true,
		// показывать последний разделитель, когда заголовок в конце не отображается
		'markup'          => 'schema.org',
		// 'markup' - микроразметка. Может быть: 'rdf.data-vocabulary.org', 'schema.org', '' - без микроразметки
		// или можно указать свой массив разметки:
		// array( 'wrappatt'=>'<div class="kama_breadcrumbs">%s</div>', 'linkpatt'=>'<a href="%s">%s</a>', 'sep_after'=>'', )
		'priority_tax'    => array( 'category' ),
		// приоритетные таксономии, нужно когда запись в нескольких таксах
		'priority_terms'  => array(),
		// 'priority_terms' - приоритетные элементы таксономий, когда запись находится в нескольких элементах одной таксы одновременно.
		// Например: array( 'category'=>array(45,'term_name'), 'tax_name'=>array(1,2,'name') )
		// 'category' - такса для которой указываются приор. элементы: 45 - ID термина и 'term_name' - ярлык.
		// порядок 45 и 'term_name' имеет значение: чем раньше тем важнее. Все указанные термины важнее неуказанных...
		'nofollow'        => false,
		// добавлять rel=nofollow к ссылкам?

		// служебные
		'sep'             => '',
		'linkpatt'        => '',
		'pg_end'          => '',
	);

	function get_crumbs( $sep, $l10n, $args ) {
		global $post, $wp_query, $wp_post_types;

		self::$args['sep'] = $sep;

		// Фильтрует дефолты и сливает
		$loc = (object) array_merge( apply_filters( 'kama_breadcrumbs_default_loc', self::$l10n ), $l10n );
		$arg = (object) array_merge( apply_filters( 'kama_breadcrumbs_default_args', self::$args ), $args );

		$arg->sep = '<span class="kb_sep">' . $arg->sep . '</span>'; // дополним

		// упростим
		$sep       = &$arg->sep;
		$this->arg = &$arg;

		// микроразметка ---
		if ( 1 ) {
			$mark = &$arg->markup;

			// Разметка по умолчанию
			if ( ! $mark ) {
				$mark = array(
					'wrappatt'  => '<ul class="breadcrumbs">%s</ul>',
					'linkpatt'  => '<a href="%s">%s</a>',
					'sep_after' => '',
				);
			} // rdf
            elseif ( $mark === 'rdf.data-vocabulary.org' ) {
				$mark = array(
					'wrappatt'  => '<ul class="breadcrumbs">%s</ul>',
					'linkpatt'  => '<span><a href="%s">%s</a>',
					'sep_after' => '</span>', // закрываем span после разделителя!
				);
			} // schema.org
            elseif ( $mark === 'schema.org' ) {
				$mark = array(
					'wrappatt'  => '<ul class="breadcrumbs">%s</ul>',
					'linkpatt'  => '<span><a href="%s"><span>%s</span></a></span>',
					'sep_after' => '',
				);
			} elseif ( ! is_array( $mark ) ) {
				die( __CLASS__ . ': "markup" parameter must be array...' );
			}

			$wrappatt      = $mark['wrappatt'];
			$arg->linkpatt = $arg->nofollow ? str_replace( '<a ', '<a rel="nofollow"', $mark['linkpatt'] ) : $mark['linkpatt'];
			$arg->sep      .= $mark['sep_after'] . "\n";
		}

		$linkpatt = $arg->linkpatt; // упростим

		$q_obj = get_queried_object();

		// может это архив пустой таксы?
		$ptype = null;
		if ( empty( $post ) ) {
			if ( isset( $q_obj->taxonomy ) ) {
				$ptype = &$wp_post_types[ get_taxonomy( $q_obj->taxonomy )->object_type[0] ];
			}
		} else {
			$ptype = &$wp_post_types[ $post->post_type ];
		}

		// paged
		$arg->pg_end = '';
		if ( ( $paged_num = get_query_var( 'paged' ) ) || ( $paged_num = get_query_var( 'page' ) ) ) {
			$arg->pg_end = $sep . sprintf( $loc->paged, (int) $paged_num );
		}

		$pg_end = $arg->pg_end; // упростим

		$out = '';

		if ( is_front_page() ) {
			return $arg->on_front_page ? sprintf( $wrappatt, ( $paged_num ? sprintf( $linkpatt, get_home_url(), $loc->home ) . $pg_end : $loc->home ) ) : '';
		} // страница записей, когда для главной установлена отдельная страница.
        elseif ( is_home() ) {
			$out = $paged_num ? ( sprintf( $linkpatt, get_permalink( $q_obj ), esc_html( $q_obj->post_title ) ) . $pg_end ) : esc_html( $q_obj->post_title );
		} elseif ( is_404() ) {
			$out = $loc->_404;
		} elseif ( is_search() ) {
			$out = sprintf( $loc->search, esc_html( $GLOBALS['s'] ) );
		} elseif ( is_author() ) {
			$tit = sprintf( $loc->author, esc_html( $q_obj->display_name ) );
			$out = ( $paged_num ? sprintf( $linkpatt, get_author_posts_url( $q_obj->ID, $q_obj->user_nicename ) . $pg_end, $tit ) : $tit );
		} elseif ( is_year() || is_month() || is_day() ) {
			$y_url = get_year_link( $year = get_the_time( 'Y' ) );

			if ( is_year() ) {
				$tit = sprintf( $loc->year, $year );
				$out = ( $paged_num ? sprintf( $linkpatt, $y_url, $tit ) . $pg_end : $tit );
			} // month day
			else {
				$y_link = sprintf( $linkpatt, $y_url, $year );
				$m_url  = get_month_link( $year, get_the_time( 'm' ) );

				if ( is_month() ) {
					$tit = sprintf( $loc->month, get_the_time( 'F' ) );
					$out = $y_link . $sep . ( $paged_num ? sprintf( $linkpatt, $m_url, $tit ) . $pg_end : $tit );
				} elseif ( is_day() ) {
					$m_link = sprintf( $linkpatt, $m_url, get_the_time( 'F' ) );
					$out    = $y_link . $sep . $m_link . $sep . get_the_time( 'l' );
				}
			}
		} // Древовидные записи
        elseif ( is_singular() && $ptype->hierarchical ) {
			$out = $this->_add_title( $this->_page_crumbs( $post ), $post );
		} // Таксы, плоские записи и вложения
		else {
			$term = $q_obj; // таксономии

			// определяем термин для записей (включая вложения attachments)
			if ( is_singular() ) {
				// изменим $post, чтобы определить термин родителя вложения
				if ( is_attachment() && $post->post_parent ) {
					$save_post = $post; // сохраним
					$post      = get_post( $post->post_parent );
				}

				// учитывает если вложения прикрепляются к таксам древовидным - все бывает :)
				$taxonomies = get_object_taxonomies( $post->post_type );
				// оставим только древовидные и публичные, мало ли...
				$taxonomies = array_intersect( $taxonomies, get_taxonomies( array(
					'hierarchical' => true,
					'public'       => true
				) ) );

				if ( $taxonomies ) {
					// сортируем по приоритету
					if ( ! empty( $arg->priority_tax ) ) {
						usort( $taxonomies, function ( $a, $b ) use ( $arg ) {
							$a_index = array_search( $a, $arg->priority_tax );
							if ( $a_index === false ) {
								$a_index = 9999999;
							}

							$b_index = array_search( $b, $arg->priority_tax );
							if ( $b_index === false ) {
								$b_index = 9999999;
							}

							return ( $b_index === $a_index ) ? 0 : ( $b_index < $a_index ? 1 : - 1 ); // меньше индекс - выше
						} );
					}

					// пробуем получить термины, в порядке приоритета такс
					foreach ( $taxonomies as $taxname ) {
						if ( $terms = get_the_terms( $post->ID, $taxname ) ) {
							// проверим приоритетные термины для таксы
							$prior_terms = &$arg->priority_terms[ $taxname ];
							if ( $prior_terms && count( $terms ) > 2 ) {
								foreach ( (array) $prior_terms as $term_id ) {
									$filter_field = is_numeric( $term_id ) ? 'term_id' : 'slug';
									$_terms       = wp_list_filter( $terms, array( $filter_field => $term_id ) );

									if ( $_terms ) {
										$term = array_shift( $_terms );
										break;
									}
								}
							} else {
								$term = array_shift( $terms );
							}

							break;
						}
					}
				}

				if ( isset( $save_post ) ) {
					$post = $save_post;
				} // вернем обратно (для вложений)
			}

			// вывод

			// все виды записей с терминами или термины
			if ( $term && isset( $term->term_id ) ) {
				$term = apply_filters( 'kama_breadcrumbs_term', $term );

				// attachment
				if ( is_attachment() ) {
					if ( ! $post->post_parent ) {
						$out = sprintf( $loc->attachment, esc_html( $post->post_title ) );
					} else {
						if ( ! $out = apply_filters( 'attachment_tax_crumbs', '', $term, $this ) ) {
							$_crumbs    = $this->_tax_crumbs( $term, 'self' );
							$parent_tit = sprintf( $linkpatt, get_permalink( $post->post_parent ), get_the_title( $post->post_parent ) );
							$_out       = implode( $sep, array( $_crumbs, $parent_tit ) );
							$out        = $this->_add_title( $_out, $post );
						}
					}
				} // single
                elseif ( is_single() ) {
					if ( ! $out = apply_filters( 'post_tax_crumbs', '', $term, $this ) ) {
						$_crumbs = $this->_tax_crumbs( $term, 'self' );
						$out     = $this->_add_title( $_crumbs, $post );
					}
				} // не древовидная такса (метки)
                elseif ( ! is_taxonomy_hierarchical( $term->taxonomy ) ) {
					// метка
					if ( is_tag() ) {
						$out = $this->_add_title( '', $term, sprintf( $loc->tag, esc_html( $term->name ) ) );
					} // такса
                    elseif ( is_tax() ) {
						$post_label = $ptype->labels->name;
						$tax_label  = $GLOBALS['wp_taxonomies'][ $term->taxonomy ]->labels->name;
						$out        = $this->_add_title( '', $term, sprintf( $loc->tax_tag, $post_label, $tax_label, esc_html( $term->name ) ) );
					}
				} // древовидная такса (рибрики)
				else {
					if ( ! $out = apply_filters( 'term_tax_crumbs', '', $term, $this ) ) {
						$_crumbs = $this->_tax_crumbs( $term, 'parent' );
						$out     = $this->_add_title( $_crumbs, $term, esc_html( $term->name ) );
					}
				}
			} // влоежния от записи без терминов
            elseif ( is_attachment() ) {
				$parent      = get_post( $post->post_parent );
				$parent_link = sprintf( $linkpatt, get_permalink( $parent ), esc_html( $parent->post_title ) );
				$_out        = $parent_link;

				// вложение от записи древовидного типа записи
				if ( is_post_type_hierarchical( $parent->post_type ) ) {
					$parent_crumbs = $this->_page_crumbs( $parent );
					$_out          = implode( $sep, array( $parent_crumbs, $parent_link ) );
				}

				$out = $this->_add_title( $_out, $post );
			} // записи без терминов
            elseif ( is_singular() ) {
				$out = $this->_add_title( '', $post );
			}
		}

		// замена ссылки на архивную страницу для типа записи
		$home_after = apply_filters( 'kama_breadcrumbs_home_after', '', $linkpatt, $sep, $ptype );

		if ( '' === $home_after ) {
			// Ссылка на архивную страницу типа записи для: отдельных страниц этого типа; архивов этого типа; таксономий связанных с этим типом.
			if ( $ptype && $ptype->has_archive && ! in_array( $ptype->name, array( 'post', 'page', 'attachment' ) )
			     && ( is_post_type_archive() || is_singular() || ( is_tax() && in_array( $term->taxonomy, $ptype->taxonomies ) ) )
			) {
				$pt_title = $ptype->labels->name;

				// первая страница архива типа записи
				if ( is_post_type_archive() && ! $paged_num ) {
					$home_after = sprintf( $this->arg->title_patt, $pt_title );
				} // singular, paged post_type_archive, tax
				else {
					$home_after = sprintf( $linkpatt, get_post_type_archive_link( $ptype->name ), $pt_title );

					$home_after .= ( ( $paged_num && ! is_tax() ) ? $pg_end : $sep ); // пагинация
				}
			}
		}

		$before_out = sprintf( $linkpatt, home_url(), $loc->home ) . ( $home_after ? $sep . $home_after : ( $out ? $sep : '' ) );

		$out = apply_filters( 'kama_breadcrumbs_pre_out', $out, $sep, $loc, $arg );

		$out = sprintf( $wrappatt, $before_out . $out );

		return apply_filters( 'kama_breadcrumbs', $out, $sep, $loc, $arg );
	}

	function _page_crumbs( $post ) {
		$parent = $post->post_parent;

		$crumbs = array();
		while ( $parent ) {
			$page     = get_post( $parent );
			$crumbs[] = sprintf( $this->arg->linkpatt, get_permalink( $page ), esc_html( $page->post_title ) );
			$parent   = $page->post_parent;
		}

		return implode( $this->arg->sep, array_reverse( $crumbs ) );
	}

	function _tax_crumbs( $term, $start_from = 'self' ) {
		$termlinks = array();
		$term_id   = ( $start_from === 'parent' ) ? $term->parent : $term->term_id;
		while ( $term_id ) {
			$term        = get_term( $term_id, $term->taxonomy );
			$termlinks[] = sprintf( $this->arg->linkpatt, get_term_link( $term ), esc_html( $term->name ) );
			$term_id     = $term->parent;
		}

		if ( $termlinks ) {
			return implode( $this->arg->sep, array_reverse( $termlinks ) ) /*. $this->arg->sep*/ ;
		}

		return '';
	}

	// добалвяет заголовок к переданному тексту, с учетом всех опций. Добавляет разделитель в начало, если надо.
	function _add_title( $add_to, $obj, $term_title = '' ) {
		$arg        = &$this->arg; // упростим...
		$title      = $term_title ? $term_title : esc_html( $obj->post_title ); // $term_title чиститься отдельно, теги моугт быть...
		$show_title = $term_title ? $arg->show_term_title : $arg->show_post_title;

		// пагинация
		if ( $arg->pg_end ) {
			$link   = $term_title ? get_term_link( $obj ) : get_permalink( $obj );
			$add_to .= ( $add_to ? $arg->sep : '' ) . sprintf( $arg->linkpatt, $link, $title ) . $arg->pg_end;
		} // дополняем - ставим sep
        elseif ( $add_to ) {
			if ( $show_title ) {
				$add_to .= $arg->sep . sprintf( $arg->title_patt, $title );
			} elseif ( $arg->last_sep ) {
				$add_to .= $arg->sep;
			}
		} // sep будет потом...
        elseif ( $show_title ) {
			$add_to = sprintf( $arg->title_patt, $title );
		}

		return $add_to;
	}

}

/**
 * Настройка хлебных крошек.
 *
 * @author mikhail@kobzarev.com
 */
add_filter(
	'kama_breadcrumbs_default_args',
	function ( $args ) {
		$args['show_post_title'] = false;
		$args['last_sep']        = false;
		$args['markup']          = '';

		return $args;
	},
	10,
	4
);


add_action('wp_ajax_myfilter', 'misha_filter_function'); // wp_ajax_{ACTION HERE}
add_action('wp_ajax_nopriv_myfilter', 'misha_filter_function');

function misha_filter_function(){
	if ($_POST['date_range'] != 'notfill') {
		$ajax_date = $_POST['date_range'];
	}
	if ($_POST['type_news'] != 'notfill') {
		$ajax_type = $_POST['type_news'];
	}
	if ($_POST['categoryfilter'] != 'notfill') {
		$ajax_cat = $_POST['categoryfilter'];
	}
	if (isset($ajax_date) && isset($ajax_type) && isset($ajax_cat)) {
		$args = array(
			'ignore_sticky_posts' => 1,
			'posts_per_page' => 7,
			'date_query' => array(
				array(
					'after' => $ajax_date,
				),
			),
			'tax_query' => [
				'relation' => 'AND',
				[
					'taxonomy' => 'category',
					'field'    => 'id',
					'terms'    => $ajax_type,
				],
				[
					'taxonomy' => 'category',
					'field'    => 'id',
					'terms'    => $ajax_cat,
				]
			],

		);
	} elseif (isset($ajax_date) && !isset($ajax_type) && !isset($ajax_cat)) {
		$args = array(
			'ignore_sticky_posts' => 1,
			'posts_per_page' => 7,
			'date_query' => array(
				array(
					'after' => $ajax_date,
				),
			),
		);
	} elseif (!isset($ajax_date) && isset($ajax_type) && !isset($ajax_cat)) {
		$args = array(
			'ignore_sticky_posts' => 1,
			'posts_per_page' => 7,
			'cat' => $ajax_type
		);
	} elseif (!isset($ajax_date) && !isset($ajax_type) && isset($ajax_cat)) {
		$args = array(
			'ignore_sticky_posts' => 1,
			'posts_per_page' => 7,
			'cat' => $ajax_cat
		);
	} elseif (isset($ajax_date) && isset($ajax_type) && !isset($ajax_cat)) {
		$args = array(
			'ignore_sticky_posts' => 1,
			'posts_per_page' => 7,
			'cat' => $ajax_type,
			'date_query' => array(
				array(
					'after' => $ajax_date,
				),
			),
		);
	} elseif (isset($ajax_date) && !isset($ajax_type) && isset($ajax_cat)) {
		$args = array(
			'ignore_sticky_posts' => 1,
			'posts_per_page' => 7,
			'cat' => $ajax_cat,
			'date_query' => array(
				array(
					'after' => $ajax_date,
				),
			),
		);
	} elseif (!isset($ajax_date) && isset($ajax_type) && isset($ajax_cat)) {
		$args = array(
			'ignore_sticky_posts' => 1,
			'posts_per_page' => 7,
			'tax_query' => [
				'relation' => 'AND',
				[
					'taxonomy' => 'category',
					'field'    => 'id',
					'terms'    => $ajax_type,
				],
				[
					'taxonomy' => 'category',
					'field'    => 'id',
					'terms'    => $ajax_cat,
				]
			],
		);
	}


	$query = new WP_Query( $args );

	if( $query->have_posts() ) :
		while( $query->have_posts() ): $query->the_post(); ?>
			<div class="news-row">
				<div class="news-row__icon">
					<?php if ( ( $video_thumbnail = get_video_thumbnail() ) != null ) {
						echo '<img src="/wp-content/themes/newsfront/img/icon-video.png" alt="">';
					} else {
						echo '<img src="/wp-content/themes/newsfront/img/icon-document2.png" alt="">';
					} ?>
				</div>
				<div class="news-row__content">
					<a href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
					</a>
					<div class="news-row__bottom">
						<span class="date-style date-style--s12"><?php the_time('d.m.Y, H:i'); ?></span>
					</div>
				</div>
			</div>
		<?php
		endwhile;
		wp_reset_postdata();
	else :
		echo 'No posts found';
	endif;

	die();
}

add_action('wp_ajax_myfilter_cat', 'misha_filter_function_cat'); // wp_ajax_{ACTION HERE}
add_action('wp_ajax_nopriv_myfilter_cat', 'misha_filter_function_cat');

function misha_filter_function_cat(){
	$ajax_current_cat = $_POST['curr_term_filter'];
	if ($_POST['date_range_cat'] != 'notfill') {
		$ajax_date = $_POST['date_range_cat'];
	}
	if ($_POST['type_news_cat'] != 'notfill') {
		$ajax_type = $_POST['type_news_cat'];
	}
	if (isset($ajax_date) && !isset($ajax_type)) {
		$args = array(
			'cat' => $ajax_current_cat,
			'ignore_sticky_posts' => 1,
			'posts_per_page' => 9,
			'date_query' => array(
				array(
					'after' => $ajax_date,
				),
			),
		);
	} elseif (!isset($ajax_date) && isset($ajax_type)) {
		$args = array(
			'ignore_sticky_posts' => 1,
			'posts_per_page' => 9,
			'tax_query' => [
				'relation' => 'AND',
				[
					'taxonomy' => 'category',
					'field'    => 'id',
					'terms'    => $ajax_current_cat,
				],
				[
					'taxonomy' => 'category',
					'field'    => 'id',
					'terms'    => $ajax_type,
				]
			],
		);
	} elseif (isset($ajax_date) && isset($ajax_type)) {
		$args = array(
			'ignore_sticky_posts' => 1,
			'posts_per_page' => 9,
			'date_query' => array(
				array(
					'after' => $ajax_date,
				),
			),
			'tax_query' => [
				'relation' => 'AND',
				[
					'taxonomy' => 'category',
					'field'    => 'id',
					'terms'    => $ajax_current_cat,
				],
				[
					'taxonomy' => 'category',
					'field'    => 'id',
					'terms'    => $ajax_type,
				]
			],
		);
	}


	$query = new WP_Query( $args );

	if( $query->have_posts() ) : ?>
        <div class="articles-list articles-list--mb10 articles-list--mobile-table">
        <?php
		while( $query->have_posts() ): $query->the_post(); ?>
            <div class="article-link <?php if ( ( $video_thumbnail = get_video_thumbnail() ) != null ) { echo 'article-link--video'; } ?>">
                <a href="<?php the_permalink(); ?>" class="article-link__img">

					<?php if ( ( $video_thumbnail = get_video_thumbnail() ) != null ) {
						echo "<img src='" . $video_thumbnail . "' />"; ?>
                        <span class="video-yt-icon video-yt-icon--big">
								<svg viewBox="0 0 100 100" class="icon">
									<use xlink:href="#icon-yt2"></use>
								</svg>
							</span>
						<?php
					} else {
						echo "<img src='" . first_img() . "' />";
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
								<?php the_time('d.m.Y, H:i'); ?>
							</span>
                </div>
            </div>
		<?php
		endwhile;
		wp_reset_postdata();
	else :
		echo 'No posts found'; ?>
        </div>
    <?php
	endif;

	die();
}
function wpschool_disable_srcset( $sources ) {
	return false;
}
add_filter( 'wp_calculate_image_srcset', 'wpschool_disable_srcset' );


add_action('wp_ajax_myfilter_video', 'misha_filter_function_video'); // wp_ajax_{ACTION HERE} 
add_action('wp_ajax_nopriv_myfilter_video', 'misha_filter_function_video');
 
function misha_filter_function_video(){
	$args = array(
		'orderby' => 'date', // we will sort posts by date
		'cat'	=> 2100,
		'offset'=> $_POST['offset'],
		'posts_per_page' => 12
	);
	
 
	$query = new WP_Query( $args );
 
	if( $query->have_posts() ) : ?>
	<?php
		while( $query->have_posts() ): $query->the_post(); ?>
            <div class="article-link">
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
		endwhile;?>
<?php
		wp_reset_postdata();
	else :
		echo 'No posts found';
	endif;
 
	die();
}

## Отключаем стили, скрипты плагина везде кроме страницы contacts
add_action('wp_print_styles', 'my_deregister_javascript', 100 );
function my_deregister_javascript(){
	if( ! is_page (144) ){
		wp_deregister_script( 'contact-form-7' ); // отключаем скрипты плагина
		wp_deregister_style( 'contact-form-7' ); // отключаем стили плагина
	}
}

/**
 * Добавить свой класс к post_class().
 *
 * @author mikhail@kobzarev.com
 */
add_filter(
	'post_class',
	function ( $classes ) {
		$classes[] = 'article';

		return $classes;
	}
);

if( !function_exists('post_count_on_archive') ):
	function post_count_on_archive( $query ) {
		if ($query->is_search()) {
			$query->set( 'posts_per_page', '100' );
		}
	}
	add_action( 'pre_get_posts', 'post_count_on_archive' );
endif;

function create_meta_desc() {
	global $post;
	if (!is_single()) { return; }
	$meta = strip_tags($post->post_content);
	$meta = strip_shortcodes($post->post_content);
	$meta = str_replace(array("\n", "\r", "\t"), ' ', $meta);
	$meta = substr($meta, 0, 125);
	echo "<meta name='description' content='$meta' />";
}
add_action('wp_head', 'create_meta_desc');