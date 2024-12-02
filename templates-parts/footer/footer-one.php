<div class="f-one">
    <div class="container">
        <div class="f-one__wrap">
            <div class="col">

                <div class="b-logo">
                    <div class="b-logo__wrap">
                        <img src="<?php echo get_template_directory_uri(); ?>/src/img/logo-footer.png" alt="BINI">
                        <div class="b-logo__info">
                            <h4><?php echo get_bloginfo('name'); ?></h5>
                                <h5><?php _e('Bądź na bieżąco', 'go'); ?></h5>
                                <?php get_template_part('templates-parts/parts/social_media'); ?>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col">
                <?php if (is_active_sidebar('footer-2')) : ?>
                    <?php dynamic_sidebar('footer-2'); ?>
                <?php else : ?>
                <?php endif; ?>
                <?php if (is_active_sidebar('footer-3')) : ?>
                    <?php dynamic_sidebar('footer-3'); ?>
                <?php else : ?>
                <?php endif; ?>
            </div>
            <div class="col">
                <?php if (is_active_sidebar('footer-4')) : ?>
                    <?php dynamic_sidebar('footer-4'); ?>
                <?php else : ?>
                    <div class="b-info">
                        <div class="b-info__wrap">
                            <h4 class="h5"><?php _e('Metody płatności', 'go'); ?></h4>
                            <div class="b-info__wrap__logos">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/src/img/payments.png"
                                    alt="Payments">

                            </div>
                            <h4 class="h5"><?php _e('Kurierzy', 'go'); ?></h4>
                            <div class="b-info__wrap__logos">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/src/img/delivery.png"
                                    alt="Delivery">
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>