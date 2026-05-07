<?php
/**
 * Title: CTA
 * Slug: gss/cta
 * Categories: gss
 * Keywords: cta, lead, form, calculation
 * Inserter: true
 */

if (!defined('ABSPATH')) {
	exit;
}

$theme_uri = get_template_directory_uri();
?>

<!-- wp:group {"tagName":"section","className":"gss-cta"} -->
<section class="wp-block-group gss-cta">

	<!-- wp:group {"className":"gss-cta__card"} -->
	<div class="wp-block-group gss-cta__card">

		<!-- wp:group {"className":"gss-cta__content"} -->
		<div class="wp-block-group gss-cta__content">

			<!-- wp:heading {"level":2,"className":"gss-cta__title"} -->
			<h2 class="wp-block-heading gss-cta__title">Получите расчет стоимости работ</h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"className":"gss-cta__subtitle"} -->
			<p class="gss-cta__subtitle">Оставьте заявку — мы:</p>
			<!-- /wp:paragraph -->

			<!-- wp:group {"className":"gss-cta__benefits"} -->
			<div class="wp-block-group gss-cta__benefits">

				<!-- wp:group {"className":"gss-cta__benefit"} -->
				<div class="wp-block-group gss-cta__benefit">
					<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"gss-cta__benefit-icon"} -->
					<figure class="wp-block-image size-full gss-cta__benefit-icon">
						<img src="<?php echo esc_url($theme_uri . '/assets/images/cta/icon-1.png'); ?>" alt="">
					</figure>
					<!-- /wp:image -->

					<!-- wp:paragraph {"className":"gss-cta__benefit-text"} -->
					<p class="gss-cta__benefit-text">Подберем техническое решение под ваш объект</p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->

				<!-- wp:group {"className":"gss-cta__benefit"} -->
				<div class="wp-block-group gss-cta__benefit">
					<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"gss-cta__benefit-icon"} -->
					<figure class="wp-block-image size-full gss-cta__benefit-icon">
						<img src="<?php echo esc_url($theme_uri . '/assets/images/cta/icon-2.png'); ?>" alt="">
					</figure>
					<!-- /wp:image -->

					<!-- wp:paragraph {"className":"gss-cta__benefit-text"} -->
					<p class="gss-cta__benefit-text">Рассчитаем стоимость и сроки выполнения</p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->

				<!-- wp:group {"className":"gss-cta__benefit"} -->
				<div class="wp-block-group gss-cta__benefit">
					<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"gss-cta__benefit-icon"} -->
					<figure class="wp-block-image size-full gss-cta__benefit-icon">
						<img src="<?php echo esc_url($theme_uri . '/assets/images/cta/icon-3.png'); ?>" alt="">
					</figure>
					<!-- /wp:image -->

					<!-- wp:paragraph {"className":"gss-cta__benefit-text"} -->
					<p class="gss-cta__benefit-text">Проконсультируем по реализации проекта</p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->

			</div>
			<!-- /wp:group -->

		</div>
		<!-- /wp:group -->

		<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"gss-cta__person"} -->
		<figure class="wp-block-image size-full gss-cta__person">
			<img src="<?php echo esc_url($theme_uri . '/assets/images/cta/person.png'); ?>" alt="">
		</figure>
		<!-- /wp:image -->

		<!-- wp:group {"className":"gss-cta__form-column"} -->
		<div class="wp-block-group gss-cta__form-column">

			<!-- wp:heading {"level":3,"className":"gss-cta__form-title"} -->
			<h3 class="wp-block-heading gss-cta__form-title">Заполните форму:</h3>
			<!-- /wp:heading -->
			<!-- wp:html -->
			<form
				class="gss-cta__form"
				id="gss-cta-form"
				action="<?php echo esc_url(admin_url('admin-post.php')); ?>"
				method="post"
				data-gss-lead-form
			>
				<input type="hidden" name="action" value="gss_submit_lead">
				<input type="hidden" name="form_source" value="CTA">
				<input type="hidden" name="page_url" value="">
				<input type="hidden" name="redirect_to" value="">

				<label class="gss-cta__honeypot" aria-hidden="true">
					<span>Компания</span>
					<input type="text" name="company" tabindex="-1" autocomplete="off">
				</label>

				<div class="gss-cta__notice" data-gss-lead-message hidden></div>

				<div class="gss-cta__fields">
					<label class="gss-cta__field">
						<span class="screen-reader-text">Ваше имя</span>
						<span class="gss-cta__field-icon" aria-hidden="true">
							<img src="<?php echo esc_url($theme_uri . '/assets/images/cta/name.svg'); ?>" alt="">
						</span>
						<input
							class="gss-cta__input"
							type="text"
							name="name"
							placeholder="Ваше имя"
							autocomplete="name"
							required
						>
					</label>

					<label class="gss-cta__field">
						<span class="screen-reader-text">Телефон</span>
						<span class="gss-cta__field-icon" aria-hidden="true">
							<img src="<?php echo esc_url($theme_uri . '/assets/images/cta/phone.svg'); ?>" alt="">
						</span>
						<input
							class="gss-cta__input"
							type="tel"
							name="phone"
							placeholder="+7(__)___-__-__"
							inputmode="tel"
							autocomplete="tel"
							required
						>
					</label>
				</div>

				<button class="gss-cta__submit" type="submit">Получить расчет</button>

				<label class="gss-cta__agreement">
					<input
						class="gss-cta__checkbox"
						type="checkbox"
						name="agreement"
						value="1"
						required
					>
					<span class="gss-cta__agreement-text">
						<span>Я согласен на обработку</span>
						<a class="gss-cta__agreement-link" href="#">персональных данных</a>
					</span>
				</label>
			</form>
			<!-- /wp:html -->
		</div>
		<!-- /wp:group -->

	</div>
	<!-- /wp:group -->

</section>
<!-- /wp:group -->