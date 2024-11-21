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
}

add_action('wp_enqueue_scripts', 'enqueue_scripts');
