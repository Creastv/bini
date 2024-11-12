<?php
function mytheme_customize_register($wp_customize)
{
    // Dodanie sekcji dla linków do social media
    $wp_customize->add_section('social_media_section', array(
        'title'       => __('Linki do Social Media', 'mytheme'),
        'priority'    => 35, // Kolejność wyświetlania sekcji
    ));

    // Dodanie ustawienia i kontrolki dla Facebooka
    $wp_customize->add_setting('facebook_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw', // Walidacja URL
    ));
    $wp_customize->add_control('facebook_url', array(
        'label'    => __('Facebook URL', 'mytheme'),
        'section'  => 'social_media_section',
        'type'     => 'url',
    ));

    // Dodanie ustawienia i kontrolki dla Twittera
    $wp_customize->add_setting('twitter_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('twitter_url', array(
        'label'    => __('Twitter URL', 'mytheme'),
        'section'  => 'social_media_section',
        'type'     => 'url',
    ));

    // Dodanie ustawienia i kontrolki dla Instagrama
    $wp_customize->add_setting('instagram_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('instagram_url', array(
        'label'    => __('Instagram URL', 'mytheme'),
        'section'  => 'social_media_section',
        'type'     => 'url',
    ));

    // Dodanie ustawienia i kontrolki dla LinkedIn
    // $wp_customize->add_setting('linkedin_url', array(
    //     'default'           => '',
    //     'sanitize_callback' => 'esc_url_raw',
    // ));
    // $wp_customize->add_control('linkedin_url', array(
    //     'label'    => __('LinkedIn URL', 'mytheme'),
    //     'section'  => 'social_media_section',
    //     'type'     => 'url',
    // ));
}
add_action('customize_register', 'mytheme_customize_register');
