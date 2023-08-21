<?php


	//Убираем админ плашку
	add_filter( 'show_admin_bar', '__return_false');
	
	//Разрешаем загружать JSON в библиотеку, для отзывов
	function cc_mime_types($mimes) {
	    $mimes['json'] = 'application/json';
	    return $mimes;
	}
	add_filter('upload_mimes', 'cc_mime_types');
	

	
	//Работа с ролями
	require_once (get_template_directory (). '/functions/author.php');
	//Работа с психологами
	require_once (get_template_directory (). '/functions/psychologist.php');
	//Функции помощники
	require_once (get_template_directory (). '/functions/helper.php');
	//Функции расписания
	require_once (get_template_directory (). '/functions/shedule.php');
	//Назначения шаблонов
	require_once (get_template_directory (). '/functions/url.php');
	//Телеграм
	require_once (get_template_directory (). '/functions/telegram.php');
	//Сендпульс
	require_once (get_template_directory (). '/functions/sendpulse.php');
	//Смс
	require_once (get_template_directory (). '/functions/sms.php');
	//Касса
	require_once (get_template_directory (). '/functions/ykassa.php');
	//Промокоды
	require_once (get_template_directory (). '/functions/promocode.php');
	//Приемщик форм
	require_once (get_template_directory (). '/functions/form.php');
	//Коды доступа для психосоматики
	require_once (get_template_directory (). '/functions/access.php');
	//Партнерка
	require_once (get_template_directory (). '/functions/partner.php');
	//Интеграция с AMO
	require_once (get_template_directory (). '/functions/amo.php');
	//Интеграция с Yclients / Подключаем в самом файле Update.php
	//require_once (get_template_directory (). '/functions/yclients.php');
	//Рассылка в канал
	require_once (get_template_directory (). '/functions/ollybot.php');
	//Бронирование проектоного дома
	require_once (get_template_directory (). '/functions/booking_home.php');
	// Получение графика пользователей якл
	//require_once (get_template_directory (). '/functions/ycalendar.php');

	
	
	//Функция получение ID пользователя по ID уклиента
	function getIdUser ($yclient_id){
		global $wpdb;
		return $wpdb->get_var( $wpdb->prepare("SELECT user_id FROM wp_usermeta WHERE meta_value=%s",$yclient_id ));
	}
	//Функция получение тип сессии по ID услуги в Уклиенте
	function getTypeService ($service_id){
		global $wpdb;
		$slug_services = $wpdb->get_var( $wpdb->prepare("SELECT meta_key FROM wp_usermeta WHERE meta_value=%s",$service_id ));
		
		if ($slug_services=="id_service_base_yclients") { return "Основа";}
		if ($slug_services=="id_service_psy_yclients") { return "Психосоматика2";}
	}
	
function filter_gettext( $translated, $original, $domain ) {
    // Если не основной текстовый домен WP - ничего не делаем
    if ($domain !== 'default') return $translated;
    // Текстовая строка должна быть в точности такой, как в файле перевода
    if ( $translated == "Имя пользователя" ) {
        $translated = "Имя пользователя - вводить только латинскими буквами без пробелов";
    }
    return $translated;
}
add_filter( 'gettext', 'filter_gettext', 10, 3 );
	

	
	
	