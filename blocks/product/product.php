<?php
$style = get_field('styl');
$type = get_field('wyswietlaj_produkty');
$postperpage = get_field('liczba_wyswietlanych_produktow');

if ($type == 1) {
    $cat = get_field('kategoria');
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => $postperpage,
        'tax_query' => array(array(
            'taxonomy'         => 'product_cat',
            'field'            => 'term_id', // Or 'term_id' or 'name'
            'terms'            => $cat, // A slug term
        )),
    );
} elseif ($type == 2) {
    $cat = get_field('tagu');
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => $postperpage,
        'tax_query' => array(array(
            'taxonomy'         => 'product_tag',
            'field'            => 'term_id', // Or 'term_id' or 'name'
            'terms'            => $cat, // A slug term
        )),
    );
}
?>

<div class="custome-product">
    <?php if ($style == 1) : ?>
        <?php
        $products = new WP_Query($args);
        if ($products->have_posts()) :
            echo ' <div class="swiper products-carousel woocommerce">';
            echo ' <div class="swiper-wrapper products">';

            while ($products->have_posts()) : $products->the_post();
                global $product;
                echo ' <div class="swiper-slide product">';
                get_template_part('woocommerce/content-product');
                echo '</div>';
            // Dodatkowe informacje o produkcie można dodać w podobny sposób
            endwhile;
            echo '</div>'; ?>



            <div class="slider-nav__prev slider-nav__prod__prev">
                <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="0.5" y="0.5" width="49" height="49" rx="24.5" stroke="#b3cce6" />
                    <path
                        d="M39.583 22.9166H18.7497L25.6101 16.0562L22.6642 13.1104L13.7205 22.0541C12.9394 22.8355 12.5005 23.8951 12.5005 24.9999C12.5005 26.1048 12.9394 27.1644 13.7205 27.9458L22.6642 36.8895L25.6101 33.9437L18.7497 27.0833H39.583V22.9166Z"
                        fill="#b3cce6" />
                </svg>
            </div>
            <div class="slider-nav__next slider-nav__prod__next">
                <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="49.5" y="49.5" width="49" height="49" rx="24.5" transform="rotate(-180 49.5 49.5)"
                        stroke="#b3cce6" />
                    <path
                        d="M10.4169 27.0834L31.2503 27.0834L24.3899 33.9438L27.3357 36.8896L36.2794 27.9459C37.0606 27.1645 37.4994 26.1049 37.4994 25.0001C37.4994 23.8952 37.0606 22.8356 36.2794 22.0542L27.3357 13.1105L24.3899 16.0563L31.2503 22.9167L10.4169 22.9167L10.4169 27.0834Z"
                        fill="#b3cce6" />
                </svg>

            </div>

        <?php
            echo '</div>';
            wp_reset_postdata();

        endif;
        ?>

    <?php else : ?>

        <?php
        $products = new WP_Query($args);
        if ($products->have_posts()) :
            echo '<div class="woocommerce">';
            echo '<ul class="products columns-4">';
            while ($products->have_posts()) : $products->the_post();
                global $product;
                get_template_part('woocommerce/content-product');
            // Dodatkowe informacje o produkcie można dodać w podobny sposób
            endwhile;
            echo '</ul>';
            wp_reset_postdata();
            echo '</div>';
        endif;
        ?>

    <?php endif; ?>
</div>