<?php

	/*
	Template Name: Страница для вывода информации о терапевте
	*/
  
	get_header();
	
	$cur_user_id = get_current_user_id();
?>

<body>
<div class="font-preload" style="position: absolute; top: -9999px; width: 0; height: 0; opacity: 0;">
  <span style="font-weight: 400; font-family: Appetite Pro, sans-serif;"></span>
  <span style="font-weight: 100; font-family: Museo Sans, sans-serif;"></span>
  <span style="font-weight: 300; font-family: Museo Sans, sans-serif;"></span>
  <span style="font-weight: 500; font-family: Museo Sans, sans-serif;"></span>
  <span style="font-weight: 700; font-family: Museo Sans, sans-serif;"></span>
</div>
<style>
	.ot-example-session {
		width: 58px;
		height: 30px;
		border-radius: 5px;
	}
	
	.ot-time-long-color,
	.ot-time-long-color:hover {
		color: #fff;
		font-weight: 500;
		background: linear-gradient(to bottom, #81d5ea, #61b9cf) #5ab3c9;
	}
	.rounded-lg {
    border-radius: 1rem !important
}

.text-small {
    font-size: 0.9rem !important
}

.pricing {
    color: #fff
}

.custom-separator {
    width: 5rem;
    height: 6px;
    border-radius: 1rem;
}

.text-uppercase {
    letter-spacing: 0.2em
}

.btn-warning {
    color: #fff
}

.btn-warning:hover {
    color: #fff
}

.ot-packages .badge {
    padding: 5px;
    font-size: 16px !important;
    font-weight: 500;
}

.ot-header__menu-item {
	font-size:14px; max-width:none;
}
}
 

</style>
<div class="ot-psychologist-page ot-main-wrapper d-flex flex-column justify-content-between">
  <header class="ot-header js-header">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-6 col-md-4 col-lg-3 d-flex justify-content-center justify-content-lg-start order-1 order-lg-0">
          <a class="ot-header__logo d-flex align-items-center justify-content-center" href="/">
            <span class="ot-header__logo-text">Команда психологов<br> Ольги Роменской</span>
          </a>
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
                <a class="ot-header__menu-link js-menu-link" href="/#section-psychologists">Психологи</a>
              </li>
              <li class="ot-header__menu-item">
                <a class="ot-header__menu-link js-menu-link" href="#section-reviews">Отзывы</a>
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
  <?
	  switch (get_field( "category" )) {
	    case '1 категория':
	        $category = "Психолог 1 категории";
	        break;
	    case '2 категория':
	        $category = "Психолог 2 категории";
	        break;
	    case '3 категория':
	        $category = "Психолог 3 категории";
	        break;
	    case 'Высшая категория':
	        $category = "Психолог высшей категории";
	        break;	        
	}
	
  ?>
  <main class="ot-main-wrapper__main d-flex flex-column">
    <section class="ot-section ot-psychologist-info">
      <div class="container">
        <div class="ot-psychologist-info__content d-flex">
          <div class="ot-psychologist-info__photo-wrp d-none d-md-block">
            <div class="ot-psychologist-info__photo" style="background-image: url(<?=get_field( "photo" )?>);"></div>
          </div>
          <div class="ot-psychologist-info__main d-flex flex-column align-items-center align-items-md-start">
            <span class="ot-psychologist-info__name d-block text-center"><?=get_field( "fi" );?></span>
            <span class="ot-psychologist-info__category d-block"><?=$category?></span>
            <div class="ot-psychologist-info__photo-wrp d-md-none">
              <div class="ot-psychologist-info__photo" style="background-image: url(<?=get_field( "photo" )?>);"></div>
            </div>
            <span class="ot-psychologist-info__session-text d-inline-block">
              Цена за консультацию: <span class="ot-psychologist-info__session-price"><?=get_field( "price" );?> рублей</span>
            </span>
            <span class="ot-psychologist-info__title-about d-block">Обо мне</span>
            <p class="ot-psychologist-info__description js-desc">
              <?=get_field( "biography" );?>
            </p>
            <button class="ot-psychologist-info__show-desc ot-btn js-btn-show-desc">Читать полностью</button>
          </div>
        </div>
      </div>
    </section>
    <section id="shedule" class="ot-section ot-section_light-bg ot-schedule">
    	<input type="hidden" name="id_therapist" value="<?=get_field( "id_therapist" );?>">
    	<input type="hidden" name="type" value="<?
	    		if (isset($_GET['code'])) 
				{
					
					$code = $_GET['code'];
					$psy = $wpdb->get_row( "SELECT * FROM wp_olly_access WHERE code='$code' " );
					
					if ($psy===NULL || $psy->status==1) { $type = "Основа";} else {$type= "Психосоматика";}

				} else {$type= "Основа";}
				echo $type;

			?>">
		

		
		
		
      <div class="container">

        
        <h2 class="ot-section__title ot-schedule__title">Запись на онлайн-консультацию</h2>
        

        <span class="ot-schedule__select-text d-block">Выберите категорию консультаций:</span>
        <div class="row">
          <div class="col-12 col-md-6 col-xl-4 ot-schedule__select-wrp d-flex position-relative">
            <select class="ot-schedule__select" id="select-type">
              <option value="Основа">Психология</option>
              <option value="Психосоматика">Психосоматика</option>
              <option value="Насилие/ПА">Насилие/ПА</option>
            </select>
          </div>
        </div>
        <span class="ot-schedule__available-sessions d-block">Список доступных сессий</span>
        <span class="ot-schedule__time d-block">
          Время указано Московское
        </span>
        <template v-if="selectedCategory === 'Психосоматика'">
    	<!--	<div class="d-flex align-items-center mb-2">
	        	<div class="ot-example-session ot-btn_gradient-secondary flex-shrink-0"></div>
	        	<span class="mx-2">—</span>
	        	<span class="text-left">Консультация по психосоматике, продолжительность: 1-1,5 часа</span>
	        </div>-->
	        <div class="d-flex align-items-center mb-4">
	      
	        	<!--<span class="mx-2">—</span>-->
	        	<span class="text-left" style="font-size: 14px;">
