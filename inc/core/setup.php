<?php

if (!defined('ABSPATH')) {
    exit;
}

add_action('after_setup_theme', function (): void {
    load_theme_textdomain('garantstroyset', GARANT_THEME_DIR . '/languages');

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_image_size('gss_project_grid', 720, 520, true);
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ]);

    add_theme_support('align-wide');
    add_theme_support('editor-styles');

    add_editor_style('assets/dist/css/editor.css');

    register_nav_menus([
        'primary' => __('Primary Menu', 'garantstroyset'),
        'footer' => __('Footer Menu', 'garantstroyset'),
    ]);
});