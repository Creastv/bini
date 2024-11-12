<?php

// Exit if accessed directly
if (!defined('ABSPATH')) {
	exit;
}
function enqueue_styles()
{
	wp_enqueue_style('go-style', get_stylesheet_uri());
	wp_enqueue_style('go-custome-style', get_template_directory_uri() . '/src/css/go-main.min.css');
}
add_action('wp_enqueue_scripts', 'enqueue_styles');