Первичная терапия по психосоматике включает в себя две терапии. На первой идёт сбор цепочки заболевания и поиск шаблона клиента. На второй — проработка точечного запроса из всей цепочки.<br />
<br />
Длительность первичной консультации по психосоматике от 1,5 до 3 часов.<br />
Это может зависеть от сложности диагноза и информации по заболеванию, предоставленной клиентом.
			        	<span style="font-size:12px"></span>
			        </span>	
	        </div>
        </template>

        
        <div class="row">
        	<template v-if="isLoading">
        		<div class="col-12">
        			<div class="ot-schedule__block d-flex flex-column align-items-center justify-content-center">
        				<svg  xmlns="http://www.w3.org/2000/svg" style="margin: auto; display: block;" width="60px" height="60px" viewBox="0 0 100 100">
							<circle cx="50" cy="50" fill="none" stroke="#5ab3c9" stroke-width="10" r="35" stroke-dasharray="164.93361431346415 56.97787143782138">
								<animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
							</circle>
						</svg>
						<span class="mt-2">Загружаем данные...</span>
        			</div>
        		</div>
        	</template>
        	<template v-else-if="!sessions">
        		<div class="col-12">
        			<div class="ot-schedule__block d-flex flex-column align-items-center justify-content-center">
        				<p>К сожалению, на данный момент свободных окошек нет.</p>
        			</div>
					
        		</div>
        	</template>
        	<template v-else>
        		<div class="col-12 col-md-6 col-xl-4" v-for="(session, index) in sessions">
		            <div class="ot-schedule__block">
		              <span class="ot-schedule__date">{{ index }}</span>
		              <div class="ot-schedule__row-time d-flex flex-wrap justify-content-center justify-content-md-start">
		                <a v-on:click="callCartModal(item.date, item.booking_id, item.type)" href="#" data-toggle="modal" v-bind:data-target="selectedCategory === 'Насилие/ПА' ? '#modalViolence' : '#cart'" class="ot-schedule__time-item ot-btn" :class="item.type === 'Психосоматика2' ? 'ot-time-long-color' : 'ot-btn_gradient-secondary'" v-for="(item, index) in session">{{ index }}</a>
		              </div>
		            </div>
        		</div>
        	</template>
			<div class="col-12">
				<div class="ot-schedule__block d-flex flex-column align-items-center justify-content-center" style="text-align: center;">
					<p style="margin-bottom: 25px;">Если на сайте нет подходящего времени для записи или у психолога нет окошек, вы можете оставить заявку в Службу заботы и наши менеджеры помогут решить вопрос.</p>
					
					<a href="#" class="order_individ ot-schedule__time-item ot-btn ot-btn_gradient-secondary" style="min-width: 261px;">Оставить заявку</a>
				</div>
			</div>
        </div>
      </div>
    </section>

	<?
		
	switch (get_field("price")) {
		case 1:
			$price_5 = 15000;
			$price_10 = 30000;
			$price_20 = 60000;
			//$sale_desc = "Скидка 1500 рублей!";
			$sale_desc = "Приоритетная запись к психологу!";
			break;			
		case 3000:
			$price_5 = 15000;
			$price_10 = 30000;
			$price_20 = 60000;
			//$sale_desc = "Скидка 1500 рублей!";
			$sale_desc = "Приоритетная запись к психологу!";
			break;
		case 5000:
			$price_5 = 25000;
			$price_10 = 50000;
			$price_20 = 100000;
			//$sale_desc = "Скидка 2500 рублей!";
			$sale_desc = "Приоритетная запись к психологу!";
			break;
		case 8000:
			$price_5 = 40000;
			$price_10 = 80000;
			$price_20 = 160000;
			//$sale_desc = "Скидка 4000 рублей!";
			$sale_desc = "Приоритетная запись к психологу!";
			break;
		case 10000:
			$price_5 = 50000;
			$price_10 = 100000;
			$price_20 = 200000;
			//$sale_desc = "Скидка 5000 рублей!";
			$sale_desc = "Приоритетная запись к психологу!";
			break;
		case 15000:
			$price_5 = 75000;
			$price_10 = 150000;
			$price_20 = 300000;
			//$sale_desc = "Скидка 7500 рублей!";
			$sale_desc = "Приоритетная запись к психологу!";
			break;
		case 20000:
			$price_5 = 100000;
			$price_10 = 200000;
			$price_20 = 400000;
			//$sale_desc = "Скидка 7500 рублей!";
			$sale_desc = "Приоритетная запись к психологу!";
			break;					
	}		
	
	if (!empty($price_5) && !empty($price_10) && !empty($price_20) && !empty($sale_desc) && get_field('id_therapist')!=44):
	?>	
	<div class="container">
	
	<h3 class="ot-section__title ot-schedule__title">Пакеты консультаций со скидкой!</h3>
	
	    <div class="ot-packages row">
	    		<div class="d-flex col-12 col-md-6 col-xl-4">
        			<div class="ot-schedule__block w-100 d-flex flex-column">
        				<span class="ot-schedule__date"><strong>5 консультаций</strong></span>
        				<ul class="pt-3 pl-3 text-left">
        				    <li>Цена за пакет: <?=$price_5;?> руб.</li>
        				</ul>
        				<span class="badge badge-light w-100 py-2 mt-1 mb-1"><?=$sale_desc;?></span>
						<span class="badge badge-light w-100 py-2 mb-1" style="white-space: normal;">Использовать можно в течение 6 месяцев с момента покупки</span>
        					<div class="ot-schedule__row-time d-flex flex-wrap justify-content-center justify-content-md-start pt-3 mt-auto">
        						<a href="#" <?="data-packages='5 консультаций' data-price='$price_5'";?> class="packages_cart ot-schedule__time-item ot-btn ot-btn_gradient-secondary m-0 py-2 w-100">Оплатить</a>
        					</div>
        			</div>
        		</div>
				
	    		<div class="d-flex col-12 col-md-6 col-xl-4">
        			<div class="ot-schedule__block w-100 d-flex flex-column">
        				<span class="ot-schedule__date"><strong>10 консультаций</strong></span>
        				<ul class="pt-3 pl-3 text-left">
        				    <li>Цена за пакет: <?=$price_10;?> руб.</li>
        				</ul>
						<span class="badge badge-light w-100 py-2 mt-1 mb-1">Приоритетная запись к психологу!</span>
        				<span class="badge badge-light w-100 py-2 mb-1">Купи 10 консультаций + 1 в подарок!</span>
						<span class="badge badge-light w-100 py-2 mb-1" style="white-space: normal;">Использовать можно в течение 6 месяцев с момента покупки</span>						
        					<div class="ot-schedule__row-time d-flex flex-wrap justify-content-center justify-content-md-start pt-3 mt-auto">
        						<a href="#" <?="data-packages='10 консультаций' data-price='$price_10'";?> class="packages_cart ot-schedule__time-item ot-btn ot-btn_gradient-secondary m-0 py-2 w-100">Оплатить</a>
        					</div>
        			</div> 
        		</div>
	    		<div class="d-flex col-12 col-md-6 col-xl-4">
        			<div class="ot-schedule__block w-100 d-flex flex-column">
        				<span class="ot-schedule__date"><strong>20 консультаций</strong></span>
        				<ul class="pt-3 pl-3 text-left">
        				    <li>Цена за пакет: <?=$price_20;?> руб.</li>
        				</ul>
						<span class="badge badge-light w-100 py-2 mt-1 mb-1">Приоритетная запись к психологу!</span>						
        				<span class="badge badge-light w-100 py-2 mb-1">Купи 20 консультаций + 3 в подарок!</span>
						<span class="badge badge-light w-100 py-2 mb-1" style="white-space: normal;">Использовать можно в течение 12 месяцев с момента покупки</span>
						
        					<div class="ot-schedule__row-time d-flex flex-wrap justify-content-center justify-content-md-start pt-3 mt-auto">
        						<a href="#" <?="data-packages='20 консультаций' data-price='$price_20'";?> class="packages_cart ot-schedule__time-item ot-btn ot-btn_gradient-secondary m-0 py-2 w-100">Оплатить</a>
        					</div>
        			</div>
        		</div>				
	    </div>
				

	</div>
	<?php endif; ?>
    <section class="ot-section ot-reviews" id="section-reviews">
      <div class="container">
        <div class="ot-section__title-wrp">
          <h2 class="ot-section__title"><span class="ot-section__title-accent">Отзывы</span> наших клиентов</h2>
        </div>
        <div class="d-flex justify-content-center">
          <div class="ot-reviews__phone">
            <div class="ot-reviews__phone-content swiper-container js-phone-slider">
              <div class="swiper-wrapper">

              	<?
				function curl_get_contents($url)
{
				  $ch = curl_init($url);
				  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
				  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
				  $data = curl_exec($ch);
				  curl_close($ch);
				  return $data;
				}
                	if (	get_field( "review" )	)
                	{
                		//echo trim(get_field( "review" ));
                		
                		$my_url = trim(get_field( "review" ));
	                	$j = curl_get_contents( $my_url ); 
						$data = json_decode($j,true);
						$i=0;
						foreach ($data as $re)
						{
	    					echo '<div class="swiper-slide ot-reviews__phone-text" data-simplebar>
	                			<p>'.$re['review'].'</p>
	                		</div>';
	                		$i++;
						}
                	} else
                	{
                		echo '
    						<div class="swiper-slide ot-reviews__phone-text" data-simplebar>
                				<p>Информация будет доступна в ближайшее время.</p>
                			</div>';
                	}
                	
              	?>
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
      </div>
    </section>
  </main>
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
          <input type="hidden" name="booking_id" value="">
          <input type="hidden" name="therapist_price" value="<? echo get_field("price");?>">
		  <? if (!empty(get_field( "price_violence" ))) { echo '<input type="hidden" name="price_violence" value="'.get_field( "price_violence" ).'">';}?>
		  <? if (!empty(get_field( "price_panic" ))) { echo '<input type="hidden" name="price_panic" value="'.get_field( "price_panic" ).'">';}?>
          <input type="hidden" name="sum_client" value="<? echo get_field( "price" );?>">
          
          

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
              <td><?=get_field( "fi" );?></td>
              <td id="date"></td>
              <td id="price"><?echo get_field( "price" );?></td>
            </tr>
            </tbody>
          </table>
          
          <label class="ot-check mb-3 d-none" id="cart-psy-block" for="cart-psy">
            <input class="ot-check__input" id="cart-psy" type="checkbox" required>
            <span class="ot-check__mark"></span>
            <span class="ot-check__text d-flex flex-column">
                <span>Ознакомлен<br>
                Обратите, пожалуйста, внимание, что Вы бронируете окно на работу с запросом по психологии (общие запросы), в рамках этой терапий работа с запросами по психосоматике не происходит. Если Вы хотите проработать запрос по психосоматике (связанный со здоровьем), выберете окно из раздела «Психосоматика».</span>
              </span>
          </label>
          <div class="alert alert-primary" role="alert" id="psy2">Первичная (первая) консультация по психосоматике, которая включает в себя разбор цепочки + начало работы над Вашим запросом (диагнозом). Продолжительность: 2,5-3 часа</div>
          
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
            <input type="text" class="ot-input form-control is-invalid" name="phone_client" id="cart-phone" placeholder="Введите ваш телефон" value="" required>
          </div>
          
          <div class="form-group mb-4">
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

