<?
/*
 * Template name: Olly - главная
 * Template post type: page
 */
	get_header();

	$args = array(
	     'role'    => 'psychologist',
	     'orderby' => 'rand',
	     'order'   => 'DESC'
	);
	$users = get_users($args);
	
	$cur_user_id = get_current_user_id();
?>



<div class="font-preload" style="position: absolute; top: -9999px; width: 0; height: 0; opacity: 0;">
  <span style="font-weight: 400; font-family: Appetite Pro, sans-serif;"></span>
  <span style="font-weight: 100; font-family: Museo Sans, sans-serif;"></span>
  <span style="font-weight: 300; font-family: Museo Sans, sans-serif;"></span>
  <span style="font-weight: 500; font-family: Museo Sans, sans-serif;"></span>
  <span style="font-weight: 700; font-family: Museo Sans, sans-serif;"></span>
</div>
<style>
	.ot-example-session {
		width: 40px;
		height: 20px;
		border-radius: 5px;
	}
	
	.ot-time-long-color,
	.ot-time-long-color:hover {
		color: #fff;
		font-weight: 500;
		background: linear-gradient(to bottom, #81d5ea, #61b9cf) #5ab3c9;
	}
	
	.attack,
	.etherether
	{
	display: none;
	}
</style>

<div class="ot-main-wrapper d-flex flex-column justify-content-between">

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
		  <style>
			.ot-header__menu-item {font-size:14px; max-width:none;}
		  </style>
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
			  <?php
					/*if(!is_user_logged_in() && !current_user_can('Subscriber')) {		
						echo '<li class="ot-header__menu-item">
								<a class="ot-header__menu-link" href="https://ollyteam.ru/wp-login.php">Войти</a>
							  </li>
							  <li class="ot-header__menu-item">
								<a class="ot-header__menu-link" href="https://ollyteam.ru/wp-login.php?action=register">Регистрация</a>
							  </li>';				
					} else {
						echo '<li class="ot-header__menu-item">
								<a class="ot-header__menu-link" href="https://ollyteam.ru/wp-admin/profile.php">Профиль</a>
							  </li>';							
					}*/
			  ?>
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
  <main class="ot-main-wrapper__main d-flex flex-column">
    <section class="ot-section ot-intro">
      <div class="container">
        <div class="row no-gutters">
          <div class="ot-intro__info col-12 col-md-6 d-flex flex-column align-items-center align-items-md-start justify-content-between">
            <div class="ot-section__title-wrp">
              <h1 class="ot-section__title">
                <span class="ot-section__title-accent">Онлайн психологическая помощь,</span> которая даёт быстрые результаты!
              </h1>
              <span class="ot-section__subtitle">Поможем вам решить любой запрос</span>
            </div>
            <div class="ot-intro__info-items d-none d-md-flex justify-content-between">
              <div class="ot-intro__info-item d-flex flex-column">
                <span class="ot-intro__info-item-num"><?=count($users);?></span>
                <span class="ot-intro__info-item-title">Психологов-практиков<br> в команде</span>
              </div>
              <div class="ot-intro__info-item d-flex flex-column">
                <span class="ot-intro__info-item-num">1000+</span>
                <span class="ot-intro__info-item-title">Счастливых клиентов</span>
              </div>
              <div class="ot-intro__info-item d-flex flex-column">
                <span class="ot-intro__info-item-num">>4</span>
                <span class="ot-intro__info-item-title">Лет опыта</span>
              </div>
            </div>
            <div class="d-flex d-md-none">
            <!-- 123-->
              <picture class="d-block">
                <source srcset="<?= bloginfo('template_directory'); ?>/images/main/intro/olly.webp 1x, <?= bloginfo('template_directory'); ?>/images/main/intro/olly_2x.webp 2x" type="image/webp">
                <img class="ot-intro__olly-photo" src="<?= bloginfo('template_directory'); ?>/images/main/intro/olly.png"
                     srcset="<?= bloginfo('template_directory'); ?>/images/main/intro/olly.png 1x, <?= bloginfo('template_directory'); ?>/images/main/intro/olly_2x.png" alt="Ольга Роменская">
              </picture>
            </div>
            <a class="ot-btn ot-btn_main ot-btn_gradient-primary js-link text-center" href="#section-select-psychologist">Записаться к терапевту</a>
            <span class="ot-intro__bottom-text">Общаться с психологом - это нормально!</span>
            <div class="ot-intro__mobile-items d-md-none">
              <div class="ot-intro__mobile-item-content d-flex flex-column flex-sm-row">
                <div class="ot-intro__mobile-item d-flex flex-column">
                  <span class="ot-intro__mobile-item-num"><?=count($users);?></span>
                  <span class="ot-intro__mobile-item-title">Психолога-практика в команде</span>
                </div>
                <div class="ot-intro__mobile-item d-flex flex-column">
                  <span class="ot-intro__mobile-item-num">1000+</span>
                  <span class="ot-intro__mobile-item-title">Счастливых клиентов</span>
                </div>
                <div class="ot-intro__mobile-item d-flex flex-column">
                  <span class="ot-intro__mobile-item-num">>4</span>
                  <span class="ot-intro__mobile-item-title">Лет опыта</span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-6 d-none d-md-flex align-items-end justify-content-center">
            <picture class="d-block">
              <source srcset="<?= bloginfo('template_directory'); ?>/images/main/intro/olly.webp 1x, <?= bloginfo('template_directory'); ?>/images/main/intro/olly_2x.webp 2x" type="image/webp">
              <img class="ot-intro__olly-photo" src="<?= bloginfo('template_directory'); ?>/images/main/intro/olly.png"
                   srcset="<?= bloginfo('template_directory'); ?>/images/main/intro/olly.png 1x, <?= bloginfo('template_directory'); ?>/images/main/intro/olly_2x.png" alt="Ольга Роменская">
            </picture>
          </div>
        </div>
      </div>
    </section>
    <section class="ot-section ot-questions">
      <div class="container">
        <div class="ot-section__title-wrp d-flex justify-content-center">
          <h2 class="ot-section__title">
            Психологи нашей команды способны <span class="ot-section__title-accent">помочь Вам</span> в таких вопросах:
          </h2>
        </div>
        <div class="d-flex flex-wrap justify-content-between">
          <div class="ot-questions__item ot-questions__item_personal d-flex">
            <div class="ot-questions__item-content">
              <span class="ot-questions__item-title">Личные</span>
              <ul class="ot-list">
                <li class="ot-list__item">Принять себя</li>
                <li class="ot-list__item">Влюбиться в жизнь</li>
                <li class="ot-list__item">Жить от хочу</li>
                <li class="ot-list__item">Слышать свои желания</li>
                <li class="ot-list__item">Найти своё предназначение</li>
                <li class="ot-list__item">Делать то, что запланировала</li>
              </ul>
            </div>
          </div>
          <div class="ot-questions__item ot-questions__item_family d-flex">
            <div class="ot-questions__item-content">
              <span class="ot-questions__item-title">Семейные</span>
              <ul class="ot-list">
                <li class="ot-list__item">Принять родителей, мужа,<br> детей</li>
                <li class="ot-list__item">Наладить отношения в семье</li>
                
              </ul>
            </div>
          </div>
          <div class="ot-questions__item ot-questions__item_bg-right ot-questions__item_relationship d-flex">
            <div class="ot-questions__item-content">
              <span class="ot-questions__item-title">Отношения</span>
              <ul class="ot-list">
                <li class="ot-list__item">Создать отношения мечты</li>
                <li class="ot-list__item">Выйти из созависимых отношений</li>
                <li class="ot-list__item">Вернуть страсть с мужем</li>
                <li class="ot-list__item">Начать испытывать оргазм</li>
                <li class="ot-list__item">Начать жить после измены, развода, насилия</li>
              </ul>
            </div>
          </div>
          <div class="ot-questions__item ot-questions__item_bg-right ot-questions__item_finance d-flex">
            <div class="ot-questions__item-content">
              <span class="ot-questions__item-title">Финансы</span>
              <ul class="ot-list">
                <li class="ot-list__item">Увеличить доход</li>
                <li class="ot-list__item">Найти работу, которая зажигает</li>
                <li class="ot-list__item">Делегировать с легкостью</li>
                <li class="ot-list__item">Открыть своё дело</li>
                <li class="ot-list__item">Уйти с нелюбимой работы</li>
              </ul>
            </div>
          </div>
        </div>
        <div class="ot-questions__btn-wrp d-flex justify-content-center">
          <a class="ot-btn ot-btn_main ot-btn_gradient-primary js-link" href="#section-select-psychologist">Хочу на консультацию</a>
        </div>
      </div>
    </section>
    <section class="ot-section ot-why-online">
      <div class="container">
        <div class="ot-section__title-wrp">
          <h2 class="ot-section__title"><span class="ot-section__title-accent">Почему</span> онлайн?</h2>
        </div>
        <div class="row">
          <div class="ot-why-online__item col-12 col-lg-6 d-flex">
            <div class="ot-why-online__item-img ot-why-online__item-img_wallet flex-shrink-0 d-none d-sm-flex"></div>
            <div class="ot-why-online__item-content">
              <div class="ot-why-online__item-title-wrp d-flex align-items-center">
                <div class="ot-why-online__item-img ot-why-online__item-img_wallet flex-shrink-0 d-sm-none"></div>
                <span class="ot-why-online__item-title d-block">Это доступно</span>
              </div>
              <p class="ot-why-online__item-desc">
                Стоимость онлайн-консультации всегда ниже, чем офлайн.
                Терапевт не оплачивает дополнительно помещение
                и не тратит, как и Вы, время и деньги на дорогу,
                что позволяет уменьшить стоимость.
              </p>
            </div>
          </div>
          <div class="ot-why-online__item col-12 col-lg-6 d-flex">
            <div class="ot-why-online__item-img ot-why-online__item-img_sofa flex-shrink-0 d-none d-sm-flex"></div>
            <div class="ot-why-online__item-content">
              <div class="ot-why-online__item-title-wrp d-flex align-items-center">
                <div class="ot-why-online__item-img ot-why-online__item-img_sofa flex-shrink-0 d-sm-none"></div>
                <span class="ot-why-online__item-title d-block">Это комфортно</span>
              </div>
              <p class="ot-why-online__item-desc">
                Вы можете рассказать о своем запросе, своих переживаниях,
                оставаясь в полной безопасности у себя дома или в офисе.
                При этом контакт с психологом и помощь будут
                полноценными.
              </p>
            </div>
          </div>
          <div class="ot-why-online__item col-12 col-lg-6 d-flex">
            <div class="ot-why-online__item-img ot-why-online__item-img_clock flex-shrink-0 d-none d-sm-flex"></div>
            <div class="ot-why-online__item-content">
              <div class="ot-why-online__item-title-wrp d-flex align-items-center">
                <div class="ot-why-online__item-img ot-why-online__item-img_clock flex-shrink-0 d-sm-none"></div>
                <span class="ot-why-online__item-title d-block">Это экономит время</span>
              </div>
              <p class="ot-why-online__item-desc">
                Чтобы попасть на беседу с психологом по WhatsApp,
                не придется тратить время на дорогу. Заявки на запись
                к психологу принимаются на сайте круглосуточно
                и без регистрации.
              </p>
            </div>
          </div>
          <div class="ot-why-online__item col-12 col-lg-6 d-flex">
            <div class="ot-why-online__item-img ot-why-online__item-img_lock flex-shrink-0 d-none d-sm-flex"></div>
            <div class="ot-why-online__item-content">
              <div class="ot-why-online__item-title-wrp d-flex align-items-center">
                <div class="ot-why-online__item-img ot-why-online__item-img_lock flex-shrink-0 d-sm-none"></div>
                <span class="ot-why-online__item-title d-block">Это конфиденциально</span>
              </div>
              <p class="ot-why-online__item-desc">
                Вам не придется сталкиваться с другими клиентами психолога,
                разговор не станет публичным, а для записи на онлайн-консультацию требуется минимум Ваших данных.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="ot-section ot-section_light-bg ot-our-psychologists" id="section-psychologists">
      <div class="container">
        <div class="row no-gutters">
          <div class="col-12 col-lg-8 col-xl-6 d-flex justify-content-center">
            <div class="ot-our-psychologists__text-content d-flex flex-column justify-content-center">
              <h2 class="ot-section__title">Кто наши <span class="ot-section__title-accent">психологи?</span></h2>
              <p class="ot-our-psychologists__subtitle">
                Все психологи нашей команды успешно прошли
                обучение в школе психологов Ольги Роменской
              </p>
              <ul class="ot-list">
                <li class="ot-list__item">имеют профильное образование «Психолог-консультант»</li>
                <li class="ot-list__item">внушительный практический опыт</li>
                <li class="ot-list__item">регулярно проходят супервизию у Ольги</li>
                <li class="ot-list__item">постоянно обучаются и повышают уровень своей квалификации</li>
                <li class="ot-list__item">каждый из психологов работает в авторской технике<br> Ольги -QR (Quick Results),
                  которая даёт быстрые результаты
                </li>
              </ul>
            </div>
          </div>
          <div class="col-12 col-lg-4 col-xl-6">
            <div class="ot-our-psychologists__slider">

              <div class="ot-our-psychologists__team-text d-flex flex-column flex-md-row align-items-center">
                <span class="ot-our-psychologists__team-count"><?=count($users);?></span>
                <span>психологов-практиков в команде</span>
              </div>
              <div class="swiper-container js-our-psychologists-slider">
              	
                <div class="swiper-wrapper">
	             <?
	                
					foreach ($users as $user) {
					switch  (get_the_author_meta('category',$user->ID)) {
						    case '1 категория':
						        $category_name = "Психолог 1 категории";
						        break;
						    case '3 категория':
						         $category_name = "Психолог 3 категории";
						        break;
						    case '2 категория':
						         $category_name = "Психолог 2 категории";
						        break;
						    case 'Высшая категория':
						         $category_name = "Психолог высшей категории";
						        break;						        
						}
						echo '
						
		                  <div class="swiper-slide ot-psychologist-card d-flex flex-column"> 
		                    <div class="ot-psychologist-card__photo" style="background-image:URL('.get_the_author_meta('photo',$user->ID).')"></div>
		                    <div class="ot-psychologist-card__info d-flex flex-column align-items-center">
		                      <span class="ot-psychologist-card__name">'.$user->display_name.'</span>
		                      <span class="ot-psychologist-card__category">'.$category_name.'</span>
		                    </div>
		                  </div>						
						
						';
					}
	             ?>  	
                </div>
                
              </div>
            </div>
            <button class="ot-our-psychologists__btn-slider ot-our-psychologists__btn-slider_prev ot-btn ot-btn_circle ot-btn_gradient-primary">
              <svg class="ot-btn__icon-arrow">
                <use xlink:href="#icon-arrow"></use>
              </svg>
            </button>
            <button class="ot-our-psychologists__btn-slider ot-our-psychologists__btn-slider_next ot-btn ot-btn_circle ot-btn_gradient-primary">
              <svg class="ot-btn__icon-arrow ot-btn__icon-arrow_right">
                <use xlink:href="#icon-arrow"></use>
              </svg>
            </button>
          </div>
        </div>
      </div>
    </section>
    <section class="ot-section ot-psychologist-selection" id="section-select-psychologist">
      <div class="container">
        <div class="ot-section__title-wrp">
          <h2 class="ot-section__title"><span class="ot-section__title-accent">Подберите</span> себе психолога</h2>
        </div>
        <!--<div class="d-flex justify-content-center">
          <div class="ot-psychologist-selection__notification text-center">
            <span class="ot-psychologist-selection__notification-title d-block">Важно!</span>
            <p class="ot-psychologist-selection__notification-text">На данной странице Вы можете выбрать психолога для работы с общими запросами (личные, семейные, отношения, страхи, финансы, лишний вес до 10 кг и т.д.), по другим запросам (насилие, панические атаки) свободных мест нет, запись не производится. Когда вознобится запись, Ольга сообщит в сториз в Инстаграм</p>

          </div>
        </div>-->
        <div class="ot-psychologist-selection__categories">
          <div class="d-flex justify-content-center">
            <!--<h3 class="ot-psychologist-selection__title-select">Записаться на:</h3>-->
          </div>
          <div class="d-flex align-items-center justify-content-center flex-wrap flex-sm-nowrap">
          	
            <!--<div class="ot-psychologist-selection__btn-wrp d-flex flex-column align-items-center">
              <a style="text-align:center" href="https://n619662.yclients.com/company:542516/idx:0/service" target="_BLANK" class="ot-psychologist-selection__btn-type ot-btn">Психология</a>
            </div>-->   
            
            <!--<script type="text/javascript" src="https://w574101.yclients.com/widgetJS" charset="UTF-8"></script>-->
            
            <div class="ot-psychologist-selection__btn-wrp d-flex flex-column align-items-center">
            	<button data-toggle="modal" data-target="#calendar" class="ot-psychologist-selection__btn-type ot-btn" id="base_btn">Психология</button>
              <!--<a style="text-align:center" href="" target="_BLANK" class="ot-psychologist-selection__btn-type ot-btn" style="background:#5ab3c9;color:#fff">Выбор окна</a>-->
            </div>
			<div class="ot-psychologist-selection__btn-wrp d-flex flex-column align-items-center">
            	<button data-toggle="modal" data-target="#calendar" class="ot-psychologist-selection__btn-type ot-btn" id="psy_btn">Психосоматика</button>
              <!--<a style="text-align:center" href="" target="_BLANK" class="ot-psychologist-selection__btn-type ot-btn" style="background:#5ab3c9;color:#fff">Выбор окна</a>-->
            </div>
          </div>
			<div style="margin-top: 25px" class="d-flex align-items-center justify-content-center flex-wrap flex-sm-nowrap">
				<div class="ot-psychologist-selection__btn-wrp d-flex flex-column align-items-center">
					<button data-toggle="modal" data-target="#inPerson" class="ot-psychologist-selection__btn-type ot-btn">Насилие / Панические атаки</button>
				</div>
			</div>
		  
		</div>      
        <div class="ot-psychologist-selection__categories">
          <div class="d-flex justify-content-center">
            <h3 class="ot-psychologist-selection__title-select">Выберите категорию психолога</h3>
          </div>
          <div class="d-flex align-items-center justify-content-center flex-wrap flex-sm-nowrap">
            <div class="ot-psychologist-selection__btn-wrp d-flex flex-column align-items-center">
              <button class="ot-psychologist-selection__btn-category ot-btn" data-swiper-class="super">Высшая категория</button>
              <span
                class="ot-psychologist-selection__category-price-range d-none d-md-block">Стоимость консультации от 10000 до 50000 руб</span>
            </div>          	
            <div class="ot-psychologist-selection__btn-wrp d-flex flex-column align-items-center">
              <button class="ot-psychologist-selection__btn-category ot-btn" data-swiper-class="top">1 категория</button>
              <span
                class="ot-psychologist-selection__category-price-range d-none d-md-block">Стоимость консультации 5000 руб</span>
            </div>
            <div class="ot-psychologist-selection__btn-wrp d-flex flex-column align-items-center">
              <button class="ot-psychologist-selection__btn-category ot-btn" data-swiper-class="base">2 категория</button>
              <span class="ot-psychologist-selection__category-price-range d-none d-md-block">Стоимость консультации 3000 руб</span>
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
						    case '1 категория':
						        $category = "top";
						        $category_name = "Психолог 1 категории";
						        break;
						    case '3 категория':
						         $category = "begin";
						         $category_name = "Психолог 3 категории";
						        break;
						    case '2 категория':
						         $category = "base";
						         $category_name = "Психолог 2 категории";
						        break;
						    case 'Высшая категория':
						         $category = "super";
						         $category_name = "Психолог высшей категории";
						        break;						        
						}
						
						if ($user->ID==16) {$dop_style="background-position:top";} else {$dop_style="";}
						
						echo '
						         <div class="swiper-slide ot-psychologist-card ot-psychologist-card_full d-flex flex-row flex-sm-column '.$category.'">
					                  <a target=""href="'.home_url('/').get_the_author_meta('url_name',$user->ID).'" class="ot-psychologist-card__photo"
					                       style="'.$dop_style.' ; background-image: url('.get_the_author_meta('photo',$user->ID).');">
					                  </a>
					                  <div class="ot-psychologist-card__info d-flex flex-column align-items-center">
					                    <div class="ot-psychologist-card__name">'.$user->display_name.'</div>
					                    <div class="ot-psychologist-card__category">'.$category_name.'</div>
					                    <div class="ot-psychologist-card__session-text">Цена за консультацию:</div>
					                    <div class="ot-psychologist-card__session-price">'.get_the_author_meta('price',$user->ID).' рублей</div>
					                   
					                    <a href="'.home_url('/').get_the_author_meta('url_name',$user->ID).'" target="_BLANK" class="ot-psychologist-card__btn ot-btn ot-btn_main ot-btn_gradient-primary">Записаться</a>
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
          <button class="ot-btn ot-btn_main ot-btn_gradient-primary js-show-all-psychologists" data-clicked="false">Показать всех психологов</button>
          <!--<button data-toggle="modal" data-target="#calendar" class="ot-psychologist-selection__btn-show-window ot-btn ot-btn_main ot-btn_gradient-secondary">Посмотреть «окна» в календаре</button>-->
        </div>
      </div>
    </section>
    <section class="ot-section ot-section_light-bg ot-about-us">
      <div class="container">
        <div class="row flex-column flex-md-row">
          <div class="col-12 col-md-6 d-flex flex-column justify-content-center">
            <h2 class="ot-section__title"><span class="ot-section__title-accent">Цифры</span> о нас</h2>
            <div class="ot-about-us__facts-list d-flex flex-column">
              <div class="ot-about-us__fact">
                <div class="ot-about-us__fact-content d-flex flex-column flex-lg-row align-items-center">
                  <span class="ot-about-us__fact-value">9,8<span class="ot-about-us__value-separate mx-1 m-lg-0">из</span>10</span>
                  <p class="ot-about-us__fact-text"><b>средняя оценка</b> результативности терапий и уровня комфортности работы с психологом</p>
                </div>
              </div>
              <div class="ot-about-us__fact">
                <div class="ot-about-us__fact-content d-flex flex-column flex-lg-row align-items-center">
                  <span class="ot-about-us__fact-value">84%</span>
                  <p class="ot-about-us__fact-text"><b>клиентов рекомендуют нас</b> своим друзьям и родным и получают за это благодарность от них</p>
                </div>
              </div>
              <div class="ot-about-us__fact">
                <div class="ot-about-us__fact-content d-flex flex-column flex-lg-row align-items-center">
                  <span class="ot-about-us__fact-value">100%</span>
                  <p class="ot-about-us__fact-text"><b>приватность.</b> Мы гарантируем, что все сказанное Вами на терапии не получит огласки</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6 d-flex justify-content-center">
            <form id="ask" class="ot-about-us__form position-relative overflow-hidden">
              <input type="hidden" name="action" value="sendForm">
			  <input type="hidden" name="partner" value="<? if (isset($_COOKIE['partner']))	echo $_COOKIE['partner']; ?>">
              <div class="ot-about-us__form-content d-flex flex-column align-items-center justify-content-center">
                <h3 class="ot-about-us__form-title text-center"><span>Остались вопросы</span> по выбору психолога?</h3>
                <p class="ot-about-us__form-subtitle">С радостью ответим на них!</p>
                <div class="d-flex flex-column align-items-center w-100">
                  <div class="ot-input-wrp ot-input-wrp_name">
                    <input class="ot-input form-control" name="recall_name" type="text" placeholder="Введите ваше имя" required>
                  </div>
                  <div class="ot-input-wrp ot-input-wrp_phone">
                    <input class="ot-input form-control" name="recall_phone"type="text" placeholder="Введите ваш номер" required>
                  </div>
                </div>
                <span class="ot-about-us__communication-title d-block">Укажите удобный способ связи:</span>
                <div class="ot-about-us__communication-types d-flex flex-wrap justify-content-center">
                  <div>
                    <input class="ot-about-us__communication-input" id="whats-app" type="radio" value="Whatsapp" name="communication-type" checked>
                    <label class="ot-about-us__communication-label d-flex flex-column align-items-center" for="whats-app">
                      <svg class="ot-about-us__communication-icon">
                        <use xlink:href="#icon-whatsapp"></use>
                      </svg>
                      <span class="ot-about-us__communication-name">WhatsApp</span>
                    </label>
                  </div>
                  <div>
                    <input class="ot-about-us__communication-input" id="telegram" value="telegram" type="radio" name="communication-type">
                    <label class="ot-about-us__communication-label d-flex flex-column align-items-center" for="telegram">
                      <svg class="ot-about-us__communication-icon">
                        <use xlink:href="#icon-telegram"></use>
                      </svg>
                      <span class="ot-about-us__communication-name">Telegram</span>
                    </label>
                  </div>
                  <!--<div>
                    <input class="ot-about-us__communication-input" id="email" value="email"  type="radio" name="communication-type">
                    <label class="ot-about-us__communication-label d-flex flex-column align-items-center mr-0" for="email">
                      <svg class="ot-about-us__communication-icon">
                        <use xlink:href="#icon-email"></use>
                      </svg>
                      <span class="ot-about-us__communication-name">E-mail</span>
                    </label>
                  </div>-->
                </div>
                <button id="ask_btn" class="ot-about-us__btn-submit ot-btn ot-btn_main ot-btn_gradient-primary" type="submit">Задать вопрос</button>
                <small class="ot-about-us__form-personal-data">Нажимая кнопку, вы даете согласие<br> на <a target="_BLANK" href="https://new.ollyteam.ru/policy/">обработку персональных данных</a></small>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <section class="ot-section ot-consultation">
      <div class="container">
        <div class="ot-section__title-wrp d-flex justify-content-center">
          <h2 class="ot-consultation__title-main ot-section__title">
            Получить консультацию можно<span class="ot-section__title-accent"> из любого места:</span>
          </h2>
        </div>
        <div class="row justify-content-center">
          <div class="col-12 col-md-6 col-lg-4">
            <div class="ot-consultation__item ot-consultation__place ot-consultation__place_home d-flex align-items-center">
              <span class="ot-consultation__item-title">Из дома</span>
            </div>
          </div>
          <!--<div class="col-12 col-md-6 col-lg-4">
            <div class="ot-consultation__item ot-consultation__place ot-consultation__place_car d-flex align-items-center">
              <span class="ot-consultation__item-title">Из машины</span>
            </div>
          </div>-->
          <div class="col-12 col-md-6 col-lg-4">
            <div class="ot-consultation__item ot-consultation__place ot-consultation__place_office d-flex align-items-center">
              <span class="ot-consultation__item-title">Из офиса</span>
            </div>
          </div>
        </div>
        <h2 class="ot-consultation__title-device ot-section__title"><span class="ot-section__title-accent">С любого устройства:</span></h2>
        <div class="ot-consultation__row-device row justify-content-center">
          <div class="col-12 col-md-6 col-lg-4">
            <div class="ot-consultation__item ot-consultation__device ot-consultation__device_phone d-flex align-items-center">
              <span class="ot-consultation__item-title">С телефона</span>
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-4">
            <div class="ot-consultation__item ot-consultation__device ot-consultation__device_notebook d-flex align-items-center">
              <span class="ot-consultation__item-title">Ноутбука</span>
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-4">
            <div class="ot-consultation__item ot-consultation__device ot-consultation__device_computer d-flex align-items-center">
              <span class="ot-consultation__item-title">Компьютера</span>
            </div>
          </div>
        </div>
        <div class="ot-consultation__text-wrp d-flex justify-content-center">
          <p class="ot-consultation__help-text">Психотерапия действительно помогает и сильно повышает качество жизни!</p>
        </div>
        <div class="d-flex justify-content-center">
          <button class="ot-btn ot-btn_main ot-btn_gradient-primary" data-toggle="modal" data-target="#modalRequests">Посмотреть варианты запросов к психологу</button>
        </div>
      </div>
    </section>
    <section class="ot-section ot-acquaintance">
      <div class="ot-acquaintance__inner">
        <div class="container">
          <h2 class="ot-section__title text-center">Давайте <span class="ot-section__title-accent">познакомимся</span> поближе!</h2>
          <div class="row">
            <div class="col-12 d-flex justify-content-end">
              <div class="ot-acquaintance__founder d-none d-lg-block">
                <span class="ot-acquaintance__founder-text d-block">
                  Идейный вдохновитель<br><span class="ot-acquaintance__company-name">Olly_team</span>
                </span>
              </div>
              <div class="ot-acquaintance__main">
                <div class="ot-acquaintance__content">
                  <span class="ot-acquaintance__title d-block">Я - Ольга Роменская, счастливый психолог!</span>
                  <ul class="ot-acquaintance__list ot-list">
                    <li class="ot-list__item">руководитель и основатель школы психологов</li>
                    <li class="ot-list__item">клинический психолог</li>
                    <li class="ot-list__item">гештальт-терапевт</li>
                    <li class="ot-list__item">специалист по психосоматике</li>
                    <li class="ot-list__item">автор марафонов и вебинаров</li>
                  </ul>
                  <span class="ot-acquaintance__psychology d-block">
                    <b>Для меня психология - это больше, чем дело жизни, это душа!</b>
                  </span>
                  <p class="ot-acquaintance__text">На этом сайте я хочу познакомить Вас с психологами из моей команды.  Мы любим Ваши быстрые результаты и когда Ваши глаза начинают светиться от счастья. Классическая психология нашей команде психологов не близка в работе, очень уж долго и отнимает много сил, а результат даёт временный. Мало - понимать, важно применять - и тут помогают более глубокие методы!</p>
                  <p class="ot-acquaintance__text">Именно поэтому мы выбираем работу с подсознанием, которая дает видимые результаты за короткое время.<br> С нами Вы быстро сможете поменять свою жизнь! Достать настоящую себя!</p>
                </div>
              </div>
            </div>
          </div>
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
                  <p>Индивидуальная консультация длится час, проходит онлайн через видеозвонок WhatsApp</p>
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
						<li>2 категория, работают с Олиной супервизией - стоимость 3000 ₽</li>
						<li>1 категория - 5000 ₽</li>
						<li>Высшая категория - 7000-15000 ₽</li>
					</ul>
					<p>Стоимость очной консультации:</p>
					<ul>
						<li>Москва + 2000 ₽</li>
						<li>Санкт-Петербург + 3500 ₽</li>
						<li>Срочные консультации + 2000 ₽ к стоимости</li>
						<li>Проработка насилия и панических атак 12000-30000 ₽ (длительность консультации 2 часа)</li>


					</ul>					
					<p>Все психологи команды Оли проходят постоянное обучение и повышают уровень своей квалификации</p>
					<p>Записаться на очную консультацию можно, написав нам в WhatsApp по номеру <a href="https://api.whatsapp.com/send?phone=79785060117" style="color:#5ab3c9">+7 978 506-01-17</a></p>
					
					
					
					
					
					
					
					
					
					
					

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
                  <p>Для записи на консультацию по психосоматике, необходимо открыть раздел «календарь» и выбрать категорию «психосоматика», тогда откроется расписание свободных окошек для записи по данному запросу</p>
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
                  <p>Психологи команды Оли работают с людьми от 18 лет</p>
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
                  <p>Опираясь на нашу практику, мы не рекомендуем записывать близких, родных или друзей на терапию. Поскольку, если человек сам не готов к консультации с терапевтом, такая терапия обычно не приводит к результату и воспринимается Вашим близким человеком как навязанная услуга. Если это его желание, ему нужно будет записаться самостоятельно </p>
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
              <a class="ot-reviews__slider-slide swiper-slide d-block" data-fancybox="gallery" href="<?= bloginfo('template_directory'); ?>/images/main/reviews/review-1.png"><img class="w-100" width="246" src="<?= bloginfo('template_directory'); ?>/images/main/reviews/review-1.png"></a>
              <a class="ot-reviews__slider-slide swiper-slide d-block" data-fancybox="gallery" href="<?= bloginfo('template_directory'); ?>/images/main/reviews/review-2.png"><img class="w-100" width="246" src="<?= bloginfo('template_directory'); ?>/images/main/reviews/review-2.png"></a>
              <a class="ot-reviews__slider-slide swiper-slide d-block" data-fancybox="gallery" href="<?= bloginfo('template_directory'); ?>/images/main/reviews/review-3.png"><img class="w-100" width="246" src="<?= bloginfo('template_directory'); ?>/images/main/reviews/review-3.png"></a>
              <a class="ot-reviews__slider-slide swiper-slide d-block" data-fancybox="gallery" href="<?= bloginfo('template_directory'); ?>/images/main/reviews/review-4.png"><img class="w-100" width="246" src="<?= bloginfo('template_directory'); ?>/images/main/reviews/review-4.png"></a>
              <a class="ot-reviews__slider-slide swiper-slide d-block" data-fancybox="gallery" href="<?= bloginfo('template_directory'); ?>/images/main/reviews/review-5.png"><img class="w-100" width="246" src="<?= bloginfo('template_directory'); ?>/images/main/reviews/review-5.png"></a>
              <a class="ot-reviews__slider-slide swiper-slide d-block" data-fancybox="gallery" href="<?= bloginfo('template_directory'); ?>/images/main/reviews/review-6.png"><img class="w-100" width="246" src="<?= bloginfo('template_directory'); ?>/images/main/reviews/review-6.png"></a>
              <a class="ot-reviews__slider-slide swiper-slide d-block" data-fancybox="gallery" href="<?= bloginfo('template_directory'); ?>/images/main/reviews/review-7.png"><img class="w-100" width="246" src="<?= bloginfo('template_directory'); ?>/images/main/reviews/review-7.png"></a>
              <a class="ot-reviews__slider-slide swiper-slide d-block" data-fancybox="gallery" href="<?= bloginfo('template_directory'); ?>/images/main/reviews/review-8.png"><img class="w-100" width="246" src="<?= bloginfo('template_directory'); ?>/images/main/reviews/review-8.png"></a>
              <a class="ot-reviews__slider-slide swiper-slide d-block" data-fancybox="gallery" href="<?= bloginfo('template_directory'); ?>/images/main/reviews/review-9.png"><img class="w-100" width="246" src="<?= bloginfo('template_directory'); ?>/images/main/reviews/review-9.png"></a>
              <a class="ot-reviews__slider-slide swiper-slide d-block" data-fancybox="gallery" href="<?= bloginfo('template_directory'); ?>/images/main/reviews/review-10.png"><img class="w-100" width="246" src="<?= bloginfo('template_directory'); ?>/images/main/reviews/review-10.png"></a>
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
    
    <!--<section class="ot-section ot-instagram d-none">
      <div class="container text-center">
        <div class="ot-section__title-wrp">
          <h2 class="ot-section__title">
            <span class="ot-section__title-accent">Следите за нашим Instagram,</span><br> там много полезного
          </h2>
        </div>
        <a href="https://www.instagram.com/olly_russia" target="_BLANK" class="ot-btn">Перейти в Instagram</a>
      </div>
    </section>-->
	
    <section class="ot-section ot-ask-question">
      <div class="container">
        <div class="ot-section__title-wrp">
          <h2 class="ot-section__title">Остались вопросы?</h2>
          <span class="ot-section__subtitle">Напишите нам и мы ответим</span>
        </div>
        <div class="ot-ask-question__btn-wrp d-flex flex-column flex-md-row align-items-center justify-content-center">
          <!--<a class="ot-ask-question__btn-instagram ot-btn ot-btn_main ot-btn_gradient-primary d-flex align-items-center" target="_BLANK" href="https://www.instagram.com/olly_russia">
            Задать в Instagram
            <svg class="ot-ask-question__btn-icon">
              <use xlink:href="#icon-instagram"></use>
            </svg>
          </a>-->
          <a class="ot-ask-question__btn-whatsapp ot-btn ot-btn_main ot-btn_gradient-primary d-flex align-items-center" target="_BLANK" href="https://api.whatsapp.com/send?phone=79785060117&text=%D0%94%D0%BE%D0%B1%D1%80%D1%8B%D0%B9%20%D0%B4%D0%B5%D0%BD%D1%8C!%20%20%D0%A5%D0%BE%D1%87%D1%83%20%D0%B7%D0%B0%D0%BF%D0%B8%D1%81%D0%B0%D1%82%D1%8C%D1%81%D1%8F%20%D0%BD%D0%B0%20%D0%BA%D0%BE%D0%BD%D1%81%D1%83%D0%BB%D1%8C%D1%82%D0%B0%D1%86%D0%B8%D1%8E%E2%9D%A4%EF%B8%8F">
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
  
  
<div class="ot-modal ot-modal-calendar modal fade" tabindex="-1" id="calendar">
  <div class="ot-modal__dialog modal-dialog modal-dialog-centered">
    <div class="ot-modal__content modal-content d-flex align-items-center">
      <div class="ot-modal__main-wrp">
        <div class="ot-modal__main d-flex flex-column align-items-center">
          <div class="ot-modal__header d-flex justify-content-between align-items-start">
            <span class="ot-modal-calendar__title d-block text-center">Календарь консультаций</span>
            
            <button class="ot-modal__btn-close ot-btn close d-flex" type="button" data-dismiss="modal">
              <svg class="ot-modal__icon-close">
                <use xlink:href="#icon-cross"></use>
              </svg>
            </button>
          </div>
          
          <div class="d-flex flex-column flex-md-row w-100">
            <div class="ot-modal-calendar__calendar">
            	
              <div class="ot-modal-calendar__category-wrp d-flex flex-column">
                <p class="ot-modal-calendar__category-text" style="
				    font-weight: bold;
				    background: #c0f0fb;
				    padding: 5px;
				    color: black;
				">Выберите категорию консультаций:</p>
                <div class="ot-modal-calendar__category-select-wrp">
                  <select name="type_calendar" class="ot-modal-calendar__category-select" style="background: #c0f0fb;">
                    <option value="Основа" selected>Психология</option>
                    <option value="Психосоматика">Психосоматика</option>
                    <option value="Насилие/ПА">Насилие/ПА</option>
                  </select>
                </div>
              </div>
              
			  <div class="d-flex flex-column">
			  	<div class="my-calendar"></div>
                <div class="ot-modal-calendar__legend d-flex justify-content-center justify-content-md-start flex-wrap">
                  <div class="ot-modal-calendar__legend-item ot-modal-calendar__legend-item_today d-flex align-items-center flex-shrink-0 mr-3">
                    <div class="ot-modal-calendar__item-example d-flex align-items-center justify-content-center"></div>
                    <span class="mx-1">-</span>
                    <span class="ot-modal-calendar__item-text">текущая дата</span>
                  </div>
                  <div class="ot-modal-calendar__legend-item ot-modal-calendar__legend-item_event d-flex align-items-center flex-shrink-0">
                    <div class="ot-modal-calendar__item-example d-flex align-items-center justify-content-center"></div>
                    <span class="mx-1">-</span>
                    <span class="ot-modal-calendar__item-text">есть свободные окна</span>
                  </div>
                </div>
			  </div>
            </div>
            <div class="ot-modal-calendar__data-content d-flex flex-column">
              <template v-if="selectedCategory !== 'Психосоматика'">
            	<div class="ot-modal-calendar__data-content-title d-flex align-items-center justify-content-between flex-shrink-0">
                  Список консультаций: <span class="js-zabuto-date ml-1"></span>
            	</div>
              </template>
              <template v-else>
              	<div class="ot-modal-calendar__data-content-title d-flex flex-column" style="padding: 8px 15px; height: auto;">
              	  <div class="d-flex align-items-center justify-content-between flex-shrink-0 mb-2" style="font-size: 14px;">
              	  	Список консультаций: <span class="js-zabuto-date ml-1"></span>
              	  </div>
              	  <!--<div class="d-flex align-items-center mb-2">
			        <div class="ot-example-session ot-btn_gradient-secondary flex-shrink-0"></div>
			        <span class="mx-2">—</span>
			        <span class="text-left" style="font-size: 14px;">Консультация по психосоматике, продолжительность: 1-1,5 часа</span>
			      </div>-->
			      <div class="d-flex align-items-center">
			        <!--<div class="ot-example-session ot-time-long-color flex-shrink-0"></div>
			        <span class="mx-2">—</span>-->
			        <span class="text-left" style="font-size: 14px;">
			        	<span style="font-size:12px">Первичная терапия по психосоматике включает в себя две терапии. На первой идёт сбор цепочки заболевания и поиск шаблона клиента. На второй — проработка точечного запроса из всей цепочки.<br /><br />Длительность первичной консультации по психосоматике от 1,5 до 3 часов.<br /> 
