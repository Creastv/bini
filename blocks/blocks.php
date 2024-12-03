<?php
function register_acf_block_types()
{
  acf_register_block_type(array(
    'name'              => 'slider',
    'title'             => __('Slider '),
    'render_template'   => 'blocks/slider/slider.php',
    'category'          => 'formatting',
    'icon' => array(
      'background' => '#122b4f',
      'foreground' => '#fff',
      'src' => 'ellipsis',
    ),
    'mode'            => 'preview',
    'keywords'          => array('slider', 'hero'),
    'supports'    => [
      'align'      => false,
      'anchor'    => true,
      'customClassName'  => true,
      'jsx'       => false,
    ],
    'enqueue_assets'    => function () {
      wp_enqueue_style('go-slider',  get_template_directory_uri() . '/blocks/slider/slider.min.css');
      wp_enqueue_style('go-swipeer_css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
      wp_enqueue_script('go-swiper_js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',  array(), '20130456', true);
      wp_enqueue_script('go-slider-js', get_template_directory_uri() . '/blocks/slider/slider.js', array('jquery'), '20', true);
    },
  ));
  acf_register_block_type(array(
    'name'              => 'product',
    'title'             => __('product '),
    'render_template'   => 'blocks/product/product.php',
    'category'          => 'formatting',
    'icon' => array(
      'background' => '#122b4f',
      'foreground' => '#fff',
      'src' => 'ellipsis',
    ),
    'mode'            => 'preview',
    'keywords'          => array('product', 'hero'),
    'supports'    => [
      'align'      => false,
      'anchor'    => true,
      'customClassName'  => true,
      'jsx'       => false,
    ],
    'enqueue_assets'    => function () {
      wp_enqueue_style('go-product',  get_template_directory_uri() . '/blocks/product/product.min.css');
      wp_enqueue_style('go-swipeer_css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
      wp_enqueue_script('go-swiper_js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',  array(), '20130456', true);
      wp_enqueue_script('go-product-js', get_template_directory_uri() . '/blocks/product/product.js', array('jquery'), '20', true);
    },
  ));
  acf_register_block_type(array(
    'name'              => 'category',
    'title'             => __('category '),
    'render_template'   => 'blocks/category/category.php',
    'category'          => 'formatting',
    'icon' => array(
      'background' => '#122b4f',
      'foreground' => '#fff',
      'src' => 'ellipsis',
    ),
    'mode'            => 'preview',
    'keywords'          => array('category', 'hero'),
    'supports'    => [
      'align'      => false,
      'anchor'    => true,
      'customClassName'  => true,
      'jsx'       => false,
    ],
    'enqueue_assets'    => function () {
      wp_enqueue_style('go-category',  get_template_directory_uri() . '/blocks/category/category.min.css');
      wp_enqueue_style('go-swipeer_css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
      wp_enqueue_script('go-swiper_js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',  array(), '20130456', true);
      wp_enqueue_script('go-category-js', get_template_directory_uri() . '/blocks/category/category.js', array('jquery'), '20', true);
    },
  ));
  acf_register_block_type(array(
    'name'              => 'collections',
    'title'             => __('collections '),
    'render_template'   => 'blocks/collections/collections.php',
    'category'          => 'formatting',
    'icon' => array(
      'background' => '#122b4f',
      'foreground' => '#fff',
      'src' => 'ellipsis',
    ),
    'mode'            => 'preview',
    'keywords'          => array('collections'),
    'supports'    => [
      'align'      => false,
      'anchor'    => true,
      'customClassName'  => true,
      'jsx'       => false,
    ],
    'enqueue_assets'    => function () {
      wp_enqueue_style('go-colections',  get_template_directory_uri() . '/blocks/collections/collections.min.css');
      wp_enqueue_style('go-swipeer_css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
      wp_enqueue_script('go-swiper_js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',  array(), '20130456', true);
      wp_enqueue_script('go-collections-js', get_template_directory_uri() . '/blocks/collections/collections.js', array('jquery'), '20', true);
    },
  ));
  acf_register_block_type(array(
    'name'              => 'testimonial',
    'title'             => __('testimonial '),
    'render_template'   => 'blocks/testimonial/testimonial.php',
    'category'          => 'formatting',
    'icon' => array(
      'background' => '#122b4f',
      'foreground' => '#fff',
      'src' => 'ellipsis',
    ),
    'mode'            => 'preview',
    'keywords'          => array('testimonial', 'hero'),
    'supports'    => [
      'align'      => false,
      'anchor'    => false,
      'customClassName'  => true,
      'jsx'       => false,
    ],
    'enqueue_assets'    => function () {
      wp_enqueue_style('go-testimonial',  get_template_directory_uri() . '/blocks/testimonial/testimonial.min.css');
      wp_enqueue_style('go-swipeer_css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
      wp_enqueue_script('go-swiper_js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',  array(), '20130456', true);
      wp_enqueue_script('go-testimonial-js', get_template_directory_uri() . '/blocks/testimonial/testimonial.js', array('jquery'), '20', true);
    },
  ));
  acf_register_block_type(array(
    'name'              => 'container',
    'title'             => __('Container'),
    'render_template'   => 'blocks/container/container.php',
    'category'          => 'formatting',
    'icon' => array(
      'background' => '#122b4f',
      'foreground' => '#fff',
      'src' => 'ellipsis',
    ),
    'mode'            => 'preview',
    'keywords'          => array('Kontener', 'container'),
    'supports'    => [
      'align'      => false,
      'anchor'    => false,
      'customClassName'  => true,
      'jsx'       => true,
    ],
    'enqueue_assets'    => function () {
      wp_enqueue_style('go-container',  get_template_directory_uri() . '/blocks/container/container.min.css');
    }
  ));
  acf_register_block_type(array(
    'name'              => 'separator',
    'title'             => __('separator'),
    'render_template'   => 'blocks/separator/separator.php',
    'category'          => 'formatting',
    'icon' => array(
      'background' => '#122b4f',
      'foreground' => '#fff',
      'src' => 'ellipsis',
    ),
    'mode'            => 'preview',
    'keywords'          => array('Kontener', 'separator'),
    'supports'    => [
      'align'      => false,
      'anchor'    => true,
      'customClassName'  => true,
      'jsx'       => false,
    ],
    'enqueue_assets'    => function () {
      wp_enqueue_style('go-separator',  get_template_directory_uri() . '/blocks/separator/separator.min.css');
    }
  ));

  acf_register_block_type(array(
    'name'              => 'opinions',
    'title'             => __('opinions'),
    'render_template'   => 'blocks/opinions/opinions.php',
    'category'          => 'formatting',
    'icon' => array(
      'background' => '#122b4f',
      'foreground' => '#fff',
      'src' => 'ellipsis',
    ),
    'mode'            => 'preview',
    'keywords'          => array('Kontener', 'opinions'),
    'supports'    => [
      'align'      => false,
      'anchor'    => false,
      'customClassName'  => true,
      'jsx'       => true,
    ],
    'enqueue_assets'    => function () {
      wp_enqueue_style('go-opinions',  get_template_directory_uri() . '/blocks/opinions/opinions.min.css');
    }
  ));
  acf_register_block_type(array(
    'name'              => 'opinions-two',
    'title'             => __('Opinions two'),
    'render_template'   => 'blocks/opinions-two/opinions-two.php',
    'category'          => 'formatting',
    'icon' => array(
      'background' => '#122b4f',
      'foreground' => '#fff',
      'src' => 'ellipsis',
    ),
    'mode'            => 'preview',
    'keywords'          => array('Kontener', 'opinions-two'),
    'supports'    => [
      'align'      => false,
      'anchor'    => false,
      'customClassName'  => true,
      'jsx'       => true,
    ],
    'enqueue_assets'    => function () {
      wp_enqueue_style('go-opinions-two',  get_template_directory_uri() . '/blocks/opinions-two/opinions-two.min.css');
    }
  ));
  acf_register_block_type(array(
    'name'              => 'bullet',
    'title'             => __('bullet'),
    'render_template'   => 'blocks/bullet/bullet.php',
    'category'          => 'formatting',
    'icon' => array(
      'background' => '#122b4f',
      'foreground' => '#fff',
      'src' => 'ellipsis',
    ),
    'mode'            => 'preview',
    'keywords'          => array('Kontener', 'bullet'),
    'supports'    => [
      'align'      => false,
      'anchor'    => false,
      'customClassName'  => true,
      'jsx'       => true,
    ],
    'enqueue_assets'    => function () {
      wp_enqueue_style('go-bullet',  get_template_directory_uri() . '/blocks/bullet/bullet.min.css');
    }
  ));
  acf_register_block_type(array(
    'name'              => 'section-img',
    'title'             => __('section-img'),
    'render_template'   => 'blocks/section-img/section-img.php',
    'category'          => 'formatting',
    'icon' => array(
      'background' => '#122b4f',
      'foreground' => '#fff',
      'src' => 'ellipsis',
    ),
    'mode'            => 'preview',
    'keywords'          => array('Img', 'section-img'),
    'supports'    => [
      'align'      => false,
      'anchor'    => false,
      'customClassName'  => true,
      'jsx'       => true,
    ],
    'enqueue_assets'    => function () {
      wp_enqueue_style('go-section-img',  get_template_directory_uri() . '/blocks/section-img/section-img.min.css');
    }
  ));
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
