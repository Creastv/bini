<div class="f-info">
    <div class="container">
        <div class="f-info__wrap">
            <div class="left">
                <p>© 2024 Wszelkie prawa zastrzeżone. Projekt i realizacja <a href="https://roial.pl"
                        target="_blank">roial.pl</a></p>
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