Это может зависеть от сложности диагноза и информации по заболеванию, предоставленной клиентом.</span>
			        </span>	
			      </div>
            	</div>
              </template>
              <template v-if="!dateSessions">
                <div class="d-flex align-items-center justify-content-center flex-grow-1">
				  <p class="ot-modal-calendar__empty-text text-center my-5">
				  	<span v-if="isLoading" class="d-flex flex-column">
				  		<svg  xmlns="http://www.w3.org/2000/svg" style="margin: auto; display: block;" width="60px" height="60px" viewBox="0 0 100 100">
							<circle cx="50" cy="50" fill="none" stroke="#5ab3c9" stroke-width="10" r="35" stroke-dasharray="164.93361431346415 56.97787143782138">
								<animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
							</circle>
						</svg>
						<span class="mt-1">Загружаем данные...</span>
				  	</span>

				  	<span v-else-if="isDateSelected">На выбранную дату нет свободных окон</span>
				  	<span v-else>Выберите дату в календаре</span>
				  </p>
                </div>
              </template>
              <template v-else>
	              <div class="ot-modal-calendar__sessions-list d-flex flex-column flex-grow-1 overflow-auto">
	                <div class="ot-modal-calendar__list-item d-flex flex-column" v-for="item of dateSessions">
	                  <a class="ot-modal-calendar__name" v-bind:href="item.url" target="_blank" title="Перейти в профиль">{{ item.therapist_name }}</a>
	                  <span class="ot-modal-calendar__category">{{ item.category }}</span>
	                  <span class="ot-modal-calendar__price">Цена за сессию: {{ selectedCategory === 'Психосоматика' ? item.price * 2 : item.price }} рублей</span>
	                  <div class="ot-modal-calendar__sessions">
	                    <div class="ot-modal-calendar__sessions-inner d-flex flex-wrap">
	                    <a
	                    	v-bind:data-date="item.date + ' ' + time.time"
	                    	v-bind:data-booking-id="time.id_booking"
	                    	v-bind:data-type="time.type"
	                    	v-bind:data-session-price="time.type === 'Психосоматика2' ? item.price * 2 : item.price"
	                    	v-bind:data-therapist="item.therapist_name"
	                    	:class="time.type === 'Психосоматика2' ? 'ot-time-long-color' : 'ot-btn_gradient-secondary'"
		                	class="ot-modal-calendar__btn-session ot-btn" v-for="time of item.sessions">{{ time.time }}</a>
	                    </div>
	                  </div>
	                </div>
	              </div>
              </template>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!--КОРЗИНА-->
