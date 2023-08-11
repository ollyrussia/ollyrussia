<?
	/*
	Template Name: Психосоматика - главная
	*/
		#Проверка кода психосоматики

	//Если есть код, то смотрим на наличие кода в базе и статус, если всё ок - то пишем код в куки для последующей работы.
	//Иначе редирект на ошибку.
	if (isset($_GET['code'])) 
	{
		
		$code = $_GET['code'];
		$psy = $wpdb->get_row( "SELECT * FROM wp_olly_access WHERE code='$code' " );
		
		if ($psy===NULL || $psy->status==1) 
		{
			wp_redirect( '/denied' );
			exit;
	    }
		/*else 
		{
	    	 setcookie( 'psy_code', $user->code, 1 * 86400, COOKIEPATH, COOKIE_DOMAIN );
	    }*/
	} else {			wp_redirect( '/denied' );
			exit;}
	
	get_header();

	$args = array(
	     'role'    => 'psychologist',
	     'orderby' => 'rand',
	     'order'   => 'DESC'
	);
	$users = get_users($args);
?>
<div class="font-preload" style="position: absolute; top: -9999px; width: 0; height: 0; opacity: 0;">
  <span style="font-weight: 400; font-family: Appetite Pro, sans-serif;"></span>
  <span style="font-weight: 100; font-family: Museo Sans, sans-serif;"></span>
  <span style="font-weight: 300; font-family: Museo Sans, sans-serif;"></span>
  <span style="font-weight: 500; font-family: Museo Sans, sans-serif;"></span>
  <span style="font-weight: 700; font-family: Museo Sans, sans-serif;"></span>
</div>
<div class="ot-main-wrapper ot-main-wrapper_inner d-flex flex-column justify-content-between">
  <header class="ot-header js-header">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-6 col-md-4 col-lg-3 d-flex justify-content-center justify-content-lg-start order-1 order-lg-0">
          <div class="ot-header__logo d-flex align-items-center justify-content-center">
            <span class="ot-header__logo-text">Команда психологов<br> Ольги Роменской</span>
          </div>
        </div>
        <div class="col-3 col-md-4 col-lg-6 order-0 order-lg-0 position-relative">
          <button class="ot-header__btn-menu ot-btn d-flex d-lg-none align-items-center js-menu-btn">
              <span class="ot-header__btn-lines d-flex align-items-center justify-content-center">
                <span class="ot-header__btn-line ot-header__btn-line_top"></span>
                <span class="ot-header__btn-line ot-header__btn-line_middle"></span>
                <span class="ot-header__btn-line ot-header__btn-line_bottom"></span>
              </span>
            <span class="d-none d-md-inline-block">Меню</span>
          </button>
          <nav class="ot-header__menu justify-content-center">
            <ul class="ot-header__menu-list d-flex flex-column flex-lg-row justify-content-between m-0 p-0">
              <li class="ot-header__menu-item">
                <a class="ot-header__menu-link js-link js-menu-link" href="#section-psychologists">Психологи</a>
              </li>
              <li class="ot-header__menu-item">
                <a class="ot-header__menu-link js-link js-menu-link" href="#section-faq">Вопрос / Ответ</a>
              </li>
              <li class="ot-header__menu-item">
                <a class="ot-header__menu-link js-link js-menu-link" href="#section-reviews">Отзывы</a>
              </li>
            </ul>
          </nav>
        </div>
        <div class="col-3 col-md-4 col-lg-3 d-flex justify-content-end order-2 order-lg-0">
          <button class="ot-header__btn-callback ot-btn d-flex align-items-center" data-toggle="modal" data-target="#modalCallback">
            <svg class="ot-header__icon-phone">
              <use xlink:href="#icon-phone"></use>
            </svg>
            <span class="d-none d-md-inline-block">Заказать звонок</span>
          </button>
        </div>
      </div>
    </div>
  </header>
  
    <section class="ot-section ot-psychologist-selection" id="section-select-psychologist">
      <div class="container">
        <div class="ot-section__title-wrp">
          <h2 class="ot-section__title"><span class="ot-section__title-accent">Подберите</span> себе психолога по психосоматике</h2>
        </div>
        <div class="d-flex justify-content-center">
          <div class="ot-psychologist-selection__notification text-center">
            <span class="ot-psychologist-selection__notification-title d-block">Схема работы с психосоматикой</span>
            <p class="ot-psychologist-selection__notification-text">
