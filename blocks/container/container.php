<?php
$type = get_field('szerokosc_kontenra');
$bg = get_field('tlo');
$classType = 'container';
if ($type == 1) :
    $classType = 'container';
elseif ($type == 2) :
    $classType = 'container-wide';
elseif ($type == 3) :
    $classType = 'container-narrow';
endif;

$class_name = 'custome-container ';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}

$anchor = '';
if (!empty($block['anchor'])) {
    $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}
?>
<div <?php echo esc_attr($anchor); ?> class="<?php echo $class_name; ?>" style="background-color: <?php echo $bg; ?>">
    <div class="<?php echo $classType; ?>">
        <div class="row">
            <InnerBlocks />
        </div>
    </div>
</div>