<div class="ot-cart-modal modal fade show" id="cart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-modal="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header d-flex align-items-center">
        <h5 class="modal-title" id="exampleModalLabel">Оформить заказ</h5>
        <button class="ot-btn close" type="button" data-dismiss="modal">
          <svg class="ot-modal__icon-close">
            <use xlink:href="#icon-cross"></use>
          </svg>
        </button>
      </div>
      <div class="modal-body">
      	
      	<!--<div class="alert alert-danger" role="alert" style="color:black;">
        	<b>Важно!</b> Запросы по паническим атакам, насилию, онкологии или психосоматике (запросы, связанные с заболеваниями и лишним весом более 10 кг) не рассматриваются в рамках терапий данного формата.<br>Подробнее о записи на эти запросы <a href="/#section-faq" style="color:#0043A4">смотрите тут</a>
		</div>-->

        <form id="" action='/wp-admin/admin-post.php' method="POST">

          <input type="hidden" name="action" value="setPayment">
		  <input type="hidden" name="partner" value="<? if (isset($_COOKIE['partner']))	echo $_COOKIE['partner']; ?>">
		  <input type="hidden" name="therapist_price" value="">
          <input type="hidden" name="booking_id" value="">
          <input type="hidden" name="sum_client" value="">
          
          <table class="table">
            <thead class="thead-dark">
            <tr>
              <th scope="col">Психолог</th>
              <th scope="col">Дата</th>
              <th scope="col">Сумма</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td id="therapist"></td>
              <td id="date"></td>
              <td id="price"></td>
            </tr>
            </tbody>
          </table>
          
          <label class="ot-check mb-3 js-cart-warning d-none" id="cart-psy-block" for="cart-psy">
            <input class="ot-check__input" id="cart-psy" type="checkbox" required>
            <span class="ot-check__mark"></span>
            <span class="ot-check__text d-flex flex-column">
                <span>Ознакомлен<br>
                Обратите, пожалуйста, внимание, что Вы бронируете окно на работу с запросом по психологии (общие запросы), в рамках этой терапий работа с запросами по психосоматике не происходит. Если Вы хотите проработать запрос по психосоматике (связанный со здоровьем), выберете окно из раздела «Психосоматика».</span>
              </span>
          </label>
          
		  <div class="alert alert-primary d-none" role="alert" id="psy2">Первичная (первая) консультация по психосоматике, которая включает в себя разбор цепочки + начало работы над Вашим запросом (диагнозом). Продолжительность: 2,5-3 часа</div>
		  
		  
          <label class="ot-check mb-3 d-none" id="violence_block" for="violence">
            <input class="ot-check__input" id="violence" type="checkbox" required>
            <span class="ot-check__mark"></span>
            <span class="ot-check__text d-flex flex-column">
                <span>В случае выхода на насилие во время терапии, консультация по текущему запросу может быть остановлена терапевтом до очной проработки насилия, либо продолжена, но с другим запросом</span>
              </span>
          </label>	
          
          <div class="form-group">
            <label class="mb-2" for="cart-request-text">Ваш запрос <span class="ot-cart__required-text">(Обязательное поле)</span></label>
            <textarea class="form-control" name="query_client" id="cart-request-text" rows="3" placeholder="Введите ваш запрос" required></textarea>
          </div>

          <div class="form-group mb-4">
            <label class="mb-2" for="cart-name">Ваше имя <span class="ot-cart__required-text">(Обязательное поле)</span></label>
            <input type="text" class="ot-input form-control" name="name_client" id="cart-name" placeholder="Введите ваше имя" value="" required>
          </div>
          <div class="form-group mb-4">
            <label class="mb-2" for="cart-surname">Ваша фамилия <span class="ot-cart__required-text">(Обязательное поле)</span></label>
            <input type="text" class="ot-input form-control" name="surname_client" id="cart-surname" placeholder="Введите вашу фамилию" value="" required>
          </div>
          <div class="form-group mb-4">
            <label class="d-flex flex-column mb-2" for="cart-birthday_client">
              <span class="mb-1">Дата вашего рождения <span class="ot-cart__required-text">(Обязательное поле)</span></span>
              <span class="ot-cart__explain">Дата должна быть в формате: день.месяц.год</span>
            </label>
            <input type="text" class="ot-input form-control" name="birthday_client" id="cart-birthday_client" placeholder="Например: 10.12.1990" value="" required>
          </div>
          <div class="form-group mb-4">
            <label class="mb-2" for="cart-email">Ваша почта <span class="ot-cart__required-text">(Обязательное поле)</span></label>
            <input type="email" class="ot-input form-control" name="email_client" id="cart-email" placeholder="Введите вашу почту" value="" required>
          </div>
          
          <div class="form-group mb-4">
            <label class="d-flex flex-column mb-2" for="cart-phone">
              <span class="mb-1">Ваш телефон <span class="ot-cart__required-text">(Обязательное поле)</span></span>
              <span class="ot-cart__explain">Введите номер телефона, по которому планируете связываться с психологом</span>
            </label>
            <input type="text" class="ot-input form-control" name="phone_client" id="cart-phone" placeholder="Введите ваш телефон" value="" required>
          </div>
          
          <div class="form-group mb-4" id="promo_block">
            <label class="ot-input-wrp mb-2" for="promo">Промокод <span class="ot-cart__required-text" id="promo_status">(если есть)</span></label>
            <div class="ot-cart__code d-flex">
              <input type="text" name="promocode_client" class="ot-input form-control" id="promo" placeholder="Промокод">
              
              <button id="promo_btn" class="ot-cart__btn-activate ot-btn ot-btn_gradient-primary">Активировать</button>
            </div>
          </div>
          
          <label class="ot-check mb-3" for="cart-terms">
            <input class="ot-check__input" id="cart-terms" type="checkbox" required>
            <span class="ot-check__mark"></span>
            <span class="ot-check__text d-flex flex-column">
                <span>Ознакомлен/ознакомлена и согласен/согласна с тем, что в случае отмены консультации более, чем за 24 часа, возврат денежных средств осуществляется с удержанием орг.взноса в размере 3% от суммы. При отмене консультации менее, чем за 24 часа - оплата не возвращается.</span>
              </span>
          </label>

          <label class="ot-check mb-3" for="cart-politic">
            <input class="ot-check__input" id="cart-politic" type="checkbox" required>
            <span class="ot-check__mark"></span>
            <span class="ot-check__text d-flex flex-column">
                <span>Я принимаю <a class="ot-btn-link" href="/oferta">условия оферты</a> и согласен с <a class="ot-btn-link" href="/policy">политикой обработки персональных данных</a></span>
              </span>
          </label>

          <label class="ot-check mb-3" for="cart-18">
            <input class="ot-check__input" id="cart-18" type="checkbox" required>
            <span class="ot-check__mark"></span>
            <span class="ot-check__text d-flex flex-column">
                <span>Я подтверждаю, что мне есть 18 лет</span>
              </span>
          </label>

        </div>
      <div class="modal-footer d-flex justify-content-between">
        <button type="button" class="ot-btn" data-dismiss="modal">Закрыть</button>
        <button type="submit" class="ot-btn ot-btn-done">Оплатить</button>
      </div>
      
	</form>

    </div>
  </div>