Стоимость первичной консультации по сбору цепочки событий у любого терапевта - 3000 рублей<br>
Количество консультаций зависит от сложности заболевания. В среднем, для диагнозов легкой и средней тяжести достаточно 1-2 консультаций.<br>
Дальнейшая работа оплачивается в зависимости от категории терапевта, стоимость консультации указана в его анкете.</p>

            <!--<button class="ot-psychologist-selection__notification-btn ot-btn ot-btn_main ot-btn_gradient-primary">Другие запросы</button>-->
          </div>
        </div>
        <div class="ot-psychologist-selection__categories">
          <div class="d-flex justify-content-center">
            <h3 class="ot-psychologist-selection__title-select">Выберите категорию психолога</h3>
          </div>
          <div class="d-flex align-items-center justify-content-center flex-wrap flex-sm-nowrap">
            <div class="ot-psychologist-selection__btn-wrp d-flex flex-column align-items-center">
              <button class="ot-psychologist-selection__btn-category ot-btn" data-swiper-class="top">Ведущий</button>
              <span
                class="ot-psychologist-selection__category-price-range d-none d-md-block">Стоимость сессии от 6000 до 12000 руб</span>
            </div>
            <div class="ot-psychologist-selection__btn-wrp d-flex flex-column align-items-center">
              <button class="ot-psychologist-selection__btn-category ot-btn" data-swiper-class="base">Психолог команды</button>
              <span class="ot-psychologist-selection__category-price-range d-none d-md-block">Стоимость сессии 4000 руб</span>
            </div>
            <div class="ot-psychologist-selection__btn-wrp d-flex flex-column align-items-center">
              <button class="ot-psychologist-selection__btn-category ot-btn" data-swiper-class="begin">Начинающий</button>
              <span class="ot-psychologist-selection__category-price-range d-none d-md-block">Стоимость сессии 3000 руб</span>
            </div>
          </div>
        </div>
        <!--<div class="d-flex justify-content-center">
          <div class="ot-psychologist-selection__search-wrp d-flex">
            <input type="text" class="ot-psychologist-selection__search-input form-control" placeholder="Поиск по психологам...">
            <button class="ot-psychologist-selection__btn-search ot-btn ot-btn_gradient-primary">Искать</button>
          </div>
        </div>-->
        <div class="position-relative">
        	
          <div class="ot-psychologist-selection__slider">
            <div class="swiper-container js-psychologist-list-slider">
              <div class="swiper-wrapper">
              	
              	<?
	                
					foreach ($users as $user) {
						
						switch  (get_the_author_meta('category',$user->ID)) {
						    case 'Ведущий психолог':
						        $category = "top";
						        break;
						    case 'Начинающий психолог':
						         $category = "begin";
						        break;
						    case 'Психолог команды':
						         $category = "base";
						        break;
						}
						
						if ($user->ID==16) {$dop_style="background-position:top";} else {$dop_style="";}
						
						echo '
						         <div class="swiper-slide ot-psychologist-card ot-psychologist-card_full d-flex flex-row flex-sm-column '.$category.'">
					                  <div class="ot-psychologist-card__photo"
					                       style="'.$dop_style.' ; background-image: url('.get_the_author_meta('photo',$user->ID).');"></div>
					                  <div class="ot-psychologist-card__info d-flex flex-column align-items-center">
					                    <div class="ot-psychologist-card__name">'.$user->display_name.'</div>
					                    <div class="ot-psychologist-card__category">'.get_the_author_meta('category',$user->ID).'</div>
					                    <div class="ot-psychologist-card__session-text">Цена за сессию:</div>
					                    <div class="ot-psychologist-card__session-price">'.get_the_author_meta('price',$user->ID).' рублей</div>
					                    <a href="'.home_url('/').get_the_author_meta('url_name',$user->ID).'?code='.$psy->code.'" class="ot-psychologist-card__btn ot-btn ot-btn_main ot-btn_gradient-primary">Записаться</a>
					                  </div>
				                </div>
						';
					}
	             ?>  


                
              </div>
            </div>
          </div>
          
          
          <div class="ot-psychologist-selection__btns-wrp">
            <button class="ot-psychologist-selection__btn-slider ot-psychologist-selection__btn-slider_prev ot-btn ot-btn_circle ot-btn_gradient-primary">
              <svg class="ot-btn__icon-arrow">
                <use xlink:href="#icon-arrow"></use>
              </svg>
            </button>
            <button class="ot-psychologist-selection__btn-slider ot-psychologist-selection__btn-slider_next ot-btn ot-btn_circle ot-btn_gradient-primary">
              <svg class="ot-btn__icon-arrow ot-btn__icon-arrow_right">
                <use xlink:href="#icon-arrow"></use>
              </svg>
            </button>
          </div>
        </div>

        <div class="ot-psychologist-selection__actions d-flex flex-column flex-lg-row justify-content-center align-items-center">
          <button class="ot-btn ot-btn_main ot-btn_gradient-primary js-show-all-psychologists">Показать всех психологов</button>
          <button class="ot-psychologist-selection__btn-show-window d-none ot-btn ot-btn_main ot-btn_gradient-secondary">Посмотреть «окна» в календаре</button>
        </div>
      </div>
    </section>
    
    <section class="ot-section ot-section_light-bg ot-faq" id="section-faq">
      <div class="container">
        <div class="ot-section__title-wrp">
          <h2 class="ot-section__title">Часто задаваемые <span class="ot-section__title-accent">вопросы</span></h2>
        </div>
        <div class="row" style="margin-bottom: 40px;">
          <div class="col-12 col-lg-6">
            <div class="ot-faq__collapse-item">
              <div class="ot-faq__collapse-item-main">
                <a class="ot-faq__collapse-item-header d-flex align-items-center justify-content-between collapsed" data-toggle="collapse" href="#faq-consultation-format">
                  <span class="ot-faq__collapse-item-title">Формат консультаций</span>
                  <span class="ot-btn ot-btn_gradient-primary ot-btn_circle">
                      <svg class="ot-btn__icon-arrow">
                        <use xlink:href="#icon-arrow"></use>
                      </svg>
                    </span>
                </a>
                <div class="ot-faq__collapse-item-content collapse" id="faq-consultation-format">
                  <p>Индивидуальная консультация длится час-полтора, проходит онлайн через видеозвонок WhatsApp</p>
					 <p>Онлайн-прием терапевты из команды ведут по любым вопросам, кроме проработки насилия и панических атак</p>
					 <p>Проработка насилия осуществляется очно, длительность консультации 2 часа. На проработку единичного случая насилия необходима одна, иногда две консультации</p>
					 <p>Консультации можно проводить в режиме онлайн с частотой НЕ чаще раза в неделю, в остальном - по свободной записи и на ваше усмотрение</p>
					 <p>В 80% решение одного запроса прорабатывается за 1-2 консультации, но следует учитывать индивидуальные случаи</p>
					 <p>Проработка панических атак происходит очно за 1-2 консультации, затем работу можно вести онлайн в обычном режиме</p>
					</p>
                </div>
              </div>
            </div>
            <div class="ot-faq__collapse-item">
              <div class="ot-faq__collapse-item-main">
                <a class="ot-faq__collapse-item-header d-flex align-items-center justify-content-between collapsed" data-toggle="collapse" href="#faq-request">
                  <span class="ot-faq__collapse-item-title">Как выбрать запрос</span>
                  <span class="ot-btn ot-btn_gradient-primary ot-btn_circle">
                      <svg class="ot-btn__icon-arrow">
                        <use xlink:href="#icon-arrow"></use>
                      </svg>
                    </span>
                </a>
                <div class="ot-faq__collapse-item-content collapse" id="faq-request">
                  <p>Для первой терапии возьмите тот запрос, который беспокоит Вас больше всего на сегодняшний день, далее можно будет постепенно проработать все ситуации</p>
					<p>Онлайн-терапии способны помочь вам:</p>
					<ul>
						<li>Принять себя/партнёра/ребенка</li>
						<li>Снять чувство вины</li>
						<li>Построить гармоничные отношения с партнёром/детьми/близкими</li>
						<li>Проработать утрату близких/любимых людей</li>
						<li>Проработать шокирующее событие</li>
						<li>Обрести внутреннюю свободу</li>
						<li>Стать стройной, перестать переедать или наоборот набрать вес</li>
						<li>Отпустить прошлые обиды/отношения</li>
						<li>Стать увереннее</li>
						<li>Отпустить вредные привычки</li>
						<li>Снять страхи: самолеты, высота, вода, врачи, насекомые, замкнутое пространство, страх болезни, смерти, страх новой работы, начать свое дело, решиться на что-то</li>
					</ul>

                </div>
              </div>
            </div>
            <div class="ot-faq__collapse-item">
              <div class="ot-faq__collapse-item-main">
                <a class="ot-faq__collapse-item-header d-flex align-items-center justify-content-between collapsed" data-toggle="collapse" href="#faq-price">
                  <span class="ot-faq__collapse-item-title">От чего зависит стоимость</span>
                  <span class="ot-btn ot-btn_gradient-primary ot-btn_circle">
                      <svg class="ot-btn__icon-arrow">
                        <use xlink:href="#icon-arrow"></use>
                      </svg>
                    </span>
                </a>
                <div class="ot-faq__collapse-item-content collapse" id="faq-price">
                  <p>В команде три категории психологов:</p>
                	<ul>
						<li>Начинающие, работают с Олиной супервизией - стоимость 3000 ₽</li>
						<li>Психологи команды 4000 ₽</li>
						<li>Ведущие психологи команды 6000-12000 ₽</li>
					</ul>
					<p>Стоимость очной консультации:</p>
					<ul>
						<li>Москва + 2000 ₽</li>
						<li>Санкт-Петербург + 3500 ₽</li>
						<li>Срочные консультации +2000 ₽ к стоимости</li>
						<li>Проработка насилия 12000-18000 ₽ (длительность консультации 2 часа)</li>
						<li>Панические атаки 12000-18000 ₽</li>
					</ul>
					<p>Все психологи команды Оли проходят постоянное обучение и повышают уровень своей квалификации</p>

                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-lg-6">
            <div class="ot-faq__collapse-item">
              <div class="ot-faq__collapse-item-main">
                <a class="ot-faq__collapse-item-header d-flex align-items-center justify-content-between collapsed" data-toggle="collapse" href="#faq-recording">
                  <span class="ot-faq__collapse-item-title">Как записаться на психосоматику</span>
                  <span class="ot-btn ot-btn_gradient-primary ot-btn_circle">
                      <svg class="ot-btn__icon-arrow">
                        <use xlink:href="#icon-arrow"></use>
                      </svg>
                    </span>
                </a>
                <div class="ot-faq__collapse-item-content collapse" id="faq-recording">
                  <p>В данный момент запись на консультации по психосоматике приостановлена, о появлении мест Оля скажет у себя в сториз в Инстаграм</p>
                </div>
              </div>
            </div>
            <div class="ot-faq__collapse-item">
              <div class="ot-faq__collapse-item-main">
                <a class="ot-faq__collapse-item-header d-flex align-items-center justify-content-between collapsed" data-toggle="collapse" href="#faq-age">
                  <span class="ot-faq__collapse-item-title">С какого возраста можно на терапию</span>
                  <span class="ot-btn ot-btn_gradient-primary ot-btn_circle">
                      <svg class="ot-btn__icon-arrow">
                        <use xlink:href="#icon-arrow"></use>
                      </svg>
                    </span>
                </a>
                <div class="ot-faq__collapse-item-content collapse" id="faq-age">
                  <p>Психологи команды Оли работают с людьми от 14 лет</p>
                </div>
              </div>
            </div>
            <div class="ot-faq__collapse-item">
              <div class="ot-faq__collapse-item-main">
                <a class="ot-faq__collapse-item-header d-flex align-items-center justify-content-between collapsed" data-toggle="collapse" href="#faq-recording-another">
                  <span class="ot-faq__collapse-item-title">Можно ли записать маму/подругу</span>
                  <span class="ot-btn ot-btn_gradient-primary ot-btn_circle">
                      <svg class="ot-btn__icon-arrow">
                        <use xlink:href="#icon-arrow"></use>
                      </svg>
                    </span>
                </a>
                <div class="ot-faq__collapse-item-content collapse" id="faq-recording-another">
                  <p>Мы не ведем запись на консультации со слов родственников. Если человек сам не готов, то не всегда терапия может дать результат. Если это его желание, ему необходимо записаться самостоятельно </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="d-flex justify-content-center">
          <a class="ot-btn ot-btn_main ot-btn_gradient-primary js-link" href="#section-select-psychologist">Записаться на терапию</a>
        </div>
      </div>
    </section>
    <section class="ot-section ot-reviews" id="section-reviews">
      <div class="container">
        <div class="ot-section__title-wrp">
          <h2 class="ot-section__title">
            <span class="ot-section__title-accent">Отзывы</span> наших клиентов
          </h2>
          <span class="ot-section__subtitle">Нажмите на отзыв, чтобы увеличить его</span>
        </div>
        <div class="row position-relative">
          <div class="ot-reviews__slider swiper-container js-reviews-slider">
            <div class="swiper-wrapper">
              <a class="ot-reviews__slider-slide swiper-slide d-block" data-fancybox="gallery" href="<?= bloginfo('template_directory'); ?>/images/main/reviews/review-1.png"><img class="w-100" src="<?= bloginfo('template_directory'); ?>/images/main/reviews/review-1.png"></a>
              <a class="ot-reviews__slider-slide swiper-slide d-block" data-fancybox="gallery" href="<?= bloginfo('template_directory'); ?>/images/main/reviews/review-2.png"><img class="w-100" src="<?= bloginfo('template_directory'); ?>/images/main/reviews/review-2.png"></a>
              <a class="ot-reviews__slider-slide swiper-slide d-block" data-fancybox="gallery" href="<?= bloginfo('template_directory'); ?>/images/main/reviews/review-3.png"><img class="w-100" src="<?= bloginfo('template_directory'); ?>/images/main/reviews/review-3.png"></a>
              <a class="ot-reviews__slider-slide swiper-slide d-block" data-fancybox="gallery" href="<?= bloginfo('template_directory'); ?>/images/main/reviews/review-4.png"><img class="w-100" src="<?= bloginfo('template_directory'); ?>/images/main/reviews/review-4.png"></a>
              <a class="ot-reviews__slider-slide swiper-slide d-block" data-fancybox="gallery" href="<?= bloginfo('template_directory'); ?>/images/main/reviews/review-5.png"><img class="w-100" src="<?= bloginfo('template_directory'); ?>/images/main/reviews/review-5.png"></a>
              <a class="ot-reviews__slider-slide swiper-slide d-block" data-fancybox="gallery" href="<?= bloginfo('template_directory'); ?>/images/main/reviews/review-6.png"><img class="w-100" src="<?= bloginfo('template_directory'); ?>/images/main/reviews/review-6.png"></a>
              <a class="ot-reviews__slider-slide swiper-slide d-block" data-fancybox="gallery" href="<?= bloginfo('template_directory'); ?>/images/main/reviews/review-7.png"><img class="w-100" src="<?= bloginfo('template_directory'); ?>/images/main/reviews/review-7.png"></a>
              <a class="ot-reviews__slider-slide swiper-slide d-block" data-fancybox="gallery" href="<?= bloginfo('template_directory'); ?>/images/main/reviews/review-8.png"><img class="w-100" src="<?= bloginfo('template_directory'); ?>/images/main/reviews/review-8.png"></a>
              <a class="ot-reviews__slider-slide swiper-slide d-block" data-fancybox="gallery" href="<?= bloginfo('template_directory'); ?>/images/main/reviews/review-9.png"><img class="w-100" src="<?= bloginfo('template_directory'); ?>/images/main/reviews/review-9.png"></a>
              <a class="ot-reviews__slider-slide swiper-slide d-block" data-fancybox="gallery" href="<?= bloginfo('template_directory'); ?>/images/main/reviews/review-10.png"><img class="w-100" src="<?= bloginfo('template_directory'); ?>/images/main/reviews/review-10.png"></a>
            </div>
          </div>
          <div class="ot-reviews__btn-wrp">
            <button class="ot-reviews__btn-slider ot-reviews__btn-slider_prev ot-btn ot-btn_circle ot-btn_gradient-primary">
              <svg class="ot-btn__icon-arrow">
                <use xlink:href="#icon-arrow"></use>
              </svg>
            </button>
            <button class="ot-reviews__btn-slider ot-reviews__btn-slider_next ot-btn ot-btn_circle ot-btn_gradient-primary">
              <svg class="ot-btn__icon-arrow ot-btn__icon-arrow_right">
                <use xlink:href="#icon-arrow"></use>
              </svg>
            </button>
          </div>
        </div>
      </div>
    </section>
    <section class="ot-section ot-instagram d-none">
      <div class="container text-center">
        <div class="ot-section__title-wrp">
          <h2 class="ot-section__title">
            <span class="ot-section__title-accent">Следите за нашим Instagram,</span><br> там много полезного
          </h2>
        </div>
        <a href="https://www.instagram.com/olly_russia" target="_BLANK" class="ot-btn">Перейти в Instagram</a>
      </div>
    </section>
    <section class="ot-section ot-ask-question">
      <div class="container">
        <div class="ot-section__title-wrp">
          <h2 class="ot-section__title">Остались вопросы?</h2>
          <span class="ot-section__subtitle">Напишите нам и мы ответим</span>
        </div>
        <div class="ot-ask-question__btn-wrp d-flex flex-column flex-md-row align-items-center justify-content-center">
          <a class="ot-ask-question__btn-instagram ot-btn ot-btn_main ot-btn_gradient-primary d-flex align-items-center" target="_BLANK" href="https://www.instagram.com/olly_russia">
            Задать в Instagram
            <svg class="ot-ask-question__btn-icon">
              <use xlink:href="#icon-instagram"></use>
            </svg>
          </a>
          <a class="ot-ask-question__btn-whatsapp ot-btn ot-btn_main ot-btn_gradient-primary d-flex align-items-center" target="_BLANK" href="https://wa.me/79785060117">
            Задать в Whatsapp
            <svg class="ot-ask-question__btn-icon">
              <use xlink:href="#icon-whatsapp-filled"></use>
            </svg>
          </a>
        </div>
        <p class="ot-ask-question__path-text">Начните путь к лучшей себе вместе с нами!</p>
      </div>
    </section>
  </main>

