<?php

require_once get_template_directory() . '/func/enqueue-styles.php';
require_once get_template_directory() . '/func/enqueue-scripts.php';
require get_template_directory() . '/func/clean-up.php';
require get_template_directory() . '/blocks/blocks.php';
require get_template_directory() . '/func/wp-cuztomize.php';
require get_template_directory() . '/func/cpt.php';
require get_template_directory() . '/func/woocommerce.php';



add_theme_support('post-thumbnails');
add_image_size('post-futured', 600, 370, array('center', 'center'), true);
add_image_size('category-futured', 500, 500, array('center', 'center'), true);
add_image_size('collection-futured', 800, 500, array('center', 'center'), true);


if (!function_exists('go_register_nav_menu')) {
	function go_register_nav_menu()
	{
		register_nav_menus(array(
			'primary_menu' => __('Primary Menu', 'go'),
			'footer' => __('Footer', 'go'),
		));
	}
	add_action('after_setup_theme', 'go_register_nav_menu', 0);
}
function go_custom_logo_setup()
{
	$defaults = array(
		'height'               => 100,
		'width'                => 400,
		'flex-height'          => true,
		'flex-width'           => true,
		'header-text'          => array('site-title', 'site-description'),
		'unlink-homepage-logo' => true,
	);
	add_theme_support('custom-logo', $defaults);
}
add_action('after_setup_theme', 'go_custom_logo_setup');

function go_widgets_init()
{
	// register_sidebar(array(
	// 	'name'          => __('sidebar', 'go'),
	// 	'id'            => 'sidebar',
	// 	'before_widget' => '<div id="%1$s" class="calaps widget %2$s">',
	// 	'after_widget'  => '</div>',
	// 	'before_title'  => '<h4 class="h5 widget-title">',
	// 	'after_title'   => '</h4>',
	// ));

	register_sidebar(array(
		'name'          => __('footer one', 'go'),
		'id'            => 'footer-2',
		'before_widget' => '<div class="calaps">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<div class="calaps__opener"><h4 class="h5 widget-title">',
		'after_title'   => '</h4></div> <div class="calaps__list">',
	));
	register_sidebar(array(
		'name'          => __('footer two', 'go'),
		'id'            => 'footer-3',
		'before_widget' => '<div class="calaps">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<div class="calaps__opener"><h4 class="h5 widget-title">',
		'after_title'   => '</h4></div> <div class="calaps__list">',
	));
	register_sidebar(array(
		'name'          => __('footer tree', 'go'),
		'id'            => 'footer-4',
		'before_widget' => '<div class="calaps">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<div class="calaps__opener"><h4 class="h5 widget-title">',
		'after_title'   => '</h4></div> <div class="calaps__list">',
	));
}
add_action('widgets_init', 'go_widgets_init');




// Steings
// add_filter('excerpt_length', 'my_excerpt_length');

if (function_exists('acf_add_options_page')) {
	acf_add_options_page(array(
		'page_title' => 'Ustawienia szablonu',
		'menu_title' => 'Ustawienia szablonu',
		'parent_slug' => 'themes.php',
	));
}



// gutenberg editor
function add_block_editor_assets()
{
	wp_enqueue_style('block_editor_css', get_template_directory_uri() . '/src/css/go-admin.css');
}
add_action('enqueue_block_editor_assets', 'add_block_editor_assets', 10, 0);


// Paginacja
function pagination_bars()
{
	global $wp_query;

	$total_pages = $wp_query->max_num_pages;
	$big = 999999999; // need an unlikely integer
	if ($total_pages > 1) {
		$current_page = max(1, get_query_var('paged'));
		echo paginate_links(array(
			'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
			'format' => '?paged=%#%',
			'current' => $current_page,
			'total' => $total_pages,
		));
	}
}
// Excerpt changing 3 dots
function new_excerpt_more($more)
{
	// return ' <a href="' . get_permalink() . '">' . esc_attr_x('Czytaj więcej ', 'go') . ' ...  </a>';
	return ' <a href="' . get_permalink() . '"> czytaj więcej ...  </a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

// Excerpt
function wp_example_excerpt_length($length)
{
	return 20;
}

add_filter('excerpt_length', 'wp_example_excerpt_length');

// Aktualizacja produktów, dodając wzorzec o id 565
// function add_reusable_block_to_products($post_id)
// {
// 	// Upewnij się, że edytowany post to produkt
// 	if (get_post_type($post_id) !== 'product') {
// 		return;
// 	}

// 	// ID reusable block (wstaw swoje ID)
// 	$reusable_block_id = 565; // Zastąp ID wzorca

// 	// Pobierz bieżącą treść produktu
// 	$current_content = get_post_field('post_content', $post_id);

// 	// Przygotuj blok reusable block jako JSON
// 	$reusable_block = '<!-- wp:block {"ref":' . $reusable_block_id . '} /-->';

// 	// Sprawdź, czy blok już istnieje w treści
// 	if (strpos($current_content, $reusable_block) !== false) {
// 		return; // Jeśli istnieje, nie dodawaj ponownie
// 	}

// 	// Dodaj reusable block na początku treści produktu
// 	$updated_content = $reusable_block . "\n\n" . $current_content;

// 	// Zaktualizuj treść produktu
// 	wp_update_post([
// 		'ID'           => $post_id,
// 		'post_content' => $updated_content,
// 	]);
// }

// // Hook uruchamiający funkcję podczas zapisu produktu
// add_action('save_post', 'add_reusable_block_to_products');


if (function_exists('acf_add_options_page')) {
	acf_add_options_page(array(
		'page_title' => 'Mega menu',
		'menu_title' => 'Mega menu',
		'parent_slug' => 'themes.php',
	));
}