</div>

<!-- ПА/Н -->

<div class="ot-psychologist-cart-modal modal fade show" id="inPerson" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-modal="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header d-flex align-items-center">
      	<h5 id="inPerson_title" class="ot-modal-callback__title d-block text-center">Запись на консультацию</h5>

        <button class="ot-btn close" type="button" data-dismiss="modal">
          <svg class="ot-modal__icon-close">
            <use xlink:href="#icon-cross"></use>
          </svg>
        </button>
      </div>
      <div class="modal-body">
			<form id="inPersonForm" method="POST">		
			<div class="ot-schedule__block d-flex flex-column align-items-center justify-content-center" style="text-align: center;">
			<p style="font-size: 14px;">Если Ваш запрос связан с проработкой физического/сексуального насилия, либо Вы хотите избавиться от панических атак, то такие консультации проходят только в ОЧНОМ формате. Для безопасности клиента необходимо быть лично в контакте с терапевтом, в формате онлайн обеспечить эту безопасность, к сожалению, невозможно.</p>
			<p>&nbsp;</p>
			<p style="font-size: 14px;">Вы можете оставить заявку, с Вами свяжется Служба заботы, проконсультирует и подберет удобное окошко.</p>
			</div>
		  <input type="hidden" name="action" value="inPerson">
		  <input type="hidden" name="partner" value="<?if (isset($_COOKIE['partner'])){echo $_COOKIE['partner']; }?>">
		  
		  <div class="form-group">
		    <label for="direction">Выберите направление</label>
		    <select class="form-control" id="direction" name="direction">
		    	<option value="Насилие">Насилие</option>
				<option value="Панические атаки">Панические атаки</option>
		    </select>
		  </div>
		  
		  <div class="form-group">
		    <label for="in-therapist">В каком городе Вам удобно?</label>
			<?
				//foreach ($users as $user) {
				//	if (get_the_author_meta('city',$user->ID)) {
				//		echo "<option value='".$user->display_name."'>".$user->display_name." ( ".get_the_author_meta('city',$user->ID)." )</option>";
				//	}					        
				//}	    	
		     ?>
		    <select class="form-control nasilie" id="in-city" name="city">
				<option value='Москва'>Москва</option>
				<option value='Санкт-Петербург'>Санкт-Петербург</option>
				<option value='Нижний Новгород'>Нижний Новгород</option>
				<option value='Набережные Челны'>Набережные Челны</option>
				<option value='Краснодар'>Краснодар</option>
				<option value='Таганрог'>Таганрог</option>
				<option value='Нижний Тагил'>Нижний Тагил</option>
				<option value='ether'>Другой город</option>

		    </select>
			<select class="form-control attack" id="in-city" name="city">
				<option value='Москва'>Москва</option>
				<option value='Санкт-Петербург'>Санкт-Петербург</option>
				<option value='Краснодар'>Краснодар</option>
				<option value='Таганрог'>Таганрог</option>
				<option value='Нижний Тагил'>Нижний Тагил</option>
				<option value='ether'>Другой город</option>
		    </select>
		  </div>

			<div class="form-group mb-4 etherether">
				<label class="mb-2" for="in-city">Укажиет ваш город <span class="ot-cart__required-text">(Обязательное поле)</span></label>
				<input type="text" class="ot-input form-control" name="city_text" id="in-city" value="Москва" placeholder="Укажиет ваш город" required>
			</div>

          <div class="form-group mb-4">
            <label class="mb-2" for="in-name">Ваше имя <span class="ot-cart__required-text">(Обязательное поле)</span></label>
            <input type="text" class="ot-input form-control" name="name_client" id="in-name" placeholder="Введите ваше имя" required>
          </div>
          <div class="form-group mb-4">
            <label class="mb-2" for="in-surname">Ваша фамилия <span class="ot-cart__required-text">(Обязательное поле)</span></label>
            <input type="text" class="ot-input form-control" name="surname_client" id="in-surname" placeholder="Введите вашу фамилию" required>
          </div>
 
          <div class="form-group mb-4">
            <label class="mb-2" for="in-email">Ваша почта <span class="ot-cart__required-text">(Обязательное поле)</span></label>
            <input type="email" class="ot-input form-control" name="email_client" id="in-email" placeholder="Введите вашу почту" required>
          </div>
          
          <div class="form-group mb-4">
            <label class="d-flex flex-column mb-2" for="in-phone">
              <span class="mb-1">Ваш телефон <span class="ot-cart__required-text">(Обязательное поле)</span></span>
         
            </label>
            <input type="text" class="ot-input form-control" name="phone_client" id="in-phone" placeholder="Введите ваш телефон" required ">
          </div>
         
          <label class="ot-check mb-3" for="cart-politic_1">
            <input class="ot-check__input" id="cart-politic_1" type="checkbox" required>
            <span class="ot-check__mark"></span>
            <span class="ot-check__text d-flex flex-column">
                <span>Я принимаю <a class="ot-btn-link" href="/oferta">условия оферты</a> и согласен с <a class="ot-btn-link" href="/policy">политикой обработки персональных данных</a></span>
              </span>
          </label> 

          <label class="ot-check mb-3" for="cart-18_1">
            <input class="ot-check__input" id="cart-18_1" type="checkbox" required>
            <span class="ot-check__mark"></span>
            <span class="ot-check__text d-flex flex-column">
                <span>Я подтверждаю, что мне есть 18 лет</span>
              </span>
          </label>

        </div>
      <div class="modal-footer d-flex justify-content-between">
        <button type="button" class="ot-btn" data-dismiss="modal">Закрыть</button>
        <button id="inPerson_btn" type="submit" class="ot-btn ot-btn-done">Оставить заявку</button>
      </div>
      
	</form>

    </div>
  </div>