<script>
<?="var ajaxurl='".admin_url('admin-ajax.php')."'";?>
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
	$(document).ready(function(){
		var categoryBtn = $('.ot-psychologist-selection__btn-category');
		var showAllBtn = $('.js-show-all-psychologists');
		
		if (categoryBtn) {
			categoryBtn.on('click', function(e) {
				var selectedCategory = e.target.dataset.swiperClass;
				
				if ($(this).hasClass('ot-btn_selected')) {
					if (window.psychologistsSwiper.destroyed) {
						$('.swiper-wrapper').empty();
						
						window.psychologistsSwiperSlides.forEach(function(el) {
							if (!el.classList.contains('swiper-slide-duplicate')) {
								$('.swiper-wrapper').append($(el).removeAttr('style'));
							}	
						});
					} else {
						window.psychologistsSwiper.removeAllSlides();
						
						window.psychologistsSwiperSlides.forEach(function(el) {
							window.psychologistsSwiper.appendSlide(el);
						});
					}
					
					$(this).removeClass('ot-btn_selected');
				} else {
					categoryBtn.each(function() {
						$(this).removeClass('ot-btn_selected');
					});
					$(this).addClass('ot-btn_selected');
					
					if (window.psychologistsSwiper.destroyed) {
						$('.swiper-wrapper').empty();
						
						window.psychologistsSwiperSlides.forEach(function(el) {
							if (el.classList.contains(selectedCategory) && !el.classList.contains('swiper-slide-duplicate')) {
								$('.swiper-wrapper').append($(el).removeAttr('style'));
							}	
						});
					} else {
						window.psychologistsSwiper.removeAllSlides();
	
						window.psychologistsSwiperSlides.forEach(function(el) {
							if (el.classList.contains(selectedCategory) ) {
								window.psychologistsSwiper.appendSlide(el);
							}	
						});
					}
				}
			});
		}
	});
</script>
<script>

$(document).ready(function() {
	$('#ask').on('submit', function(event){
		event.preventDefault();
		
		$.ajax({ 
			url: ajaxurl,
			type: "POST",
			data: $("#ask").serialize(),
			success: function(data) {
				$('.ot-about-us__form-content').append(`
					<div class="ot-about-us__form-message d-flex align-items-center justify-content-center text-center" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; padding: 0 15px; background: rgba(0, 0, 0, 0.5); color: #fff; font-weight: 500;">
						<p>${data}</p>
					</div>
				`);
				
				setTimeout(function() {
					$('.ot-about-us__form-message').remove();
					$('#ask').trigger("reset");
				}, 4000);
			}
		});
	});
});

</script>
<?get_footer();?>
