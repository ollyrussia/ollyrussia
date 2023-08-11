  <footer class="ot-footer mt-4">
    <div class="container">
      <div class="row">
        <div class="col-12 col-sm-6 col-md- d-flex flex-column order-1 order-sm-0">
          <div class="ot-footer__contact-item ot-footer__contact-item_phone d-flex align-items-center">
            <div class="ot-footer__contact-icon-wrp d-flex align-items-center justify-content-center">
              <svg class="ot-footer__icon-contact">
                <use xlink:href="#icon-phone"></use>
              </svg>
            </div>
            <a class="ot-footer__contact-link" href="https://api.whatsapp.com/send?phone=79785060117&text=">+7 978 506-01-17</a>
          </div>
          <div class="ot-footer__contact-item ot-footer__contact-item_email d-flex align-items-center">
            <div class="ot-footer__contact-icon-wrp d-flex align-items-center justify-content-center">
              <svg class="ot-footer__icon-contact">
                <use xlink:href="#icon-email"></use>
              </svg>
            </div>
            <a class="ot-footer__contact-text" href="mailto:info@ollyrussia.ru">info@ollyrussia.ru</a>
          </div>
          <span class="ot-footer__company-info">

              <span class="d-block d-sm-inline-block">ИП Роменская Ольга Геннадьевна, </span>
              <span class="d-block d-sm-inline-block">ИНН: 920155476939, </span>
              <span class="d-block">ОГРНИП: 316920400063346</span>
            </span>
        </div>
        <div class="col-12 col-sm-6 d-flex justify-content-center justify-content-sm-end text-right order-0 order-sm-0">
          <ul class="ot-footer__links-list">
            <li class="ot-footer__link-item">
              <a href="/policy" target="_BLANK">Политика в отношении обработки персональных данных</a>
            </li>
            <li class="ot-footer__link-item">
              <a href="/pay_rules" target="_BLANK">Правила оплаты</a>
            </li>
            <li class="ot-footer__link-item">
              <a href="/contacts" target="_BLANK">Контактная информация</a>
            </li>
           
          </ul>
        </div>
      </div>
    </div>
  </footer>
</div>

<div class="ot-modal ot-modal-callback modal fade" tabindex="-1" id="modalCallback">
  <div class="ot-modal__dialog modal-dialog modal-dialog-centered">
    <div class="ot-modal__content modal-content d-flex align-items-center">
      <div class="ot-modal__main-wrp">
        <div class="ot-modal__main d-flex flex-column align-items-center">
          <div class="ot-modal__header d-flex justify-content-between align-items-start">
            <span id="recall_title" class="ot-modal-callback__title d-block text-center">Оставьте, пожалуйста, Ваш контактный номер телефона и мы свяжемся с Вами в ближайшее время<br> ПН-ПТ: с 9.00 до 18.00 Мск</span>
            <button class="ot-modal__btn-close ot-btn close d-flex" type="button" data-dismiss="modal">
              <svg class="ot-modal__icon-close">
                <use xlink:href="#icon-cross"></use>
              </svg>
            </button>
          </div>
          <form id="recall" class="ot-modal-callback__form d-flex flex-column">
          	<input type="hidden" name="action" value="sendForm">
            <div class="ot-input-wrp ot-input-wrp_name">
              <input class="ot-input form-control" name="recall_name" type="text" placeholder="Введите ваше имя" required>
            </div>
            <div class="ot-input-wrp ot-input-wrp_phone">
              <input class="ot-input form-control" name="recall_phone" type="text" placeholder="Введите ваш номер" required>
            </div>
            <label class="ot-check" for="terms">
              <input class="ot-check__input" id="terms" type="checkbox" required>
              <span class="ot-check__mark"></span>
              <span class="ot-check__text">
                Я принимаю <a class="ot-btn-link" href="/oferta" target="_BLANK">условия оферты</a> и согласен с <a class="ot-btn-link" href="/policy" target="_BLANK">политикой обработки персональных данных</a>
              </span>
            </label>
            <button id="recall_btn" class="ot-btn ot-btn_main ot-btn_gradient-primary" type="submit">Перезвоните мне</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>





