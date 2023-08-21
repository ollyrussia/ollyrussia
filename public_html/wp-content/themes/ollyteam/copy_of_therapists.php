<?php
	/*
	Template Name: Страница для вывода информации о терапевте
	*/
  
	get_header();
?>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<body>
<div class="font-preload" style="position: absolute; top: -9999px; width: 0; height: 0; opacity: 0;">
  <span style="font-weight: 400; font-family: Appetite Pro, sans-serif;"></span>
  <span style="font-weight: 100; font-family: Museo Sans, sans-serif;"></span>
  <span style="font-weight: 300; font-family: Museo Sans, sans-serif;"></span>
  <span style="font-weight: 500; font-family: Museo Sans, sans-serif;"></span>
  <span style="font-weight: 700; font-family: Museo Sans, sans-serif;"></span>
</div>
<div class="ot-psychologist-page ot-main-wrapper d-flex flex-column justify-content-between">
  <header class="ot-header js-header">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-6 col-md-4 col-lg-3 d-flex justify-content-center justify-content-lg-start order-1 order-lg-0">
          <a class="ot-header__logo d-flex align-items-center justify-content-center" href="#">
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
    <section class="ot-section ot-psychologist-info">
      <div class="container">
        <div class="ot-psychologist-info__content d-flex">
          <div class="ot-psychologist-info__photo-wrp d-none d-md-block">
            <div class="ot-psychologist-info__photo" style="background-image: url(<?=get_field( "photo" )?>);"></div>
          </div>
          <div class="ot-psychologist-info__main d-flex flex-column align-items-center align-items-md-start">
            <span class="ot-psychologist-info__name d-block text-center"><?=get_field( "fi" );?></span>
            <span class="ot-psychologist-info__category d-block"><?=get_field( "category" );?></span>
            <div class="ot-psychologist-info__photo-wrp d-md-none">
              <div class="ot-psychologist-info__photo" style="background-image: url(<?=get_field( "photo" )?>);"></div>
            </div>
            <span class="ot-psychologist-info__session-text d-inline-block">
              Цена за сессию: <span class="ot-psychologist-info__session-price"><?=get_field( "price" );?> рублей</span>
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
    <section id="shedule" class="ot-section ot-section_light-bg ot-schedule" data-id_therapist="<?=get_field( "id_therapist" );?>">
      <div class="container">
        <h2 class="ot-section__title ot-schedule__title">Расписание</h2>
        <span class="ot-schedule__available-sessions d-block">Список доступных сессий:</span>
        <span class="ot-schedule__time d-block">Время указано Московское</span>
        
        <div class="row">
        	
          <div class="col-12 col-md-6 col-xl-4" v-for="(session, index) in sessions">
          	
	            <template v-if="!index">
					<p>На данный момент свободных терапий нет. Попробуйте зайти попозже.</p>
				</template>
				
				<template v-else>
		            <div class="ot-schedule__block">
		              <span class="ot-schedule__date">{{ index }}</span>
		              <div class="ot-schedule__row-time d-flex flex-wrap justify-content-center justify-content-md-start" >
		                <a v-bind:data-date="item['date']"
		                   v-bind:data-booking-id="item['booking_id']" 
		                   href="#" data-toggle="modal" data-target="#cart" class="ot-schedule__time-item ot-btn ot-btn_gradient-secondary" v-for="(item, index) in session">{{ index }}</a>
		              </div>
		            </div>
	            </template>
          </div>
          
        </div>
      </div>
    </section>
    <section class="ot-section ot-reviews" id="section-reviews">
      <div class="container">
        <div class="ot-section__title-wrp">
          <h2 class="ot-section__title"><span class="ot-section__title-accent">Отзывы</span> наших клиентов</h2>
        </div>
        <div class="d-flex justify-content-center">
          <div class="ot-reviews__phone">
            <div class="ot-reviews__phone-content swiper-container js-phone-slider">
              <div class="swiper-wrapper">
                <div class="swiper-slide ot-reviews__phone-text" data-simplebar>
                  <p>Lorem ipsum dolor sit amet</p>
                </div>
                <div class="swiper-slide ot-reviews__phone-text" data-simplebar>
                  <p>Lorem ipsum dolor sit amet</p>
                </div>
                <div class="swiper-slide ot-reviews__phone-text" data-simplebar>
                  <p>Lorem ipsum dolor sit amet</p>
                </div>
                <div class="swiper-slide ot-reviews__phone-text" data-simplebar>
                  <p>Lorem ipsum dolor sit amet</p>
                </div>
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
 <div class="modal fade" id="cart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Оформить заказ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form id="cart" action="<?= admin_url('admin-post.php'); ?>" method="POST">
      		
      		<input type="hidden" name="action" value="setPayment">
      		
      		<input type="hidden" name="booking_id" value="">
      		<input type="hidden" name="sum_client" value="<?=get_field( "price" );?>">
      		
      		
      		
      		
      		
			<table class="table">
			  <thead class="thead-dark">
			    <tr>
			      <th scope="col" >Психолог</th>
			      <th scope="col" >Дата</th>
			      <th scope="col" >Сумма</th>
			    </tr>
			  </thead>
			  <tbody>
			    <tr>
			      <td><?=get_field( "fi" );?></td>
			      <td id="date"></td>
			      <td id="price"><?=get_field( "price" );?></td>
			    </tr>
			  </tbody>
			</table>
			
		  <div class="form-group">
		  	<label for="request" class="col-form-label">Промокод (если есть)</label>
		  	<div class="input-group">
		  	  
			  <input type="text" name="promocode_client" class="form-control" placeholder="Промокод" aria-label="Промокод" aria-describedby="basic-addon2">
			  <div class="input-group-append">
			    <button class="btn btn-outline-secondary" type="button">Активировать</button>
			  </div>
			</div>
          </div>
          
          <div class="form-group">
            <label for="request" class="col-form-label">Ваш запрос</label>
            <textarea class="form-control" id="request" name="query_client" placeholder="Введите ваш запрос" required></textarea>
          </div>
          
          <div class="form-group">
            <label for="name" class="col-form-label">Ваше имя</label>
            <input type="text" class="form-control" id="name" placeholder="Введите ваше имя" name="name_client" required>
          </div>
          
          <div class="form-group">
            <label for="surname" class="col-form-label">Ваша фамилия</label>
            <input type="text" class="form-control" id="surname" placeholder="Введите вашу фамилию" name="surname_client" required>
          </div>
          
          <div class="form-group">
            <label for="birthday" class="col-form-label">Дата вашего рождения</label>
            <input type="text" class="form-control" id="birthday" placeholder="Введите дату рождения" name="birthday_client" required>
          </div>
          
          <div class="form-group">
            <label for="email" class="col-form-label">Ваша почта</label>
            <input type="text" class="form-control" id="email" placeholder="Введите вашу почту" name="email_client" required>
          </div>
          
          <div class="form-group">
            <label for="phone" class="col-form-label">Ваш телефон</label>
            <input type="text" class="form-control" id="phone" placeholder="Введите ваш телефон" name="phone_client" required>
            <small id="phoneHelp" class="form-text text-muted">Номер телефона, по которому планируете связываться с психологом</small>
          </div>
          
          <div class="form-check mb-3">
			  <input class="form-check-input" type="checkbox" value="" name="checkOrder" id="checkOrder">
			  <label class="form-check-label" for="checkOrder">
			   Ознакомлен/ознакомлена и согласен/согласна с тем, что в случае отмены консультации более, чем за 24 часа, возврат денежных средств осуществляется с удержанием орг.взноса в размере 20% от суммы. При отмене консультации менее, чем за 24 часа - оплата не возвращается.
			  </label>
		  </div>
		  
          <div class="form-check mb-3" >
			  <input class="form-check-input" type="checkbox" value="" id="checkRe">
			  <label class="form-check-label" for="checkRe">
			   Ознакомлен/ознакомлена и согласен/согласна с тем, что в случае отмены консультации более, чем за 24 часа, возврат денежных средств осуществляется с удержанием орг.взноса в размере 20% от суммы. При отмене консультации менее, чем за 24 часа - оплата не возвращается.
			  </label>
		  </div>
		  
          <div class="form-check mb-3">
			  <input class="form-check-input" type="checkbox" name="save" value="" id="saveCart">
			  <label class="form-check-label" for="saveCart">
			   Сохранить введенные данные в браузере, чтобы не вводить их в следующий раз.
			  </label>
		  </div>  
		  
        
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
        <button type="submit" class="btn btn-primary">Оплатить</button>
      </div>
      
      </form>
    </div>
  </div>
</div> 
  
  
<script>
<?="var ajaxurl='".admin_url('admin-ajax.php')."'";?>
</script>  
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
	var vueApp = new Vue({
		el: '#shedule',
		data() {
			return {
				sessions: null
			}
		},
		methods: {
			getSessions: function() {
				$.ajax({ 
					url: ajaxurl, 
					type: "POST",
					crossDomain: true,
					dataType: 'json',
					data: {action : "getTherapyFront", id_therapist: 8, type:"Основа",status:"Свободно"},
					success: (data) => {
						this.sessions = data;
					}
				});
			}
		},
		mounted() {
			this.getSessions();
			
			setInterval(() => {
				console.log('updated');
				this.getSessions();
			}, 3000)
		}
	});
	
	$(document).ready(function() {
		$(document).on('click','[data-target="#cart"]', function(){
			$('#date').text($(this).data('date'));
			$('[name="booking_id"]').val($(this).data('booking-id'))
		})
	});
</script>
  <? get_footer();?>




	


