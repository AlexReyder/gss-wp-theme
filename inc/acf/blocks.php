<?php

if (!defined('ABSPATH')) {
    exit;
}

add_action('acf/init', function (): void {
    if (!function_exists('acf_register_block_type')) {
        return;
    }

    $blocks = [
        [
            'name' => 'projects',
            'title' => __('Projects', 'gss'),
            'description' => __('Projects gallery block.', 'gss'),
            'render_template' => GARANT_THEME_DIR . '/template-parts/blocks/projects.php',
            'category' => 'garantstroyset',
            'icon' => 'format-gallery',
            'keywords' => ['projects', 'gallery', 'проекты', 'галерея'],
            'mode' => 'preview',
            'supports' => [
                'align' => false,
                'mode' => true,
                'jsx' => true,
            ],
        ],
        [
            'name' => 'contacts',
            'title' => __('Contacts', 'garantstroyset'),
            'description' => __('Contacts and company requisites section.', 'garantstroyset'),
            'render_template' => GARANT_THEME_DIR . '/template-parts/blocks/contacts.php',
            'category' => 'garantstroyset',
            'icon' => 'location-alt',
            'keywords' => ['contacts', 'контакты', 'реквизиты'],
            'mode' => 'preview',
            'supports' => [
                'align' => false,
                'mode' => true,
                'jsx' => true,
            ],
        ],
    ];

    foreach ($blocks as $block) {
        acf_register_block_type($block);
    }
});

add_filter('block_categories_all', function (array $categories): array {
    return array_merge(
        [
            [
                'slug' => 'garantstroyset',
                'title' => __('Garantstroyset', 'garantstroyset'),
                'icon' => null,
            ],
        ],
        $categories
    );
});

acf_register_block_type([
    'name' => 'projects',
    'title' => __('Projects', 'gss'),
    'description' => __('Projects gallery block.', 'gss'),
    'render_template' => GARANT_THEME_DIR . '/template-parts/blocks/projects.php',
    'category' => 'garantstroyset',
    'icon' => 'format-gallery',
    'keywords' => ['projects', 'gallery', 'проекты', 'галерея'],
    'mode' => 'preview',
    'supports' => [
        'align' => false,
        'mode' => true,
        'jsx' => true,
    ],
]);