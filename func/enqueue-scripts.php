<?php

// Exit if accessed directly
if (!defined('ABSPATH')) {
	exit;
}

function enqueue_scripts()
{
	wp_enqueue_script('go-main', get_template_directory_uri() . '/src/js/go-main.js', array('jquery'), '3', true);
	if (is_shop() || is_tax('collection')) {
		wp_enqueue_script('go-swiper_js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',  array(), '20130456', true);
		wp_enqueue_script('go-related', get_template_directory_uri() . '/src/js/go-releted-cat.js', array('jquery'), '3', true);
	}
	if (is_product_category()) {
		wp_enqueue_script('go-swiper_js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',  array(), '20130456', true);
		wp_enqueue_script('go-related', get_template_directory_uri() . '/src/js/go-releted-coll.js', array('jquery'), '3', true);
	}
	// bundler
	if (is_page_template('teplate-bundler.php')) {
		wp_enqueue_script('go-swiper_js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',  array(), '20130456', true);
		wp_enqueue_script('go-bundler_js', get_template_directory_uri() . '/src/js/go-bundler.js',  array(), '20130456', true);
	}
	// Stringi w bundler js
	$translations = [
		'selectProduct' => __('Wybierz produkt', 'go'), // Tłumaczenie
		'zl' => __('zł', 'go'),
		'przejdzDoZamowienia' => __('Przejdź do zamówienia', 'go'),
		'przetwarzanie' => __('Przetwarzanie...', 'go'),
	];
	// Przekaż dane do JavaScript
	wp_localize_script('go-bundler_js', 'wpmlStrings', $translations);

	if (is_post_type_archive('inspiracje')) {
		// swiper
		wp_enqueue_script('go-swiper_js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',  array(), '20130456', true);
		// Załaduj Masonry
		wp_enqueue_script('masonry-cdn', 'https://cdnjs.cloudflare.com/ajax/libs/masonry/4.2.2/masonry.pkgd.min.js', array('jquery'), '4.2.2', true);

		// Załaduj własny skrypt
		wp_enqueue_script('go-inspirations', get_template_directory_uri() . '/src/js/go-inspirations.js', array('masonry-cdn', 'jquery'), null, true);

		// Przekaż dane PHP do JavaScript
		wp_localize_script('go-inspirations', 'ajaxData', array('ajaxUrl' => admin_url('admin-ajax.php'),));
	}
}

add_action('wp_enqueue_scripts', 'enqueue_scripts');
