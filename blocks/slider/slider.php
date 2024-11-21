<?php
$slider = get_field('slider');

$class_name = 'slider-hero ';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}

$anchor = '';
if (!empty($block['anchor'])) {
    $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}
?>
<div <?php echo esc_attr($anchor); ?> class="<?php echo $class_name; ?>">
    <div class="slider__wrap">
        <div class="swiper slider-carousel">
            <div class="swiper-wrapper">
                <?php foreach ($slider as $slide) { ?>
                    <div class="swiper-slide">
                        <div class="item">
                            <div class="img" style="background-image: url(<?php echo $slide['zdjecie']; ?>);">
                                <div class="content">
                                    <?php if ($slide['title']) { ?>
                                        <h1 class="big-title"><?php echo $slide['title']; ?></h1>
                                    <?php } ?>
                                    <?php if ($slide['desc']) { ?>
                                        <p> <?php echo $slide['desc']; ?></p>
                                    <?php } ?>
                                    <?php if ($slide['link']) { ?>
                                        <a class="btn-main" href="<?php echo esc_url($slide['link']['url']); ?>"
                                            target="<?php echo esc_attr($slide['link']['target'] ? $slide['link']['target'] : '_self'); ?>"><?php echo esc_html($slide['link']['title']); ?></a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>