<?php
/**
 * Title: CTA
 * Slug: gss/cta
 * Categories: gss
 * Description: Блок заявки на расчет стоимости работ.
 */

$theme_uri = get_template_directory_uri();
?>

<section class="gss-cta" aria-labelledby="gss-cta-title">
	<div class="gss-cta__inner">
		<div class="gss-cta__content">
			<h2 class="gss-cta__title" id="gss-cta-title">
				Получите расчет стоимости работ
			</h2>

			<p class="gss-cta__subtitle">
				Оставьте заявку — мы:
			</p>

			<ul class="gss-cta__list">
				<li class="gss-cta__item">
					<span class="gss-cta__item-icon" aria-hidden="true">
						<img src="<?php echo esc_url($theme_uri . '/assets/images/cta/icon-1.png'); ?>" alt="">
					</span>
					<span class="gss-cta__item-text">
						Подберем техническое решение под ваш объект
					</span>
				</li>

				<li class="gss-cta__item">
					<span class="gss-cta__item-icon" aria-hidden="true">
						<img src="<?php echo esc_url($theme_uri . '/assets/images/cta/icon-2.png'); ?>" alt="">
					</span>
					<span class="gss-cta__item-text">
						Рассчитаем стоимость и сроки выполнения
					</span>
				</li>

				<li class="gss-cta__item">
					<span class="gss-cta__item-icon" aria-hidden="true">
						<img src="<?php echo esc_url($theme_uri . '/assets/images/cta/icon-3.png'); ?>" alt="">
					</span>
					<span class="gss-cta__item-text">
						Проконсультируем по реализации проекта
					</span>
				</li>
			</ul>
		</div>

		<div class="gss-cta__person" aria-hidden="true">
			<img src="<?php echo esc_url($theme_uri . '/assets/images/cta/person.png'); ?>" alt="">
		</div>

		<div class="gss-cta__form-wrap">
			<h3 class="gss-cta__form-title">
				Заполните форму:
			</h3>

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

				<button class="gss-cta__submit" type="submit">
					Получить расчет
				</button>

				<label class="gss-cta__agreement">
					<input
						class="gss-cta__checkbox"
						type="checkbox"
						name="agreement"
						value="1"
						required
					>
					<span class="gss-cta__agreement-text">
						Я согласен на обработку
						<a href="#" class="gss-cta__agreement-link">
							персональных данных
						</a>
					</span>
				</label>
			</form>
		</div>
	</div>
</section>