<?php

// Exit if accessed directly
if (!defined('ABSPATH')) {
	exit;
}
function enqueue_styles()
{
	wp_enqueue_style('go-style', get_stylesheet_uri());
	wp_enqueue_style('go-custome-style', get_template_directory_uri() . '/src/css/go-main.min.css');
	if (is_shop() || is_product_category() || is_tax('collection')) {
		wp_enqueue_style('go-swipeer_css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
	}
	if (is_page_template('teplate-bundler.php') || is_post_type_archive('inspiracje')) {
		// bundler i inspiracje
		wp_enqueue_style('go-swipeer_css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
	}
}
add_action('wp_enqueue_scripts', 'enqueue_styles');