<div class="ot-modal ot-modal-callback modal fade" tabindex="-1" id="modalViolence" style="background-color: rgba(0, 0, 0, 0.7);">
  <div class="ot-modal__dialog modal-dialog modal-dialog-centered">
    <div class="ot-modal__content modal-content d-flex align-items-center">
      <div class="ot-modal__main-wrp">
        <div class="ot-modal__main d-flex flex-column align-items-center">
          <div class="ot-modal__header d-flex justify-content-between align-items-start" style="margin-bottom: 10px;">
          	<span class="ot-modal-callback__title d-block text-center">Покупка только через службу заботы</span>
            <button class="ot-modal__btn-close ot-btn close d-flex" type="button" data-dismiss="modal">
              <svg class="ot-modal__icon-close">
                <use xlink:href="#icon-cross"></use>
              </svg>
            </button>
          </div>
		  <a class="ot-btn ot-btn_main ot-btn_gradient-primary text-center" style="margin-top: 12px;" href="https://api.whatsapp.com/send?phone=79785060117&text=" target="_blank">Написать в службу заботы</a>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="ot-modal ot-modal-requests modal fade" tabindex="-1" id="modalRequests">
  <div class="ot-modal__dialog modal-dialog modal-dialog-centered">
    <div class="ot-modal__content modal-content d-flex align-items-center">
      <button class="ot-modal__btn-close ot-btn close d-none d-lg-flex" type="button" data-dismiss="modal">
        <svg class="ot-modal__icon-close">
          <use xlink:href="#icon-cross"></use>
        </svg>
      </button>
      <div class="ot-modal__main-wrp">
        <div class="ot-modal__main">
          <div class="ot-modal__header d-flex justify-content-between align-items-start">
            <span class="ot-modal-requests__title d-block">Список запросов, с которыми помогают наши психологи:</span>
            <button class="ot-modal__btn-close ot-btn close d-flex d-lg-none" type="button" data-dismiss="modal">
              <svg class="ot-modal__icon-close">
                <use xlink:href="#icon-cross"></use>
              </svg>
            </button>
          </div>
          <div class="row">
            <div class="col-12 col-sm-6">
              <ul class="ot-modal-requests__list ot-modal-requests__list_first ot-list">
                <li class="ot-list__item">Кредиты</li>
                <li class="ot-list__item">Лишний вес до 10 кг</li>
                <li class="ot-list__item">Проработка денежных установок</li>
                <li class="ot-list__item">Раздражение на детей</li>
                <li class="ot-list__item">Принятие себя и своего тела</li>
                <li class="ot-list__item">Отношения с мужем/женой</li>
                <li class="ot-list__item">Страх смерти</li>
                <li class="ot-list__item">Отношения с мамой/папой</li>
                <li class="ot-list__item">Страх стать мамой/папой</li>
                <li class="ot-list__item">Утрата близкого</li>
                <li class="ot-list__item">Личные границы</li>
                <li class="ot-list__item">Отпустить обиды</li>
              </ul>
            </div>
            <div class="col-12 col-sm-6">
              <ul class="ot-modal-requests__list ot-list">
                <li class="ot-list__item">Есть, только когда голоден (-на)</li>
                <li class="ot-list__item">Страх оценки</li>
                <li class="ot-list__item">Открыто говорить о своих чувствах и состояниях</li>
                <li class="ot-list__item">Принятие мамы/папы</li>
                <li class="ot-list__item">Самообесценивание</li>
                <li class="ot-list__item">Сравнение себя с другими</li>
                <li class="ot-list__item">Муж/жена выпивает</li>
                <li class="ot-list__item">Развивать свое дело</li>
                <li class="ot-list__item">Делать для удовольствия, для себя</li>
                <li class="ot-list__item">Детские травмы</li>
                <li class="ot-list__item">Измена мужа/жены</li>
              </ul>
            </div>
          </div>
          <span class="ot-modal-requests__text-more d-block">И это ещё не все!</span>
        </div>
      </div>
    </div>
  </div>
