<?php

if (!defined('ABSPATH')) {
    exit;
}

add_action('acf/init', function (): void {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group([
        'key' => 'group_gss_header_settings',
        'title' => __('Настройки шапки', 'garantstroyset'),
        'fields' => [
            [
                'key' => 'field_gss_header_logo',
                'label' => __('Логотип', 'garantstroyset'),
                'name' => 'gss_header_logo',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
                'library' => 'all',
                'instructions' => __('Если логотип не выбран, будет показан placeholder #.', 'garantstroyset'),
            ],
            [
                'key' => 'field_gss_header_phone',
                'label' => __('Телефон', 'garantstroyset'),
                'name' => 'gss_header_phone',
                'type' => 'text',
                'default_value' => '+7 (921) 903-07-86',
                'placeholder' => '+7 (921) 903-07-86',
            ],
            [
                'key' => 'field_gss_header_menu',
                'label' => __('Пункты меню', 'garantstroyset'),
                'name' => 'gss_header_menu',
                'type' => 'repeater',
                'layout' => 'table',
                'button_label' => __('Добавить пункт меню', 'garantstroyset'),
                'min' => 0,
                'sub_fields' => [
                    [
                        'key' => 'field_gss_header_menu_label',
                        'label' => __('Название', 'garantstroyset'),
                        'name' => 'label',
                        'type' => 'text',
                        'required' => 1,
                        'placeholder' => 'Услуги',
                    ],
                    [
                        'key' => 'field_gss_header_menu_url',
                        'label' => __('Ссылка', 'garantstroyset'),
                        'name' => 'url',
                        'type' => 'text',
                        'required' => 1,
                        'placeholder' => '#services',
                    ],
                    [
                        'key' => 'field_gss_header_menu_target_blank',
                        'label' => __('Открывать в новой вкладке', 'garantstroyset'),
                        'name' => 'target_blank',
                        'type' => 'true_false',
                        'ui' => 1,
                        'default_value' => 0,
                    ],
                ],
            ],
            [
                'key' => 'field_gss_header_messengers',
                'label' => __('Мессенджеры', 'garantstroyset'),
                'name' => 'gss_header_messengers',
                'type' => 'repeater',
                'layout' => 'table',
                'button_label' => __('Добавить мессенджер', 'garantstroyset'),
                'min' => 0,
                'sub_fields' => [
                    [
                        'key' => 'field_gss_header_messenger_title',
                        'label' => __('Название', 'garantstroyset'),
                        'name' => 'title',
                        'type' => 'text',
                        'required' => 1,
                        'placeholder' => 'Telegram',
                    ],
                    [
                        'key' => 'field_gss_header_messenger_label',
                        'label' => __('Короткая подпись', 'garantstroyset'),
                        'name' => 'label',
                        'type' => 'text',
                        'required' => 1,
                        'placeholder' => 'TG',
                        'maxlength' => 8,
                    ],
                    [
                        'key' => 'field_gss_header_messenger_url',
                        'label' => __('Ссылка', 'garantstroyset'),
                        'name' => 'url',
                        'type' => 'url',
                        'required' => 1,
                        'placeholder' => 'https://t.me/...',
                    ],
                    [
                        'key' => 'field_gss_header_messenger_icon',
                        'label' => __('Иконка', 'garantstroyset'),
                        'name' => 'icon',
                        'type' => 'image',
                        'return_format' => 'array',
                        'preview_size' => 'thumbnail',
                        'library' => 'all',
                        'instructions' => __('Необязательно. Если иконка не выбрана, будет показана короткая подпись.', 'garantstroyset'),
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'gss-header-settings',
                ],
            ],
        ],
        'position' => 'normal',
        'style' => 'default',
        'active' => true,
    ]);
});