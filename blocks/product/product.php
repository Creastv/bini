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
            echo '</div>';
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