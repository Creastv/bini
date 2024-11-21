<?php
/////////////////////////////////////////////Filter Kolekcja
// Dodaj filtr obok sortowania
add_action('woocommerce_before_shop_loop', 'add_kolekcja_filter_next_to_sorting', 20);

function add_kolekcja_filter_next_to_sorting()
{
    // Sprawdzenie, czy jesteśmy na stronie sklepu lub kategorii produktów
    if (is_shop() || is_product_category()) {
        // Pobierz dostępne terminy w taksonomii 'marka'
        $terms = get_terms(array(
            'taxonomy' => 'kolekcja', // Nasza niestandardowa taksonomia
            'orderby' => 'name',
            'order' => 'ASC',
        ));

        // Jeśli są terminy (marki), wyświetl filtr
        if ($terms && !is_wp_error($terms)) {
            echo '<div class="kolekcja-filter-wrap" style="display: inline-block; margin-left: 20px;">';
            echo '<form method="GET" action="' . esc_url(home_url('/sklep/')) . '" id="kolekcja-filter-form">';
            echo '<select name="kolekcja_filter" class="kolekcja-filter-dropdown">';
            echo '<option value="">Wybierz markę</option>';

            // Dodaj opcje dla każdego terminu
            foreach ($terms as $term) {
                $selected = (isset($_GET['kolekcja_filter']) && $_GET['kolekcja_filter'] == $term->slug) ? 'selected' : '';
                echo '<option value="' . esc_attr($term->slug) . '" ' . $selected . '>' . esc_html($term->name) . '</option>
            ';
            }

            echo '</select>';
            echo '</form>';
            echo '</div>';
        }
    }
}


// Modyfikowanie zapytania produktów na podstawie wybranej marki
// Dodajemy JavaScript do automatycznego wysyłania formularza po zmianie w select
add_action('wp_footer', 'add_kolekcja_filter_script', 20);

function add_kolekcja_filter_script()
{
    // Sprawdzamy, czy jesteśmy na stronie sklepu lub kategorii
    if (is_shop() || is_product_category()) {
?>
        <script type="text/javascript">
            // Nasłuchujemy zmiany w select (filtrze marek)
            jQuery(document).ready(function($) {
                $('.kolekcja-filter-dropdown').change(function() {
                    // Przesyłamy formularz po zmianie wartości
                    $('#kolekcja-filter-form').submit();
                });
            });
        </script>
    <?php
    }
}


////////////////////////////////////////////Filtracja po atrybucie Kolor

add_action('add_color_filter_dropdown', 'display_color_filter_dropdown');

function display_color_filter_dropdown()
{
    // Pobieramy dostępne terminy atrybutu 'pa_color'
    $taxonomy = 'pa_color'; // Upewnij się, że używasz poprawnej nazwy taksonomii (np. 'pa_color' dla koloru)
    $terms = get_terms(array(
        'taxonomy'   => $taxonomy,
        'orderby'    => 'name',
        'order'      => 'ASC',
        'hide_empty' => true, // Ukryj terminy, które nie są przypisane do żadnych produktów
    ));

    // Sprawdzamy, czy mamy jakieś terminy
    if (! empty($terms) && ! is_wp_error($terms)) :
    ?>
        <form method="GET" action="<?php echo esc_url(home_url('/sklep/')); ?>" class="color-filter-form">
            <select name="filter_color" class="color-filter-dropdown" onchange="this.form.submit()">
                <option value=""><?php _e('Wybierz kolor', 'go'); ?></option>
                <?php foreach ($terms as $term) : ?>
                    <option value="<?php echo esc_attr($term->slug); ?>"
                        <?php echo isset($_GET['filter_color']) && $_GET['filter_color'] === $term->slug ? 'selected' : ''; ?>>
                        <?php echo esc_html($term->name); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </form>
    <?php
    endif;
}
add_action('pre_get_posts', 'filter_products_by_color');

function filter_products_by_color($query)
{
    // Sprawdzamy, czy to zapytanie główne (main query) i czy dotyczy strony sklepu WooCommerce
    if (! is_admin() && $query->is_main_query() && (is_shop() || is_product_category()) && isset($_GET['filter_color']) && ! empty($_GET['filter_color'])) {

        // Pobieramy slug wybranego koloru z parametru URL
        $color_slug = sanitize_text_field($_GET['filter_color']);

        // Dodajemy tax_query do zapytania, aby filtrować po kolorze (pa_color)
        $tax_query = array(
            array(
                'taxonomy' => 'pa_color', // Nazwa atrybutu "Kolor"
                'field'    => 'slug',
                'terms'    => $color_slug,
                'operator' => 'IN',
            ),
        );

        // Jeżeli już mamy jakieś inne tax_query (np. dla kategorii), dodajemy nasz filtr
        if (isset($query->query_vars['tax_query'])) {
            $query->query_vars['tax_query'] = array_merge($query->query_vars['tax_query'], $tax_query);
        } else {
            $query->query_vars['tax_query'] = $tax_query;
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
    if (is_shop() || is_product_category() || is_product()) {
    ?>
        <div class="custom-wrapper">
            <div class="woocommerce-filter-wrap">
                <?php
                // Display the result count
                woocommerce_result_count();

                // Display the color filter form (if you have one)
                do_action('add_color_filter_dropdown'); // Custom hook for color filter form

                // Display the ordering dropdown
                woocommerce_catalog_ordering();
                ?>
            </div>
        </div>
<?php
    }
}
add_action('woocommerce_before_shop_loop', 'wrap_elements_in_div', 5);
