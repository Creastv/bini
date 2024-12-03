<?php
function load_more_inspirations()
{
    ob_start(); // Włącz buforowanie wyjścia

    if (!isset($_POST['page']) || !is_numeric($_POST['page'])) {
        wp_send_json_error('Invalid page parameter');
        wp_die();
    }

    $page = intval($_POST['page']);
    $posts_per_page = 9;
    $offset = ($page - 1) * $posts_per_page;
    $args = array(
        'post_type'      => 'inspiracje',
        'posts_per_page' => $posts_per_page,
        'paged'          => $page,
        'offset'         => $offset,
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        $html = '';
        while ($query->have_posts()) {
            $query->the_post();
            $html .= '<div class="grid-item" data-id="' . get_the_ID() . '" data-image="' . esc_url(get_the_post_thumbnail_url(null, 'full')) . '">';
            $html .= get_the_post_thumbnail(null, 'medium');
            $html .= '</div>';
        }
        wp_reset_postdata();

        ob_clean(); // Wyczyść bufor wyjścia
        wp_send_json_success(array(
            'html' => $html,
            'has_more' => $query->max_num_pages > $page,
        ));
    } else {
        ob_clean(); // Wyczyść bufor wyjścia
        wp_send_json_error('No more posts available');
    }

    wp_die();
}

add_action('wp_ajax_load_more_inspirations', 'load_more_inspirations');
add_action('wp_ajax_nopriv_load_more_inspirations', 'load_more_inspirations');



function fetch_products_for_inspiration()
{
    // Walidacja parametru "inspiration_id"
    if (!isset($_POST['inspiration_id']) || !is_numeric($_POST['inspiration_id'])) {
        wp_send_json_error('Invalid inspiration ID');
        wp_die();
    }

    $inspiration_id = intval($_POST['inspiration_id']); // ID inspiracji
    $products = get_field('products', $inspiration_id); // Pobierz produkty za pomocą ACF

    if ($products && is_array($products)) {
        $output = '';

        foreach ($products as $product) {
            $thumbnail = get_the_post_thumbnail_url($product->ID, 'thumbnail'); // Miniaturka
            $permalink = get_permalink($product->ID);                         // Link do produktu
            $title = $product->post_title;                                   // Tytuł produktu
            $price = wc_price(get_post_meta($product->ID, '_price', true));  // Cena
            $add_to_cart_url = esc_url(add_query_arg('add-to-cart', $product->ID, wc_get_cart_url()));
            $button = __('Dodaj do koszyka', 'go');

            // HTML dla każdego produktu
            $output .= "
                 <div class='swiper-slide'>
                    <div class='item'>
                    <a href='{$permalink}'>
                        <img src='{$thumbnail}' alt='{$title}'>
                        </a>
                        <div class='item__content' >
                        <p class='h5'>{$title}</p>
                         <a href='{$add_to_cart_url}' class='btn-main add-to-cart'>$button • {$price}</a>
                        </div>
                    </div>
                </div>";
        }
        // Zwróć HTML z produktami
        wp_send_json_success($output);
    } else {
        // Brak przypisanych produktów
        wp_send_json_error('No products found');
    }

    wp_die();
}
add_action('wp_ajax_fetch_products', 'fetch_products_for_inspiration');
add_action('wp_ajax_nopriv_fetch_products', 'fetch_products_for_inspiration');


if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title' => 'Opcje Inspiracji',
        'menu_title' => 'Opcje Inspiracji',
        'parent_slug' => 'edit.php?post_type=inspiracje',
    ));
}