</div>
<div style="position: absolute; top: -9999px; width: 0; height: 0; opacity: 0;">
  <svg xmlns="http://www.w3.org/2000/svg"><symbol viewBox="0 0 240.823 240.823" fill="currentColor" id="icon-arrow" xmlns="http://www.w3.org/2000/svg"><path d="M57.633 129.007L165.93 237.268c4.752 4.74 12.451 4.74 17.215 0 4.752-4.74 4.752-12.439 0-17.179l-99.707-99.671 99.695-99.671c4.752-4.74 4.752-12.439 0-17.191-4.752-4.74-12.463-4.74-17.215 0L57.621 111.816c-4.679 4.691-4.679 12.511.012 17.191z"/></symbol><symbol viewBox="0 0 512.001 512.001" fill="currentColor" id="icon-cross" xmlns="http://www.w3.org/2000/svg"><path d="M284.286 256.002L506.143 34.144c7.811-7.811 7.811-20.475 0-28.285-7.811-7.81-20.475-7.811-28.285 0L256 227.717 34.143 5.859c-7.811-7.811-20.475-7.811-28.285 0-7.81 7.811-7.811 20.475 0 28.285l221.857 221.857L5.858 477.859c-7.811 7.811-7.811 20.475 0 28.285a19.938 19.938 0 0014.143 5.857 19.94 19.94 0 0014.143-5.857L256 284.287l221.857 221.857c3.905 3.905 9.024 5.857 14.143 5.857s10.237-1.952 14.143-5.857c7.811-7.811 7.811-20.475 0-28.285L284.286 256.002z"/></symbol><symbol viewBox="0 0 512 512" fill="currentColor" id="icon-email" xmlns="http://www.w3.org/2000/svg"><path d="M339.392 258.624L512 367.744V144.896zM0 144.896v222.848l172.608-109.12zM480 80H32C16.032 80 3.36 91.904.96 107.232L256 275.264l255.04-168.032C508.64 91.904 495.968 80 480 80zM310.08 277.952l-45.28 29.824a15.983 15.983 0 01-8.8 2.624c-3.072 0-6.112-.864-8.8-2.624l-45.28-29.856L1.024 404.992C3.488 420.192 16.096 432 32 432h448c15.904 0 28.512-11.808 30.976-27.008L310.08 277.952z"/></symbol><symbol viewBox="0 0 300 300" fill="#fff" id="icon-instagram" xmlns="http://www.w3.org/2000/svg"><path d="M38.52.012h222.978C282.682.012 300 17.336 300 38.52v222.978c0 21.178-17.318 38.49-38.502 38.49H38.52c-21.184 0-38.52-17.313-38.52-38.49V38.52C0 17.336 17.336.012 38.52.012zm180.026 33.317c-7.438 0-13.505 6.091-13.505 13.525v32.314c0 7.437 6.067 13.514 13.505 13.514h33.903c7.426 0 13.506-6.077 13.506-13.514V46.854c0-7.434-6.08-13.525-13.506-13.525h-33.903zm47.538 93.539h-26.396a87.715 87.715 0 013.86 25.759c0 49.882-41.766 90.34-93.266 90.34-51.487 0-93.254-40.458-93.254-90.34 0-8.963 1.37-17.584 3.861-25.759H33.35V253.6c0 6.563 5.359 11.902 11.916 11.902h208.907c6.563 0 11.911-5.339 11.911-11.902V126.868zm-115.801-35.89c-33.26 0-60.24 26.128-60.24 58.388 0 32.227 26.98 58.375 60.24 58.375 33.278 0 60.259-26.148 60.259-58.375 0-32.261-26.981-58.388-60.259-58.388z"/></symbol><symbol viewBox="0 0 480.56 480.56" fill="currentColor" id="icon-phone" xmlns="http://www.w3.org/2000/svg"><path d="M365.354 317.9c-15.7-15.5-35.3-15.5-50.9 0-11.9 11.8-23.8 23.6-35.5 35.6-3.2 3.3-5.9 4-9.8 1.8-7.7-4.2-15.9-7.6-23.3-12.2-34.5-21.7-63.4-49.6-89-81-12.7-15.6-24-32.3-31.9-51.1-1.6-3.8-1.3-6.3 1.8-9.4 11.9-11.5 23.5-23.3 35.2-35.1 16.3-16.4 16.3-35.6-.1-52.1-9.3-9.4-18.6-18.6-27.9-28-9.6-9.6-19.1-19.3-28.8-28.8-15.7-15.3-35.3-15.3-50.9.1-12 11.8-23.5 23.9-35.7 35.5-11.3 10.7-17 23.8-18.2 39.1-1.9 24.9 4.2 48.4 12.8 71.3 17.6 47.4 44.4 89.5 76.9 128.1 43.9 52.2 96.3 93.5 157.6 123.3 27.6 13.4 56.2 23.7 87.3 25.4 21.4 1.2 40-4.2 54.9-20.9 10.2-11.4 21.7-21.8 32.5-32.7 16-16.2 16.1-35.8.2-51.8-19-19.1-38.1-38.1-57.2-57.1zM346.254 238.2l36.9-6.3c-5.8-33.9-21.8-64.6-46.1-89-25.7-25.7-58.2-41.9-94-46.9l-5.2 37.1c27.7 3.9 52.9 16.4 72.8 36.3 18.8 18.8 31.1 42.6 35.6 68.8zM403.954 77.8c-42.6-42.6-96.5-69.5-156-77.8l-5.2 37.1c51.4 7.2 98 30.5 134.8 67.2 34.9 34.9 57.8 79 66.1 127.5l36.9-6.3c-9.7-56.2-36.2-107.2-76.6-147.7z"/></symbol><symbol viewBox="0 0 24 24" id="icon-phone-circle" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="12" fill="#d3d0d0"/><path d="M16.774 13.758c-.506-.5-1.137-.5-1.64 0-.384.38-.767.76-1.144 1.147-.103.107-.19.13-.316.058-.248-.135-.512-.245-.75-.393-1.113-.7-2.044-1.598-2.87-2.61-.408-.503-.773-1.041-1.027-1.647-.052-.123-.042-.203.058-.303.383-.37.757-.75 1.134-1.131.526-.529.526-1.147-.003-1.68-.3-.302-.6-.599-.9-.901-.309-.31-.615-.622-.927-.929-.506-.493-1.138-.493-1.64.004-.387.38-.758.77-1.151 1.144a1.867 1.867 0 00-.587 1.26c-.061.802.136 1.56.413 2.298.567 1.527 1.43 2.884 2.478 4.128a15.336 15.336 0 005.08 3.973c.889.432 1.81.764 2.813.819.69.038 1.289-.136 1.769-.674.329-.367.7-.702 1.047-1.054.516-.522.52-1.153.007-1.669-.613-.615-1.228-1.228-1.844-1.84z"/></symbol><symbol viewBox="0 0 300 300" fill="currentColor" id="icon-telegram" xmlns="http://www.w3.org/2000/svg"><path d="M5.299 144.645l69.126 25.8 26.756 86.047c1.712 5.511 8.451 7.548 12.924 3.891l38.532-31.412a11.496 11.496 0 0114.013-.391l69.498 50.457c4.785 3.478 11.564.856 12.764-4.926L299.823 29.22c1.31-6.316-4.896-11.585-10.91-9.259L5.218 129.402c-7.001 2.7-6.94 12.612.081 15.243zm91.57 12.066l135.098-83.207c2.428-1.491 4.926 1.792 2.841 3.726L123.313 180.87a23.112 23.112 0 00-7.163 13.829l-3.798 28.146c-.503 3.758-5.782 4.131-6.819.494l-14.607-51.325c-1.673-5.854.765-12.107 5.943-15.303z"/></symbol><symbol viewBox="0 0 45.532 45.532" fill="currentColor" id="icon-user" xmlns="http://www.w3.org/2000/svg"><path d="M22.766.001C10.194.001 0 10.193 0 22.766s10.193 22.765 22.766 22.765c12.574 0 22.766-10.192 22.766-22.765S35.34.001 22.766.001zm0 6.807a7.53 7.53 0 11.001 15.06 7.53 7.53 0 01-.001-15.06zm-.005 32.771a16.708 16.708 0 01-10.88-4.012 3.209 3.209 0 01-1.126-2.439c0-4.217 3.413-7.592 7.631-7.592h8.762c4.219 0 7.619 3.375 7.619 7.592a3.2 3.2 0 01-1.125 2.438 16.702 16.702 0 01-10.881 4.013z"/></symbol><symbol viewBox="0 0 512 512" fill="currentColor" id="icon-whatsapp" xmlns="http://www.w3.org/2000/svg"><path d="M435.922 74.352C387.824 26.434 323.84.027 255.742 0 187.797 0 123.711 26.383 75.297 74.29 26.797 122.276.063 186.05 0 253.628v.125c.008 40.902 10.754 82.164 31.152 119.828L.7 512l140.012-31.848c35.46 17.871 75.027 27.293 114.934 27.309h.101c67.934 0 132.02-26.387 180.441-74.297 48.543-48.027 75.29-111.719 75.32-179.34.02-67.144-26.82-130.883-75.585-179.472zM255.742 467.5h-.09c-35.832-.016-71.336-9.012-102.668-26.023l-6.62-3.594-93.102 21.176 20.222-91.907-3.898-6.722C50.203 327.004 39.96 290.105 39.96 253.71c.074-117.8 96.863-213.75 215.773-213.75 57.446.024 111.422 22.294 151.985 62.7 41.176 41.031 63.844 94.711 63.824 151.153-.047 117.828-96.856 213.687-215.8 213.687zm0 0"/><path d="M186.152 141.863h-11.21c-3.903 0-10.239 1.461-15.598 7.293-5.364 5.836-20.477 19.942-20.477 48.63s20.965 56.405 23.887 60.3c2.926 3.89 40.469 64.64 99.93 88.012 49.418 19.422 59.476 15.558 70.199 14.586 10.726-.97 34.613-14.102 39.488-27.715s4.875-25.285 3.414-27.723c-1.465-2.43-5.367-3.887-11.215-6.8-5.851-2.919-34.523-17.262-39.886-19.212-5.364-1.941-9.262-2.914-13.164 2.926-3.903 5.828-15.391 19.313-18.805 23.203-3.41 3.895-6.824 4.383-12.676 1.465-5.852-2.926-24.5-9.191-46.848-29.05-17.394-15.458-29.464-35.169-32.879-41.005-3.41-5.832-.363-8.988 2.57-11.898 2.63-2.61 6.18-6.18 9.106-9.582 2.922-3.406 3.754-5.836 5.707-9.727 1.95-3.89.973-7.296-.488-10.21-1.465-2.919-12.691-31.75-17.895-43.282h.004c-4.382-9.71-8.996-10.039-13.164-10.21zm0 0"/></symbol><symbol viewBox="0 0 512 512" fill="#fff" id="icon-whatsapp-filled" xmlns="http://www.w3.org/2000/svg"><path d="M256.064 0h-.128C114.784 0 0 114.816 0 256c0 56 18.048 107.904 48.736 150.048l-31.904 95.104 98.4-31.456C155.712 496.512 204 512 256.064 512 397.216 512 512 397.152 512 256S397.216 0 256.064 0zm148.96 361.504c-6.176 17.44-30.688 31.904-50.24 36.128-13.376 2.848-30.848 5.12-89.664-19.264-75.232-31.168-123.68-107.616-127.456-112.576-3.616-4.96-30.4-40.48-30.4-77.216s18.656-54.624 26.176-62.304c6.176-6.304 16.384-9.184 26.176-9.184 3.168 0 6.016.16 8.576.288 7.52.32 11.296.768 16.256 12.64 6.176 14.88 21.216 51.616 23.008 55.392 1.824 3.776 3.648 8.896 1.088 13.856-2.4 5.12-4.512 7.392-8.288 11.744-3.776 4.352-7.36 7.68-11.136 12.352-3.456 4.064-7.36 8.416-3.008 15.936 4.352 7.36 19.392 31.904 41.536 51.616 28.576 25.44 51.744 33.568 60.032 37.024 6.176 2.56 13.536 1.952 18.048-2.848 5.728-6.176 12.8-16.416 20-26.496 5.12-7.232 11.584-8.128 18.368-5.568 6.912 2.4 43.488 20.48 51.008 24.224 7.52 3.776 12.48 5.568 14.304 8.736 1.792 3.168 1.792 18.048-4.384 35.52z"/></symbol></svg>
