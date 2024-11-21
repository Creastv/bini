<?php get_header(); ?>
<div id="error" class="title-page-wraper">
    <div class="container">
        <div class="row">
            <div class="text-center">
                <h1>404</h1>
                <h2><?php _e('Upss. Chyba się zgubiłeś?', 'go'); ?></h2>
                <a class="btn-main" href="<?php echo esc_url(home_url('/')); ?>">
                    <?php _e('Wróć do strony głównej ', 'go'); ?></a>
            </div>
        </div>
    </div>
</div>

<?php get_footer();
