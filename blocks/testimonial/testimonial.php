<?php
$testimonial = get_field('testimonial');


$class_name = 'testimonial';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}

$anchor = '';
if (!empty($block['anchor'])) {
    $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}
?>
<div <?php echo esc_attr($anchor); ?> class="<?php echo $class_name; ?>">
    <div class="testimonial__wrap">
        <div class="swiper testimonial-carousel">
            <div class="swiper-wrapper">
                <?php foreach ($testimonial as $item) { ?>
                    <div class="swiper-slide">
                        <div class="item">
                            <?php if ($item['desc']) { ?>
                                <?php echo $item['desc']; ?>
                            <?php } ?>
                            <?php if ($item['person']) { ?>
                                <div class="person">
                                    <p><b><?php echo $item['person']; ?></b></p>
                                    <svg width="107" height="83" viewBox="0 0 107 83" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.1"
                                            d="M99.4471 68.8523C99.4471 72.8346 97.6637 76.1881 94.0971 78.9129C90.7402 81.6376 86.0196 83 79.9353 83C73.851 83 68.2912 80.1704 63.2559 74.5114C58.4304 68.6427 56.0176 61.3068 56.0176 52.5038C56.0176 42.8624 58.4304 34.1642 63.2559 26.4091C68.0814 18.4444 73.9559 12.1566 80.8794 7.54547C87.8029 2.72476 94.4118 0.209606 100.706 0H101.335C105.112 0 107 1.15278 107 3.45834C107 5.34471 105.531 6.60228 102.594 7.23106C94.4118 8.90783 87.2784 12.5758 81.1941 18.2349C75.3196 23.6844 72.3823 31.4394 72.3823 41.5C72.3823 44.2248 73.6412 47.1591 76.1588 50.303C78.6765 53.2374 81.9284 54.9141 85.9147 55.3333C89.6912 55.5429 92.8382 56.9053 95.3559 59.4204C98.0833 61.9356 99.4471 65.0795 99.4471 68.8523ZM43.4294 68.8523C43.4294 72.8346 41.6461 76.1881 38.0794 78.9129C34.7225 81.6376 30.002 83 23.9176 83C17.8333 83 12.2735 80.1704 7.23823 74.5114C2.41275 68.6427 0 61.3068 0 52.5038C0 42.8624 2.41275 34.1642 7.23823 26.4091C12.0637 18.4444 17.9382 12.1566 24.8618 7.54547C31.7853 2.72476 38.3941 0.209606 44.6882 0H45.3176C49.0941 0 50.9824 1.15278 50.9824 3.45834C50.9824 5.34471 49.5137 6.60228 46.5765 7.23106C38.3941 8.90783 31.2608 12.5758 25.1765 18.2349C19.302 23.6844 16.3647 31.4394 16.3647 41.5C16.3647 44.2248 17.6235 47.1591 20.1412 50.303C22.6588 53.2374 25.9108 54.9141 29.8971 55.3333C33.6735 55.5429 36.8206 56.9053 39.3382 59.4204C42.0657 61.9356 43.4294 65.0795 43.4294 68.8523Z"
                                            fill="black" />
                                    </svg>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
        <div class="swiper-button-prev OfferSwiperLeft">
            <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="0.5" y="0.5" width="59" height="59" rx="29.5" stroke="#E1E1E1" />
                <path
                    d="M47.4995 27.4999H22.4995L30.732 19.2674L27.197 15.7324L16.4645 26.4649C15.5272 27.4026 15.0006 28.6741 15.0006 29.9999C15.0006 31.3257 15.5272 32.5973 16.4645 33.5349L27.197 44.2674L30.732 40.7324L22.4995 32.4999H47.4995V27.4999Z"
                    fill="#E1E1E1" />
            </svg>
        </div>
        <div class="swiper-button-next OfferSwiperRight">
            <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="59.5" y="59.5" width="59" height="59" rx="29.5" transform="rotate(-180 59.5 59.5)"
                    stroke="#E1E1E1" />
                <path
                    d="M12.5004 32.5001L37.5004 32.5001L29.2679 40.7326L32.8029 44.2676L43.5354 33.5351C44.4728 32.5974 44.9993 31.3259 44.9993 30.0001C44.9993 28.6743 44.4728 27.4027 43.5354 26.4651L32.8029 15.7326L29.2679 19.2676L37.5004 27.5001L12.5004 27.5001L12.5004 32.5001Z"
                    fill="#E1E1E1" />
            </svg>
        </div>
    </div>
</div>