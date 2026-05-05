<?php

if (!defined('ABSPATH')) {
    exit;
}

add_action('init', function (): void {
    if (!function_exists('register_block_pattern_category')) {
        return;
    }

    register_block_pattern_category('gss', [
        'label' => __('GSS Blocks', 'gss'),
    ]);
});