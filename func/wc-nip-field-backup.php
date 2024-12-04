<?php
add_action('woocommerce_before_order_notes', 'add_invoice_checkbox_and_fields');

function add_invoice_checkbox_and_fields($checkout)
{
    echo '<div id="invoice_fields"';

    // Checkbox
    woocommerce_form_field('invoice_checkbox', [
        'type'  => 'checkbox',
        'class' => ['form-row-wide'],
        'label' => '<span> ' . __('Chcę otrzymać fakturę', 'go') . '</span>',
    ], $checkout->get_value('invoice_checkbox'));

    // Pole: nazwa firmy
    woocommerce_form_field('invoice_company_name', [
        'type'        => 'text',
        'class'       => ['form-row-first hidden-field'],
        // 'label'       => 'Nazwa firmy',
        'placeholder' => __('Nazwa firmy', 'go'),
    ], $checkout->get_value('invoice_company_name'));

    // Pole: NIP
    woocommerce_form_field('invoice_nip', [
        'type'        => 'text',
        'class'       => ['form-row-last hidden-field'],
        // 'label'       => 'NIP',
        'placeholder' => 'NIP',
    ], $checkout->get_value('invoice_nip'));

    echo '</div>';
}



// Walidacja pól
add_action('woocommerce_checkout_process', 'validate_invoice_fields');
function validate_invoice_fields()
{
    if (!empty($_POST['invoice_checkbox'])) {
        if (empty($_POST['invoice_company_name'])) {
            wc_add_notice(__('<strong>Nazwa firmy</strong> jest wymaganym polem.', 'go'), 'error');
        }
        if (empty($_POST['invoice_nip'])) {
            wc_add_notice(__('<strong>NIP</strong> jest wymaganym polem.', 'go'), 'error');
        }
    }
}

// Zapis do metadanych zamówienia
add_action('woocommerce_checkout_update_order_meta', 'save_invoice_fields');
function save_invoice_fields($order_id)
{
    if (!empty($_POST['invoice_checkbox'])) {
        update_post_meta($order_id, 'invoice_checkbox', 'tak');
        update_post_meta($order_id, 'invoice_company_name', sanitize_text_field($_POST['invoice_company_name']));
        update_post_meta($order_id, 'invoice_nip', sanitize_text_field($_POST['invoice_nip']));
    }
}



add_action('woocommerce_admin_order_data_after_billing_address', 'display_invoice_fields_in_admin', 10, 1);
function display_invoice_fields_in_admin($order)
{
    $invoice_checkbox = get_post_meta($order->get_id(), 'invoice_checkbox', true);
    $invoice_company_name = get_post_meta($order->get_id(), 'invoice_company_name', true);
    $invoice_nip = get_post_meta($order->get_id(), 'invoice_nip', true);

    if ($invoice_checkbox === 'tak') {
        echo '<li><strong>Faktura VAT:</strong> Tak</li>';
        echo '<li><strong>Nazwa firmy:</strong> ' . esc_html($invoice_company_name) . '</li>';
        echo '<li><strong>NIP:</strong> ' . esc_html($invoice_nip) . '</li>';
    }
}


add_action('wp_footer', 'add_invoice_script', 20);

function add_invoice_script()
{
    if (is_checkout()) { // Sprawdzamy, czy jesteśmy na stronie checkout
?>
        <script type="text/javascript">
            jQuery(function($) {
                $('#invoice_checkbox').change(function() {
                    if ($(this).is(':checked')) {
                        $('.hidden-field').show();
                    } else {
                        $('.hidden-field').hide();
                    }
                });
            });
        </script>
<?php
    }
}
