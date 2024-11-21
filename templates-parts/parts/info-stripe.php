<?php
$infoStripe = get_field('info_stripe', 'options');
?>

<div class="info-stripe">
    <div class="info-stripe__wrap">
        <span class=" marquee"> <?php echo $infoStripe; ?></span>
    </div>
</div>