<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Leads post type.
 */
add_action('init', function (): void {
    register_post_type('gss_lead', [
        'labels' => [
            'name' => 'Заявки',
            'singular_name' => 'Заявка',
            'menu_name' => 'Заявки',
            'name_admin_bar' => 'Заявка',
            'add_new' => 'Добавить заявку',
            'add_new_item' => 'Добавить заявку',
            'edit_item' => 'Просмотр заявки',
            'new_item' => 'Новая заявка',
            'view_item' => 'Посмотреть заявку',
            'search_items' => 'Искать заявки',
            'not_found' => 'Заявки не найдены',
            'not_found_in_trash' => 'В корзине заявок не найдено',
        ],
        'public' => false,
        'publicly_queryable' => false,
        'exclude_from_search' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_rest' => false,
        'menu_position' => 26,
        'menu_icon' => 'dashicons-email-alt2',
        'capability_type' => 'post',
        'supports' => ['title'],
    ]);
});

/**
 * Disable Gutenberg for Leads.
 */
add_filter('use_block_editor_for_post_type', function (bool $use_block_editor, string $post_type): bool {
    if ($post_type === 'gss_lead') {
        return false;
    }

    return $use_block_editor;
}, 10, 2);

/**
 * ACF settings page under Leads.
 */
add_action('acf/init', function (): void {
    if (!function_exists('acf_add_options_sub_page')) {
        return;
    }

    acf_add_options_sub_page([
        'page_title' => 'Настройки заявок',
        'menu_title' => 'Настройки',
        'menu_slug' => 'gss-leads-settings',
        'parent_slug' => 'edit.php?post_type=gss_lead',
        'capability' => 'edit_posts',
        'redirect' => false,
    ]);
});

/**
 * ACF fields for Leads.
 */
add_action('acf/init', function (): void {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group([
        'key' => 'group_gss_lead_fields',
        'title' => 'Данные заявки',
        'fields' => [
            [
                'key' => 'field_gss_lead_name',
                'label' => 'Имя',
                'name' => 'gss_lead_name',
                'type' => 'text',
                'readonly' => 1,
            ],
            [
                'key' => 'field_gss_lead_phone',
                'label' => 'Телефон',
                'name' => 'gss_lead_phone',
                'type' => 'text',
                'readonly' => 1,
            ],
            [
                'key' => 'field_gss_lead_form_source',
                'label' => 'Форма',
                'name' => 'gss_lead_form_source',
                'type' => 'text',
                'readonly' => 1,
            ],
            [
                'key' => 'field_gss_lead_page_url',
                'label' => 'Страница отправки',
                'name' => 'gss_lead_page_url',
                'type' => 'url',
                'readonly' => 1,
            ],
            [
                'key' => 'field_gss_lead_client_ip',
                'label' => 'IP',
                'name' => 'gss_lead_client_ip',
                'type' => 'text',
                'readonly' => 1,
            ],
            [
                'key' => 'field_gss_lead_user_agent',
                'label' => 'User Agent',
                'name' => 'gss_lead_user_agent',
                'type' => 'textarea',
                'rows' => 3,
                'readonly' => 1,
            ],
            [
                'key' => 'field_gss_lead_created_at',
                'label' => 'Дата заявки',
                'name' => 'gss_lead_created_at',
                'type' => 'text',
                'readonly' => 1,
            ],
            [
                'key' => 'field_gss_lead_agreement',
                'label' => 'Согласие на обработку данных',
                'name' => 'gss_lead_agreement',
                'type' => 'true_false',
                'ui' => 1,
                'disabled' => 1,
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'gss_lead',
                ],
            ],
        ],
    ]);

    acf_add_local_field_group([
        'key' => 'group_gss_leads_settings',
        'title' => 'Настройки заявок',
        'fields' => [
            [
                'key' => 'field_gss_leads_recipient_email',
                'label' => 'Email для получения заявок',
                'name' => 'gss_leads_recipient_email',
                'type' => 'email',
                'instructions' => 'Если поле пустое, заявки будут отправляться на email администратора сайта из настроек WordPress.',
                'required' => 0,
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'gss-leads-settings',
                ],
            ],
        ],
    ]);
});

/**
 * Leads admin columns.
 */
add_filter('manage_gss_lead_posts_columns', function (array $columns): array {
    return [
        'cb' => $columns['cb'],
        'title' => 'Заявка',
        'gss_lead_name' => 'Имя',
        'gss_lead_phone' => 'Телефон',
        'gss_lead_source' => 'Форма',
        'gss_lead_page' => 'Страница',
        'date' => $columns['date'],
    ];
});

add_action('manage_gss_lead_posts_custom_column', function (string $column, int $post_id): void {
    if ($column === 'gss_lead_name') {
        echo esc_html((string) get_field('gss_lead_name', $post_id));
    }

    if ($column === 'gss_lead_phone') {
        echo esc_html((string) get_field('gss_lead_phone', $post_id));
    }

    if ($column === 'gss_lead_source') {
        echo esc_html((string) get_field('gss_lead_form_source', $post_id));
    }

    if ($column === 'gss_lead_page') {
        $page_url = (string) get_field('gss_lead_page_url', $post_id);

        if ($page_url !== '') {
            echo '<a href="' . esc_url($page_url) . '" target="_blank" rel="noopener noreferrer">Открыть</a>';
        }
    }
}, 10, 2);