<?php
// rejestracja zakładki Bundler z ACF
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title' => 'Bundler',
        'menu_title' => 'Bundler',
        'parent_slug' => 'themes.php',
    ));
}
// Rejestracja niestandardowej taksonomii Bundler i przypisanie jej do produktów WooCommerce
function create_bundler_taxonomy()
{
    $labels = array(
        'name'              => _x('Bundler', 'taxonomy general name'),
        'singular_name'     => _x('Bundler', 'taxonomy singular name'),
        'search_items'      => __('Search Bundler'),
        'all_items'         => __('All Bundler'),
        'parent_item'       => __('Parent Bundler'),
        'parent_item_colon' => __('Parent Bundler:'),
        'edit_item'         => __('Edit Bundler'),
        'update_item'       => __('Update Bundler'),
        'add_new_item'      => __('Add New Bundler'),
        'new_item_name'     => __('New Bundler Name'),
        'menu_name'         => __('Bundler'),
    );

    $args = array(
        'hierarchical'      => true,
        'public'            => false,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'bundler'),
    );

    register_taxonomy('bundler', array('product'), $args);
}
add_action('init', 'create_bundler_taxonomy');

// Rest APi
add_action('rest_api_init', function () {
    register_rest_route('custom-bundler/v1', '/add-to-cart', array(
        'methods' => 'POST',
        'callback' => 'custom_bundler_add_to_cart',
        'permission_callback' => '__return_true', // Brak ograniczeń dla testów
    ));
});


// Add to cart and go to checkout
function custom_bundler_add_to_cart($request)
{
    if (!class_exists('WooCommerce')) {
        return new WP_REST_Response(['success' => false, 'message' => 'WooCommerce nie jest aktywne'], 500);
    }

    if (null === WC()->session) {
        WC()->initialize_session();
    }

    if (null === WC()->cart) {
        WC()->initialize_cart();
    }

    $products = $request->get_param('products');

    if (!is_array($products) || empty($products)) {
        return new WP_REST_Response(['success' => false, 'message' => 'Nieprawidłowe dane wejściowe'], 400);
    }

    // Zapisz produkty w sesji WooCommerce
    WC()->session->set('bundler_products', $products);

    foreach ($products as $product_id) {
        if (!is_numeric($product_id) || !wc_get_product($product_id)) {
            return new WP_REST_Response(['success' => false, 'message' => "Nieprawidłowy produkt ID $product_id"], 400);
        }

        WC()->cart->add_to_cart($product_id);
    }

    return new WP_REST_Response(['success' => true, 'message' => 'Produkty dodane do koszyka'], 200);
}


// Inicializacja sesi
add_action('init', function () {
    if (class_exists('WooCommerce') && null === WC()->session) {
        WC()->initialize_session();
    }
});



add_filter('woocommerce_cart_item_quantity', 'disable_quantity_for_bundler_products', 10, 2);

function disable_quantity_for_bundler_products($product_quantity, $cart_item_key)
{
    $bundler_products = WC()->session->get('bundler_products', []);

    if (!empty($bundler_products)) {
        $cart_item = WC()->cart->get_cart()[$cart_item_key];

        if (in_array($cart_item['product_id'], $bundler_products)) {
            return $cart_item['quantity']; // Zablokuj możliwość edycji ilości
        }
    }

    return $product_quantity;
}

add_action('woocommerce_before_cart_totals', 'bundler_discount_message');

function bundler_discount_message()
{
    echo '<p style="color: green; font-weight: bold;">Rabat Bundlera dotyczy maksymalnie 3 produktów dodanych przez Bundler.</p>';
}



add_action('woocommerce_cart_item_removed', 'remove_all_bundler_products_with_notice', 10, 2);

function remove_all_bundler_products_with_notice($cart_item_key, $cart)
{
    // Pobierz produkty z bundlera z sesji
    $bundler_products = WC()->session->get('bundler_products', []);

    if (!empty($bundler_products)) {
        foreach ($cart->get_cart() as $key => $item) {
            // Usuń produkty z bundlera
            if (in_array($item['product_id'], $bundler_products)) {
                WC()->cart->remove_cart_item($key);
            }
        }

        // Usuń dane bundlera z sesji
        WC()->session->__unset('bundler_products');

        // Dodaj komunikat do sesji
        WC()->session->set('bundler_removal_notice', 'Wszystkie produkty z bundlera zostały usunięte.');
    }
}

add_action('woocommerce_before_cart', 'display_bundler_removal_notice');

function display_bundler_removal_notice()
{
    // Pobierz komunikat z sesji
    $notice = WC()->session->get('bundler_removal_notice');

    if ($notice) {
        echo '<p style="color: red; font-weight: bold;">' . esc_html($notice) . '</p>';

        // Usuń komunikat po wyświetleniu
        WC()->session->__unset('bundler_removal_notice');
    }
}

// Dodawanie Rabatu
add_action('woocommerce_cart_calculate_fees', 'apply_bundler_discount', 10, 1);

add_action('woocommerce_cart_calculate_fees', 'apply_bundler_discount', 10, 1);

function apply_bundler_discount($cart)
{
    // Sprawdź, czy koszyk istnieje
    if (!is_a($cart, 'WC_Cart')) {
        return;
    }

    if (is_admin() || !did_action('woocommerce_before_calculate_totals')) {
        return;
    }

    // Pobierz produkty z sesji
    $bundler_products = WC()->session->get('bundler_products', []);

    if (!empty($bundler_products)) {
        $bundler_total = 0;
        $counted_items = 0;

        // Przeiteruj produkty w koszyku
        foreach ($cart->get_cart() as $cart_item) {
            if (in_array($cart_item['product_id'], $bundler_products)) {
                // Dodaj produkt do sumy, jeśli nie przekroczono limitu 3 produktów
                $quantity = $cart_item['quantity'];

                for ($i = 0; $i < $quantity; $i++) {
                    if ($counted_items < 3) {
                        $bundler_total += $cart_item['line_total'] / $quantity; // Podziel total przez ilość, by naliczyć dla każdej sztuki
                        $counted_items++;
                    } else {
                        break;
                    }
                }

                // Jeśli już mamy 3 produkty, zakończ pętlę
                if ($counted_items >= 3) {
                    break;
                }
            }
        }

        // Oblicz rabat 15% dla maksymalnie 3 produktów
        $discount = $bundler_total * 0.15;

        if ($discount > 0) {
            $cart->add_fee(__('Rabat Bundlera (-15%)', 'go'), -$discount);
        }
    }
}

add_filter('woocommerce_cart_item_name', 'add_bundler_info_to_cart_item_name', 10, 3);

function add_bundler_info_to_cart_item_name($product_name, $cart_item, $cart_item_key)
{
    // Pobierz produkty z bundlera z sesji
    $bundler_products = WC()->session->get('bundler_products', []);

    // Sprawdź, czy produkt należy do bundlera
    if (!empty($bundler_products) && in_array($cart_item['product_id'], $bundler_products)) {
        $product_name .= '<p style="color: green; font-size: 0.9em;"> ' . __('Produkt dodany przez bundler', 'go') . ' </p>';
    }

    return $product_name;
}


add_action('wp_enqueue_scripts', function () {
    wp_enqueue_script('custom-script', get_template_directory_uri() . '/js/custom.js', ['jquery'], '1.0', true);

    // Pobierz bieżący język
    $current_language = apply_filters('wpml_current_language', null);

    // Przekaż język do JavaScript
    wp_localize_script('custom-script', 'wpmlSettings', [
        'currentLanguage' => $current_language
    ]);
});
