<?php
$site = get_field('strona_zdjecia');
$bg = get_field('tlo');
$img = get_field('zdjecie');

$class_name = 'section-img';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
$anchor = '';
if (!empty($block['anchor'])) {
    $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}
?>
<div <?php echo esc_attr($anchor); ?> class="<?php echo $class_name; ?> <?php echo $site['label']; ?>"
    style="background-color: <?php echo $bg; ?>">
    <div class="row">
        <div class="col">
            <div class="img" style="background-image: url(<?php echo $img; ?>)"></div>
        </div>
        <div class="col">
            <div class="content">
                <InnerBlocks />
            </div>
        </div>
    </div>
</div>