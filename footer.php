</div>
</div>
</main>


<footer id="footer" itemscope itemtype="http://schema.org/WPFooter">
    <?php get_template_part('templates-parts/footer/footer', 'one'); ?>
    <?php get_template_part('templates-parts/footer/footer', 'info'); ?>
</footer>
<span id="go-to-top">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
        <path id="Icon_material-arrow-upward" data-name="Icon material-arrow-upward"
            d="M6,18l2.115,2.115,8.385-8.37V30h3V11.745l8.37,8.385L30,18,18,6Z" transform="translate(-6 -6)" />
    </svg>
</span>
<?php wp_footer(); ?>
<script>
    jQuery(function($) {
        $('#invoice_checkbox').change(function() {
            if ($(this).is(':checked')) {
                $('.hidden-field').show();
            } else {
                $('.hidden-field').hide();
            }
        });
    });
</script>
<script>
    jQuery(document).ready(function($) {
        $('.accordion-title').on('click', function() {
            var contentId = $(this).data('accordion');

            // Toggle current accordion
            $('#' + contentId).toggleClass('open');
            $(this).toggleClass('active');

            // Close other accordions
            // $('.accordion-content').not('#' + contentId).removeClass('open');
            // $('.accordion-title').not(this).removeClass('active');
        });
    });
</script>
</body>

</html>