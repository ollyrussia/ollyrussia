<?
/*
 * Template name: Olly - лендинг
 * Template post type: page
 */
	get_header();

	$args = array(
	     'role'    => 'psychologist',
	     'orderby' => 'rand',
	     'order'   => 'DESC'
	);
	$users = get_users($args);
	
	function get_utm() 
	{
		$out = array();
		$keys = array('utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term');
		foreach ($keys as $row) {
			if (!empty($_GET[$row])) {
				$value = strval($_GET[$row]);
				$value = stripslashes($value);
				$value = htmlspecialchars_decode($value, ENT_QUOTES);	
				$value = strip_tags($value); 		
				$value = htmlspecialchars($value, ENT_QUOTES);	
				$out[] = '<input type="hidden" name="' . $row . '" value="' . $value . '">';
			}
		}
	 
		return implode("\r\n", $out);
	}
?>

<!-- Meta Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '328945054772289');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=328945054772289&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->

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

	body.modal-open {position:relative!important;}
</style>


<div class="ot-modal ot-modal-callback modal fade" tabindex="-1" id="modalLanding">
  <div class="ot-modal__dialog modal-dialog modal-dialog-centered">
    <div class="ot-modal__content modal-content d-flex align-items-center">
      <div class="ot-modal__main-wrp">
        <div class="ot-modal__main d-flex flex-column align-items-center">
          <div class="ot-modal__header d-flex justify-content-between align-items-start">
            <span id="landing_title" class="ot-modal-callback__title d-block text-center">Оставьте, пожалуйста, Ваш контакты и мы свяжемся с Вами в ближайшее время<br> ПН-ПТ: с 9.00 до 18.00 Мск</span>
            <button class="ot-modal__btn-close ot-btn close d-flex" type="button" data-dismiss="modal">
              <svg class="ot-modal__icon-close">
                <use xlink:href="#icon-cross"></use>
              </svg>
            </button>
          </div>
          <form id="landing" class="ot-modal-callback__form d-flex flex-column">
          	<input type="hidden" name="action" value="sendFormLanding">
          	<div class="ot-input-wrp ot-input-wrp_name">
              <input class="ot-input form-control" name="landing_name" type="text" placeholder="Введите ваше имя" required>
            </div> 
            <div class="ot-input-wrp ot-input-wrp_name">
              <input class="ot-input form-control" name="landing_email" type="text" placeholder="Введите ваш E-mail" required>
            </div>          	
            <div class="ot-input-wrp ot-input-wrp_phone">
              <input class="ot-input form-control" name="landing_phone" type="text" placeholder="Введите ваш номер" required>
            </div>
            <label class="ot-check" for="terms">
              <input class="ot-check__input" id="terms" type="checkbox" required>
              <span class="ot-check__mark"></span>
              <span class="ot-check__text">
                Я принимаю <a class="ot-btn-link" href="/oferta" target="_BLANK">условия оферты</a> и согласен с <a class="ot-btn-link" href="/policy" target="_BLANK">политикой обработки персональных данных</a>
              </span>
            </label>
            <button id="landing_btn" class="ot-btn ot-btn_main ot-btn_gradient-primary" type="submit">Оставить заявку</button>
            <?php echo get_utm(); ?>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

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
          <button class="ot-header__btn-callback ot-btn d-flex align-items-center amo" data-toggle="modal" data-target="#modalLanding">
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
            <a class="ot-btn ot-btn_main ot-btn_gradient-primary js-link text-center amo" data-toggle="modal" data-target="#modalLanding" href="">Записаться к терапевту</a>
            
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
        	
          <a class="ot-btn ot-btn_main ot-btn_gradient-primary js-link amo" href="" data-toggle="modal" data-target="#modalLanding" >Хочу на консультацию</a>
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
        
        <div class="ot-psychologist-selection__categories">
          <div class="d-flex justify-content-center">
            <h3 class="ot-psychologist-selection__title-select">Выберите категорию психолога</h3>
          </div>
          <div class="d-flex align-items-center justify-content-center flex-wrap flex-sm-nowrap">
            <div class="ot-psychologist-selection__btn-wrp d-flex flex-column align-items-center">
              <button class="ot-psychologist-selection__btn-category ot-btn" data-swiper-class="super">Высшая категория</button>
              <span
                class="ot-psychologist-selection__category-price-range d-none d-md-block">Стоимость консультации от 7000 до 15000 руб</span>
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
					                  <a href="" data-toggle="modal" data-target="#modalLanding" class="ot-psychologist-card__photo amo"
					                       style="'.$dop_style.' ; background-image: url('.get_the_author_meta('photo',$user->ID).');">
					                  </a>
					                  <div class="ot-psychologist-card__info d-flex flex-column align-items-center">
					                    <div class="ot-psychologist-card__name">'.$user->display_name.'</div>
					                    <div class="ot-psychologist-card__category">'.$category_name.'</div>
					                    <div class="ot-psychologist-card__session-text">Цена за консультацию:</div>
					                    <div class="ot-psychologist-card__session-price">'.get_the_author_meta('price',$user->ID).' рублей</div>
					                   
					                    <a href="" data-toggle="modal" data-target="#modalLanding" class="ot-psychologist-card__btn ot-btn ot-btn_main ot-btn_gradient-primary amo">Записаться</a>
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
                <small class="ot-about-us__form-personal-data">Нажимая кнопку, вы даете согласие<br> на <a target="_BLANK" href="https://ollyteam.ru/policy/">обработку персональных данных</a></small>
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
          <div class="col-12 col-md-6 col-lg-4">
            <div class="ot-consultation__item ot-consultation__place ot-consultation__place_car d-flex align-items-center">
              <span class="ot-consultation__item-title">Из машины</span>
            </div>
          </div>
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
          <a class="ot-btn ot-btn_main ot-btn_gradient-primary js-link amo" data-toggle="modal" data-target="#modalLanding" href="" >Записаться на терапию</a>
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
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
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

		

		

	
<?get_footer();?>
