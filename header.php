<?php
/**
 * Theme header.
 */

if (!defined('ABSPATH')) {
	exit;
}

$phone_raw = '+7 (921) 903-07-86';
$phone_href = preg_replace('/[^0-9+]/', '', $phone_raw);
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
		<a class="gss-header__brand" href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php echo esc_attr(get_bloginfo('name')); ?>">
			<span class="gss-header__logo-placeholder" aria-hidden="true">
				<span class="gss-header__logo-mark">GSS</span>
			</span>

			<span class="gss-header__brand-text">
				<span class="gss-header__brand-name">ГАРАНТСТРОЙСЕТЬ</span>
				<span class="gss-header__brand-caption">СТРОИТЕЛЬСТВО ИНЖЕНЕРНЫХ СЕТЕЙ</span>
			</span>
		</a>

		<nav class="gss-header__nav" aria-label="Основная навигация">
			<?php
			wp_nav_menu([
				'theme_location' => 'primary',
				'container'      => false,
				'menu_class'     => 'gss-header__menu',
				'fallback_cb'    => false,
				'depth'          => 1,
			]);
			?>

			<?php if (!has_nav_menu('primary')) : ?>
				<ul class="gss-header__menu">
					<li class="gss-header__menu-item">
						<a class="gss-header__menu-link" href="#services">Услуги</a>
					</li>
					<li class="gss-header__menu-item">
						<a class="gss-header__menu-link" href="#about">О компании</a>
					</li>
					<li class="gss-header__menu-item">
						<a class="gss-header__menu-link" href="#contacts">Контакты</a>
					</li>
				</ul>
			<?php endif; ?>
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
		<nav class="gss-header__mobile-nav" aria-label="Мобильная навигация">
			<?php
			wp_nav_menu([
				'theme_location' => 'primary',
				'container'      => false,
				'menu_class'     => 'gss-header__mobile-menu',
				'fallback_cb'    => false,
				'depth'          => 1,
			]);
			?>

			<?php if (!has_nav_menu('primary')) : ?>
				<ul class="gss-header__mobile-menu">
					<li class="gss-header__mobile-menu-item">
						<a class="gss-header__mobile-link" href="#services">Услуги</a>
					</li>
					<li class="gss-header__mobile-menu-item">
						<a class="gss-header__mobile-link" href="#about">О компании</a>
					</li>
					<li class="gss-header__mobile-menu-item">
						<a class="gss-header__mobile-link" href="#contacts">Контакты</a>
					</li>
				</ul>
			<?php endif; ?>

			<a class="gss-header__mobile-phone" href="<?php echo esc_url('tel:' . $phone_href); ?>">
				<?php echo esc_html($phone_raw); ?>
			</a>
		</nav>
	</div>
</header>