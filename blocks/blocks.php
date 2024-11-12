<?php
function register_acf_block_types()
{
  // acf_register_block_type(array(
  //   'name'              => 'prelegenci',
  //   'title'             => __('Prelegenci - karuzela'),
  //   'render_template'   => 'blocks/prelegenci/prelegenci.php',
  //   'category'          => 'formatting',
  //   'icon' => array(
  //     'background' => '#122b4f',
  //     'foreground' => '#fff',
  //     'src' => 'ellipsis',
  //   ),
  //   'mode'            => 'preview',
  //   'keywords'          => array('Aktualności'),
  //   'supports'    => [
  //     'align'      => false,
  //     'anchor'    => false,
  //     'customClassName'  => true,
  //     'jsx'       => true,
  //   ],
  //   'enqueue_assets'    => function () {
  //     wp_enqueue_style('go-prelegenci',  get_template_directory_uri() . '/blocks/prelegenci/prelegenci.min.css');
  //     wp_enqueue_style('go-swipeer_css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
  //     wp_enqueue_script('go-swiper_js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',  array(), '20130456', true);
  //     wp_enqueue_script('go-prelegenci-js', get_template_directory_uri() . '/blocks/prelegenci/prelegenci.js', array('jquery'), '20', true);
  //   },
  // ));
}
if (function_exists('acf_register_block_type')) {
  add_action('acf/init', 'register_acf_block_types');
}

add_filter('acf/settings/save_json', 'my_acf_json_save_point');

function my_acf_json_save_point($path)
{
  // Update path
  $path = get_template_directory() . '/blocks/acf-json';
  // Return path
  return $path;
}
