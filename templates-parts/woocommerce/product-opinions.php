<?php if (comments_open() || get_comments_number()) {
    echo '<div class="product-reviews-section">';
    comments_template();
    echo '</div>';
}
