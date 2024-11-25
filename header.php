<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta name="google-site-verification" content="EecTcvdM0xO2hTF18KPt-aHk1WlgoacxMqV7DU-UW0Y" />
    <meta name="theme-color" content="#fff">
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php wp_title('|', true, 'right'); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://use.typekit.net/ueq0xyu.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/5.0.0/imagesloaded.pkgd.min.js"></script>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php get_template_part('templates-parts/parts/info-stripe'); ?>
    <?php if (!is_checkout()) { ?>
        <header id="header" class="js-header " itemscope itemtype="http://schema.org/WPHeader">
            <div class="container">
                <div class="navbar js-navbar">
                    <div class="navbar-left">
                        <?php //get_template_part('templates-parts/header/header', 'nav'); 
                        ?>
                        <?php get_template_part('templates-parts/header/header-megamenu'); ?>
                        <?php get_template_part('templates-parts/header/header', 'burger'); ?>
                    </div>
                    <div class="navbar-middle">
                        <?php get_template_part('templates-parts/header/header', 'brand'); ?>
                    </div>
                    <div class="navbar-right">
                        <?php get_template_part('templates-parts/header/header', 'icons'); ?>
                    </div>
                </div>
            </div>
        </header>
    <?php } ?>


    <main class="main <?php echo get_field('remove_title_section', get_the_ID()) == false ? 'main-padding' : null; ?>">
        <div class="container">
            <div class="row">