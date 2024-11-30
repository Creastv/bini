<?php
require get_template_directory() . '/func/wc-nip-field.php';
require get_template_directory() . '/func/wc-filters.php';
require get_template_directory() . '/func/wc-form-comments.php';
require get_template_directory() . '/func/wc-checkout.php';

add_theme_support('woocommerce');
// add_theme_support('wc-product-gallery-zoom');
add_theme_support('wc-product-gallery-lightbox');
add_theme_support('wc-product-gallery-slider');

add_filter('wc_add_to_cart_message_html', '__return_null');
remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10);

// Stars
add_filter('woocommerce_product_get_rating_html', 'add_text_near_rating_stars', 10, 3);

function add_text_near_rating_stars($html, $rating, $count)
{
    // Sprawdź, czy produkt ma ocenę
    if ($rating > 0) {
        // Dodaj tekst "Oceniono X na 5" po gwiazdkach
        $text = '<span class="custom-rating-text">' . number_format($rating, 2) . ' (5)</span>';
        $html .= $text;
    }

    return $html;
}

// Quantity
add_action('wp_footer', 'custom_quantity_fields_script', 0);
function custom_quantity_fields_script()
{
?>
    <script type='text/javascript'>
        jQuery(function($) {
            // Dodajemy przyciski + i - obok pola ilości
            $('.quantity').each(function() {
                var $quantity = $(this);
                if ($quantity.find('.plus, .minus').length === 0) {
                    // Dodajemy przyciski, jeśli jeszcze ich nie ma
                    $quantity.prepend('<button type="button" class="minus">-</button>');
                    $quantity.append('<button type="button" class="plus">+</button>');
                }
            });

            // Funkcja obsługująca kliknięcie na przyciski plus i minus
            $(document.body).on('click', '.plus, .minus', function() {
                var $qty = $(this).closest('.quantity').find('.qty'),
                    currentVal = parseFloat($qty.val()),
                    max = parseFloat($qty.attr('max')),
                    min = parseFloat($qty.attr('min')),
                    step = parseFloat($qty.attr('step'));

                // Domyślne wartości
                if (isNaN(currentVal) || currentVal <= 0) currentVal = 0;
                if (isNaN(max)) max = ''; // Brak maksymalnej ilości
                if (isNaN(min)) min = 1; // Minimalna ilość to 1
                if (isNaN(step) || step <= 0) step = 1; // Domyślny krok to 1

                // Funkcja do obliczania liczby miejsc po przecinku
                function getDecimals(num) {
                    var match = ('' + num).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
                    if (!match) {
                        return 0;
                    }
                    return Math.max(0, (match[1] ? match[1].length : 0) - (match[2] ? +match[2] : 0));
                }

                // Zwiększanie ilości po kliknięciu "plus"
                if ($(this).is('.plus')) {
                    if (max && (currentVal >= max)) {
                        $qty.val(max);
                    } else {
                        $qty.val((currentVal + step).toFixed(getDecimals(step)));
                    }
                }
                // Zmniejszanie ilości po kliknięciu "minus"
                else {
                    if (min && (currentVal <= min)) {
                        $qty.val(min);
                    } else if (currentVal > 0) {
                        $qty.val((currentVal - step).toFixed(getDecimals(step)));
                    }
                }

                // Wyzwalanie zmiany
                $qty.trigger('change');
            });
        });
    </script>
<?php
}

// Disable new WooCommerce product template (from Version 7.7.0)
function restored_reset_product_template($post_type_args)
{
    if (array_key_exists('template', $post_type_args)) {
        unset($post_type_args['template']);
    }
    return $post_type_args;
}
// add_filter('woocommerce_register_post_type_product', 'restored_reset_product_template');

// Enable Gutenberg editor for WooCommerce
function restored_activate_gutenberg_product($can_edit, $post_type)
{
    if ($post_type == 'product') {
        $can_edit = true;
    }
    return $can_edit;
}

add_filter('use_block_editor_for_post_type', 'restored_activate_gutenberg_product', 10, 2);


// Enable taxonomy fields for woocommerce with gutenberg on
function restored_enable_taxonomy_rest($args)
{
    $args['show_in_rest'] = true;
    return $args;
}
add_filter('woocommerce_taxonomy_args_product_cat', 'restored_enable_taxonomy_rest');
add_filter('woocommerce_taxonomy_args_product_tag', 'restored_enable_taxonomy_rest');



