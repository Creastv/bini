<?php
// add_action('add_color_filter_dropdown', 'display_color_and_size_filter_dropdown');

add_action('add_filter_dropdown', 'display_filter_dropdown');

function display_filter_dropdown()
{
    // Filtr koloru
    $color_terms = get_terms(array(
        'taxonomy' => 'tkaniny',
        'orderby' => 'name',
        'order' => 'ASC',
        'hide_empty' => true,
    ));

    // Filtr rozmiaru
    $size_terms = get_terms(array(
        'taxonomy' => 'collection',
        'orderby' => 'name',
        'order' => 'ASC',
        'hide_empty' => true,
    ));
?>

    <form method="GET" action="<?php echo esc_url(home_url('/sklep/')); ?>" class="filter-form">
        <select name="collection" class="size-filter-dropdown" onchange="this.form.submit()">
            <option value=""><?php _e('Filtruj po kolekcji', 'go'); ?></option>
            <?php foreach ($size_terms as $term) : ?>
                <option value="<?php echo esc_attr($term->slug); ?>"
                    <?php echo isset($_GET['collection']) && $_GET['collection'] === $term->slug ? 'selected' : ''; ?>>
                    <?php echo esc_html($term->name); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <select name="tkaniny" class="color-filter-dropdown" onchange="this.form.submit()">
            <option value=""><?php _e('Filtruj po tkaninie', 'go'); ?></option>
            <?php foreach ($color_terms as $term) : ?>
                <option value="<?php echo esc_attr($term->slug); ?>"
                    <?php echo isset($_GET['tkaniny']) && $_GET['tkaniny'] === $term->slug ? 'selected' : ''; ?>>
                    <?php echo esc_html($term->name); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>
<?php
}


add_action('pre_get_posts', 'filter_products_by_color_and_size');

function filter_products_by_color_and_size($query)
{
    if (!is_admin() && $query->is_main_query() && is_shop()) {
        $tax_query = array();

        // Filtr koloru
        if (!empty($_GET['color'])) {
            $tax_query[] = array(
                'taxonomy' => 'tkaniny',
                'field'    => 'slug',
                'terms'    => sanitize_text_field($_GET['tkaniny']),
            );
        }

        // Filtr rozmiaru
        if (!empty($_GET['collection'])) {
            $tax_query[] = array(
                'taxonomy' => 'collection',
                'field'    => 'slug',
                'terms'    => sanitize_text_field($_GET['collection']),
            );
        }

        // Dodaj zapytania taksonomiczne tylko, jeśli są filtry
        if (!empty($tax_query)) {
            $query->set('tax_query', $tax_query);
        }
    }
}


// Usuń domyślne wyświetlanie liczby wyników
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);

// Usuń domyślną wyświetlanie dropdowna do sortowania
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);


// Hook to wrap .woocommerce-result-count, .color-filter-form, and .woocommerce-ordering
function wrap_elements_in_div()
{
    // Check if we're on the shop or product archive page
    // if (is_shop() || is_product_category() || is_product()) {
?>
    <div class="woocommerce-filter">
        <div class="woocommerce-filter__wrap">
            <?php
            // Display the result count
            woocommerce_result_count();
            echo '<span class="separator"></span>';

            // Display the color filter form (if you have one)
            do_action('add_filter_dropdown'); // Custom hook for color filter form

            // Display the ordering dropdown
            woocommerce_catalog_ordering();
            ?>
        </div>
    </div>
<?php
    // }
}
add_action('woocommerce_before_shop_loop', 'wrap_elements_in_div', 5);
