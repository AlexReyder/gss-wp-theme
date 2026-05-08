<?php
/**
 * Theme header.
 */

if (!defined('ABSPATH')) {
	exit;
}

$default_menu_items = [
	[
		'label' => 'Услуги',
		'url' => '#services',
		'target_blank' => false,
	],
	[
		'label' => 'О компании',
		'url' => '#about',
		'target_blank' => false,
	],
	[
		'label' => 'Контакты',
		'url' => '#contacts',
		'target_blank' => false,
	],
];

$default_messengers = [
	[
		'title' => 'Telegram',
		'label' => 'TG',
		'url' => '#',
		'icon' => null,
	],
	[
		'title' => 'WhatsApp',
		'label' => 'WA',
		'url' => '#',
		'icon' => null,
	],
	[
		'title' => 'VK',
		'label' => 'VK',
		'url' => '#',
		'icon' => null,
	],
];

$logo = function_exists('get_field') ? get_field('gss_header_logo', 'option') : null;

$phone_raw = function_exists('get_field')
	? (string) get_field('gss_header_phone', 'option')
	: '';

if ($phone_raw === '') {
	$phone_raw = '+7 (921) 903-07-86';
}

$phone_href = preg_replace('/[^0-9+]/', '', $phone_raw);

$menu_items = function_exists('get_field') ? get_field('gss_header_menu', 'option') : [];
$menu_items = is_array($menu_items) && !empty($menu_items) ? $menu_items : $default_menu_items;

$messengers = function_exists('get_field') ? get_field('gss_header_messengers', 'option') : [];
$messengers = is_array($messengers) && !empty($messengers) ? $messengers : $default_messengers;
?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="gss-header">
	<div class="gss-header__container">
		<a
			class="gss-header__brand"
			href="<?php echo esc_url(home_url('/')); ?>"
			aria-label="<?php echo esc_attr(get_bloginfo('name')); ?>"
		>
			<?php if (is_array($logo) && !empty($logo['url'])) : ?>
				<img
					class="gss-header__logo"
					src="<?php echo esc_url($logo['url']); ?>"
					alt="<?php echo esc_attr($logo['alt'] ?? get_bloginfo('name')); ?>"
				>
			<?php else : ?>
				<span class="gss-header__logo-placeholder" aria-hidden="true">#</span>
			<?php endif; ?>
		</a>

		<nav class="gss-header__nav" aria-label="Основная навигация">
			<ul class="gss-header__menu">
				<?php foreach ($menu_items as $item) : ?>
					<?php
					$label = isset($item['label']) ? trim((string) $item['label']) : '';
					$url = isset($item['url']) ? trim((string) $item['url']) : '#';
					$target_blank = !empty($item['target_blank']);

					if ($label === '') {
						continue;
					}
					?>
					<li>
						<a
							href="<?php echo esc_url($url !== '' ? $url : '#'); ?>"
							<?php echo $target_blank ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>
						>
							<?php echo esc_html($label); ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</nav>

		<a class="gss-header__phone" href="<?php echo esc_url('tel:' . $phone_href); ?>">
			<?php echo esc_html($phone_raw); ?>
		</a>

		<button
			class="gss-header__burger"
			type="button"
			aria-label="Открыть меню"
			aria-expanded="false"
			aria-controls="gss-mobile-menu"
			data-menu-toggle
		>
			<span></span>
			<span></span>
			<span></span>
		</button>
	</div>

	<div class="gss-header__mobile" id="gss-mobile-menu" data-mobile-menu>
		<div class="gss-header__mobile-panel">
			<nav class="gss-header__mobile-nav" aria-label="Мобильная навигация">
				<ul class="gss-header__mobile-menu">
					<?php foreach ($menu_items as $item) : ?>
						<?php
						$label = isset($item['label']) ? trim((string) $item['label']) : '';
						$url = isset($item['url']) ? trim((string) $item['url']) : '#';
						$target_blank = !empty($item['target_blank']);

						if ($label === '') {
							continue;
						}
						?>
						<li>
							<a
								href="<?php echo esc_url($url !== '' ? $url : '#'); ?>"
								<?php echo $target_blank ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>
							>
								<?php echo esc_html($label); ?>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			</nav>

			<div class="gss-header__mobile-footer">
				<a class="gss-header__mobile-phone" href="<?php echo esc_url('tel:' . $phone_href); ?>">
					<?php echo esc_html($phone_raw); ?>
				</a>

				<?php if (!empty($messengers)) : ?>
					<div class="gss-header__mobile-socials" aria-label="Мессенджеры">
						<?php foreach ($messengers as $messenger) : ?>
							<?php
							$title = isset($messenger['title']) ? trim((string) $messenger['title']) : '';
							$label = isset($messenger['label']) ? trim((string) $messenger['label']) : '';
							$url = isset($messenger['url']) ? trim((string) $messenger['url']) : '#';
							$icon = $messenger['icon'] ?? null;

							if ($title === '' && $label === '') {
								continue;
							}

							$aria_label = $title !== '' ? $title : $label;
							?>
							<a
								class="gss-header__mobile-social"
								href="<?php echo esc_url($url !== '' ? $url : '#'); ?>"
								aria-label="<?php echo esc_attr($aria_label); ?>"
								target="_blank"
								rel="noopener noreferrer"
							>
								<?php if (is_array($icon) && !empty($icon['url'])) : ?>
									<img
										class="gss-header__mobile-social-icon"
										src="<?php echo esc_url($icon['url']); ?>"
										alt=""
									>
								<?php else : ?>
									<?php echo esc_html($label !== '' ? $label : $title); ?>
								<?php endif; ?>
							</a>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</header>