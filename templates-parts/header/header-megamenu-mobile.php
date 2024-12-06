<?php if (have_rows('menu', 'option')): ?>
    <nav class="header-nav js mobile">
        <span class="close-nav h1">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 96.77 96.78">
                <path fill="#fff"
                    d="M7.55,0C7.61,0,7.67,0,7.73,0c.19.24.36.5.58.72,13.09,13.12,26.18,26.23,39.27,39.35.22.22.45.42.71.66.26-.24.5-.45.71-.66C62.1,26.95,75.19,13.83,88.28.72c.22-.22.39-.48.58-.72.06,0,.13,0,.19,0,2.55,2.47,5.09,4.95,7.73,7.5-13.72,13.75-27.25,27.3-40.81,40.89,13.56,13.58,27.08,27.14,40.79,40.87-2.62,2.56-5.16,5.04-7.71,7.52h-.19c-.19-.24-.36-.5-.58-.72-13.09-13.12-26.18-26.23-39.27-39.35-.22-.22-.45-.42-.71-.66-.26.24-.5.45-.71.66-13.09,13.11-26.18,26.23-39.27,39.35-.22.22-.39.48-.58.72h-.19C5.03,94.26,2.52,91.73,0,89.21c0-.06,0-.13,0-.19.24-.19.5-.36.71-.58,13.09-13.11,26.18-26.23,39.27-39.35.22-.22.42-.45.66-.71-.24-.26-.45-.5-.66-.71C26.9,34.56,13.81,21.44.71,8.33.5,8.11.24,7.94,0,7.75c0-.06,0-.13,0-.19C2.52,5.04,5.03,2.52,7.55,0Z" />
            </svg>
        </span>
        <ul id="header-nav-list" class="header-nav-list" itemscope itemtype="https://www.schema.org/SiteNavigationElement">
            <?php while (have_rows('menu', 'option')): the_row();
                $link = get_sub_field('link_do_strony');
                $class = get_sub_field('class');

                $link_url = $link['url'];
                $link_title = $link['title'];
                $link_target = $link['target'] ? $link['target'] : '_self';
                $link_slug = basename($link['url']);
                $post_slug =  basename(get_permalink(get_the_ID()));
                if ($post_slug ==  $link_slug) {
                    $class .= "current_page_item";
                }
                $hasChild = "";
            ?>

                <?php if (have_rows('linki_potomne', 'option')) {
                    $hasChild = "has-child";
                } ?>

                <li id=" menu-item-<?php echo  $link_slug; ?>" data-menu="submenu-<?php echo  $link_slug; ?>"
                    class="<?php echo $hasChild; ?> menu-item  <?php echo $class; ?>">
                    <a itemprop="url" href="<?php echo esc_url($link_url); ?>">
                        <span itemprop="name"><?php echo esc_html($link_title); ?></span>
                    </a>
                    <?php if (have_rows('linki_potomne', 'option')) { ?>
                        <span class="arrow-plus">
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M9.3554 4.10499C9.30892 4.05813 9.25361 4.02093 9.19269 3.99555C9.13176 3.97016 9.0664 3.95709 9.0004 3.95709C8.93439 3.95709 8.86904 3.97016 8.80811 3.99555C8.74718 4.02093 8.69188 4.05813 8.6454 4.10499L6.3554 6.39499C6.30892 6.44185 6.25361 6.47905 6.19269 6.50443C6.13176 6.52982 6.0664 6.54289 6.0004 6.54289C5.93439 6.54289 5.86904 6.52982 5.80811 6.50443C5.74718 6.47905 5.69188 6.44185 5.6454 6.39499L3.3554 4.10499C3.30891 4.05813 3.25361 4.02093 3.19268 3.99555C3.13176 3.97016 3.0664 3.95709 3.0004 3.95709C2.93439 3.95709 2.86904 3.97016 2.80811 3.99555C2.74718 4.02093 2.69188 4.05813 2.6454 4.10499C2.55227 4.19867 2.5 4.3254 2.5 4.45749C2.5 4.58958 2.55227 4.71631 2.6454 4.80999L4.9404 7.10499C5.22165 7.38589 5.6029 7.54366 6.0004 7.54366C6.3979 7.54366 6.77915 7.38589 7.0604 7.10499L9.3554 4.80999C9.44852 4.71631 9.50079 4.58958 9.50079 4.45749C9.50079 4.3254 9.44852 4.19867 9.3554 4.10499Z"
                                    fill="black" />
                            </svg>

                        </span>
                    <?php } ?>
                    <?php if (have_rows('linki_potomne', 'option')): ?>
                        <div id="submenu-<?php echo  $link_slug; ?>" data-submenu="submenu-<?php echo  $link_slug; ?>"
                            class="mega-submenu">
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        <div class="wraper-links">
                                            <?php while (have_rows('linki_potomne', 'option')): the_row();
                                                $linkChilde = get_sub_field('link_potomny_two');
                                                $linkChildeChilde = get_sub_field('linki_potomne_3');
                                            ?>
                                                <div class="co no ">
                                                    <?php if ($linkChilde) : ?>
                                                        <a itemprop="url" href="<?php echo esc_url($linkChilde['url']); ?>"
                                                            title="<?php echo $linkChilde['title']; ?>">
                                                            <span class="name bold"
                                                                itemprop="name"><?php echo esc_html($linkChilde['title']); ?></span>
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                                <?php if ($linkChildeChilde['linki']) { ?>
                                                    <div class="childe">
                                                        <?php if ($linkChildeChilde) { ?>
                                                            <?php foreach ($linkChildeChilde['linki'] as $link) : ?>
                                                                <a itemprop="url" href="<?php echo esc_url($link['link']['url']); ?>"
                                                                    title="<?php echo $link['link']['title']; ?>">
                                                                    <span class="name <?php echo $styl; ?>"
                                                                        itemprop="name"><?php echo esc_html($link['link']['title']); ?></span>
                                                                </a>
                                                            <?php endforeach; ?>
                                                        <?php } ?>
                                                    </div>
                                                <?php } ?>

                                            <?php endwhile; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </li>
            <?php endwhile; ?>
        </ul>
    </nav>
    <?php // var_dump($link); 
    ?>
<?php endif; ?>