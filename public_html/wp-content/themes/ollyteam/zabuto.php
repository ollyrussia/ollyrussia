<?
	/*
	Template Name: Вывод сгрупированных дат для zabuto
	*/
	
	$dates=[];
	$i=0;
	$type = $_GET['type'];
	
	if (	$type=="Основа" )
	{
		$sql = "SELECT *
				FROM wp_olly_booking
				WHERE wp_olly_booking.type IN ('Психология/Психосоматика','Основа')
				AND wp_olly_booking.status='Свободно'
				AND date_event BETWEEN NOW() AND DATE_ADD( NOW(), INTERVAL 150 DAY)
				GROUP BY DATE(date_event)";
	}
	if (	$type=="Психосоматика" )
	{
		$sql = "SELECT *
				FROM wp_olly_booking
				WHERE wp_olly_booking.type IN ('Психология/Психосоматика','Психосоматика2','Психосоматика')
				AND wp_olly_booking.status='Свободно'
				AND date_event BETWEEN NOW() AND DATE_ADD( NOW(), INTERVAL 150 DAY)
				GROUP BY DATE(date_event)";
	}
	if (	$type=="Насилие/ПА" )
	{
		$sql = "SELECT *
				FROM wp_olly_booking
				WHERE wp_olly_booking.type IN ('Насилие/ПА')
				AND wp_olly_booking.status='Свободно'
				AND date_event BETWEEN NOW() AND DATE_ADD( NOW(), INTERVAL 150 DAY)
				GROUP BY DATE(date_event)";
	}	
	
	$sql = $wpdb->prepare( $sql);
	$result = $wpdb->get_results($sql);

	if ($result)
	    {
	      foreach ( $result as $row ) {
	      	
	      	$dates[$i] = array(
	        'date' => date("Y-m-d ",strtotime($row->date_event)),
	        'badge' => true,
			 );
			 
			 $i++;
	    }
    }
    
    echo json_encode($dates);


?>