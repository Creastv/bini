<?php
// Zmiana formularza checkout
add_filter('woocommerce_checkout_fields', 'customize_checkout_fields');

function customize_checkout_fields($fields)
{
    // Iteracja przez wszystkie pola
    foreach ($fields as $fieldset_key => $fieldset) {
        foreach ($fieldset as $field_key => $field) {
            // Usuń etykiety
            unset($fields[$fieldset_key][$field_key]['label']);

            // Dodaj placeholdery
            $placeholder = isset($field['label']) ? $field['label'] : ''; // Użyj etykiety jako domyślnego placeholdera
            $fields[$fieldset_key][$field_key]['placeholder'] = $placeholder;
        }
    }

    $fields['billing']['billing_first_name']['priority'] = 10;
    $fields['billing']['billing_last_name']['priority'] = 20;

    $fields['billing']['billing_email']['priority'] = 30;
    $fields['billing']['billing_phone']['priority'] = 40;

    $fields['billing']['billing_country']['priority'] = 50;
    $fields['billing']['billing_city']['priority'] = 60;

    $fields['billing']['billing_address_1']['priority'] = 70;

    $fields['billing']['billing_address_2']['priority'] = 80;


    $fields['billing']['billing_postcode']['priority'] = 90;


    return $fields;
}

add_filter('woocommerce_checkout_fields', 'remove_state_field');


function remove_state_field($fields)
{
    unset($fields['billing']['billing_state']);
    unset($fields['billing']['billing_nip']);
    unset($fields['shipping']['shipping_state']);
    unset($fields['billing']['billing_company']);
    return $fields;
}


// Przekierowania
function change_cart_url_to_checkout()
{
    return wc_get_checkout_url();
}
add_filter('woocommerce_get_cart_url', 'change_cart_url_to_checkout', 10, 1);

add_action('template_redirect', function () {
    // Sprawdź, czy użytkownik jest na stronie koszyka
    if (is_cart()) {
        // Przekierowanie na stronę checkout
        wp_safe_redirect(wc_get_checkout_url());
        exit;
    }
});

add_action('template_redirect', function () {
    // Sprawdź, czy jesteś na stronie checkout
    if (is_checkout() && !is_wc_endpoint_url('order-received')) {
        // Sprawdź, czy koszyk jest pusty
        if (WC()->cart->is_empty()) {
            // Przekierowanie na stronę sklepu
            wp_safe_redirect(wc_get_page_permalink('shop'));
            exit;
        }
    }
});
