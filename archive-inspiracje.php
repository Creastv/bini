<?php
get_header(); ?>
<?php get_template_part('templates-parts/header/header', 'title');  ?>
<div class="inspirations">
    <div class="inspirations-container">
        <!-- Masonry Grid -->
        <div id="inspirations-grid" class="masonry-grid">
            <?php
            $args = array(
                'post_type'      => 'inspiracje',
                'posts_per_page' => 9,
            );
            $query = new WP_Query($args);
            $total_posts = $query->found_posts; // Liczba postów

            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post(); ?>
                    <div class="grid-item" data-id="<?php the_ID(); ?>"
                        data-image="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(), 'full')[0]; ?>">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('large'); ?>
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
                <span class="colose-sidebar">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="24" height="24" rx="12" fill="#AE0101" />
                        <path
                            d="M6.4 19L5 17.6L10.6 12L5 6.4L6.4 5L12 10.6L17.6 5L19 6.4L13.4 12L19 17.6L17.6 19L12 13.4L6.4 19Z"
                            fill="white" />
                    </svg>
                </span>
                <img id="sidebar-image" src="" alt="Inspiration Image">
                <div id="product"></div>
                <div id="sidebar-products">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                        </div>
                        <br><br>
                        <div class="swiper-pagination swiper-pagination--col"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Load More Button -->
    <div class="load-more" <?php echo ($total_posts < 8) ? 'style="display: none;"' : ''; ?>><button id="load-more"
            class="btn-main" data-page="1"><?php _e('Wczytaj więcej', 'go'); ?></button>
    </div>
</div>

<?php
get_footer();