</div>
<script>
<?="var ajaxurl='".admin_url('admin-ajax.php')."'";?>
</script>  
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
<script src="https://unpkg.com/simplebar@latest/dist/simplebar.min.js"></script>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/zabuto_calendar/1.6.4/zabuto_calendar.min.js"></script>-->
<script src="<?= bloginfo('template_directory'); ?>/scripts/zabuto_calendar.js"></script>
<script src="<?= bloginfo('template_directory'); ?>/scripts/main.js"></script>
<script>
$(document).ready(function() {
	
	$('#recall').on('submit', function(event){
		event.preventDefault();
		$('#recall_btn').prop('disabled', true); // блокировка кнопки
		$.ajax({ 
			url: ajaxurl,
			type: "POST",
			data: $("#recall").serialize(),
			success: function() {
				$('#recall_title').text('Спасибо за заявку. В ближайшее время мы с Вами свяжемся.')
				$('#recall').remove();
			}
		});
	});
	
	$('#landing').on('submit', function(event){
		event.preventDefault();
		
		$.ajax({ 
			url: ajaxurl,
			type: "POST",
			data: $("#landing").serialize(),
			success: function() {
				$('#landing_title').text('Спасибо за заявку. В ближайшее время мы с Вами свяжемся.')
				$('#landing').remove();
			}
		});
	});
	
	$('#inIndividForm').on('submit', function(event){
		event.preventDefault();
		$('#inIndivid_btn').prop('disabled', true); // блокировка кнопки
		$.ajax({ 
			url: ajaxurl,
			type: "POST",
			data: $("#inIndividForm").serialize(),
			success: function() {
				$('#inIndividForm_title').text('Спасибо за заявку. В ближайшее время мы с Вами свяжемся.')
				$('#inIndividForm').remove();
			}
		});
	});
	
	
	$('.ot-modal').on('show.bs.modal', function() {
		//document.body.style.position = 'fixed';
		// $('.ot-main-wrapper').css({'position': 'fixed', 'width': '100%', 'top': window.pageYOffset });
	});
	
	$('.ot-modal').on('hide.bs.modal', function() {
		//document.body.style.position = '';
		//$('.ot-main-wrapper').css({'position': 'static'});
	})
	
});

</script>
</body>
</html>