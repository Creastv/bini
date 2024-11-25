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

	// wp_enqueue_script('go-isotope_js', 'https://cdn.jsdelivr.net/npm/isotope-masonry-horizontal@2.0.1/masonry-horizontal.min.js',  array(), '20130456', true);
	// wp_enqueue_script('go-isotope_init_js', get_template_directory_uri() . '/src/js/mansonary-init.js',  array(), '20130456', true);
}

add_action('wp_enqueue_scripts', 'enqueue_scripts');


function enqueue_masonry_scripts()
{
	// Załaduj Masonry
	wp_enqueue_script(
		'masonry-cdn',
		'https://cdnjs.cloudflare.com/ajax/libs/masonry/4.2.2/masonry.pkgd.min.js',
		array('jquery'),
		'4.2.2',
		true
	);

	// Załaduj własny skrypt
	wp_enqueue_script(
		'masonry-init',
		get_template_directory_uri() . '/src/js/masonry-init.js',
		array('masonry-cdn', 'jquery'),
		null,
		true
	);

	// Przekaż dane PHP do JavaScript
	wp_localize_script('masonry-init', 'ajaxData', array(
		'ajaxUrl' => admin_url('admin-ajax.php'), // Ścieżka do admin-ajax.php
	));
}
add_action('wp_enqueue_scripts', 'enqueue_masonry_scripts');
