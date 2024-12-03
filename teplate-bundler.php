<?php
/* Template Name: Product Bundler */
get_header();

$catOne = get_field('pierwsza_kategoria', 'options');
$catTwo = get_field('druga_kategoria', 'options');
$catTree = get_field('trzecia_kategoria', 'options');
if ($catOne) :
    $argsOne = [
        'post_type' => 'product',
        'posts_per_page' => -1,
        'tax_query' => [
            [
                'taxonomy' => 'bundler',
                'field'    => 'id',
                'terms'    => $catOne,
            ],
        ],
    ];
    $queryOne = new WP_Query($argsOne);
endif;
if ($catTwo) :
    $argsTwo = [
        'post_type' => 'product',
        'posts_per_page' => -1,
        'tax_query' => [
            [
                'taxonomy' => 'bundler',
                'field'    => 'id',
                'terms'    => $catTwo,
            ],
        ],
    ];
    $queryTwo = new WP_Query($argsTwo);
endif;
if ($catTree) :
    $argsTree = [
        'post_type' => 'product',
        'posts_per_page' => -1,
        'tax_query' => [
            [
                'taxonomy' => 'bundler',
                'field'    => 'id',
                'terms'    => $catTree,
            ],
        ],
    ];
    $queryTree = new WP_Query($argsTree);
endif;
?>

