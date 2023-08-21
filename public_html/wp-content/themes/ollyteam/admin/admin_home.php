<?
	//Если неавторизован, то перебрасываем на страницу входа
	if(!is_user_logged_in() || !current_user_can('administrator')) 
	{
	  auth_redirect();
	 }
	//Выход
	if( isset( $_GET['logout'] ) ) {
        wp_logout();
    }
    

	 
	//Получаем текущего пользователя
	$current_user   = wp_get_current_user();
    //$wp_user   = $current_user->ID;
	
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.x/css/materialdesignicons.min.css" rel="stylesheet">
    <title>Календарь занятости дома</title>
  </head>
  <body>
    <div id="app"></div>
    <script src="<?= bloginfo('template_directory'); ?>/admin/js/build.js"></script>
    <script>window.employee="<?php echo $current_user->ID;?>"</script>
  </body>
</html>
