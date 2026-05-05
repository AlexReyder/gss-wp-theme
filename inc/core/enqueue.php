<?php

if (!defined('ABSPATH')) {
    exit;
}

add_action('wp_enqueue_scripts', function (): void {
    if (garant_is_vite_dev()) {
        wp_enqueue_script(
            'garant-vite-client',
            'http://127.0.0.1:5173/@vite/client',
            [],
            null,
            true
        );

        wp_enqueue_script(
            'garant-app',
            'http://127.0.0.1:5173/assets/src/js/app.js',
            [],
            null,
            true
        );

        return;
    }

    $entry = garant_vite_asset('assets/src/js/app.js');

    if (!$entry || empty($entry['file'])) {
        return;
    }

    if (!empty($entry['css']) && is_array($entry['css'])) {
        foreach ($entry['css'] as $index => $css_file) {
            wp_enqueue_style(
                'garant-app-' . $index,
                GARANT_THEME_URI . '/assets/dist/' . $css_file,
                [],
                GARANT_THEME_VERSION
            );
        }
    }

    wp_enqueue_script(
        'garant-app',
        GARANT_THEME_URI . '/assets/dist/' . $entry['file'],
        [],
        GARANT_THEME_VERSION,
        true
    );
});

add_action('enqueue_block_editor_assets', function (): void {
    if (garant_is_vite_dev()) {
        wp_enqueue_script(
            'garant-vite-client-editor',
            'http://127.0.0.1:5173/@vite/client',
            [],
            null,
            true
        );

        wp_enqueue_style(
            'garant-editor-dev',
            'http://127.0.0.1:5173/assets/src/scss/editor.scss',
            [],
            null
        );

        return;
    }

    $entry = garant_vite_asset('assets/src/scss/editor.scss');

    if (!$entry || empty($entry['file'])) {
        return;
    }

    wp_enqueue_style(
        'garant-editor',
        GARANT_THEME_URI . '/assets/dist/' . $entry['file'],
        [],
        GARANT_THEME_VERSION
    );
});