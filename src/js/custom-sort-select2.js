jQuery(document).ready(function ($) {
    // Znajdź pole sortowania WooCommerce
    var $orderby = $('select');

    if ($orderby.length) {
        $orderby.select2({
            minimumResultsForSearch: Infinity, // Ukryj pole wyszukiwania, jeśli jest niepotrzebne
            width: 'auto' // Dostosuj szerokość
        });
    }
});