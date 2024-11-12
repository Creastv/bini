<article class="card-post <?php echo $post->ID; ?>">
    <header>
        <a href="<?php the_permalink(); ?>">
            <?php if (has_post_thumbnail($post->ID)) : ?>
                <?php the_post_thumbnail('post-futured', array('alt' => get_the_title())); ?>
            <?php else : ?>
                <img src="<?php echo get_template_directory_uri(); ?>/src/img/thumbnail.png" alt="<?php the_title(); ?> ">
            <?php endif; ?>
        </a>
    </header>
    <div class="entry-wraper">
        <h2 class="entry-title h3">
            <?php the_title(); ?>
        </h2>
        <div class="entry-content">
            <?php the_excerpt(); ?>
        </div>
    </div>
</article>