<!---Индивидуальная заявка при отсутствии окон-->
<div class="ot-cart-modal modal fade hide" id="individ_order" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-modal="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header d-flex align-items-center">
        <h5 class="modal-title" id="inIndividForm_title">Оставить заявку к психологу <?=get_field( "fi" );?></h5>
        <button class="ot-btn close" type="button" data-dismiss="modal">
          <svg class="ot-modal__icon-close">
            <use xlink:href="#icon-cross"></use>
          </svg>
        </button>
      </div>
      <div class="modal-body">
      	
        <form id="inIndividForm" method="POST">

          <input type="hidden" name="action" value="inIndivid">
          <input type="hidden" name="therapist" value="<?=get_field( "fi" );?>">
		  <input type="hidden" name="partner" value="<? if (isset($_COOKIE['partner']))	echo $_COOKIE['partner']; ?>">
		  <label for="direction">Выберите категорию консультаций:</label>
		  <div class="ot-schedule__select-wrp d-flex position-relative">
		    <select class="mb-2 ot-schedule__select" id="select-type" name="direction">
		    	<option value="Психология">Психология</option>
				<option value="Психосоматика">Психосоматика</option>
				<option value="Насилие/Панические атаки">Насилие/Панические атаки</option>
		    </select>
		  </div>
          <div class="form-group mb-4">
            <label class="mb-2" for="cart-name">Ваше имя <span class="ot-cart__required-text">(Обязательное поле)</span></label>
            <input type="text" class="ot-input form-control" name="name_client" id="cart-name" placeholder="Введите ваше имя" required>
          </div>
          <div class="form-group mb-4">
            <label class="mb-2" for="cart-surname">Ваша фамилия <span class="ot-cart__required-text">(Обязательное поле)</span></label>
            <input type="text" class="ot-input form-control" name="surname_client" id="cart-surname" placeholder="Введите вашу фамилию" required>
          </div>
		  
          <div class="form-group mb-4">
            <label class="mb-2" for="cart-email">Ваша почта <span class="ot-cart__required-text">(Обязательное поле)</span></label>
            <input type="email" class="ot-input form-control" name="email_client" id="cart-email" placeholder="Введите вашу почту" required>
          </div>
          
          <div class="form-group mb-4">
            <label class="d-flex flex-column mb-2" for="cart-phone">
              <span class="mb-1">Ваш телефон <span class="ot-cart__required-text">(Обязательное поле)</span></span>
              <span class="ot-cart__explain">Введите номер телефона, по которому планируете связываться с психологом</span>
            </label>
            <input type="text" class="ot-input form-control is-invalid" name="phone_client" id="cart-phone" placeholder="Введите ваш телефон" required>
          </div>
         
          <label class="ot-check mb-3" for="politic_pack">
            <input class="ot-check__input" id="politic_pack" type="checkbox" required>
            <span class="ot-check__mark"></span>
            <span class="ot-check__text d-flex flex-column">
                <span>Я принимаю <a class="ot-btn-link" href="/oferta">условия оферты</a> и согласен с <a class="ot-btn-link" href="/policy">политикой обработки персональных данных</a></span>
              </span>
          </label>

          <label class="ot-check mb-3" for="18_pack">
            <input class="ot-check__input" id="18_pack" type="checkbox" required>
            <span class="ot-check__mark"></span>
            <span class="ot-check__text d-flex flex-column">
                <span>Я подтверждаю, что мне есть 18 лет</span>
              </span>
          </label>

        </div>
      <div class="modal-footer d-flex justify-content-between">
        <button type="button" class="ot-btn" data-dismiss="modal">Закрыть</button>
        <button id="inIndivid_btn" class="ot-btn ot-btn-done" type="submit">Оставить заявку</button>
      </div>
	</form>
    </div>
  </div>
