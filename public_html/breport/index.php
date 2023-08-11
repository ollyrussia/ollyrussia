<?
	ini_set('display_errors', 1);
	error_reporting(E_ALL);
	
	define('WP_USE_THEMES', false);
	require('../wp-blog-header.php');
	
	global $wpdb;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  	
  <div class="container">
    <h2>Отчет</h2>

<form class="form-inline" action="https://ollyteam.ru/breport/" method="POST" style="padding:20px;">
<?
	if (!$_POST)
	{
		$_POST['year']=2022;
		$_POST['month']=2;
		
	}
		
?>	
  <div class="form-group">
    <label for="exampleInputName2">Месяц</label>
		<select name="month" class="form-control">
		  <option value="1" <?php if($_POST['month'] == '1') {echo "selected";}?>>Январь</option>
		  <option value="2" <?php if($_POST['month'] == '2') {echo "selected";}?>>Февраль</option>
		  <option value="3" <?php if($_POST['month'] == '3') {echo "selected";}?>>Март</option>
		  <option value="4" <?php if($_POST['month'] == '4') {echo "selected";}?>>Апрель</option>
		  <option value="5" <?php if($_POST['month'] == '5') {echo "selected";}?>>Май</option>
		  <option value="6" <?php if($_POST['month'] == '6') {echo "selected";}?> >Июнь</option>
		  <option value="7" <?php if($_POST['month'] == '7') {echo "selected";}?>>Июль</option>
		  <option value="8" <?php if($_POST['month'] == '8') {echo "selected";}?>>Август</option>
		  <option value="9" <?php if($_POST['month'] == '9') {echo "selected";}?>>Сентябрь</option>
		  <option value="10" <?php if($_POST['month'] == '10') {echo "selected";}?>>Октябрь</option>
		  <option value="11" <?php if($_POST['month'] == '11') {echo "selected";}?>>Ноябрь</option>
		  <option value="12" <?php if($_POST['month'] == '12') {echo "selected";}?>>Декабрь</option>
		</select>
  </div>
  
  <div class="form-group">
    <label for="exampleInputName2">Месяц</label>
		<select name="year" class="form-control">
		  <option value="2021" <?php if($_POST['year'] == '2021') {echo "selected";}?>>2021</option>
		  <option value="2022" <?php if($_POST['year'] == '2022') {echo "selected";}?>>2022</option>
		</select>
  </div>
  <button type="submit" class="btn btn-default">Посмотреть</button>
</form>
        <table class="table table-striped ">
        <thead>
	        <tr>
	          <th style="width: 25%" >Психолог</b></th>
	          <th style="width: 25%">Тип терапии</th>
	          <th style="width: 25%">Количество</th>
	        </tr>
        </thead>
        <tbody>
	<?php 
		$users = get_users('role=psychologist' );
			foreach ($users as $user): 
	?>
	


        	
 		<?
 		
 		$reports = $wpdb->get_results($wpdb->prepare("SELECT wp_olly_booking.status,MONTH(date_event),COUNT(status) as `counter`,wp_olly_booking.type
				FROM wp_olly_booking
				WHERE wp_olly_booking.therapist = %d
				AND MONTH(wp_olly_booking.date_event)=%d
				AND YEAR(wp_olly_booking.date_event)=%d
				AND wp_olly_booking.status = 'Забронировано'
				GROUP BY wp_olly_booking.type
				ORDER BY wp_olly_booking.date_event",$user->ID,$_POST['month'],$_POST['year']));
				

			
		foreach( $reports as $report): ?>
		
				<?  
				if (	count((array)$report)==0 ):?>
					<tr><td colspan="3">Терапий не было</td></tr>
				<?else:?>
				<?
					$user_info = get_userdata($user->ID);?>
				<tr>
					  <td><?=$user_info->display_name?></td>
                      <td data-label="Тип"><?=$report->type;?></td>
                      <td data-label="Количество"><?=$report->counter;?></td>

    			</tr>
    			<?endif;?>

		<?php endforeach; ?>
    						

    								
	<?php endforeach; ?>

 					

        </tbody>
    </table>
    </div>



  </body>
</html>