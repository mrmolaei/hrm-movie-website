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
