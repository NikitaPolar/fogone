<?php
/*
Template Name: Контакты
*/
?>
<?php
get_header();
?>
	<h2 class="main-head main-head--big main-head--mb25">
		Контакты
	</h2>

	<div class="all-news">
		<?php get_sidebar(); ?>
		<div class="all-news__inner">
			<div class="contacts">
				<div class="contact">
					<div class="contact__img">
						<img src="/wp-content/themes/newsfront/img/knyrick.png" alt="">
					</div>
					<div class="contact__content">
						<div class="contact__content--inner">
							<div class="contact__name">
								Константин Кнырик
							</div>
							<div class="contact__position">
								Руководитель агентства News Front<br>
								<em><a href="https://news-front.info/konstantin-sergeevich-knyrik-biografiya/"><strong>Биография</strong></a></em>
							</div>
							<div class="contact__phone">
								Телефоны:
								<a href="tel:+79788413170">+7 (978) 841-31-70</a>
								<a href="tel:+79263181042">+7 (926) 318-10-42</a>
							</div>
						</div>
						<ul class="contact__social">
							<li>
								<svg viewBox="0 0 100 100" class="icon">
									<use xlink:href="#icon-mail"></use>
								</svg>
								<a href="mailto:cf.presscentr@mail.ru">cf.presscentr@mail.ru</a>
							</li>
							<li>
								<svg viewBox="0 0 100 100" class="icon">
									<use xlink:href="#icon-vk"></use>
								</svg>
								<a href="https://vk.com/knyrik">https://vk.com/knyrik</a>
							</li>
							<li>
								<svg viewBox="0 0 100 100" class="icon">
									<use xlink:href="#icon-fb"></use>
								</svg>
								<a href="https://www.facebook.com/knyrik">https://www.facebook.com/knyrik</a>
							</li>

						</ul>

					</div>
				</div>
				<div class="contact">
					<div class="contact__img">
						<img src="/wp-content/themes/newsfront/img/veselovsky.png" alt="">
					</div>
					<div class="contact__content">
						<div class="contact__content--inner">
							<div class="contact__name">
								Сергей Веселовский
							</div>
							<div class="contact__position contact__position--m40">
								Ведущий передачи «На самом деле» <br>
								агентства News Front
							</div>
						</div>
						<ul class="contact__social">
							<li>
								<svg viewBox="0 0 100 100" class="icon">
									<use xlink:href="#icon-ok"></use>
								</svg>
								<a href="https://ok.ru/profile/582221720848">https://ok.ru/profile/582221720848</a>
							</li>
							<li>
								<svg viewBox="0 0 100 100" class="icon">
									<use xlink:href="#icon-vk"></use>
								</svg>
								<a href="https://vk.com/id279577347">https://vk.com/id279577347</a>
							</li>
							<li>
								<svg viewBox="0 0 100 100" class="icon">
									<use xlink:href="#icon-fb"></use>
								</svg>
								<a
									href="https://www.facebook.com/sergej.veselovskij">https://www.facebook.com/sergej.veselovskij</a>
							</li>

						</ul>

					</div>
				</div>

				<div class="address-feedback">
					<div class="address">
						<div class="address__head">
							Наш адрес: 295034, Россия,
							Республика Крым, г. Симферополь
						</div>
						<div class="address__text">
							<span class="marked">Информационное агентство «News Front» </span>
							зарегистрировано в Федеральной службе по надзору
							в сфере связи, информационных технологий и массовых
							коммуникаций 26 июня 2015 г.
						</div>
						<div class="address__text">
							<span class="marked">Свидетельство о регистрации</span> ИА № ФС77-62129
						</div>
						<div class="address__text">
							<span class="marked">Учредитель:</span> ООО «МедиаГрупп Ньюс Фронт»,
							Руководитель (Глав.ред.) Кнырик Константин Сергеевич

						</div>
						<div class="address__text">
							<span class="marked">Адрес электронной почты редакции:</span> cf.presscentr@mail.ru.
						</div>
						<div class="address__text">
							<span class="marked">Телефон для связи:</span> +7 (978) 841-31-70
						</div>
					</div>
					<div class="feedback">
						<div class="feedback__inner">
							<div class="feedback__title">
								Обратная связь
							</div>
                            <?php echo do_shortcode('[contact-form-7 id="591731" title="Контактная форма 1"]')?>
						</div>
					</div>
				</div>
				<div class="contact-map">
-				</div>
			</div>
		</div>
	</div>


<?php
get_footer();