// Dodanie sekcji do strony produktu
function add_tabs_section()
{
    get_template_part('templates-parts/woocommerce/product', 'tabs');
}
add_action('woocommerce_single_product_summary', 'add_tabs_section', 40);

// function add_custome_sections()
// {
//     echo '<div class="custome-product-sections">';
//     get_template_part('templates-parts/woocommerce/product', 'dimension');
//     get_template_part('templates-parts/woocommerce/product', 'bullets');
//     get_template_part('templates-parts/woocommerce/product', 'opinions');
//     get_template_part('templates-parts/woocommerce/product', '2columns');
//     echo '</div>';
// }
// add_action('woocommerce_after_single_product_summary', 'add_custome_sections', 40);

// Usuwa wyświetlanie krótkiego opisu na stronie produktu
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);


// Usuwa tekst 'In Stock' z wyświetlania
add_filter('woocommerce_get_availability', 'remove_in_stock_text', 10, 2);
function remove_in_stock_text($availability, $product)
{
    if ($product->is_in_stock()) {
        $availability = ''; // Zastępuje 'In Stock' pustym ciągiem
    }
    return $availability;
}

// Usunięcie tabów
add_filter('woocommerce_product_tabs', 'remove_product_tabs', 98);

function remove_product_tabs($tabs)
{
    // Usuń wszystkie zakładki
    unset($tabs['description']);  // Opis
    unset($tabs['reviews']);      // Opinie
    unset($tabs['additional_information']); // Dodatkowe informacje

    return $tabs;
}

// Dodanie etykietki przed tytułem produktu
function add_product_labels()
{
    global $product; // Używamy globalnego obiektu produktu


    echo '<div class="labels-product">';
    // Dodanie etykiety "Best Seller" tylko jeśli produkt ma odpowiedni tag
    if (has_term('nowosc', 'product_tag', get_the_ID()) || has_term('new', 'product_tag', get_the_ID())) {
        echo '<span class="labels-sale new-label">' . __('Nowość', 'go') . ' </span>';
    }
    // Dodanie etykiety "Nowość" tylko jeśli produkt ma odpowiedni tag
    if (has_term('bestseller', 'product_tag', get_the_ID())) {
        echo '<span class="labels-sale best-seller-label">Bestseller</span>';
    }
    // Dodanie etykiety "Flash Sale" jeśli produkt jest w promocji
    if ($product->is_on_sale()) {
        echo '<span class="labels-sale flash-sale-label">Sale</span>';
    }
    echo '</div>'; // Zamykanie div.labels
}

// Wywołanie tej funkcji przed tytułem produktu
add_action('woocommerce_single_product_summary', 'add_product_labels', 1);

// Produkt Archive page
add_filter('woocommerce_sale_flash', '__return_false');
// Usuń oceny gwiazdkowe z produktów na stronie sklepu (archiwum, kategorie)
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);

add_action('woocommerce_before_shop_loop_item_title', 'remove_product_thumbnail_from_archive', 1);

function remove_product_thumbnail_from_archive()
{
    remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail');
}
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

add_action('woocommerce_before_shop_loop_item_title', 'add_on_hover_shop_loop_image');

function add_on_hover_shop_loop_image()
{
    global $product;

    echo '<div class="product-thumbnails">';
    echo '<div class="labels">';
    // Dodanie etykiety "Best Seller" tylko jeśli produkt ma odpowiedni tag
    if (has_term('nowosc', 'product_tag', get_the_ID()) || has_term('new', 'product_tag', get_the_ID())) {
        echo '<span class="labels-sale new-label"> ' . __('Nowość', 'go') . ' </span>';
    }
    // Dodanie etykiety "Nowość" tylko jeśli produkt ma odpowiedni tag
    if (has_term('bestseller', 'product_tag', get_the_ID())) {
        echo '<span class="labels-sale best-seller-label">Bestseller</span>';
    }
    // Dodanie etykiety "Flash Sale" jeśli produkt jest w promocji
    if ($product->is_on_sale()) {
        echo '<span class="labels-sale flash-sale-label">Sale</span>';
    }
    echo '</div>';

    // Pobranie pierwszego obrazu galerii
    $image_id = '';
    if ($product->get_gallery_image_ids()) {
        $image_id = $product->get_gallery_image_ids()[0]; // Pierwszy obrazek z galerii
    }

    // Wyświetlenie głównego obrazka produktu
    echo '<div class="img">';
    if (has_post_thumbnail(get_the_ID())) {
        echo wp_get_attachment_image($product->get_image_id(), 'medium', get_the_ID());
    } else {
        echo '<img src="' . get_template_directory_uri() . '/src/img/thumbnail.png" alt="">'; // Domyślny obrazek
    }
    echo '</div>';

    // Wyświetlenie drugiego obrazka z galerii (jeśli istnieje)
    echo '<div class="img-2">';
    if ($image_id) {
        echo wp_get_attachment_image($image_id, 'woocommerce_thumbnail');
    } else {
        echo '<img src="' . get_template_directory_uri() . '/src/img/thumbnail.png" alt="">'; // Domyślny obrazek
    }
    echo '</div>';

    // Szybki podgląd i przycisk "Dodaj do koszyka"
    echo '<div class="quick-view">';
    echo woocommerce_template_loop_add_to_cart(); // Przycisk dodania do koszyka
    echo '</div>';

    echo '</div>'; // Zamykanie div.product-thumbnails
}

