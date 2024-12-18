<?php
function mytheme_customize_register($wp_customize)
{
    // Dodanie sekcji dla linków do social media
    $wp_customize->add_section('social_media_section', array(
        'title'       => __('Linki do Social Media', 'go'),
        'priority'    => 35, // Kolejność wyświetlania sekcji
    ));

    // Dodanie ustawienia i kontrolki dla Facebooka
    $wp_customize->add_setting('facebook_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw', // Walidacja URL
    ));
    $wp_customize->add_control('facebook_url', array(
        'label'    => __('Facebook URL', 'go'),
        'section'  => 'social_media_section',
        'type'     => 'url',
    ));

    // Dodanie ustawienia i kontrolki dla Twittera
    $wp_customize->add_setting('pinterest', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('pinterest', array(
        'label'    => __('Pinterest', 'go'),
        'section'  => 'social_media_section',
        'type'     => 'url',
    ));

    // Dodanie ustawienia i kontrolki dla Instagrama
    $wp_customize->add_setting('instagram_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('instagram_url', array(
        'label'    => __('Instagram URL', 'go'),
        'section'  => 'social_media_section',
        'type'     => 'url',
    ));

    // Dodanie ustawienia i kontrolki dla LinkedIn
    // $wp_customize->add_setting('linkedin_url', array(
    //     'default'           => '',
    //     'sanitize_callback' => 'esc_url_raw',
    // ));
    // $wp_customize->add_control('linkedin_url', array(
    //     'label'    => __('LinkedIn URL', 'go'),
    //     'section'  => 'social_media_section',
    //     'type'     => 'url',
    // ));
}
add_action('customize_register', 'mytheme_customize_register');
