<?php


$product_id = get_the_ID();
$title = get_field('title');
$desc = get_field('desc');

if (!empty($product_id)) {
    $args = array(
        'post_id' => $product_id, // Pobieramy komentarze dla konkretnego produktu
        'status' => 'approve',    // Tylko zatwierdzone komentarze
        'post_type' => 'product'  // Tylko komentarze z produktów
    );
    $comments = get_comments($args);


    if (!empty($comments)) {
        echo '<div id="reviews" class="reviews-container">';
        if ($title) {
            echo '<h2> ' . $title . ' </h2>';
        }
        if ($desc) {
            echo $desc;
        }
        echo '<ul class="reviews">';

        wp_list_comments(
            array(
                'callback' => 'my_custom_comment_callback',
            ),
            $comments
        );
        echo '</ul>';
        echo '</div>';
    } else {
        // echo 'Brak komentarzy dla tego produktu.';
    }
    if (current_user_can('administrator')) {
        echo do_shortcode('[product_review_form]');
    }
}
