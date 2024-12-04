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

// Rozmiar
function create_rozmiar_taxonomy()
{
    $labels = array(
        'name'              => _x('Rozmiar', 'go'),
        'singular_name'     => _x('Rozmiar', 'go'),
        'search_items'      => __('Search rozmiar'),
        'all_items'         => __('All rozmiar'),
        'parent_item'       => __('Parent rozmiar'),
        'parent_item_colon' => __('Parent rozmiar:'),
        'edit_item'         => __('Edit rozmiar'),
        'update_item'       => __('Update rozmiar'),
        'add_new_item'      => __('Add New rozmiar'),
        'new_item_name'     => __('New rozmiar Name'),
        'menu_name'         => __('Rozmiar'),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'rozmiar'),
    );

    register_taxonomy('rozmiar', array('product'), $args);
}
add_action('init', 'create_rozmiar_taxonomy');
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
// Wyłączenie widoczności pojedynczych postów
function disable_single_opinie()
{
    if (is_singular('opinie')) {
        wp_redirect(get_post_type_archive_link('opinie'));
        exit;
    }
}
add_action('template_redirect', 'disable_single_opinie');

//  Wyłączenie dostępu do API dla pojedynczych postów

function restrict_opinie_rest_access($response, $post, $request)
{
    if ($post->post_type === 'opinie' && is_singular('opinie')) {
        return new WP_Error('rest_forbidden', __('Access denied.', 'go'), array('status' => 403));
    }
    return $response;
}
add_filter('rest_prepare_opinie', 'restrict_opinie_rest_access', 10, 3);


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

// Wyłączenie widoczności pojedynczych postów CPT
function disable_single_inspiracje()
{
    if (is_singular('inspiracje')) {
        wp_redirect(get_post_type_archive_link('inspiracje'));
        exit;
    }
}
add_action('template_redirect', 'disable_single_inspiracje');

// Wyłączenie dostępu do API dla pojedynczych postów
function restrict_inspiracje_rest_access($response, $post, $request)
{
    if ($post->post_type === 'inspiracje' && is_singular('inspiracje')) {
        return new WP_Error('rest_forbidden', __('Access denied.', 'go'), array('status' => 403));
    }
    return $response;
}
add_filter('rest_prepare_inspiracje', 'restrict_inspiracje_rest_access', 10, 3);
