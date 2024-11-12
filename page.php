<?php
get_header();
?>
<?php
while (have_posts()) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" class="hentry page">
        <?php get_template_part('templates-parts/header/header', 'title'); ?>
        <div class="entry-content">
            <div class="container-narrow">
                <?php the_content(); ?>
            </div>
        </div>
    </article>
<?php endwhile;

get_footer();
