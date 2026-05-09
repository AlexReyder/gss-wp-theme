<?php
/**
 * Title: Hero
 * Slug: gss/hero
 * Categories: gss
 * Inserter: true
 * Description: Первый экран лендинга с заголовком, CTA и направлениями работ.
 */

if (!defined('ABSPATH')) {
	exit;
}

$hero_bg_url = 'https://xn--80aahktxhncjdhbf4m.xn--p1ai/wp-content/uploads/2026/05/hero.jpg';
?>

<!-- wp:cover {"url":"<?php echo esc_url($hero_bg_url); ?>","dimRatio":0,"minHeight":100,"minHeightUnit":"vh","tagName":"section","className":"gss-hero","layout":{"type":"default"}} -->
<section class="wp-block-cover gss-hero" style="min-height:100vh">
	<span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim"></span>
	<img class="wp-block-cover__image-background" alt="" src="<?php echo esc_url($hero_bg_url); ?>" data-object-fit="cover" />
	<div class="wp-block-cover__inner-container">

		<!-- wp:group {"className":"gss-hero__container","layout":{"type":"default"}} -->
		<div class="wp-block-group gss-hero__container">

			<!-- wp:group {"className":"gss-hero__main","layout":{"type":"default"}} -->
			<div class="wp-block-group gss-hero__main">

				<!-- wp:heading {"level":1,"className":"gss-hero__title"} -->
				<h1 class="wp-block-heading gss-hero__title">СТРОИТЕЛЬСТВО<br>И ПРОЕКТИРОВАНИЕ<br>ИНЖЕНЕРНЫХ СИСТЕМ</h1>
				<!-- /wp:heading -->

				<!-- wp:paragraph {"className":"gss-hero__lead"} -->
				<p class="gss-hero__lead">Берём на себя полный цикл — от проекта до ввода объекта в эксплуатацию</p>
				<!-- /wp:paragraph -->

				<!-- wp:buttons {"className":"gss-hero__actions","layout":{"type":"flex","justifyContent":"left"}} -->
				<div class="wp-block-buttons gss-hero__actions">

					<!-- wp:button {"url":"#","className":"gss-hero__button"} -->
					<div class="wp-block-button gss-hero__button">
						<a class="wp-block-button__link wp-element-button" href="#">Получить расчет</a>
					</div>
					<!-- /wp:button -->

				</div>
				<!-- /wp:buttons -->

			</div>
			<!-- /wp:group -->

			<!-- wp:group {"className":"gss-hero__directions","layout":{"type":"default"}} -->
			<div class="wp-block-group gss-hero__directions">

				<!-- wp:group {"className":"gss-hero-direction","layout":{"type":"default"}} -->
				<div class="wp-block-group gss-hero-direction">

					<!-- wp:heading {"level":3,"className":"gss-hero-direction__title"} -->
					<h3 class="wp-block-heading gss-hero-direction__title">Проектирование</h3>
					<!-- /wp:heading -->

					<!-- wp:paragraph {"className":"gss-hero-direction__text"} -->
					<p class="gss-hero-direction__text">Выполняем полный цикл строительных работ с соблюдением сроков и технических требований</p>
					<!-- /wp:paragraph -->

				</div>
				<!-- /wp:group -->

				<!-- wp:group {"className":"gss-hero-direction","layout":{"type":"default"}} -->
				<div class="wp-block-group gss-hero-direction">

					<!-- wp:heading {"level":3,"className":"gss-hero-direction__title"} -->
					<h3 class="wp-block-heading gss-hero-direction__title">Строительство</h3>
					<!-- /wp:heading -->

					<!-- wp:paragraph {"className":"gss-hero-direction__text"} -->
					<p class="gss-hero-direction__text">Ключевая специализация — монтаж и подключение надежных инженерных сетей</p>
					<!-- /wp:paragraph -->

				</div>
				<!-- /wp:group -->

				<!-- wp:group {"className":"gss-hero-direction","layout":{"type":"default"}} -->
				<div class="wp-block-group gss-hero-direction">

					<!-- wp:heading {"level":3,"className":"gss-hero-direction__title"} -->
					<h3 class="wp-block-heading gss-hero-direction__title">Тепло- и водоснабжение</h3>
					<!-- /wp:heading -->

					<!-- wp:paragraph {"className":"gss-hero-direction__text"} -->
					<p class="gss-hero-direction__text">Профессиональный монтаж и модернизация инженерных сетей</p>
					<!-- /wp:paragraph -->

				</div>
				<!-- /wp:group -->

				<!-- wp:group {"className":"gss-hero-direction","layout":{"type":"default"}} -->
				<div class="wp-block-group gss-hero-direction">

					<!-- wp:heading {"level":3,"className":"gss-hero-direction__title"} -->
					<h3 class="wp-block-heading gss-hero-direction__title">Алмазное бурение</h3>
					<!-- /wp:heading -->

					<!-- wp:paragraph {"className":"gss-hero-direction__text"} -->
					<p class="gss-hero-direction__text">Точное бурение и резка бетона без вибрации и повреждений конструкций</p>
					<!-- /wp:paragraph -->

				</div>
				<!-- /wp:group -->

			</div>
			<!-- /wp:group -->

		</div>
		<!-- /wp:group -->

	</div>
</section>
<!-- /wp:cover -->