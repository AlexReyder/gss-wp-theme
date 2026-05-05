<?php

if (!defined('ABSPATH')) {
    exit;
}

function garant_is_vite_dev(): bool
{
    $dev_server = 'http://127.0.0.1:5173/@vite/client';

    $response = wp_remote_get($dev_server, [
        'timeout' => 0.5,
    ]);

    return !is_wp_error($response) && wp_remote_retrieve_response_code($response) === 200;
}

function garant_vite_asset(string $entry): ?array
{
    $manifest_path = GARANT_THEME_DIR . '/assets/dist/manifest.json';

    if (!file_exists($manifest_path)) {
        return null;
    }

    $manifest = json_decode((string) file_get_contents($manifest_path), true);

    if (!is_array($manifest)) {
        return null;
    }

    return $manifest[$entry] ?? null;
}