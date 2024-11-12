<aside id="sidebar" class="widget-area">
    <?php if (!is_active_sidebar('sidebar')) : ?>
        <?php dynamic_sidebar('sidebar'); ?>
    <?php else : ?>
    <?php endif; ?>
</aside>