</div> 
<!---Корзина для пакетов консультаций-->
<div class="ot-cart-modal modal fade hide" id="cart_packages" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-modal="true">
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
      	
        <form id="" action='/wp-admin/admin-post.php' method="POST">

          <input type="hidden" name="action" value="setPaymentPackages">
		  <input type="hidden" name="partner" value="<?if (isset($_COOKIE['partner'])){echo $_COOKIE['partner']; }?>">  	  		 
          <input type="hidden" name="packages_summa" value="">
		  <input type="hidden" name="packages_name" value="">
          <input type="hidden" name="therapist" value="<?=get_field( "id_therapist" );?>">
          

          <table class="table">
            <thead class="thead-dark">
            <tr>
              <th scope="col">Психолог</th>
              <th scope="col">Пакет</th>
              <th scope="col">Сумма</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td><?=get_field( "fi" );?></td>
              <td id="info_packages"></td>
              <td id="price_packages"></td>
            </tr>
            </tbody>
          </table>
          
          <div class="form-group mb-4">
            <label class="mb-2" for="cart-name">Ваше имя <span class="ot-cart__required-text">(Обязательное поле)</span></label>
            <input type="text" class="ot-input form-control" name="name_client" id="cart-name" placeholder="Введите ваше имя" required>
          </div>
		  
          <div class="form-group mb-4">
            <label class="mb-2" for="cart-surname">Ваша фамилия <span class="ot-cart__required-text">(Обязательное поле)</span></label>
            <input type="text" class="ot-input form-control" name="surname_client" id="cart-surname" placeholder="Введите вашу фамилию" required>
          </div>
		  
          <div class="form-group mb-4">
            <label class="mb-2" for="cart-email">Ваша почта <span class="ot-cart__required-text">(Обязательное поле)</span></label>
            <input type="email" class="ot-input form-control" name="email_client" id="cart-email" placeholder="Введите вашу почту" required>
          </div>
          
          <div class="form-group mb-4">
            <label class="d-flex flex-column mb-2" for="cart-phone">
              <span class="mb-1">Ваш телефон <span class="ot-cart__required-text">(Обязательное поле)</span></span>
              <span class="ot-cart__explain">Введите номер телефона, по которому планируете связываться с психологом</span>
            </label>
            <input type="text" class="ot-input form-control is-invalid" name="phone_client" id="cart-phone" placeholder="Введите ваш телефон" required>
          </div>
         
          <label class="ot-check mb-3" for="terms_pack">
            <input class="ot-check__input" id="terms_pack" type="checkbox" required>
            <span class="ot-check__mark"></span>
            <span class="ot-check__text d-flex flex-column">
                <span>Ознакомлен/ознакомлена и согласен/согласна с тем, что в случае отмены консультации более, чем за 24 часа, возврат денежных средств осуществляется с удержанием орг.взноса в размере 3% от суммы. При отмене консультации менее, чем за 24 часа - оплата не возвращается.</span>
              </span>
          </label>

          <label class="ot-check mb-3" for="politic_pack1">
            <input class="ot-check__input" id="politic_pack1" type="checkbox" required>
            <span class="ot-check__mark"></span>
            <span class="ot-check__text d-flex flex-column">
                <span>Я принимаю <a class="ot-btn-link" href="/oferta">условия оферты</a> и согласен с <a class="ot-btn-link" href="/policy">политикой обработки персональных данных</a></span>
              </span>
          </label>

          <label class="ot-check mb-3" for="18_pack1">
            <input class="ot-check__input" id="18_pack1" type="checkbox" required>
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

