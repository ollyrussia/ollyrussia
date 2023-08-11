<?

	//Возвращает русское название месяца
	function getRuMonth($month)
	{
		$monthes = array(
	    '01' => 'Января', '02' => 'Февраля', '03' => 'Марта', '04' => 'Апреля',
	    '05' => 'Мая', '06' => 'Июня', '07' => 'Июля', '08' => 'Августа',
	    '09' => 'Сентября', '10' => 'Октября', '11' => 'Ноября', '12' => 'Декабря'
		);
		
		return $monthes[$month];
	}
	
	//Удобночитаемая дата
	function ruDate($date, $time="false")
	{
		$d = date("d ",strtotime($date));
        $m = getRuMonth(date("m",strtotime($date)));
        $h = date('H:i',strtotime($date));
        
        if (!$time) {
        	return $d." ".$m;
        } else {
        	return $h;
        }
	}
	
	//Очищаем телефон от лишних символов
	function clearPhone($phone)
	{
		$phone = preg_replace('/[^0-9]/', '', $phone);
		if (substr($phone,0,1) == 8) $phone[0] = 7;
		return $phone;
	}
	
	//Функция для добавления заголовка в header, для доступа загрузки контента со сторонних сайтов
	function add_cors_http_header(){
	  header("Access-Control-Allow-Origin: *");
	}
	add_action('init','add_cors_http_header');
	
	
