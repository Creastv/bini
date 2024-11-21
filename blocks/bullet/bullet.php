<?php
$bullets = get_field('bullets');


$class_name = 'bullets';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}

$anchor = '';
if (!empty($block['anchor'])) {
    $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}
?>
<div <?php echo esc_attr($anchor); ?> class="<?php echo $class_name; ?>">
    <div class="bullets__wrap">
        <?php foreach ($bullets as $bullet) { ?>
            <div class="bullet">
                <div class="bullet__left">
                    <?php if ($bullet['icon']) { ?>
                        <?php echo wp_get_attachment_image($bullet['icon'], 'full'); ?>
                    <?php } ?>
                </div>
                <div class="bullet__right">
                    <?php if ($bullet['title']) { ?>
                        <h3 class="h5"><?php echo $bullet['title']; ?></h3>
                    <?php } ?>
                    <?php if ($bullet['desc']) { ?>
                        <p><?php echo $bullet['desc']; ?></p>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
</div>