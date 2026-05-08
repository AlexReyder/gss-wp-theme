<?php

if (!defined('ABSPATH')) {
    exit;
}

add_action('acf/init', function (): void {
    if (!function_exists('acf_add_options_page')) {
        return;
    }



     acf_add_options_page([
        'page_title' => __('Шапка', 'garantstroyset'),
        'menu_title' => __('Шапка', 'garantstroyset'),
        'menu_slug'  => 'gss-header-settings',
        'capability' => 'edit_posts',
        'redirect'   => false,
        'position'   => 58,
        'icon_url'   => 'dashicons-editor-kitchensink',
    ]);
});