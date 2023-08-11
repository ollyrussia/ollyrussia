<?	

	//Отправка сообщения в канал
	add_action( 'wp_ajax_sendMessageOllybot', 'sendMessageOllybot' );
	add_action( 'wp_ajax_nopriv_sendMessageOllybot', 'sendMessageOllybot' );
	
	
	function sendMessageOllybot(){
		
		$message = $_POST['message'];
		$post = sendTelegramOllyteam(-1001461594947, $message);

	}
	
	//Формирование сообщения для канала
	add_action( 'wp_ajax_getMessageAllBot', 'getMessageAllBot' );
	add_action( 'wp_ajax_nopriv_getMessageAllBot', 'getMessageAllBot' );
	
	function getMessageAllBot(){
		
		global $wpdb;
		$message="";
		
		$users = get_users('role=psychologist' );
		
		foreach ($users as $user) {
			
			$base = getBaseTherapyForBot($user->ID);
			$psy = getPsyTherapyForBot($user->ID);
			
			if ($base==false && $psy==false) {
				continue;
			}
			
	        $name_therapist = $user->display_name;
			$category_therapist = get_the_author_meta('category',$user->ID);
			$price = get_the_author_meta('price',$user->ID);
			
			$message.="\r\n\r\nПсихолог: ".$name_therapist;
			$message.="\r\nКатегория психолога: ".$category_therapist."\r\n";
			
			
			if ($base!=false)
			{
				$message.="\r\nСвободные даты консультации по психологии:\r\n";
				$message.="Стоимость консультации: ".$price;
				$message.="\r\n".$base;
			}
			if ($psy!=false)
			{
				$message.="\r\nСвободные даты консультации по первичной психосоматике:\r\n";
				$message.="Стоимость консультации: ".$price*2;
				$message.="\r\n".$psy;
			}		
	
		}
		
			echo $message;
			wp_die();	
	}
	
	//Формирование сообщения для канала
	add_action( 'wp_ajax_getMessageBot', 'getMessageBot' );
	add_action( 'wp_ajax_nopriv_getMessageBot', 'getMessageBot' );	
	function getMessageBot(){
		
		global $wpdb;
		
		$message="";
		
		$base = getBaseTherapyForBot($_POST['therapist']);
		$psy = getPsyTherapyForBot($_POST['therapist']);
		
		if ($base==false && $psy==false) {
			echo "!У психолога нет свободных окон!\r\n";
			wp_die();
		}
		
		$therapist = get_user_by('id', $_POST['therapist']);
        $name_therapist = $therapist->display_name;
		$category_therapist = get_the_author_meta('category',$therapist->ID);
		$price = get_the_author_meta('price',$therapist->ID);
		

		
		$message="Психолог: ".$name_therapist;
		$message.="\r\nКатегория психолога: ".$category_therapist."\r\n";
		
		
		if ($base!=false)
		{
			$message.="Свободные даты консультации по психологии:\r\n";
			$message.="Стоимость консультации: ".$price;
			$message.="\r\n".$base;
		}
		if ($psy!=false)
		{
			$message.="\r\nСвободные даты консультации по первичной психосоматике:\r\n";
			$message.="Стоимость консультации: ".$price*2;
			$message.="\r\n".$psy;
		}		

		
		echo $message;
		wp_die();
	}
	
	
	
	function getBaseTherapyForBot($id_therapist)
	{
		global $wpdb;
		
		$msg="";
		$return_arr = array();
		
		$sql = "SELECT * FROM wp_olly_booking 
		WHERE therapist = %d
		AND status='Свободно'
		AND type='Основа'
		AND date_event BETWEEN NOW() AND DATE_ADD( NOW(), INTERVAL 150 DAY )
		ORDER BY date_event,type
		";
		
		$sql = $wpdb->prepare( $sql, $id_therapist);
    	$result = $wpdb->get_results($sql);
    	
    	
    	if ($wpdb->num_rows<1) { return false;}
        
        else {

        	foreach($result as $row) {
        		

        		$date = ruDate($row->date_event,false);
        		$time = ruDate($row->date_event,true);
        		
        		$return_arr[$date][]= $time;
        		
        	}

        	foreach ($return_arr as $date => $timeList) {
        			$msg .= $date.": ";
				foreach ($timeList as $time) {
					$msg .= "[".$time."]  ";
				}
					$msg .= "\r\n";
			}
			
        }
        
        return $msg;
        	
	}
	
	function getPsyTherapyForBot($id_therapist)
	{
		global $wpdb;
		
		$return_arr   =array();
		$msg = "";
		
		$sql = "SELECT * FROM wp_olly_booking
		WHERE therapist = %d
		AND status='Свободно'
		AND type='Психосоматика2'
		AND date_event BETWEEN NOW() AND DATE_ADD( NOW(), INTERVAL 150 DAY )
		ORDER BY date_event,type
		";
		
		$sql = $wpdb->prepare($sql, $id_therapist);
    	$result = $wpdb->get_results($sql);
    	
    	
    	if ($wpdb->num_rows<1) { return false;}
        
        else {

        	foreach($result as $row) {
        		
        		$date = ruDate($row->date_event,false);
        		$time = ruDate($row->date_event,true);
        		
        		$return_arr[$date][]= $time;
        	}
        	
        	foreach ($return_arr as $date => $timeList) {
        			$msg .= $date.": ";
				foreach ($timeList as $time) {
					$msg .= "[".$time."]  ";
				}
					$msg .= "\r\n";
			}
			
        }
        
        return $msg;
        	
	}