</div> 
<? //if (isset($_GET['test'])) include_once (__DIR__.'/functions/ycalendar.php'); ?>
<? //if (isset($_GET['test'])) include_once (__DIR__.'/functions/libs/yclients/custom_ycl_v2.php'); ?>
<? if (isset($_GET['test'])) include_once (__DIR__.'/test_amo.php'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<script>
$(document).ready(function() {
  // При выборе элемента из списков nasilie или attack
  $('.nasilie, .attack').on('change', function() {
    // Получаем выбранное значение
    var selectedValue = $(this).val();
    // Подставляем его в текстовое поле с name="city_text"
    $('input[name="city_text"]').val(selectedValue);
    // Если выбран элемент со значением "ether", то очищаем текстовое поле
    if (selectedValue === "ether") {
      $('input[name="city_text"]').val('');
    }
  });
});


</script>
<script>
// Получаем список направлений и элементы с классами nasilie и attack
const directionSelect = document.querySelector('#direction');
const nasilieSelect = document.querySelector('.nasilie');
const attackSelect = document.querySelector('.attack');

// При изменении списка направлений
directionSelect.addEventListener('change', (event) => {
  // Если выбрано значение 'Насилие'
  if (event.target.value === 'Насилие') {
    // Показываем список с классом nasilie и скрываем список с классом attack
    nasilieSelect.style.display = 'block';
    attackSelect.style.display = 'none';
  } 
  // Иначе, если выбрано значение 'Панические атаки'
  else if (event.target.value === 'Панические атаки') {
    // Показываем список с классом attack и скрываем список с классом nasilie
    nasilieSelect.style.display = 'none';
    attackSelect.style.display = 'block';
  }
});



// Получаем все списки на странице
const selectList = document.querySelectorAll('select');

// Получаем текстовое поле
const etherField = document.querySelector('.etherether');

// При изменении каждого списка
selectList.forEach((select) => {
  select.addEventListener('change', (event) => {
    // Если выбрано значение 'ether'
    if (event.target.value === 'ether') {
      // Показываем текстовое поле
      etherField.style.display = 'block';
    } else {
      // Иначе скрываем его
      etherField.style.display = 'none';
    }
  });
});
</script>
<script>
<?="var ajaxurl='".admin_url('admin-ajax.php')."'";?>
</script>

<script>
	$(document).ready(function(){
		var swiperSettings;
		var categoryBtn = $('.ot-psychologist-selection__btn-category');
		var showAllBtn = document.querySelector('.js-show-all-psychologists');
		
		if (categoryBtn) {
			categoryBtn.one('click', function(){
				if (swiperSettings) return;

				swiperSettings = window.psychologistsSwiper.passedParams;
			});
			categoryBtn.on('click', function(e) {
				var selectedCategory = e.target.dataset.swiperClass;
				
				if (showAllBtn.dataset.clicked === 'false' && window.psychologistsSwiper.destroyed) {
					console.log('init swiper')
					window.psychologistsSwiper = new Swiper('.js-psychologist-list-slider', swiperSettings);
				}
				
				
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
						var slidesCount = 0;
						$('.swiper-wrapper').empty();
						
						window.psychologistsSwiperSlides.forEach(function(el) {
							if (el.classList.contains(selectedCategory) && !el.classList.contains('swiper-slide-duplicate')) {
								slidesCount++;
								$('.swiper-wrapper').append($(el).removeAttr('style'));
							}	
						});
						
						if (slidesCount < 4) {
							$('.js-show-all-psychologists').hide();
						} else {
							$('.js-show-all-psychologists').show();
						}
					} else {
						var slidesCount = 0;
						var slides = [];
						window.psychologistsSwiper.removeAllSlides();
	
						window.psychologistsSwiperSlides.forEach(function(el) {
							if (el.classList.contains(selectedCategory) && !el.classList.contains('swiper-slide-duplicate')) {
								slidesCount++;
								slides.push(el);
							}	
						});
						
						if (slidesCount > 4) {
							window.psychologistsSwiper.appendSlide(slides);
							$('.ot-psychologist-selection').removeClass('ot-psychologist-selection_full');
							$('.js-show-all-psychologists').show();
						} else {
							window.psychologistsSwiper.destroy();
							
							slides.forEach(function(el) {
								$('.swiper-wrapper').append($(el).removeAttr('style'));
							})
							
							$('.ot-psychologist-selection').addClass('ot-psychologist-selection_full');
							$('.js-show-all-psychologists').hide();
						}
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
<script type="application/javascript">
  $(document).ready(function () {
  	var vueCalendar = new Vue({
		el: '#calendar',
		data() {
			return {
				isLoading: false,
				selectedCategory: $('.ot-modal-calendar__category-select').val(),
				autoUpdateInterval: 5000,
				currentDate: new Date().toISOString().slice(0, 10),
				isDateSelected: false,
				isAutoUpdateActive: false,
				selectedDate: null,
				dateSessions: null
			}
		},
		methods: {
			getDateSessions: function(date) {
				var sessionsType = $('.ot-modal-calendar__category-select').val();
				
				if (this.selectedDate !== date) {
					this.dateSessions = null;
				}

				this.isLoading = true;
				
				$.ajax({ 
					url: ajaxurl, 
					type: "POST",
					dataType: 'json',
					data: { action: 'getTherapyByDate', date, type: sessionsType }, 
					success: (data) => {
						if (!data) {
							this.isLoading = false;
							this.disableAutoUpdate();
							
							return;
						}
						
						var resultArray = [];
						data.forEach(el => {
							var isDuplicateTherapist = resultArray.some(item => item.therapist_name === el.therapist_name);
							
							if (resultArray.length !== 0 && isDuplicateTherapist) {
								var duplicatedItem = resultArray.find(item => item.therapist_name === el.therapist_name);
								
								duplicatedItem.sessions.push({
									time: el.time,
									id_booking: el.id_booking,
									type: el.type
								});
								
								return;
							}
							
							const { id_booking, time, type, ...rest } = el;
							
							resultArray.push({
								...rest,
								sessions: [{ time, id_booking, type }]
							});
						});
						
						if (!resultArray) {
							this.dateSessions = null;
							
							if (this.isAutoUpdateActive) {
								this.disableAutoUpdate();
							}
						} else {
							this.dateSessions = resultArray;
						
							if (!this.isAutoUpdateActive) {
								this.enableAutoUpdate();
							} else if (this.selectedDate !== date) {
								this.disableAutoUpdate();
								this.enableAutoUpdate();
							}
							
							this.selectedDate = date;
						}
						
						this.isLoading = false;
						syncSessionsListHeight();
					} 
				});	
			},
			resetCalendarData() {
				this.selectedDate = null;
				this.dateSessions = null;
  				this.isDateSelected = false;
  				
  				if (this.isAutoUpdateActive) {
  					this.disableAutoUpdate();
  				}
			},
			enableAutoUpdate() {
				if (!this.dateSessions) {
					return;
				} else {
					this.isAutoUpdateActive = true;
				
					this.updateInterval = setInterval(() => {
						this.getDateSessions(this.selectedDate ? this.selectedDate : this.currentDate);
						
						syncSessionsListHeight();
					}, this.autoUpdateInterval)
				}
			},
			disableAutoUpdate() {
				this.isAutoUpdateActive = false;
				
				clearInterval(this.updateInterval);
			}
		}
	});
  	
  	$('[name="type_calendar"]').on('change',function(){
  		$('.js-zabuto-date').html(null);
  		load_calendar();
  		syncSessionsListHeight();
  		
  		vueCalendar.selectedCategory = this.value;
  		vueCalendar.resetCalendarData();
  	})
  	
  	load_calendar();
  	
  	
	function load_calendar()
	{
		const ajaxURL = "https://ollyteam.ru/zabuto?type=" + $('[name="type_calendar"]').val();
		
		$('.my-calendar').removeAttr('id').empty();
	    var zabuto = $(".my-calendar").zabuto_calendar({
	      cell_border: true,
	      language: "ru",
	      ajax: { 
	      	url: ajaxURL
	      },
	      nav_icon: {
	        prev: '<svg width="18px" height="18px"><use xlink:href="#icon-arrow"></use></svg>',
	        next: '<svg width="18px" height="18px" style="transform: rotate(180deg);"><use xlink:href="#icon-arrow"></use></svg>'
	      },
	      action: function () {
	        return myDateFunction(this.id, false);
	      },
	      action_nav: function () {
	        return syncSessionsListHeight();
	      },
	    });
	    
	    window.zb = zabuto;
	}

    function myDateFunction(id) {
    	
		var date = $("#" + id).data("date");
		
		$('.selected').removeClass('selected');
		$('#' + id).addClass('selected');
		
		var cDate = date.split('-');
		cDate.push(cDate[1], cDate[0]);
		cDate.splice(0, 2);
		$('.js-zabuto-date').html(cDate.join('.'));

		vueCalendar.isDateSelected = true;
		vueCalendar.getDateSessions(date);
		
		if (window.innerWidth < 768) {
			document.querySelector('.ot-modal-calendar__data-content').scrollIntoView(true);
    	}
    }
    
    function syncSessionsListHeight() {
    	setTimeout(function() {
    		var leftHeight = $('.ot-modal-calendar__category-select-wrp').height() + $('.zabuto_calendar').height();
    		var rightColumn = $('.ot-modal-calendar__data-content');

    		if (window.innerWidth < 768) {
        		rightColumn.css('max-height', 'none');

    			return;
    		}
    		
        	rightColumn.css('max-height', Math.floor(leftHeight) + 'px');
    	}, 0);
    }


    $('#calendar').on('shown.bs.modal', function() {
    	$(window).on('resize', syncSessionsListHeight);

    	syncSessionsListHeight();
    });

    $('#calendar').on('hidden.bs.modal', function() {
    	vueCalendar.resetCalendarData();
    	
    	$('.zabuto_calendar .selected').removeClass('selected');
    	$('.js-zabuto-date').html(null);
    	
    	$(window).off('resize', syncSessionsListHeight);
    });
    
    //Корзина
    	$(document).on('click', '.ot-modal-calendar__btn-session', function(e){
    		$('#calendar').on('hidden.bs.modal', onCalendarHide);
    		
    		if (vueCalendar.selectedCategory === 'Насилие/ПА') {
    			$('#modalViolence').modal('show');
    			
    			return;
    		}
    		
    		$('#calendar').modal('hide');
    		
			$('#date').text($(this).data('date'));
			$('#price').text($(this).data('session-price'));
			$('#therapist').text($(this).data('therapist'));
			$('[name="booking_id"]').val($(this).data('booking-id'));
			$('[name="sum_client"]').val($(this).data('session-price'));
			$('[name="therapist_price"]').val($(this).data('session-price'));
			
			
			if ($('[name="type_calendar"]').val()=="Основа"){
				
				$('#psy2').addClass('d-none');
				
				$('#cart-psy-block').removeClass('d-none');
				$('#cart-psy').attr('required', 'required');
				
				$('#violence_block').addClass('d-none');
				$('#violence').removeAttr('required');
				
			} 	
			
		
			if ( $('[name="type_calendar"]').val()=="Психосоматика") {
				
				$('#psy2').addClass('d-none');
				
				$('#violence_block').addClass('d-none');
				$('#violence').removeAttr('required');
				
				$('#cart-psy-block').addClass('d-none');
				$('#cart-psy').removeAttr('required');
				
			}
			

			if ($(e.target).data('type') === "Психосоматика2" && $('[name="type_calendar"]').val()=="Психосоматика"){
				
				$('#psy2').removeClass('d-none');
				
				$('#cart-psy-block').addClass('d-none');
				$('#cart-psy').removeAttr('required');
				
				$('#violence_block').removeClass('d-none');
				$('#violence').attr('required', '');
				
			}
	
		});
		

		
		function onCalendarHide() {
			$('.ot-cart-modal').modal('show');
			
			$('#calendar').off('hidden.bs.modal', onCalendarHide)
		}
		
		$('#calendar').on('hidden.bs.modal', function (e) {
				$('#cart-psy').prop('checked', false);
		})
		
		//Активация промокода
		$('#promo_btn').on('click',function(event)
		{
			let promo = $('#promo').val().toUpperCase();
			$.ajax({ 
			      url: ajaxurl,
			      type: "POST",
			      dataType: 'json',
			      data: { promocode: promo,action:"getPromocode" },
			      success: function(data) 
			      {
			      	
			      	if (	data['discount']>0 )
			      	{
			      		sale = $('[name="sum_client"]').val()*data['discount']/100;
			      		itogo = $('[name="sum_client"]').val() - sale;
			      		if (itogo<=0){itogo=1}
						$('[name="sum_client"]').val(itogo);
						$('#price').text(itogo);
						
			      		$('#promo_btn').prop("disabled",true);
			    		$('#promo_status').text(" активирован");
			      		$('#promo').prop("readonly",true);
			      		alert ('Промокод активирован');
			      	}
			      	else 
			      	{
			      		alert ('Указанный промокод не найден или не действителен');
			      	}
		
			       } 
			    });
			    
			    event.preventDefault();
			    
		});
		//Сброс промокода
		$('.ot-cart-modal').on('hidden.bs.modal', function() {
			$('[name="promocode_client"]').val("");
			$('#promo_btn').removeAttr('disabled');
			$('#promo_status').text(" ");
			$('#promo').removeAttr('readonly');
			$('[name="sum_client"]').val("");
		});
		
		
		//Очно
		$('#inPersonForm').on('submit', function(event){
			event.preventDefault();
			
			$.ajax({ 
				url: ajaxurl,
				type: "POST",
				data: $("#inPersonForm").serialize(),
				success: function() {
					$('#inPerson_title').text('Спасибо за заявку. В ближайшее время мы с Вами свяжемся.')
					$('#inPersonForm').remove();
				}
			});
		});
		
		$('#base_btn').on('click', function(e){
			$('[name="type_calendar"]').val("Основа").change();	
		});
		$('#psy_btn').on('click', function(e){
			$('[name="type_calendar"]').val("Психосоматика").change();		
		});
    
  });
 

$('#direction').on('change',function(){
	if ($(this).val()=="Панические атаки") {
		$('#in-therapist option:contains("Ваганова")').remove();
		$('#in-therapist option:contains("Колесникова")').remove();
		$('#in-therapist option:contains("Рыжова")').remove();
	}
	if ($(this).val()=="Насилие") {
		$('#in-therapist').append('<option value="Александра Рыжова">Александра Рыжова ( Москва )</option>');
		$('#in-therapist').append('<option value="Наталия Колесникова">Наталия Колесникова ( Москва )</option>');
		$('#in-therapist').append('<option value="Алёна Ваганова">Алёна Ваганова ( Москва )</option>');
	}
})
	
</script>
<?get_footer();?>
