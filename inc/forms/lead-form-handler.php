<?php

if (!defined('ABSPATH')) {
    exit;
}

add_action('admin_post_nopriv_gss_submit_lead', 'gss_handle_lead_form_submit');
add_action('admin_post_gss_submit_lead', 'gss_handle_lead_form_submit');
add_action('wp_ajax_nopriv_gss_submit_lead', 'gss_handle_lead_form_submit');
add_action('wp_ajax_gss_submit_lead', 'gss_handle_lead_form_submit');

function gss_handle_lead_form_submit(): void
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        gss_lead_redirect('error');
    }

    $honeypot = isset($_POST['company'])
        ? trim((string) wp_unslash($_POST['company']))
        : '';

    if ($honeypot !== '') {
        gss_lead_redirect('success');
    }

    $name = isset($_POST['name'])
        ? sanitize_text_field(wp_unslash($_POST['name']))
        : '';

    $phone = isset($_POST['phone'])
        ? sanitize_text_field(wp_unslash($_POST['phone']))
        : '';

    $agreement = isset($_POST['agreement'])
        ? sanitize_text_field(wp_unslash($_POST['agreement']))
        : '';

    $form_source = isset($_POST['form_source'])
        ? sanitize_text_field(wp_unslash($_POST['form_source']))
        : 'CTA';

    $page_url = isset($_POST['page_url'])
        ? esc_url_raw(wp_unslash($_POST['page_url']))
        : '';

    if ($page_url === '') {
        $page_url = wp_get_referer() ?: home_url('/');
    }

    $phone_digits = preg_replace('/\D+/', '', $phone);

    if ($name === '' || $phone === '' || strlen($phone_digits) < 10 || $agreement !== '1') {
        gss_lead_redirect('invalid');
    }

    $client_ip = gss_get_client_ip();

    if (gss_is_lead_rate_limited($client_ip)) {
        gss_lead_redirect('throttled');
    }

    gss_set_lead_rate_limit($client_ip);

    $created_at = current_time('mysql');

    $post_id = wp_insert_post([
        'post_type' => 'gss_lead',
        'post_status' => 'publish',
        'post_title' => sprintf(
            'Заявка от %s — %s',
            $name,
            wp_date('d.m.Y H:i')
        ),
    ], true);

    if (is_wp_error($post_id)) {
        gss_lead_redirect('error');
    }

    gss_update_lead_field('field_gss_lead_name', 'gss_lead_name', $name, $post_id);
    gss_update_lead_field('field_gss_lead_phone', 'gss_lead_phone', $phone, $post_id);
    gss_update_lead_field('field_gss_lead_form_source', 'gss_lead_form_source', $form_source, $post_id);
    gss_update_lead_field('field_gss_lead_page_url', 'gss_lead_page_url', $page_url, $post_id);
    gss_update_lead_field('field_gss_lead_client_ip', 'gss_lead_client_ip', $client_ip, $post_id);
    gss_update_lead_field(
        'field_gss_lead_user_agent',
        'gss_lead_user_agent',
        isset($_SERVER['HTTP_USER_AGENT'])
            ? sanitize_text_field(wp_unslash($_SERVER['HTTP_USER_AGENT']))
            : '',
        $post_id
    );
    gss_update_lead_field('field_gss_lead_created_at', 'gss_lead_created_at', $created_at, $post_id);
    gss_update_lead_field('field_gss_lead_agreement', 'gss_lead_agreement', 1, $post_id);

    gss_send_lead_email([
        'post_id' => (int) $post_id,
        'name' => $name,
        'phone' => $phone,
        'form_source' => $form_source,
        'page_url' => $page_url,
        'client_ip' => $client_ip,
        'created_at' => $created_at,
    ]);

    gss_lead_redirect('success');
}

function gss_update_lead_field(string $field_key, string $field_name, mixed $value, int $post_id): void
{
    if (function_exists('update_field')) {
        update_field($field_key, $value, $post_id);
        return;
    }

    update_post_meta($post_id, $field_name, $value);
}