// add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 15);

/**
 * Filer WooCommerce Flexslider options - Add Navigation Arrows
 */
function sf_update_woo_flexslider_options($options)
{
    $options['directionNav'] = true;
    $options['prevText'] = '<svg class="flex-nav-prev" width="50" height="50" viewBox="0 0 50 50" fill="none"
    xmlns="http://www.w3.org/2000/svg">
    <rect x="0.5" y="0.5" width="49" height="49" rx="24.5" stroke="#E1E1E1" />
    <path
        d="M39.5829 22.9165H18.7496L25.61 16.0561L22.6642 13.1103L13.7204 22.054C12.9393 22.8354 12.5005 23.895 12.5005 24.9999C12.5005 26.1047 12.9393 27.1643 13.7204 27.9457L22.6642 36.8895L25.61 33.9436L18.7496 27.0832H39.5829V22.9165Z"
        fill="#E1E1E1" />
</svg>
';
    $options['nextText'] = '<svg class="flex-nav-next" width="50" height="50" viewBox="0 0 50 50" fill="none"
    xmlns="http://www.w3.org/2000/svg">
    <rect x="49.5" y="49.5" width="49" height="49" rx="24.5" transform="rotate(-180 49.5 49.5)" stroke="#E1E1E1" />
    <path
        d="M10.4171 27.0834L31.2504 27.0835L24.39 33.9439L27.3358 36.8897L36.2796 27.946C37.0607 27.1646 37.4995 26.105 37.4995 25.0001C37.4995 23.8953 37.0607 22.8357 36.2796 22.0543L27.3358 13.1105L24.39 16.0564L31.2504 22.9168L10.4171 22.9168L10.4171 27.0834Z"
        fill="#E1E1E1" />
</svg>
';
    return $options;
}
add_filter('woocommerce_single_product_carousel_options', 'sf_update_woo_flexslider_options');

// Zmiana tytułu głównej strony na niestandardowy tekst
add_filter('woocommerce_get_breadcrumb', 'custom_woocommerce_breadcrumb', 10, 2);

function custom_woocommerce_breadcrumb($crumbs, $breadcrumb)
{
    $crumbs[0][0] = 'BINI';
    return $crumbs;
}


add_filter('woocommerce_pagination_args', 'custom_pagination_text');

function custom_pagination_text($args)
{
    $args['prev_text'] =  __('← Poprzednia', 'go'); // Tekst dla przycisku poprzedniej strony
    $args['next_text'] = __('Następna →', 'go'); // Tekst dla przycisku następnej strony
    return $args;
}

// add_action('woocommerce_before_shop_loop', 'display_color_and_size_filter_dropdown', 20);

// Add a custom section to the shop page
add_action('woocommerce_after_shop_loop', 'custom_shop_section', 15);

function custom_shop_section()
{
    if (is_shop()) {
        get_template_part('templates-parts/woocommerce/category');
    } elseif (is_product_category()) {
        get_template_part('templates-parts/woocommerce/collections');
    } else {
        get_template_part('templates-parts/woocommerce/category');
    }
}



function enqueue_custom_sort_select2_script()
{
    if (is_shop() || is_product_taxonomy()) {
        wp_enqueue_script('custom-sort-select2', get_template_directory_uri() . '/src/js/custom-sort-select2.js', array('jquery', 'select2'), '1.0', true);
        wp_enqueue_style('select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css', array(), '4.0.13');
    }
}
add_action('wp_enqueue_scripts', 'enqueue_custom_sort_select2_script');