<div id="product-bundler">
    <?php get_template_part('templates-parts/header/header', 'title');  ?>
    <?php the_content(); ?>
    <div class="bundler-left">

        <div id="product-list">

            <!-- Kategoria 1 -->
            <?php if ($queryOne->have_posts()) : ?>
                <div class="product-list__header">
                    <?php if (get_field('nazwa_sekcji', 'options')) : ?>
                        <h2> <?php echo get_field('nazwa_sekcji', 'options'); ?></h2>
                    <?php endif; ?>
                    <sppan class="sep"></sppan>
                    <div class="slider-nav slider-nav--one">
                        <div class="slider-nav__prev" tabindex="0" role="button" aria-label="Previous slide"
                            aria-controls="swiper-wrapper-9488c1b11ea8ce6a">
                            <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="0.5" y="0.5" width="49" height="49" rx="24.5" stroke="#b3cce6"></rect>
                                <path
                                    d="M39.583 22.9166H18.7497L25.6101 16.0562L22.6642 13.1104L13.7205 22.0541C12.9394 22.8355 12.5005 23.8951 12.5005 24.9999C12.5005 26.1048 12.9394 27.1644 13.7205 27.9458L22.6642 36.8895L25.6101 33.9437L18.7497 27.0833H39.583V22.9166Z"
                                    fill="#b3cce6"></path>
                            </svg>
                        </div>
                        <div class="slider-nav__next" tabindex="0" role="button" aria-label="Next slide"
                            aria-controls="swiper-wrapper-9488c1b11ea8ce6a">
                            <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="49.5" y="49.5" width="49" height="49" rx="24.5" transform="rotate(-180 49.5 49.5)"
                                    stroke="#b3cce6"></rect>
                                <path
                                    d="M10.4169 27.0834L31.2503 27.0834L24.3899 33.9438L27.3357 36.8896L36.2794 27.9459C37.0606 27.1645 37.4994 26.1049 37.4994 25.0001C37.4994 23.8952 37.0606 22.8356 36.2794 22.0542L27.3357 13.1105L24.3899 16.0563L31.2503 22.9167L10.4169 22.9167L10.4169 27.0834Z"
                                    fill="#b3cce6"></path>
                            </svg>

                        </div>
                    </div>
                </div>
                <div class="swiper catOne">
                    <div class="swiper-wrapper">
                        <?php while ($queryOne->have_posts()) : $queryOne->the_post();
                            global $product;
                            $image_id = '';
                            if ($product->get_gallery_image_ids()) {
                                $image_id = $product->get_gallery_image_ids()[0]; // Pierwszy obrazek z galerii
                            }
                        ?>
                            <?php if ($product): ?>
                                <div class="swiper-slide">
                                    <div class="product-item" data-id="<?php echo $product->get_id(); ?>"
                                        data-price="<?php echo $product->get_price(); ?>">
                                        <a href="<?php echo get_permalink($product->get_id()); ?>" class="product-link">
                                            <div class="img">
                                                <?php if (has_post_thumbnail()) { ?>
                                                    <?php the_post_thumbnail('woocommerce_thumbnail'); ?>
                                                <?php  } else { ?>
                                                    <?php echo '<img src="' . wc_placeholder_img_src() . '" alt="Placeholder">'; ?>
                                                <?php } ?>
                                            </div>

                                            <?php if ($image_id) { ?>
                                                <div class="img-2">
                                                    <?php echo wp_get_attachment_image($image_id, 'woocommerce_thumbnail'); ?>
                                                </div>
                                            <?php } ?>
                                        </a>
                                        <a href="<?php echo get_permalink($product->get_id()); ?>">
                                            <h3><?php the_title(); ?></h3>
                                        </a>
                                        <?php echo wc_price($product->get_price()); ?>
                                        <div class="control">
                                            <!-- Przycisk dodawania i usuwania -->
                                            <button class="add-to-bundle btn-main"
                                                data-id="<?php echo $product->get_id(); ?>"><?php echo __('Dodaj do zestawu', 'go'); ?></button>
                                            <button class="remove-from-bundle btn-rev hidden"
                                                data-id="<?php echo $product->get_id(); ?>"><?php echo __('Usuń produkt', 'go'); ?>
                                            </button>
                                            <!-- Kontrolka ilości -->
                                            <div class="quantity-control">
                                                <button class="quantity-minus"
                                                    data-id="<?php echo $product->get_id(); ?>">-</button>
                                                <input type="text" class="quantity-input" value="1" min="1" max="3"
                                                    data-id="<?php echo $product->get_id(); ?>" readonly>
                                                <button class="quantity-plus" data-id="<?php echo $product->get_id(); ?>">+</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </div>
                    <div class="swiper-pagination"></div>

                </div>
            <?php else :
                echo '<p>Brak produktów w tej kategorii.</p>';
            endif;
            wp_reset_postdata();
            ?>
            <!--end Kategoria 1 -->

            <!-- Kategoria 2 -->
            <?php if ($queryTwo->have_posts()) : ?>
                <div class="product-list__header">
                    <?php if (get_field('nazwa_sekcji_two', 'options')) : ?>
                        <h2> <?php echo get_field('nazwa_sekcji_two', 'options'); ?></h2>
                    <?php endif; ?>
                    <sppan class="sep"></sppan>
                    <div class="slider-nav slider-nav--two">
                        <div class="slider-nav__prev" tabindex="0" role="button" aria-label="Previous slide"
                            aria-controls="swiper-wrapper-9488c1b11ea8ce6a">
                            <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="0.5" y="0.5" width="49" height="49" rx="24.5" stroke="#b3cce6"></rect>
                                <path
                                    d="M39.583 22.9166H18.7497L25.6101 16.0562L22.6642 13.1104L13.7205 22.0541C12.9394 22.8355 12.5005 23.8951 12.5005 24.9999C12.5005 26.1048 12.9394 27.1644 13.7205 27.9458L22.6642 36.8895L25.6101 33.9437L18.7497 27.0833H39.583V22.9166Z"
                                    fill="#b3cce6"></path>
                            </svg>
                        </div>
                        <div class="slider-nav__next" tabindex="0" role="button" aria-label="Next slide"
                            aria-controls="swiper-wrapper-9488c1b11ea8ce6a">
                            <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="49.5" y="49.5" width="49" height="49" rx="24.5" transform="rotate(-180 49.5 49.5)"
                                    stroke="#b3cce6"></rect>
                                <path
                                    d="M10.4169 27.0834L31.2503 27.0834L24.3899 33.9438L27.3357 36.8896L36.2794 27.9459C37.0606 27.1645 37.4994 26.1049 37.4994 25.0001C37.4994 23.8952 37.0606 22.8356 36.2794 22.0542L27.3357 13.1105L24.3899 16.0563L31.2503 22.9167L10.4169 22.9167L10.4169 27.0834Z"
                                    fill="#b3cce6"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="swiper catTwo">
                    <div class="swiper-wrapper">
                        <?php while ($queryTwo->have_posts()) : $queryTwo->the_post();
                            global $product;
                            $image_id = '';
                            if ($product->get_gallery_image_ids()) {
                                $image_id = $product->get_gallery_image_ids()[0]; // Pierwszy obrazek z galerii
                            }
                        ?>
                            <?php if ($product): ?>
                                <div class="swiper-slide">
                                    <div class="product-item" data-id="<?php echo $product->get_id(); ?>"
                                        data-price="<?php echo $product->get_price(); ?>">
                                        <a href="<?php echo get_permalink($product->get_id()); ?>" class="product-link">
                                            <div class="img">
                                                <?php if (has_post_thumbnail()) { ?>
                                                    <?php the_post_thumbnail('woocommerce_thumbnail'); ?>
                                                <?php  } else { ?>
                                                    <?php echo '<img src="' . wc_placeholder_img_src() . '" alt="Placeholder">'; ?>
                                                <?php } ?>
                                            </div>

                                            <?php if ($image_id) { ?>
                                                <div class="img-2">
                                                    <?php echo wp_get_attachment_image($image_id, 'woocommerce_thumbnail'); ?>
                                                </div>
                                            <?php } ?>
                                        </a>
                                        <a href="<?php echo get_permalink($product->get_id()); ?>">
                                            <h3><?php the_title(); ?></h3>
                                        </a>
                                        <?php echo wc_price($product->get_price()); ?>
                                        <div class="control">
                                            <!-- Przycisk dodawania i usuwania -->
                                            <button class="add-to-bundle btn-main"
                                                data-id="<?php echo $product->get_id(); ?>"><?php echo __('Dodaj do zestawu', 'go'); ?></button>
                                            <button class="remove-from-bundle btn-rev hidden"
                                                data-id="<?php echo $product->get_id(); ?>"><?php echo __('Usuń produkt', 'go'); ?>
                                            </button>
                                            <!-- Kontrolka ilości -->
                                            <div class="quantity-control">
                                                <button class="quantity-minus"
                                                    data-id="<?php echo $product->get_id(); ?>">-</button>
                                                <input type="text" class="quantity-input" value="1" min="1" max="3"
                                                    data-id="<?php echo $product->get_id(); ?>" readonly disabled>
                                                <button class="quantity-plus" data-id="<?php echo $product->get_id(); ?>">+</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            <?php else :
                echo '<p>Brak produktów w tej kategorii.</p>';
            endif;
            wp_reset_postdata();
            ?>
            <!--end Kategoria 2 -->
            <!-- Kategoria 3 -->
            <?php if ($queryTree->have_posts()) : ?>
                <div class="product-list__header">
                    <?php if (get_field('nazwa_sekcji_tree', 'options')) : ?>
                        <h2> <?php echo get_field('nazwa_sekcji_tree', 'options'); ?></h2>
                    <?php endif; ?>
                    <sppan class="sep"></sppan>
                    <div class="slider-nav slider-nav--tree">
                        <div class="slider-nav__prev" tabindex="0" role="button" aria-label="Previous slide"
                            aria-controls="swiper-wrapper-9488c1b11ea8ce6a">
                            <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="0.5" y="0.5" width="49" height="49" rx="24.5" stroke="#b3cce6"></rect>
                                <path
                                    d="M39.583 22.9166H18.7497L25.6101 16.0562L22.6642 13.1104L13.7205 22.0541C12.9394 22.8355 12.5005 23.8951 12.5005 24.9999C12.5005 26.1048 12.9394 27.1644 13.7205 27.9458L22.6642 36.8895L25.6101 33.9437L18.7497 27.0833H39.583V22.9166Z"
                                    fill="#b3cce6"></path>
                            </svg>
                        </div>
                        <div class="slider-nav__next" tabindex="0" role="button" aria-label="Next slide"
                            aria-controls="swiper-wrapper-9488c1b11ea8ce6a">
                            <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="49.5" y="49.5" width="49" height="49" rx="24.5" transform="rotate(-180 49.5 49.5)"
                                    stroke="#b3cce6"></rect>
                                <path
                                    d="M10.4169 27.0834L31.2503 27.0834L24.3899 33.9438L27.3357 36.8896L36.2794 27.9459C37.0606 27.1645 37.4994 26.1049 37.4994 25.0001C37.4994 23.8952 37.0606 22.8356 36.2794 22.0542L27.3357 13.1105L24.3899 16.0563L31.2503 22.9167L10.4169 22.9167L10.4169 27.0834Z"
                                    fill="#b3cce6"></path>
                            </svg>

                        </div>
                    </div>
                </div>
                <div class="swiper catTree">
                    <div class="swiper-wrapper">
                        <?php while ($queryTree->have_posts()) : $queryTree->the_post();
                            global $product;
                            $image_id = '';
                            if ($product->get_gallery_image_ids()) {
                                $image_id = $product->get_gallery_image_ids()[0]; // Pierwszy obrazek z galerii
                            }
                        ?>
                            <?php if ($product): ?>
                                <div class="swiper-slide">
                                    <div class="product-item" data-id="<?php echo $product->get_id(); ?>"
                                        data-price="<?php echo $product->get_price(); ?>">
                                        <a href="<?php echo get_permalink($product->get_id()); ?>" class="product-link">
                                            <div class="img">
                                                <?php if (has_post_thumbnail()) { ?>
                                                    <?php the_post_thumbnail('woocommerce_thumbnail'); ?>
                                                <?php  } else { ?>
                                                    <?php echo '<img src="' . wc_placeholder_img_src() . '" alt="Placeholder">'; ?>
                                                <?php } ?>
                                            </div>

                                            <?php if ($image_id) { ?>
                                                <div class="img-2">
                                                    <?php echo wp_get_attachment_image($image_id, 'woocommerce_thumbnail'); ?>
                                                </div>
                                            <?php } ?>
                                        </a>
                                        <a href="<?php echo get_permalink($product->get_id()); ?>">
                                            <h3><?php the_title(); ?></h3>
                                        </a>
                                        <?php echo wc_price($product->get_price()); ?>
                                        <div class="control">
                                            <!-- Przycisk dodawania i usuwania -->
                                            <button class="add-to-bundle btn-main"
                                                data-id="<?php echo $product->get_id(); ?>"><?php echo __('Dodaj do zestawu', 'go'); ?></button>
                                            <button class="remove-from-bundle btn-rev hidden"
                                                data-id="<?php echo $product->get_id(); ?>"><?php echo __('Usuń produkt', 'go'); ?>
                                                produkt</button>
                                            <!-- Kontrolka ilości -->
                                            <div class="quantity-control">
                                                <button class="quantity-minus"
                                                    data-id="<?php echo $product->get_id(); ?>">-</button>
                                                <input type="text" class="quantity-input" value="1" min="1" max="3"
                                                    data-id="<?php echo $product->get_id(); ?>" readonly disabled>
                                                <button class="quantity-plus" data-id="<?php echo $product->get_id(); ?>">+</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            <?php else :
                echo '<p> ' .  __('Brak produktów w tej kategorii.', 'go') . ' </p>';
            endif;
            wp_reset_postdata();
            ?>
            <!--end Kategoria 3 -->

        </div>
    </div>
    <div class="bundler-right">
        <div class="bundler-right__wrap">
            <div class="bundler-right__header text-center">
                <p class="h5"><?php echo __('Zbuduj swój zestaw', 'go'); ?></p>
                <p class="h2"><?php echo __('Otrzymaj 15% rabatu', 'go'); ?></p>
            </div>
            <div id="selected-products">
                <div class="product-slot">
                    <a href="#product-list">
                        <div class="placeholder">
                            <span class="img"></span>
                            <span class="title"><?php echo __('Wybierz produkt', 'go'); ?></span>
                        </div>
                    </a>
                </div>
                <div class="product-slot">
                    <a href="#product-list">
                        <div class="placeholder">
                            <span class="img"></span>
                            <span class="title"><?php echo __('Wybierz produkt', 'go'); ?></span>
                        </div>
                    </a>
                </div>
                <div class="product-slot">
                    <a href="#product-list">
                        <div class="placeholder">
                            <span class="img"></span>
                            <span class="title"><?php echo __('Wybierz produkt', 'go'); ?></span>
                        </div>
                    </a>
                </div>
            </div>


            <div class="summary">
                <p class="h5"><span id="discounted-price"><?php echo __('0.00 zł', 'go'); ?> </span></p>
                <p><?php echo __('Oszczędzasz:', 'go'); ?>
                    <span id="saved-amount">
                        <?php echo __('0.00 zł', 'go'); ?>
                    </span>
                </p>

                <button id="checkout-button" class="btn-main" disabled><?php echo __('Zamawiam', 'go'); ?></button>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>