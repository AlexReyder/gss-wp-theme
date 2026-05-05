<?php

if (!defined('ABSPATH')) {
    exit;
}

add_action('acf/init', function (): void {
    if (!function_exists('acf_add_options_page')) {
        return;
    }

    acf_add_options_page([
        'page_title' => __('Theme Settings', 'garantstroyset'),
        'menu_title' => __('Theme Settings', 'garantstroyset'),
        'menu_slug' => 'theme-settings',
        'capability' => 'edit_posts',
        'redirect' => false,
        'position' => 59,
    ]);
});