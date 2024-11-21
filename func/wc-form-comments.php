<?php
function product_review_form_shortcode()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_review_submit'])) {
        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_email($_POST['email']);
        $comment = sanitize_textarea_field($_POST['comment']);
        $stars = intval($_POST['stars']);
        $product_id = get_the_ID();

        // Walidacja pól
        $errors = [];
        if (empty($name)) {
            $errors[] = 'Name is required.';
        }
        if (empty($email) || !is_email($email)) {
            $errors[] = 'Valid email is required.';
        }
        if (empty($comment)) {
            $errors[] = 'Comment is required.';
        }
        if ($stars < 1 || $stars > 5) {
            $errors[] = 'Stars must be between 1 and 5.';
        }
        if (empty($product_id) || get_post_type($product_id) !== 'product') {
            $errors[] = 'Invalid product ID.';
        }

        if (empty($errors)) {
            // Dodanie opinii jako komentarza
            $comment_data = [
                'comment_post_ID' => $product_id,
                'comment_author'  => $name,
                'comment_author_email' => $email,
                'comment_content' => $comment,
                'comment_type'    => 'review',
                'comment_approved' => 0, // Opinie będą wymagały zatwierdzenia
            ];

            $comment_id = wp_insert_comment($comment_data);

            if ($comment_id) {
                // Dodanie oceny jako metadanych komentarza
                update_comment_meta($comment_id, 'rating', $stars);

                echo '<p class="success-message">Thank you for your review! It is awaiting moderation.</p>';
            }
        } else {
            foreach ($errors as $error) {
                echo '<p class="error-message">' . esc_html($error) . '</p>';
            }
        }
    }

    // Formularz HTML
    ob_start();
?>
    <div class="custome-form-wraper">
        <h3 class="text-center">Dodaj komentarz</h3>
        <p class="text-center"><small>Formularz widoczny tylko dla administratorów</small></p>
        <form method="post" class="custome-form">
            <label for="name">Imię:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="comment">Komentarz:</label>
            <textarea id="comment" name="comment" required></textarea>

            <label for="stars">Stars (1-5):</label>
            <input type="number" id="stars" name="stars" min="1" max="5" required>

            <button type="submit" class="btn-main" name="product_review_submit">Dodaj komentarz</button>
        </form>
    </div>
<?php
    return ob_get_clean();
}
add_shortcode('product_review_form', 'product_review_form_shortcode');

// opinions

function my_custom_comment_callback($comment, $args, $depth)
{
    $tag = ('div' === $args['style']) ? 'div' : 'li';
    $comment_classes = comment_class(empty($args['has_children']) ? '' : 'parent', null, null, false);

    // Pobieramy ocenę z meta danych komentarza
    $rating = get_comment_meta($comment->comment_ID, 'rating', true);
?>
    <<?php echo $tag; ?> <?php echo $comment_classes; ?> id="comment-<?php comment_ID(); ?>">
        <div id="div-comment-<?php comment_ID(); ?>" class="comment">
            <div class="comment-author">
                <p class="h5"><?php comment_author(); ?></p>
                <?php if ($rating) : ?>
                    <?php echo wc_get_rating_html($rating); ?>
                <?php endif; ?>
            </div>
            <div class="comment-content">
                <?php comment_text(); ?>
            </div>
        </div>
    </<?php echo $tag; ?>>
<?php
}


// remove opinion from product
function wpdocs_remove_product_comments_field()
{
    remove_post_type_support('product', 'comments');
}
add_action('admin_init', 'wpdocs_remove_product_comments_field');
