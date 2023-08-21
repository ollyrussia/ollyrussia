<?
	//Добавление полей для психолога
	
	function get_user_role($user_id) {
		global $wp_roles;
		$roles = array();
		$user = new WP_User( $user_id );
		if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
		foreach ( $user->roles as $role )
			$roles[] .= translate_user_role($wp_roles->roles[$role]['name']);
		}
		return implode(', ',$roles);
	}	

	function true_remove_personal_options(){
		echo "\n" . '<script type="text/javascript">
		jQuery(document).ready(function($) {
		$(\'form#your-profile > h3:first\').hide();
		$(\'form#your-profile > table:first\').hide();
		$(\'form#your-profile\').show(); });
		</script>' . "\n";
	}
	add_action('admin_head', 'true_remove_personal_options');
	
	//Добавляем поля при добавлении пользователя
	function add_profile_fields( $user ) {
		
		$cur_user_id = get_current_user_id();  
		if (get_user_role( $cur_user_id )=="psychologist"){
		?> 
	 	<h3>Информация психолога</h3>
	 	<!-- добавляется ещё один блок в профиле, в примере он будет называться "Дополнительная информация" -->
	 	<table class="form-table">
	 	<!-- для того чтобы ваши поля выглядели так же, как и стандартные в WordPress, прописывайте такие же классы как и тут -->
	 	<!-- добавляем поле город -->
	 	<tr>
	 		<th><label for="phone">Телефон</label></th>
	 		<td><input type="text" name="phone" id="phone" value="" class="regular-text" /><br /></td>
	 	</tr>
	 	<tr>
	 		<th><label for="bot">ID бот</label></th>
	 		<td><input type="text" name="bot" id="bot" value="" class="regular-text" /><br /></td>
	 	</tr>
	 	<tr>
	 		<th><label for="price">Цена за сессию</label></th>
	 		<td><input type="text" name="price" id="price" value="" class="regular-text" /><br /></td>
	 	</tr>
	 	<tr>
	 		<th><label for="photo">Ссылка на фотографию (из библиотеки WP)</label></th>
	 		<td><input type="text" name="photo" id="photo" value="" class="regular-text" /><br /></td>
	 	</tr>	 	
	 	<tr>
	 		<th><label for="url_name">Ссылка на страницу</label></th>
	 		<td><input type="text" name="url_name" id="url_name" value="" class="regular-text" /><br /></td>
	 	</tr>
	 	<tr>
	 		<th><label for="url_name">Биография</label></th>
	 		<td><textarea row="4" cols="70"  name="biography"></textarea><br /></td>
	 	</tr>	 	
	 	<tr>
	 		<th><label for="category">Категория терапевта</label></th>
		 	<td>
		 		<ul>
		 			<li><label><input value="Начинающий психолог" type="radio" name="category"/> Начинающий психолог</label></li>
		 			<li><label><input value="Психолог команды" type="radio" name="category"/> Психолог команды</label></li>
		 			<li><label><input value="Ведущий психолог" type="radio" name="category"/> Ведущий психолог</label></li>
		 		</ul>			
		 	</td>
	 	</tr>
	 	</table>
	 <?php }
	 
	add_action( 'user_new_form', 'add_profile_fields' );
	
	//Добавляем поля при редактировании пользователя
	function show_profile_fields( $user ) {
		$cur_user_id = get_current_user_id();  
		if (get_user_role( $cur_user_id )=="psychologist"){
		?> 
	 	<h3>Информация психолога</h3>
	 	<!-- добавляется ещё один блок в профиле, в примере он будет называться "Дополнительная информация" -->
	 	<table class="form-table">
	 	<!-- для того чтобы ваши поля выглядели так же, как и стандартные в WordPress, прописывайте такие же классы как и тут -->
	 	<!-- добавляем поле город -->
	 	<tr>
	 		<th><label for="phone">Телефон</label></th>
	 		<td><input type="text" name="phone" id="phone" value="<?php echo esc_attr(get_the_author_meta('phone',$user->ID));?>" class="regular-text" /><br /></td>
	 	</tr>
	 	<tr>
	 		<th><label for="bot">ID бот</label></th>
	 		<td><input type="text" name="bot" id="bot" value="<?php echo esc_attr(get_the_author_meta('bot',$user->ID));?>" class="regular-text" /><br /></td>
	 	</tr>
	 	<tr>
	 		<th><label for="url_name">Ссылка на страницу</label></th>
	 		<td><input type="text" name="url_name" id="url_name" value="<?php echo esc_attr(get_the_author_meta('url_name',$user->ID));?>" class="regular-text" /><br /></td>
	 	</tr>
	 	<tr>
	 		<th><label for="price">Цена за сессию</label></th>
	 		<td><input type="text" name="price" id="price" value="<?php echo esc_attr(get_the_author_meta('price',$user->ID));?>" class="regular-text" /><br /></td>
	 	</tr>
	 	<tr>
	 		<th><label for="photo">Ссылка на фотографию (из библиотеки WP)</label></th>
	 		<td><input type="text" name="photo" id="photo" value="<?php echo esc_attr(get_the_author_meta('photo',$user->ID));?>" class="regular-text" /><br /></td>
	 	</tr>
	 		 	<tr>
	 		<th><label for="url_name">Биография</label></th>
	 		<td><textarea row="4" cols="70"  name="biography"><?php echo esc_attr(get_the_author_meta('biography',$user->ID));?></textarea><br/></td>
	 	</tr>
	 	<tr>
	 		<th><label for="category">Категория терапевта</label></th>
		 	<td><?php $category = get_the_author_meta('category',$user->ID ); ?>
		 		<ul>
		 			<li><label><input value="Начинающий психолог" type="radio" name="category" <?php if ($category == 'Начинающий психолог') { ?> checked="checked"<?php } ?>/> Начинающий психолог</label></li>
		 			<li><label><input value="Психолог команды" type="radio" name="category" <?php if ($category == 'Психолог команды') { ?> checked="checked"<?php } ?>/> Психолог команды</label></li>
		 			<li><label><input value="Ведущий психолог" type="radio" name="category" <?php if ($category == 'Ведущий психолог') { ?> checked="checked"<?php } ?>/> Ведущий психолог</label></li>
		 		</ul>			
		 	</td>
	 	</tr>
	 	</table>
	 <?php }
	add_action( 'show_user_profile', 'show_profile_fields' );
	add_action( 'edit_user_profile', 'show_profile_fields' );	
	
	
	//Сохраняем поля пользователя при редактировании
	function save_profile_fields_edit( $user_id ) {

		$user = get_userdata( $user_id );
		$user_roles = $user->roles;
		if ( in_array( 'psychologist', $user_roles, true ) ) {
			update_user_meta( $user_id, 'phone', $_POST['phone'] );
			update_user_meta( $user_id, 'bot', $_POST['bot'] );
			update_user_meta( $user_id, 'url_name', $_POST['url_name'] );
			update_user_meta( $user_id, 'price', $_POST['price'] );
			update_user_meta( $user_id, 'photo', $_POST['photo'] );
			update_user_meta( $user_id, 'biography', $_POST['biography'] );
			update_user_meta( $user_id, 'category', $_POST['category'] );			
		}		
	}
	 
	add_action('profile_update', 'save_profile_fields_edit');
	
	//Сохраняем поля пользователя при редактировании
	function save_profile_fields_add( $user_id ) {
		
		$user = get_userdata( $user_id );
		$user_roles = $user->roles;
		if ( in_array( 'psychologist', $user_roles, true ) ) {
			update_user_meta( $user_id, 'phone', $_POST['phone'] );
			update_user_meta( $user_id, 'bot', $_POST['bot'] );
			update_user_meta( $user_id, 'url_name', $_POST['url_name'] );
			update_user_meta( $user_id, 'price', $_POST['price'] );
			update_user_meta( $user_id, 'photo', $_POST['photo'] );
			update_user_meta( $user_id, 'biography', $_POST['biography'] );
			update_user_meta( $user_id, 'category', $_POST['category'] );
			
			$post_id=add_page($_POST['first_name'],$_POST['last_name'],$_POST['url_name']);
			
			update_field( 'photo', $_POST['photo'], $post_id );
			update_field( 'fi', $_POST['last_name']." ".$_POST['first_name'], $post_id );
			update_field( 'biography', $_POST['biography'], $post_id );
			update_field( 'price', $_POST['price'], $post_id );
			update_field( 'category', $_POST['category'], $post_id );
			update_field( 'id_therapist', $user_id, $post_id );
		}

	}	
	//Функция создания страницы
	function add_page($name,$surname,$url_name) {
		// Создаем массив данных новой записи
		$post_data = array(
			'post_name' =>$url_name,
			'post_title'    => $surname." ".$name,
			'post_content'  => "",
			'post_status'   => 'publish',
			'post_author'   => 1,
			'page_template'  => "therapists.php",
			'post_type'=>'page',
		);
		
		// Вставляем запись в базу данных
		$post_id = wp_insert_post( $post_data );
		return $post_id;
	}    

	add_action('user_register', 'save_profile_fields_add');
	
	
	//Перенаправляем психологов на личный кабинет
	/*function redirect_users_after_login() {
		
	    $user = wp_get_current_user();
	    $roles = ( array ) $user->roles;
    
	    // Редирект
	    if ( $roles[0] == 'psychologist' ) {
	         wp_redirect( '/lk' );
	         exit;
	    }

	}
	add_action( 'admin_init', 'redirect_users_after_login' );*/
	
	//Получение терапевтов
	add_action( 'wp_ajax_getTherapist', 'getTherapist' );
	add_action( 'wp_ajax_nopriv_getTherapist', 'getTherapist' );
	function getTherapist()
	{
		$return = array();
		
		$users = get_users('role=psychologist' );
		foreach ($users as $user) {
			$return[$user->user_email]['email']=$user->user_email;
			$return[$user->user_email]['name']=$user->display_name;
			$return[$user->user_email]['photo']=get_the_author_meta('photo',$user->ID);
			$return[$user->user_email]['category']=get_the_author_meta('category',$user->ID);
			$return[$user->user_email]['price']=get_the_author_meta('price',$user->ID);
			$return[$user->user_email]['url']=home_url('/').get_the_author_meta('url_name',$user->ID);
		}
		
		echo json_encode($return,JSON_UNESCAPED_UNICODE);
		wp_die();
    	
	}
	
	