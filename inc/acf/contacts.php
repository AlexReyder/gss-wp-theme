<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Contacts options page.
 */
add_action('acf/init', function (): void {
    if (!function_exists('acf_add_options_page')) {
        return;
    }

    acf_add_options_page([
        'page_title' => 'Контакты',
        'menu_title' => 'Контакты',
        'menu_slug' => 'gss-contacts',
        'capability' => 'edit_posts',
        'redirect' => false,
        'position' => 27,
        'icon_url' => 'dashicons-location-alt',
    ]);
});

/**
 * Contacts fields.
 */
add_action('acf/init', function (): void {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group([
        'key' => 'group_gss_contacts',
        'title' => 'Контакты',
        'fields' => [
            [
                'key' => 'field_gss_contacts_tab_company',
                'label' => 'Компания',
                'name' => '',
                'type' => 'tab',
                'placement' => 'top',
            ],
            [
                'key' => 'field_gss_contacts_company_title',
                'label' => 'Название компании',
                'name' => 'gss_contacts_company_title',
                'type' => 'text',
                'default_value' => 'ООО “ГАРАНТСТРОЙСЕТЬ”',
                'required' => 1,
            ],
            [
                'key' => 'field_gss_contacts_company_logo',
                'label' => 'Логотип компании',
                'name' => 'gss_contacts_company_logo',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
                'library' => 'all',
                'mime_types' => 'jpg,jpeg,png,webp,svg',
                'required' => 0,
            ],
            [
                'key' => 'field_gss_contacts_requisites_pdf',
                'label' => 'PDF с реквизитами',
                'name' => 'gss_contacts_requisites_pdf',
                'type' => 'file',
                'return_format' => 'array',
                'library' => 'all',
                'mime_types' => 'pdf',
                'required' => 0,
                'instructions' => 'Файл будет использоваться для кнопки “Скачать PDF”.',
            ],

            [
                'key' => 'field_gss_contacts_tab_registration',
                'label' => 'Регистрационные данные',
                'name' => '',
                'type' => 'tab',
                'placement' => 'top',
            ],
            [
                'key' => 'field_gss_contacts_registration_items',
                'label' => 'Регистрационные данные',
                'name' => 'gss_contacts_registration_items',
                'type' => 'repeater',
                'layout' => 'table',
                'button_label' => 'Добавить строку',
                'collapsed' => 'field_gss_contacts_registration_label',
                'sub_fields' => [
                    [
                        'key' => 'field_gss_contacts_registration_label',
                        'label' => 'Название',
                        'name' => 'label',
                        'type' => 'text',
                        'required' => 1,
                    ],
                    [
                        'key' => 'field_gss_contacts_registration_value',
                        'label' => 'Значение',
                        'name' => 'value',
                        'type' => 'text',
                        'required' => 1,
                    ],
                ],
                'default_value' => [
                    [
                        'label' => 'ИНН',
                        'value' => '7813679783',
                    ],
                    [
                        'label' => 'КПП',
                        'value' => '781301001',
                    ],
                    [
                        'label' => 'ОГРН',
                        'value' => '1247800045734',
                    ],
                    [
                        'label' => 'ОКПО',
                        'value' => '56783273',
                    ],
                ],
            ],

            [
                'key' => 'field_gss_contacts_tab_bank',
                'label' => 'Банковские реквизиты',
                'name' => '',
                'type' => 'tab',
                'placement' => 'top',
            ],
            [
                'key' => 'field_gss_contacts_bank_items',
                'label' => 'Банковские реквизиты',
                'name' => 'gss_contacts_bank_items',
                'type' => 'repeater',
                'layout' => 'table',
                'button_label' => 'Добавить строку',
                'collapsed' => 'field_gss_contacts_bank_label',
                'sub_fields' => [
                    [
                        'key' => 'field_gss_contacts_bank_label',
                        'label' => 'Название',
                        'name' => 'label',
                        'type' => 'text',
                        'required' => 1,
                    ],
                    [
                        'key' => 'field_gss_contacts_bank_value',
                        'label' => 'Значение',
                        'name' => 'value',
                        'type' => 'text',
                        'required' => 1,
                    ],
                ],
                'default_value' => [
                    [
                        'label' => 'Р/с',
                        'value' => '40702810055000126575',
                    ],
                    [
                        'label' => 'Банк',
                        'value' => 'СЕВЕРО-ЗАПАДНЫЙ БАНК ПАО СБЕРБАНК',
                    ],
                    [
                        'label' => 'БИК',
                        'value' => '044030653',
                    ],
                    [
                        'label' => 'К/с',
                        'value' => '30101810500000000653',
                    ],
                ],
            ],

            [
                'key' => 'field_gss_contacts_tab_contacts',
                'label' => 'Контактные данные',
                'name' => '',
                'type' => 'tab',
                'placement' => 'top',
            ],
            [
                'key' => 'field_gss_contacts_section_title',
                'label' => 'Заголовок блока контактов',
                'name' => 'gss_contacts_section_title',
                'type' => 'text',
                'default_value' => 'КОНТАКТЫ',
                'required' => 1,
            ],
            [
                'key' => 'field_gss_contacts_phone',
                'label' => 'Телефон',
                'name' => 'gss_contacts_phone',
                'type' => 'text',
                'default_value' => '+7 (921) 903-07-86',
                'required' => 0,
            ],
            [
                'key' => 'field_gss_contacts_phone_url',
                'label' => 'Ссылка телефона',
                'name' => 'gss_contacts_phone_url',
                'type' => 'text',
                'default_value' => 'tel:+79219030786',
                'required' => 0,
                'instructions' => 'Например: tel:+79219030786',
            ],
            [
                'key' => 'field_gss_contacts_email',
                'label' => 'Email',
                'name' => 'gss_contacts_email',
                'type' => 'email',
                'default_value' => 'garantstroyset@mail.ru',
                'required' => 0,
            ],
            [
                'key' => 'field_gss_contacts_working_hours',
                'label' => 'Режим работы',
                'name' => 'gss_contacts_working_hours',
                'type' => 'text',
                'default_value' => 'с 9:00 до 18:00',
                'required' => 0,
            ],
            [
                'key' => 'field_gss_contacts_messengers',
                'label' => 'Мессенджеры / соцсети',
                'name' => 'gss_contacts_messengers',
                'type' => 'repeater',
                'layout' => 'table',
                'button_label' => 'Добавить ссылку',
                'collapsed' => 'field_gss_contacts_messenger_label',
                'sub_fields' => [
                    [
                        'key' => 'field_gss_contacts_messenger_label',
                        'label' => 'Название',
                        'name' => 'label',
                        'type' => 'text',
                        'required' => 1,
                    ],
                    [
                        'key' => 'field_gss_contacts_messenger_url',
                        'label' => 'Ссылка',
                        'name' => 'url',
                        'type' => 'url',
                        'required' => 1,
                    ],
                    [
                        'key' => 'field_gss_contacts_messenger_icon',
                        'label' => 'Иконка',
                        'name' => 'icon',
                        'type' => 'image',
                        'return_format' => 'array',
                        'preview_size' => 'thumbnail',
                        'library' => 'all',
                        'mime_types' => 'jpg,jpeg,png,webp,svg',
                        'required' => 0,
                    ],
                ],
                'default_value' => [
                    [
                        'label' => 'VK',
                        'url' => '#',
                    ],
                    [
                        'label' => 'Telegram',
                        'url' => '#',
                    ],
                    [
                        'label' => 'Messenger',
                        'url' => '#',
                    ],
                ],
            ],

            [
                'key' => 'field_gss_contacts_tab_sro',
                'label' => 'СРО',
                'name' => '',
                'type' => 'tab',
                'placement' => 'top',
            ],
            [
                'key' => 'field_gss_contacts_sro_title',
                'label' => 'Заголовок СРО',
                'name' => 'gss_contacts_sro_title',
                'type' => 'text',
                'default_value' => 'СРО',
                'required' => 0,
            ],
            [
                'key' => 'field_gss_contacts_sro_image',
                'label' => 'Изображение / документ СРО',
                'name' => 'gss_contacts_sro_image',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
                'library' => 'all',
                'mime_types' => 'jpg,jpeg,png,webp,svg',
                'required' => 0,
            ],
            [
                'key' => 'field_gss_contacts_sro_text',
                'label' => 'Текст СРО',
                'name' => 'gss_contacts_sro_text',
                'type' => 'textarea',
                'rows' => 5,
                'new_lines' => 'br',
                'default_value' => 'Компания состоит в саморегулируемой организации. Все работы выполняются в соответствии с требованиями законодательства РФ и отраслевых стандартов.',
                'required' => 0,
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'gss-contacts',
                ],
            ],
        ],
    ]);
});