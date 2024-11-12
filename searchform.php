<form role="search" method="get" action="<?php echo home_url('/'); ?>">
    <fieldset>
        <input type="text" name="s" value="<?php the_search_query(); ?>">
        <button></button>
    </fieldset>
</form>