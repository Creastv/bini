<div class="f-info">
    <div class="container">
        <div class="f-info__wrap">
            <div class="left">
                <p>© <?php echo date("Y"); ?> –
                    <?php _e('Bini. Wszystkie prawa zastrzeżone. Projekt i realizacja', 'go'); ?> <a
                        href="https://roial.pl" target="_blank">roial.pl</a></p>
            </div>
            <div class="right">
                <?php $temp_menu = wp_nav_menu(
                    array(
                        'theme_location'  => 'footer',
                        'menu_id'           => 'footer-nav-list',
                    )
                ); ?>
            </div>
        </div>
    </div>
</div>