<script>
<?="var ajaxurl='".admin_url('admin-ajax.php')."'";?>
</script>  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://ollyteam.ru/wp-content/themes/ollyteam/scripts/custom-phone-validation.js"></script>
<script>
	var vueApp = new Vue({
		el: '#shedule',
		data() {
			return {
				isLoading: false,
				sessions: null,
				selectedCategory: $('#select-type').val(),
				autoUpdateInverval: 5000
			}
		},
		methods: {
			getSessions: function() {
				$.ajax({ 
					url: ajaxurl, 
					type: "POST",
					crossDomain: true,
					dataType: 'json',
					data: {action : "getTherapyFront", id_therapist:$('[name="id_therapist"]').val() , type: $('#select-type').val()},
					success: (data) => {
						if (!data) {
							this.disableAutoUpdate();	
						}
						
						this.isLoading = false;
						this.sessions = data;
					}
				});
			},
			
			callCartModal: function(date, id, type) {
				$('#date').text(date);
				$('[name="booking_id"]').val(id);
				
				if ($('#select-type').val()=="Основа"){
					$('#person').addClass('d-none');
					$('#cart-psy-block').removeClass('d-none');
					$('#cart-psy').attr('required', 'required');
					$('#psy2').addClass('d-none');
					
					$('#violence_block').addClass('d-none');
					$('#violence').removeAttr('required');
				}  

				if (	$('#select-type').val()=="Психосоматика"	) {

					$('#person').addClass('d-none');
					$('#cart-psy-block').addClass('d-none');
					$('#cart-psy').removeAttr('required');
					
					$('#violence_block').addClass('d-none');
					$('#violence').removeAttr('required');
					
				}
				
				if (type==="Психосоматика2")
				{
					$('#psy2').removeClass('d-none');
					$('[name="sum_client"]').val($('[name="therapist_price"]').val()*2);
					$('#price').text($('[name="therapist_price"]').val()*2);
					
					$('#violence_block').removeClass('d-none');
					$('#violence').attr('required', '');
				}
				
			},
			
			enableAutoUpdate() {
				this.getSessions();
				
				this.updateInterval = setInterval(() => {
					this.getSessions();
				}, this.autoUpdateInverval);
			},
			
			disableAutoUpdate() {
				clearInterval(this.updateInterval);
			},
			
			resetAutoUpdate() {
				this.disableAutoUpdate();
				this.enableAutoUpdate();
			}
		},
		mounted() {
			this.isLoading = true;
			this.enableAutoUpdate();
		}
	});
	
	$(document).ready(function() {
		//Индивидуальная заявка
		$(document).on('click', '.order_individ', function() {
			
			$('#individ_order').modal('show');
			
			return false;

		})
		
		$('#select-type').on('change', function() {
			vueApp.isLoading = true;
			vueApp.selectedCategory = this.value;
			vueApp.resetAutoUpdate();
		});
		
		$('#cart').on('hidden.bs.modal', function (e) {
				$('[name="sum_client"]').val($('[name="therapist_price"]').val());
				$('#price').text($('[name="therapist_price"]').val());
				$('#cart-psy').prop('checked', false);
				$('#psy2').addClass('d-none');
		})
		
		//Корзина пакетов
		$('.packages_cart').on('click', function (e) {

			$('#price_packages').text($(this).data('price'));
			$('#info_packages').text($(this).data('packages'));
			$('[name="packages_summa"]').val($(this).data('price'));
			$('[name="packages_name"]').val($(this).data('packages'));
			
			$('#cart_packages').modal('show');
			
			return false;

		})
		
		//Активация промокода
		$('#promo_btn').on('click',function(event)
		{
			let promo = $('#promo').val().toUpperCase();
			console.log(promo);
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
			      	}
			      	else 
			      	{
			      		alert ('Указанный промокод не найден или не действителен');
			      	}
		
			       } 
			    });
			    
			    event.preventDefault();
			    
		});
		
	});
</script>

<? get_footer();?>




	


