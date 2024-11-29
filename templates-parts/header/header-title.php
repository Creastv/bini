<?php
$page_id = get_the_ID();
$template = get_page_template();
$displayTitle = get_field('remove_title_section', $page_id);
$desc = get_field('title_description', $page_id);
?>
<?php if ($displayTitle !== true) { ?>
	<header class="entry-header">
		<?php if (is_checkout()) { ?>
			<?php get_template_part('templates-parts/header/header', 'brand'); ?>
		<?php } ?>
		<h1
			class="entry-title  <?php echo basename($template) === 'page.php' && get_post_type(get_the_ID()) !== 'inspiracje' ? "text-center" : false; ?>">
			<?php
			if (is_category()) :
				single_cat_title();
			elseif (is_tax()) :
				single_tag_title();
			elseif (get_post_type(get_the_ID()) == 'inspiracje') :
				_e('Inspiracje', 'go');
			elseif (is_404()) :
				_e('404', 'go');
			elseif (is_search()) :
				_e('Wyniki wyszukiwania', 'go');
			elseif (is_page()) :
				the_title();
			elseif (is_tag()) :
				single_tag_title();
			elseif (is_author()) :
				the_post();
				printf(__('%s', 'go'), get_the_author());
				rewind_posts();
			elseif (is_day()) :
				printf(__('Dzień: %s', 'go'), '<span>' . get_the_date() . '</span>');
			elseif (is_month()) :
				printf(__('Miesiąc: %s', 'go'), '<span>' . get_the_date('F Y') . '</span>');
			elseif (is_year()) :
				printf(__('Rok: %s', 'go'), '<span>' . get_the_date('Y') . '</span>');
			elseif (is_tax('post_format', 'post-format-aside')) :
				_e('Asides', 'go');
			elseif (is_tax('post_format', 'post-format-image')) :
				_e('Images', 'go');
			elseif (is_tax('post_format', 'post-format-video')) :
				_e('Videos', 'go');
			elseif (is_tax('post_format', 'post-format-quote')) :
				_e('Quotes', 'go');
			elseif (is_tax('post_format', 'post-format-link')) :
				_e('Links', 'go');
			else :
				_e('Aktualności', 'go');
			endif; ?>
		</h1>

		<div
			class="entry-desc <?php echo basename($template) === 'page.php' && get_post_type(get_the_ID()) !== 'inspiracje' ? "entry-desc--narrow" : false; ?>">
			<?php if (is_category()) : ?>
				<?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
				<?php the_archive_description('<div class="taxonomy-description">', '</div>'); ?>
			<?php endif; ?>

			<?php if ($desc) : ?>
				<?php echo $desc; ?>
			<?php endif; ?>
			<?php if (get_post_type(get_the_ID()) == 'inspiracje') : ?>

				<p>
					Make your home with what you love and who you love. The moments you’ve cherished and the memoriesthat
					linger.
					Fill your space with cozy corners and joyful chaos. BiNi the laughter, the quiet times, and everything
					in
					between. BiNi the messesthat tellstories and the traditionsthat bring comfort.</p>

			<?php endif; ?>
		</div>

	</header>

<?php } ?>