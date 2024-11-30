<?php

// Rejestracja niestandardowej taksonomii Collection i przypisanie jej do produktów WooCommerce
function create_collection_taxonomy()
{
    $labels = array(
        'name'              => _x('Collections', 'go'),
        'singular_name'     => _x('Collection', 'go'),
        'search_items'      => __('Search Collections'),
        'all_items'         => __('All Collections'),
        'parent_item'       => __('Parent Collection'),
        'parent_item_colon' => __('Parent Collection:'),
        'edit_item'         => __('Edit Collection'),
        'update_item'       => __('Update Collection'),
        'add_new_item'      => __('Add New Collection'),
        'new_item_name'     => __('New Collection Name'),
        'menu_name'         => __('Collections'),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'collection'),
    );

    register_taxonomy('collection', array('product'), $args);
}
add_action('init', 'create_collection_taxonomy');



// Rejestracja niestandardowej taksonomii Collection i przypisanie jej do produktów WooCommerce
function create_tkaniny_taxonomy()
{
    $labels = array(
        'name'              => _x('Tkaniny', 'go'),
        'singular_name'     => _x('Tkaniny', 'go'),
        'search_items'      => __('Search Tkaniny'),
        'all_items'         => __('All Tkaniny'),
        'parent_item'       => __('Parent Tkaniny'),
        'parent_item_colon' => __('Parent Tkaniny:'),
        'edit_item'         => __('Edit Tkaniny'),
        'update_item'       => __('Update Tkaniny'),
        'add_new_item'      => __('Add New Tkaniny'),
        'new_item_name'     => __('New Tkaniny Name'),
        'menu_name'         => __('Tkaniny'),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'tkaniny'),
    );

    register_taxonomy('tkaniny', array('product'), $args);
}
add_action('init', 'create_tkaniny_taxonomy');


// Cpt Opinie
function create_opinie_cpt()
{
    $labels = array(
        'name'          => __('Opinie', 'go'),
        'singular_name' => __('Opinia', 'go'),
        'menu_name'     => __('Opinie', 'go'),
    );

    $args = array(
        'labels'        => $labels,
        'public'        => true,
        'has_archive'   => true,
        'rewrite'       => array('slug' => 'opinie'),
        'supports'      => array('title', 'editor'), // Wystarczy zdjęcie wyróżniające
        'menu_icon'     => 'dashicons-lightbulb',
    );

    register_post_type('opinie', $args);
}
add_action('init', 'create_opinie_cpt');

// Cpt Inspirations
function create_inspirations_cpt()
{
    $labels = array(
        'name'          => __('Inspirations', 'go'),
        'singular_name' => __('Inspiration', 'go'),
        'menu_name'     => __('Inspirations', 'go'),
    );

    $args = array(
        'labels'        => $labels,
        'public'        => true,
        'has_archive'   => true,
        'rewrite'       => array('slug' => 'inspiracje'),
        'supports'      => array('title', 'thumbnail'), // Wystarczy zdjęcie wyróżniające
        'menu_icon'     => 'dashicons-lightbulb',
    );

    register_post_type('inspiracje', $args);
}
add_action('init', 'create_inspirations_cpt');

// Wyłączenie Gutenberg z podstrony Inspiration
function enable_classic_editor_for_inspirations($can_edit, $post_type)
{
    if ($post_type === 'inspiracje') {
        return false;
    }
    return $can_edit;
}
add_filter('use_block_editor_for_post_type', 'enable_classic_editor_for_inspirations', 10, 2);
