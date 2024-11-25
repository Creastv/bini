<?php
$styl = get_field('styl');
?>
<?php

$args = array(
    'taxonomy'   => 'product_cat',
    'orderby'    => 'name',
    'order'      => 'ASC',
    'hide_empty' => true, // Set to true to exclude empty categories
);

$categories = get_terms($args);
if (!empty($categories)) { ?>

    <div class="custome-category">
        <?php if ($styl == 1) { ?>
            <div class="custome-category-grid">


                <?php foreach ($categories as $category) {
                    $product_count = $category->count;
                    $img = get_field('zdjecie_wyrozniajace', $category);
                    $img2 = get_field('zdjecie_wyrozniajace_hover', $category);
                    $displpayProd = __('produkt', 'go');
                    if ($product_count >= 2 && $product_count <= 4) {
                        $displpayProd = __('produkty', 'go');
                    } elseif ($product_count >= 5) {
                        $displpayProd = __('produktów', 'go');
                    }

                ?>
                    <div class="related-cat__item">
                        <a href="<?php echo esc_url(get_term_link($category)); ?>">
                            <div class="item__images">
                                <?php if (!$img && !$img2) { ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/src/img/thumbnail.png"
                                        alt="<?php echo esc_url(get_term_link($category)); ?> ">
                                <?php } else { ?>
                                    <div class="img">
                                        <?php echo wp_get_attachment_image($img, 'category-futured'); ?>
                                    </div>
                                    <div class="img img-2">
                                        <?php echo wp_get_attachment_image($img2, 'category-futured'); ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="item__content">
                                <div class="title">
                                    <h3><?php echo esc_html($category->name); ?></h3>
                                </div>
                                <div class="info">
                                    <span> <?php echo $product_count; ?> <?php echo $displpayProd; ?></span>
                                    <span>
                                        <span><?php _e('Wszystkie produkty', 'go'); ?></span>
                                        <svg width="14" height="13" viewBox="0 0 14 13" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M14.0001 6.15212C13.9952 5.6283 13.7832 5.12749 13.4101 4.75821L9.12006 0.476906C8.9327 0.291465 8.67925 0.187378 8.41506 0.187378C8.15088 0.187378 7.89742 0.291465 7.71006 0.476906C7.61633 0.569465 7.54194 0.679585 7.49117 0.800914C7.4404 0.922244 7.41426 1.05238 7.41426 1.18382C7.41426 1.31526 7.4404 1.44539 7.49117 1.56672C7.54194 1.68805 7.61633 1.79817 7.71006 1.89073L11.0001 5.15647H1.00006C0.734845 5.15647 0.480491 5.26137 0.292954 5.44809C0.105418 5.63481 6.10352e-05 5.88806 6.10352e-05 6.15212C6.10352e-05 6.41618 0.105418 6.66943 0.292954 6.85615C0.480491 7.04287 0.734845 7.14777 1.00006 7.14777H11.0001L7.71006 10.4235C7.52176 10.6096 7.41544 10.8626 7.41451 11.1269C7.41357 11.3911 7.51808 11.6448 7.70506 11.8323C7.89204 12.0198 8.14616 12.1256 8.41153 12.1266C8.67689 12.1275 8.93176 12.0235 9.12006 11.8373L13.4101 7.55599C13.7856 7.18426 13.9978 6.67939 14.0001 6.15212V6.15212Z"
                                                fill="white" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
    </div>
<?php } else { ?>

    <div class="related-cat">
        <div class="swiper releted">
            <div class="swiper-wrapper">
                <?php foreach ($categories as $category) {
                    $product_count = $category->count;
                    $img = get_field('zdjecie_wyrozniajace', $category);
                    $img2 = get_field('zdjecie_wyrozniajace_hover', $category);
                    $displpayProd = __('produkt', 'go');
                    if ($product_count >= 2 && $product_count <= 4) {
                        $displpayProd = __('produkty', 'go');
                    } elseif ($product_count >= 5) {
                        $displpayProd = __('produktów', 'go');
                    }

                ?>
                    <div class="swiper-slide">
                        <div class="related-cat__item">
                            <a href="<?php echo esc_url(get_term_link($category)); ?>">
                                <div class="item__images">
                                    <?php if (!$img && !$img2) { ?>
                                        <img src="<?php echo get_template_directory_uri(); ?>/src/img/thumbnail.png"
                                            alt="<?php echo esc_url(get_term_link($category)); ?> ">
                                    <?php } else { ?>
                                        <div class="img">
                                            <?php echo wp_get_attachment_image($img, 'category-futured'); ?>
                                        </div>
                                        <div class="img img-2">
                                            <?php echo wp_get_attachment_image($img2, 'category-futured'); ?>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="item__content">
                                    <div class="title">
                                        <h3><?php echo esc_html($category->name); ?></h3>
                                    </div>
                                    <div class="info">
                                        <span> <?php echo $product_count; ?> <?php echo $displpayProd; ?></span>
                                        <span>
                                            <span><?php _e('Wszystkie produkty', 'go'); ?></span>
                                            <svg width="14" height="13" viewBox="0 0 14 13" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M14.0001 6.15212C13.9952 5.6283 13.7832 5.12749 13.4101 4.75821L9.12006 0.476906C8.9327 0.291465 8.67925 0.187378 8.41506 0.187378C8.15088 0.187378 7.89742 0.291465 7.71006 0.476906C7.61633 0.569465 7.54194 0.679585 7.49117 0.800914C7.4404 0.922244 7.41426 1.05238 7.41426 1.18382C7.41426 1.31526 7.4404 1.44539 7.49117 1.56672C7.54194 1.68805 7.61633 1.79817 7.71006 1.89073L11.0001 5.15647H1.00006C0.734845 5.15647 0.480491 5.26137 0.292954 5.44809C0.105418 5.63481 6.10352e-05 5.88806 6.10352e-05 6.15212C6.10352e-05 6.41618 0.105418 6.66943 0.292954 6.85615C0.480491 7.04287 0.734845 7.14777 1.00006 7.14777H11.0001L7.71006 10.4235C7.52176 10.6096 7.41544 10.8626 7.41451 11.1269C7.41357 11.3911 7.51808 11.6448 7.70506 11.8323C7.89204 12.0198 8.14616 12.1256 8.41153 12.1266C8.67689 12.1275 8.93176 12.0235 9.12006 11.8373L13.4101 7.55599C13.7856 7.18426 13.9978 6.67939 14.0001 6.15212V6.15212Z"
                                                    fill="white" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="swiper-pagination swiper-pagination--col"></div>
        </div>

        <div class="slider-nav">
            <div class="slider-nav__prev">
                <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="0.5" y="0.5" width="49" height="49" rx="24.5" stroke="#b3cce6" />
                    <path
                        d="M39.583 22.9166H18.7497L25.6101 16.0562L22.6642 13.1104L13.7205 22.0541C12.9394 22.8355 12.5005 23.8951 12.5005 24.9999C12.5005 26.1048 12.9394 27.1644 13.7205 27.9458L22.6642 36.8895L25.6101 33.9437L18.7497 27.0833H39.583V22.9166Z"
                        fill="#b3cce6" />
                </svg>
            </div>
            <div class="slider-nav__next">
                <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="49.5" y="49.5" width="49" height="49" rx="24.5" transform="rotate(-180 49.5 49.5)"
                        stroke="#b3cce6" />
                    <path
                        d="M10.4169 27.0834L31.2503 27.0834L24.3899 33.9438L27.3357 36.8896L36.2794 27.9459C37.0606 27.1645 37.4994 26.1049 37.4994 25.0001C37.4994 23.8952 37.0606 22.8356 36.2794 22.0542L27.3357 13.1105L24.3899 16.0563L31.2503 22.9167L10.4169 22.9167L10.4169 27.0834Z"
                        fill="#b3cce6" />
                </svg>

            </div>
        </div>

    </div>
<?php } ?>
<?php } ?>
</div>