<?php

	/*
	Template Name: Корзина
	*/
 	if(isset($_GET['pre'])) {
		
		$sql = $wpdb->prepare( "SELECT * FROM wp_olly_cart WHERE url_cart= %s",$_GET['pre'] );
    	$result = $wpdb->get_row($sql);

		if ($wpdb->num_rows==0 || $result->status_cart!="Свободно") {
				    wp_redirect( home_url( '/404/' ) );
					exit();
		}
		
			
		} else {
			
					wp_redirect( home_url( '/404/' ) );
	    			exit();
		}

	get_header();

	$therapist = get_user_by('id', $result->therapist_cart);
	$name_therapist = $therapist->display_name;
	$date = ruDate($result->date_cart,false);
    $time = ruDate($result->date_cart,true);
    

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
                <a class="ot-header__menu-link js-menu-link" href="#section-psychologists">Психологи</a>
              </li>
              <li class="ot-header__menu-item">
                <a class="ot-header__menu-link js-menu-link" href="#section-faq">Вопрос / Ответ</a>
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
    <section class="ot-section ot-section_text ot-cart">
      <div class="container">
        <div class="d-flex justify-content-center">
          <div class="ot-cart__content">
            <h2 class="ot-cart__title">Ваш заказ:</h2>
            
		<form id="" action="<?= admin_url('admin-post.php'); ?>" method="POST">

          <input type="hidden" name="action" value="setPaymentCart">
          <input type="hidden" name="cart_id" value="<? echo $result->id_cart;?>">
          <input type="hidden" name="sum_client" value="<? echo $result->sum_cart;?>">
          <input type="hidden" name="type_cart" value="<? echo $result->type_cart;?>">
          
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
              <td id="therapist"><? echo $name_therapist;?></td>
              <td id="date"><? echo $date." ".$time?></td>
              <td id="price"><? echo $result->sum_cart?></td>
            </tr>
            </tbody>
          </table>
          
          <?if  ($result->type_cart=="Психосоматика2"): ?>
          <label class="ot-check mb-3" id="violence_block" for="violence">
            <input class="ot-check__input" id="violence" type="checkbox" required>
            <span class="ot-check__mark"></span>
            <span class="ot-check__text d-flex flex-column">
                <span>В случае выхода на насилие во время терапии, консультация по текущему запросу может быть остановлена терапевтом до очной проработки насилия, либо продолжена, но с другим запросом</span>
              </span>
          </label>
          <?php endif ?>
          
          <div class="form-group">
            <label class="mb-2" for="cart-request-text">Ваш запрос <span class="ot-cart__required-text">(Обязательное поле)</span></label>
            <textarea class="form-control" name="query_client" id="cart-request-text" rows="3" placeholder="Введите ваш запрос" required></textarea>
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
            <label class="d-flex flex-column mb-2" for="cart-birthday_client">
              <span class="mb-1">Дата вашего рождения <span class="ot-cart__required-text">(Обязательное поле)</span></span>
              <span class="ot-cart__explain">Дата должна быть в формате: день.месяц.год</span>
            </label>
            <input type="text" class="ot-input form-control" name="birthday_client" id="cart-birthday_client" placeholder="Например: 10.12.1990" required>
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
            <input type="text" class="ot-input form-control" name="phone_client" id="cart-phone" placeholder="Введите ваш телефон" required>
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
          
        <div class="d-flex justify-content-center mt-4">
          <button type="submit" class="ot-btn ot-btn_main ot-btn_gradient-primary">Записаться</button>
        </div>
            
    </div>

    
	</form>
            

            
          </div>
        </div>
      </div>
    </section>
  </main>
 
<? 
	get_footer();
?>