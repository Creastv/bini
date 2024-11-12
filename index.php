<?php get_header(); ?>
<?php if (have_posts()) : ?>
    <?php get_template_part('templates-parts/header/header', 'title');  ?>
    <div class="posts-wraper">
        <?php while (have_posts()) : the_post();
            get_template_part('templates-parts/content/content-cart-post');
        endwhile; ?>
    </div>
    <?php if (paginate_links()) { ?>
        <div class="go-pagination">
            <?php pagination_bars(); ?>
        </div>
    <?php } ?>

<?php else : ?>
    <heder class="entry-header">
        <h1 class='text-center'><?php _e('Nic nie znaleziono', 'go'); ?></h1>
    </heder>
<?php endif; ?>

<?php get_footer();
