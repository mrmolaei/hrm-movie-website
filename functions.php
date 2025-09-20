<?php
/**
 * Theme Functions File
 *
 * This file loads styles, scripts, and adds basic theme support.
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Enqueue Styles and Scripts
 */
function hrm_movie_enqueue_assets() {
    wp_enqueue_style('hrm-movie-style', get_template_directory_uri() . '/assets/css/main.css', array(), wp_get_theme()->get('Version'));

    wp_enqueue_script('hrm-movie-script', get_template_directory_uri() . '/assets/js/main.js', array(), wp_get_theme()->get('Version'), true);
}
add_action('wp_enqueue_scripts', 'hrm_movie_enqueue_assets');

/**
 * Theme Setup
 */
function hrm_movie_setup() {
    // Enable Featured Images
    add_theme_support('post-thumbnails');

    // Enable Dynamic Title Tag
    add_theme_support('title-tag');

    // Enable HTML5 markup support
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
}
add_action('after_setup_theme', 'hrm_movie_setup');


function hrm_movie_register_movie_post_type()
{
    // -- Movie labels
    $labels = array(
        'name' => _x('Movies', 'Post type general name', 'hrm-movie'),
        'singular_name' => _x('Movie', 'Post type singular name', 'hrm-movie'),
        'menu_name' => _x('Movies', 'Admin Menu text', 'hrm-movie'),
        'name_admin_bar' => _x('Movie', 'Add New on Toolbar', 'hrm-movie'),
        'add_new' => __('Add New', 'hrm-movie'),
        'add_new_item' => __('Add New Movie', 'hrm-movie'),
        'new_item' => __('New Movie', 'hrm-movie'),
        'edit_item' => __('Edit Movie', 'hrm-movie'),
        'view_item' => __('View Movie', 'hrm-movie'),
        'all_items' => __('All Movies', 'hrm-movie'),
        'search_items' => __('Search Movies', 'hrm-movie'),
        'parent_item_colon' => __('Parent Movies:', 'hrm-movie'),
        'not_found' => __('No movies found.', 'hrm-movie'),
        'not_found_in_trash' => __('No movies found in Trash.', 'hrm-movie'),
    );

    // -- Movie args
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_rest' => true,            // enable Gutenberg & REST API
        'rest_base' => 'movies',
        'has_archive' => true,
        'rewrite' => array('slug' => 'movies'),
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-format-video',
        'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'custom-fields', 'comments', 'author'),
        'taxonomies' => array('genre'), // register_taxonomy_for_object_type will also be used below
    );

    register_post_type('movie', $args);
}
add_action('init', 'hrm_movie_register_movie_post_type', 0);

function hrm_movie_register_genre_taxonomy()
{
    $labels = array(
        'name' => _x('Genres', 'taxonomy general name', 'hrm-movie'),
        'singular_name' => _x('Genre', 'taxonomy singular name', 'hrm-movie'),
        'search_items' => __('Search Genres', 'hrm-movie'),
        'all_items' => __('All Genres', 'hrm-movie'),
        'parent_item' => __('Parent Genre', 'hrm-movie'),
        'parent_item_colon' => __('Parent Genre:', 'hrm-movie'),
        'edit_item' => __('Edit Genre', 'hrm-movie'),
        'update_item' => __('Update Genre', 'hrm-movie'),
        'add_new_item' => __('Add New Genre', 'hrm-movie'),
        'new_item_name' => __('New Genre Name', 'hrm-movie'),
        'menu_name' => __('Genres', 'hrm-movie'),
    );

    $args = array(
        'hierarchical' => true,             // true = like categories, false = like tags
        'labels' => $labels,
        'show_ui' => true,
        'show_in_rest' => true,             // REST / Gutenberg support
        'rest_base' => 'genres',
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'genre'),
    );

    register_taxonomy('genre', array('movie'), $args);
    // ensure the taxonomy is associated to post type (sometimes necessary)
    register_taxonomy_for_object_type('genre', 'movie');
}
add_action('init', 'hrm_movie_register_genre_taxonomy', 0);

function hrm_movie_flush_rewrite_on_theme_switch()
{
    // Re-register the post type/taxonomy if your code is loaded after theme switch.
    hrm_movie_register_movie_post_type();
    hrm_movie_register_genre_taxonomy();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'hrm_movie_flush_rewrite_on_theme_switch');


require get_template_directory() . '/inc/meta-box.php';
