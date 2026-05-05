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
            'name' => 'hero',
            'title' => __('Hero', 'garantstroyset'),
            'description' => __('Landing hero section.', 'garantstroyset'),
            'render_template' => GARANT_THEME_DIR . '/template-parts/blocks/hero.php',
            'category' => 'garantstroyset',
            'icon' => 'cover-image',
            'keywords' => ['hero', 'banner', 'главный экран'],
            'mode' => 'preview',
            'supports' => [
                'align' => false,
                'mode' => true,
                'jsx' => true,
            ],
        ],
        [
            'name' => 'engineering',
            'title' => __('Engineering Systems', 'garantstroyset'),
            'description' => __('Engineering systems intro block.', 'garantstroyset'),
            'render_template' => GARANT_THEME_DIR . '/template-parts/blocks/engineering.php',
            'category' => 'garantstroyset',
            'icon' => 'admin-tools',
            'keywords' => ['engineering', 'systems', 'инженерные системы'],
            'mode' => 'preview',
            'supports' => [
                'align' => false,
                'mode' => true,
                'jsx' => true,
            ],
        ],
        [
            'name' => 'services',
            'title' => __('Services', 'garantstroyset'),
            'description' => __('Services cards section.', 'garantstroyset'),
            'render_template' => GARANT_THEME_DIR . '/template-parts/blocks/services.php',
            'category' => 'garantstroyset',
            'icon' => 'grid-view',
            'keywords' => ['services', 'услуги'],
            'mode' => 'preview',
            'supports' => [
                'align' => false,
                'mode' => true,
                'jsx' => true,
            ],
        ],
        [
            'name' => 'portfolio',
            'title' => __('Portfolio Gallery', 'garantstroyset'),
            'description' => __('Portfolio gallery section.', 'garantstroyset'),
            'render_template' => GARANT_THEME_DIR . '/template-parts/blocks/portfolio.php',
            'category' => 'garantstroyset',
            'icon' => 'format-gallery',
            'keywords' => ['portfolio', 'gallery', 'объекты'],
            'mode' => 'preview',
            'supports' => [
                'align' => false,
                'mode' => true,
                'jsx' => true,
            ],
        ],
        [
            'name' => 'lead-form',
            'title' => __('Lead Form', 'garantstroyset'),
            'description' => __('Lead generation form section.', 'garantstroyset'),
            'render_template' => GARANT_THEME_DIR . '/template-parts/blocks/lead-form.php',
            'category' => 'garantstroyset',
            'icon' => 'email-alt',
            'keywords' => ['form', 'lead', 'заявка'],
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