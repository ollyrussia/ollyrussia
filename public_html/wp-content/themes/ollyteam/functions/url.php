<?
	add_filter( 'template_include', 'my_template' );
	
	function my_template( $template ) {
	
		#Личный кабинет психолога - расписание
		if( is_page('lk') ){
			if ( $new_template = locate_template( array( 'admin/lk.php' ) ) )
				return $new_template ;
		}
		#Лендинг
		if( is_page('landing') ){
			if ( $new_template = locate_template( array( 'landing.php' ) ) )
				return $new_template ;
		}		
		#Админка - главная
		if( is_page('admin') ){
			if ( $new_template = locate_template( array( 'admin/admin.php' ) ) )
				return $new_template ;
		}		
		#Админка - генерация корзин
		if( is_page('precart') ){
			if ( $new_template = locate_template( array( 'admin/admin_cart.php' ) ) )
				return $new_template ;
		}
		#Админка - Тест amo
		if( is_page('amo') ){
			if ( $new_template = locate_template( array( 'admin/admin_amo.php' ) ) )
				return $new_template ;
		}		
		#Админка - партнерка
		if( is_page('partner') ){
			if ( $new_template = locate_template( array( 'admin/admin_partner.php' ) ) )
				return $new_template ;
		}
		#Админка - Отчеты по терапиям
		if( is_page('report') ){
			if ( $new_template = locate_template( array( 'admin/admin_report.php' ) ) )
				return $new_template ;
		}
		#Админка - общий отчет
		if( is_page('base_report') ){
			if ( $new_template = locate_template( array( 'admin/admin_base_report.php' ) ) )
				return $new_template ;
		}
		#Админка - данные по окнам
		if( is_page('okno_report') ){
			if ( $new_template = locate_template( array( 'admin/admin_all_report.php' ) ) )
				return $new_template ;
		}		
		#Админка - Рассылка в канал
		if( is_page('ollybot') ){
			if ( $new_template = locate_template( array( 'admin/admin_ollybot.php' ) ) )
				return $new_template ;
		}
		#Админка - заявки с лендинга
		if( is_page('order_landing') ){
			if ( $new_template = locate_template( array( 'admin/admin_order_landing.php' ) ) )
				return $new_template ;
		}
		#Админка - заявки с лендинга
		if( is_page('booking_home') ){
			if ( $new_template = locate_template( array( 'admin/admin_home.php' ) ) )
				return $new_template ;
		}		
		
		return $template;
	
	}