function gss_send_lead_email(array $lead): void
{
    $recipient_email = '';

    if (function_exists('get_field')) {
        $recipient_email = (string) get_field('gss_leads_recipient_email', 'option');
    }

    $to = is_email($recipient_email)
        ? $recipient_email
        : get_option('admin_email');

    if (!is_email($to)) {
        return;
    }

    $subject = sprintf(
        'Новая заявка с сайта %s',
        wp_parse_url(home_url(), PHP_URL_HOST)
    );

    $admin_link = get_edit_post_link((int) $lead['post_id'], '');

    $message = '
        <h2>Новая заявка с сайта</h2>

        <table cellpadding="8" cellspacing="0" border="0">
            <tr>
                <td><strong>Имя:</strong></td>
                <td>' . esc_html($lead['name']) . '</td>
            </tr>
            <tr>
                <td><strong>Телефон:</strong></td>
                <td>' . esc_html($lead['phone']) . '</td>
            </tr>
            <tr>
                <td><strong>Форма:</strong></td>
                <td>' . esc_html($lead['form_source']) . '</td>
            </tr>
            <tr>
                <td><strong>Страница:</strong></td>
                <td><a href="' . esc_url($lead['page_url']) . '">' . esc_html($lead['page_url']) . '</a></td>
            </tr>
            <tr>
                <td><strong>IP:</strong></td>
                <td>' . esc_html($lead['client_ip']) . '</td>
            </tr>
            <tr>
                <td><strong>Дата:</strong></td>
                <td>' . esc_html($lead['created_at']) . '</td>
            </tr>
        </table>
    ';

    if ($admin_link) {
        $message .= '<p><a href="' . esc_url($admin_link) . '">Открыть заявку в админке</a></p>';
    }

    wp_mail($to, $subject, $message, [
        'Content-Type: text/html; charset=UTF-8',
    ]);
}

function gss_lead_redirect(string $status): void
{
    if (wp_doing_ajax()) {
        $message = gss_get_lead_status_message($status);

        if ($status === 'success') {
            wp_send_json_success([
                'status' => $status,
                'message' => $message,
            ]);
        }

        $http_status = match ($status) {
            'invalid' => 422,
            'throttled' => 429,
            default => 500,
        };

        wp_send_json_error([
            'status' => $status,
            'message' => $message,
        ], $http_status);
    }

    $redirect_to = isset($_POST['redirect_to'])
        ? esc_url_raw(wp_unslash($_POST['redirect_to']))
        : '';

    if ($redirect_to === '') {
        $redirect_to = wp_get_referer() ?: home_url('/');
    }

    $redirect_to = wp_validate_redirect($redirect_to, home_url('/'));
    $redirect_to = remove_query_arg('gss_lead_status', $redirect_to);
    $redirect_to = add_query_arg('gss_lead_status', $status, $redirect_to);

    wp_safe_redirect($redirect_to . '#gss-cta-form');
    exit;
}

function gss_get_lead_status_message(string $status): string
{
    return match ($status) {
        'success' => 'Спасибо! Заявка отправлена. Мы свяжемся с вами в ближайшее время.',
        'invalid' => 'Проверьте имя, телефон и согласие на обработку персональных данных.',
        'throttled' => 'Заявка уже была отправлена. Попробуйте повторить чуть позже.',
        default => 'Не удалось отправить заявку. Попробуйте повторить позже.',
    };
}

function gss_get_client_ip(): string
{
    if (!empty($_SERVER['REMOTE_ADDR'])) {
        return sanitize_text_field(wp_unslash($_SERVER['REMOTE_ADDR']));
    }

    return '';
}

function gss_is_lead_rate_limited(string $client_ip): bool
{
    if ($client_ip === '') {
        return false;
    }

    return (bool) get_transient('gss_lead_rate_' . md5($client_ip));
}

function gss_set_lead_rate_limit(string $client_ip): void
{
    if ($client_ip === '') {
        return;
    }

    set_transient('gss_lead_rate_' . md5($client_ip), '1', 30);
}