<?php

if (!defined('ABSPATH')) {
    exit;
}

function gss_vite_dev_server_url(): string
{
    $origin = getenv('VITE_DEV_ORIGIN');

    if (is_string($origin) && $origin !== '') {
        return rtrim($origin, '/');
    }

    return 'http://127.0.0.1:5173';
}

function gss_is_vite_dev_server_running(): bool
{
    static $is_running = null;

    if ($is_running !== null) {
        return $is_running;
    }

    $response = wp_remote_get(gss_vite_dev_server_url() . '/@vite/client', [
        'timeout' => 2,
    ]);

    $is_running = !is_wp_error($response)
        && wp_remote_retrieve_response_code($response) === 200;

    return $is_running;
}

function gss_vite_asset(string $entry): ?array
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