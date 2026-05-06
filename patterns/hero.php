<?php
/**
 * Title: Hero
 * Slug: gss/hero
 * Categories: gss
 * Inserter: true
 * Description: Первый экран лендинга с большим заголовком, CTA и списком направлений.
 */

if (!defined('ABSPATH')) {
	exit;
}
?>

<!-- wp:group {"tagName":"section","className":"gss-hero","layout":{"type":"default"}} -->
<section class="wp-block-group gss-hero">
	<div class="gss-hero__background" aria-hidden="true">
		<div class="gss-hero__background-placeholder">
			<span>Placeholder для фоновой фотографии Hero</span>
		</div>
	</div>

	<div class="gss-hero__overlay" aria-hidden="true"></div>

	<div class="gss-hero__container">
		<div class="gss-hero__content">
			<h1 class="gss-hero__title">
				СТРОИТЕЛЬСТВО<br>
				И ПРОЕКТИРОВАНИЕ<br>
				ИНЖЕНЕРНЫХ СИСТЕМ
			</h1>

			<p class="gss-hero__text">
				Берём на себя полный цикл — от проекта до ввода объекта в эксплуатацию
			</p>

			<div class="gss-hero__actions">
				<button class="gss-button gss-hero__button" type="button">
					Получить расчет
				</button>
			</div>
		</div>

		<div class="gss-hero__advantages">
			<div class="gss-hero__advantage">
				<h3 class="gss-hero__advantage-title">Проектирование</h3>
				<p class="gss-hero__advantage-text">
					Выполняем полный цикл строительных работ с соблюдением сроков и технических требований
				</p>
			</div>

			<div class="gss-hero__advantage">
				<h3 class="gss-hero__advantage-title">Строительство</h3>
				<p class="gss-hero__advantage-text">
					Ключевая специализация — монтаж и подключение надежных инженерных сетей
				</p>
			</div>

			<div class="gss-hero__advantage">
				<h3 class="gss-hero__advantage-title">Тепло- и водоснабжение</h3>
				<p class="gss-hero__advantage-text">
					Профессиональный монтаж и модернизация инженерных систем
				</p>
			</div>

			<div class="gss-hero__advantage">
				<h3 class="gss-hero__advantage-title">Алмазное бурение</h3>
				<p class="gss-hero__advantage-text">
					Точное бурение и резка бетона без вибрации и повреждений конструкций
				</p>
			</div>
		</div>
	</div>
</section>
<!-- /wp:group -->