<?php
$descBefore = get_field('opis_nad_tabami');
$firstTab = get_field('wybrane_produkty_-_pierwszy_tab');
?>


<div class="product-accordion">
    <?php if ($descBefore) : ?>
        <?php if ($descBefore['tytul']) : ?>
            <h2 class="h5"><?php echo $descBefore['tytul']; ?></h2>
        <?php endif; ?>
        <?php if ($descBefore['opis']) : ?>
            <?php echo $descBefore['opis']; ?>
        <?php endif; ?>
    <?php endif; ?>



    <div class="custom-accordions">
        <?php if ($firstTab) : ?>
            <div class="accordion-item">
                <div class="accordion-title active" data-accordion="accordion-product">
                    <?php if ($firstTab['tytul']) : ?>
                        <p class="h6"><?php echo $firstTab['tytul']; ?></p>
                        <svg width="12" height="13" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9.35491 4.60499C9.30843 4.55813 9.25313 4.52093 9.1922 4.49555C9.13127 4.47016 9.06591 4.45709 8.99991 4.45709C8.9339 4.45709 8.86855 4.47016 8.80762 4.49555C8.74669 4.52093 8.69139 4.55813 8.64491 4.60499L6.35491 6.89499C6.30843 6.94185 6.25313 6.97905 6.1922 7.00443C6.13127 7.02982 6.06591 7.04289 5.99991 7.04289C5.9339 7.04289 5.86855 7.02982 5.80762 7.00443C5.74669 6.97905 5.69139 6.94185 5.64491 6.89499L3.35491 4.60499C3.30843 4.55813 3.25313 4.52093 3.1922 4.49555C3.13127 4.47016 3.06591 4.45709 2.99991 4.45709C2.9339 4.45709 2.86855 4.47016 2.80762 4.49555C2.74669 4.52093 2.69139 4.55813 2.64491 4.60499C2.55178 4.69867 2.49951 4.8254 2.49951 4.95749C2.49951 5.08958 2.55178 5.21631 2.64491 5.30999L4.93991 7.60499C5.22116 7.88589 5.60241 8.04366 5.99991 8.04366C6.39741 8.04366 6.77866 7.88589 7.05991 7.60499L9.35491 5.30999C9.44803 5.21631 9.50031 5.08958 9.50031 4.95749C9.50031 4.8254 9.44803 4.69867 9.35491 4.60499Z"
                                fill="black" />
                        </svg>

                    <?php endif; ?>
                </div>

                <div class="accordion-content open" id="accordion-product">

                    <?php
                    // Pobierz powiązane produkty z pola ACF
                    $related_products = $firstTab['wybrane_produkty']; // Zmień 'nazwa_pola_relationship' na nazwę Twojego pola ACF

                    if ($related_products) : ?>
                        <div class="related-products">
                            <?php foreach ($related_products as $product_id) :
                                if (get_post_type($product_id) === 'product') :
                                    $product = wc_get_product($product_id);
                                    if ($product) : ?>
                                        <div class="product-item">
                                            <?php
                                            if (has_post_thumbnail($product_id)) : ?>
                                                <div class="product-image">
                                                    <?php echo get_the_post_thumbnail($product_id, 'thumbnail'); ?>
                                                </div>
                                            <?php endif; ?>
                                            <div class="product-info">
                                                <h3 class="product-title h6"><?php echo get_the_title($product_id); ?></h3>
                                                <p><?php echo __('Kupując razem, zyskasz darmową wysyłkę.', 'go'); ?></p>
                                                <div class="product-price">
                                                    <a href="<?php echo $product->add_to_cart_url(); ?>">
                                                        <?php echo __('Dodaj do koszyka', 'go'); ?><?php echo $product->get_price_html(); ?>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                            <?php endif;
                            endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

            </div>
        <?php endif; ?>
        <?php if ($firstTab) : ?>

            <?php if (have_rows('product_tabs')): ?>
                <?php
                $i = 0;
                while (have_rows('product_tabs')): the_row();
                    $title = get_sub_field('tab_title');
                    $content = get_sub_field('tab_content');
                ?>
                    <div class="accordion-item">
                        <div class="accordion-title" data-accordion="accordion-<?php echo $i; ?>">
                            <p class="h6"><?php echo esc_html($title); ?></p>
                            <svg width="12" height="13" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M9.35491 4.60499C9.30843 4.55813 9.25313 4.52093 9.1922 4.49555C9.13127 4.47016 9.06591 4.45709 8.99991 4.45709C8.9339 4.45709 8.86855 4.47016 8.80762 4.49555C8.74669 4.52093 8.69139 4.55813 8.64491 4.60499L6.35491 6.89499C6.30843 6.94185 6.25313 6.97905 6.1922 7.00443C6.13127 7.02982 6.06591 7.04289 5.99991 7.04289C5.9339 7.04289 5.86855 7.02982 5.80762 7.00443C5.74669 6.97905 5.69139 6.94185 5.64491 6.89499L3.35491 4.60499C3.30843 4.55813 3.25313 4.52093 3.1922 4.49555C3.13127 4.47016 3.06591 4.45709 2.99991 4.45709C2.9339 4.45709 2.86855 4.47016 2.80762 4.49555C2.74669 4.52093 2.69139 4.55813 2.64491 4.60499C2.55178 4.69867 2.49951 4.8254 2.49951 4.95749C2.49951 5.08958 2.55178 5.21631 2.64491 5.30999L4.93991 7.60499C5.22116 7.88589 5.60241 8.04366 5.99991 8.04366C6.39741 8.04366 6.77866 7.88589 7.05991 7.60499L9.35491 5.30999C9.44803 5.21631 9.50031 5.08958 9.50031 4.95749C9.50031 4.8254 9.44803 4.69867 9.35491 4.60499Z"
                                    fill="black" />
                            </svg>

                        </div>
                        <div class="accordion-content" id="accordion-<?php echo $i; ?>">
                            <?php echo wp_kses_post($content); ?>
                        </div>
                    </div>
                <?php
                    $i++;
                endwhile;
                ?>

            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>