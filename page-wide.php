<?php
/* Template Name: Wide container
 * Template Post Type: page
 * 
 * */
get_header(); ?>
<article id="post-<?php the_ID(); ?>" class="hentry page">
    <?php get_template_part('templates-parts/header/header', 'title'); ?>
    <div class="entry-content">
        <?php the_content(); ?>
    </div>
</article>
<?php get_footer();
