<?php

if (!defined('ABSPATH')) {
    exit;
}

add_filter('script_loader_tag', function (string $tag, string $handle, string $src): string {
    $module_handles = [
        'gss-vite-client',
        'gss-vite-client-editor',
        'gss-app',
    ];

    if (!in_array($handle, $module_handles, true)) {
        return $tag;
    }

    return sprintf(
        '<script type="module" src="%s" id="%s-js"></script>',
        esc_url($src),
        esc_attr($handle)
    );
}, 10, 3);

add_action('wp_enqueue_scripts', function (): void {
    if (gss_is_vite_dev_server_running()) {
        $dev_server = gss_vite_dev_server_url();

        wp_enqueue_script(
            'gss-vite-client',
            $dev_server . '/@vite/client',
            [],
            null,
            true
        );

        wp_enqueue_script(
            'gss-app',
            $dev_server . '/assets/js/app.js',
            ['gss-vite-client'],
            null,
            true
        );

        return;
    }

    $entry = gss_vite_asset('assets/js/app.js');

    if (!$entry || empty($entry['file'])) {
        return;
    }

    if (!empty($entry['css']) && is_array($entry['css'])) {
        foreach ($entry['css'] as $index => $css_file) {
            wp_enqueue_style(
                'gss-app-' . $index,
                GARANT_THEME_URI . '/assets/dist/' . $css_file,
                [],
                GARANT_THEME_VERSION
            );
        }
    }

    wp_enqueue_script(
        'gss-app',
        GARANT_THEME_URI . '/assets/dist/' . $entry['file'],
        [],
        GARANT_THEME_VERSION,
        true
    );
});

add_action('enqueue_block_editor_assets', function (): void {
    if (gss_is_vite_dev_server_running()) {
        $dev_server = gss_vite_dev_server_url();

        wp_enqueue_script(
            'gss-vite-client-editor',
            $dev_server . '/@vite/client',
            [],
            null,
            true
        );

        wp_enqueue_style(
            'gss-editor-dev',
            $dev_server . '/assets/scss/editor.scss',
            [],
            null
        );

        return;
    }

    $entry = gss_vite_asset('assets/scss/editor.scss');

    if (!$entry || empty($entry['file'])) {
        return;
    }

    wp_enqueue_style(
        'gss-editor',
        GARANT_THEME_URI . '/assets/dist/' . $entry['file'],
        [],
        GARANT_THEME_VERSION
    );
});