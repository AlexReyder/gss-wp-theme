<?php

if (!defined('ABSPATH')) {
    exit;
}

add_action('acf/init', function (): void {
    if (!function_exists('acf_add_options_page')) {
        return;
    }

    acf_add_options_page([
        'page_title' => __('Проекты', 'gss'),
        'menu_title' => __('Проекты', 'gss'),
        'menu_slug' => 'gss-projects',
        'capability' => 'edit_posts',
        'redirect' => false,
        'position' => 25,
        'icon_url' => 'dashicons-format-gallery',
    ]);
});

add_action('acf/init', function (): void {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group([
        'key' => 'group_gss_projects',
        'title' => 'Проекты',
        'fields' => [
            [
                'key' => 'field_gss_projects_title',
                'label' => 'Заголовок блока',
                'name' => 'gss_projects_title',
                'type' => 'text',
                'default_value' => 'Опыт реализации объектов различной сложности',
                'required' => 1,
            ],
            [
                'key' => 'field_gss_projects_text',
                'label' => 'Текст блока',
                'name' => 'gss_projects_text',
                'type' => 'textarea',
                'rows' => 3,
                'new_lines' => 'br',
                'default_value' => 'Выполняем работы по строительству и монтажу инженерных систем на объектах различного назначения — от локальных участков до протяжённых сетей.',
                'required' => 0,
            ],
            [
                'key' => 'field_gss_projects_gallery',
                'label' => 'Галерея проектов',
                'name' => 'gss_projects_gallery',
                'type' => 'gallery',
                'return_format' => 'array',
                'preview_size' => 'medium',
                'insert' => 'append',
                'library' => 'all',
                'mime_types' => 'jpg,jpeg,png,webp,avif',
                'required' => 0,
                'instructions' => 'Рекомендуем добавить минимум 21 изображение. Порядок можно менять перетаскиванием.',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'gss-projects',
                ],
            ],
        ],
    ]);
});