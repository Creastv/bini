<?php
get_header(); ?>
<?php get_template_part('templates-parts/header/header', 'title');  ?>
<div class="inspirations-container">
    <!-- Masonry Grid -->
    <div id="inspirations-grid" class="masonry-grid">
        <?php
        $args = array(
            'post_type'      => 'inspirations',
            'posts_per_page' => 9,
        );
        $query = new WP_Query($args);

        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post(); ?>
                <div class="grid-item" data-id="<?php the_ID(); ?>"
                    data-image="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(), 'full')[0]; ?>">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('medium'); ?>
                    <?php endif; ?>
                </div>
        <?php endwhile;
        endif;
        wp_reset_postdata();
        ?>
    </div>



    <!-- Sidebar -->
    <div id="sidebar">
        <div id="sidebar-content">
            <img id="sidebar-image" src="" alt="Inspiration Image">
            <div id="sidebar-products">
                <ul></ul>
            </div>
        </div>
    </div>
</div>
<!-- Load More Button -->
<div class="load-more"><button id="load-more" class="btn-main"
        data-page="1"><?php _e('Load More', 'textdomain'); ?></button>
</div>


<?php
get_footer();
