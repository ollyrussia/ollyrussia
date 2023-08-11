<?

	//Функция помощник рандомного вывода пользователей
	add_action( 'pre_user_query', 'my_random_user_query' );

	function my_random_user_query( $class ) {
	    if( 'rand' == $class->query_vars['orderby'] )
	        $class->query_orderby = str_replace( 'user_login', 'RAND()', $class->query_orderby );
	
	    return $class;
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
	
	//Добавляем поля при добавлении пользователя
	function add_profile_fields( $user ) {  
		?> 
	 	<h3>Информация психолога</h3>
	 	<!-- добавляется ещё один блок в профиле, в примере он будет называться "Дополнительная информация" -->
	 	<table class="form-table">
	 	<!-- для того чтобы ваши поля выглядели так же, как и стандартные в WordPress, прописывайте такие же классы как и тут -->
	 	<!-- добавляем поле город -->
	 	<tr>
	 		<th><label for="wg_yclients">Ссылка на скрипт YCLIENTS</label></th>
	 		<td><input type="text" name="wg_yclients" id="wg_yclients" value="" class="regular-text" /><br /></td>
	 	</tr>	 	
	 	<tr>
	 		<th><label for="phone">Телефон</label></th>
	 		<td><input type="text" name="phone" id="phone" value="" class="regular-text" /><br /></td>
	 	</tr>
	 	<tr>
	 		<th><label for="bot">ID бот</label></th>
	 		<td><input type="text" name="bot" id="bot" value="" class="regular-text" /><br /></td>
	 	</tr>
	 	<tr>
	 		<th><label for="id_yclients">ID пользователя в YCLIENTS</label></th>
	 		<td><input type="text" name="id_yclients" id="id_yclients" value="" class="regular-text" /><br /></td>
	 	</tr>
	 	
	 	<tr>
	 		<th><label for="id_service_base_yclients">ID услуги психологии в YCLIENTS</label></th>
	 		<td><input type="text" name="id_service_base_yclients" id="id_service_base_yclients" value="" class="regular-text" /><br /></td>
	 	</tr>	
	 	<tr>
	 		<th><label for="id_service_psy_yclients">ID услуги психосоматика в YCLIENTS</label></th>
	 		<td><input type="text" name="id_service_psy_yclients" id="id_service_psy_yclients" value="" class="regular-text" /><br /></td>
	 	</tr>
	 	
	 	<tr>
	 		<th><label for="id_service_pa_yclients">ID услуги ПА в YCLIENTS</label></th>
	 		<td><input type="text" name="id_service_pa_yclients" id="id_service_pa_yclients" value="" class="regular-text" /><br /></td>
	 	</tr>
	 	
	 	<tr>
	 		<th><label for="id_service_vi_yclients">ID услуги Насилие в YCLIENTS</label></th>
	 		<td><input type="text" name="id_service_vi_yclients" id="id_service_vi_yclients" value="" class="regular-text" /><br /></td>
	 	</tr>
	 	
	 	<tr>
	 		<th><label for="id_service_in_yclients">ID услуги Очно в YCLIENTS</label></th>
	 		<td><input type="text" name="id_service_in_yclients" id="id_service_in_yclients" value="" class="regular-text" /><br /></td>
	 	</tr>	 	
	 	
	 	
	 	<tr>
	 		<th><label for="price">Цена за сессию</label></th>
	 		<td><input type="text" name="price" id="price" value="" class="regular-text" /><br /></td>
	 	</tr>
	 	<tr>
	 		<th><label for="price">Город</label></th>
	 		<td><input type="text" name="city" id="city" value="" class="regular-text" /><br /></td>
	 	</tr>	 	
	 	<tr>
	 		<th><label for="price">Цена за очную сессию (насилие)</label></th>
	 		<td><input type="text" name="price_violence" id="price_violence" value="" class="regular-text" /><br /></td>
	 	</tr>
	 	<tr>
	 		<th><label for="price">Цена за очную сессию (ПА)</label></th>
	 		<td><input type="text" name="price_panic" id="price_panic" value="" class="regular-text" /><br /></td>
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
		 			<li><label><input value="2 категория" type="radio" name="category"/> 2 категория</label></li>
		 			<li><label><input value="1 категория" type="radio" name="category"/> 1 категория</label></li>
		 			<li><label><input value="Высшая категория" type="radio" name="category"/> Высшая категория</label></li>
		 		</ul>			
		 	</td>
	 	</tr>
	 	</table>
	 <?php }
	 
	add_action( 'user_new_form', 'add_profile_fields' );
	
	//Добавляем поля при редактировании пользователя
	function show_profile_fields( $user ){ 
		//if (get_user_role( $user )=="psychologist"){	
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
	 		<th><label for="wg_yclients">Ссылка на скрипт YCLIENTS</label></th>
	 		<td><input type="text" name="wg_yclients" id="wg_yclients" value="<?php echo get_the_author_meta('wg_yclients',$user->ID);?>" class="regular-text" /><br /></td>
	 	</tr>	 	
	 	<tr>
	 		<th><label for="bot">ID бот</label></th>
	 		<td><input type="text" name="bot" id="bot" value="<?php echo esc_attr(get_the_author_meta('bot',$user->ID));?>" class="regular-text" /><br /></td>
	 	</tr>
	 	
	 	<tr>
	 		<th><label for="id_yclients">ID пользователя в YCLIENTS</label></th>
	 		<td><input type="text" name="id_yclients" id="id_yclients" value="<?php echo esc_attr(get_the_author_meta('id_yclients',$user->ID));?>" class="regular-text" /><br /></td>
	 	</tr>
	 	
	 	<tr>
	 		<th><label for="id_service_base_yclients">ID услуги психологии в YCLIENTS</label></th>
	 		<td><input type="text" name="id_service_base_yclients" id="id_service_base_yclients" value="<?php echo esc_attr(get_the_author_meta('id_service_base_yclients',$user->ID));?>" class="regular-text" /><br /></td>
	 	</tr>	
	 	<tr>
	 		<th><label for="id_service_psy_yclients">ID услуги психосоматика в YCLIENTS</label></th>
	 		<td><input type="text" name="id_service_psy_yclients" id="id_service_psy_yclients" value="<?php echo esc_attr(get_the_author_meta('id_service_psy_yclients',$user->ID));?>" class="regular-text" /><br /></td>
	 	</tr>
	 	
	 	<tr>
	 		<th><label for="id_service_pa_yclients">ID услуги ПА в YCLIENTS</label></th>
	 		<td><input type="text" name="id_service_pa_yclients" id="id_service_pa_yclients" value="<?php echo esc_attr(get_the_author_meta('id_service_pa_yclients',$user->ID));?>" class="regular-text" /><br /></td>
	 	</tr>
	 	
	 	<tr>
	 		<th><label for="id_service_vi_yclients">ID услуги Насилие в YCLIENTS</label></th>
	 		<td><input type="text" name="id_service_vi_yclients" id="id_service_vi_yclients" value="<?php echo esc_attr(get_the_author_meta('id_service_vi_yclients',$user->ID));?>" class="regular-text" /><br /></td>
	 	</tr>
	 	
	 	<tr>
	 		<th><label for="id_service_in_yclients">ID услуги Очно в YCLIENTS</label></th>
	 		<td><input type="text" name="id_service_in_yclients" id="id_service_in_yclients" value="<?php echo esc_attr(get_the_author_meta('id_service_in_yclients',$user->ID));?>" class="regular-text" /><br /></td>
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
	 		<th><label for="price">Город</label></th>
	 		<td><input type="text" name="city" id="city" value="<?php echo esc_attr(get_the_author_meta('city',$user->ID));?>" class="regular-text" /><br /></td>
	 	</tr>	 	
	 	<tr>
	 		<th><label for="price">Цена за очную сессию (насилие)</label></th>
	 		<td><input type="text" name="price_violence" id="price_violence" value="<?php echo esc_attr(get_the_author_meta('price_violence',$user->ID));?>" class="regular-text" /><br /></td>
	 	</tr>
	 	<tr>
	 		<th><label for="price">Цена за очную сессию (ПА)</label></th>
	 		<td><input type="text" name="price_panic" id="price_panic" value="<?php echo esc_attr(get_the_author_meta('price_panic',$user->ID));?>" class="regular-text" /><br /></td>
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
		 			<li><label><input value="2 категория" type="radio" name="category" <?php if ($category == '2 категория') { ?> checked="checked"<?php } ?>/> 2 категория</label></li>
		 			<li><label><input value="1 категория" type="radio" name="category" <?php if ($category == '1 категория') { ?> checked="checked"<?php } ?>/> 1 категория</label></li>
		 			<li><label><input value="Высшая категория" type="radio" name="category" <?php if ($category == 'Высшая категория') { ?> checked="checked"<?php } ?>/> Высшая категория</label></li>		 			
		 		</ul>			
		 	</td>
	 	</tr>
	 	</table>
	<?php }
	 
	add_action( 'show_user_profile', 'show_profile_fields' );
	add_action( 'edit_user_profile', 'show_profile_fields' );	
	
	
	//Сохраняем поля пользователя при редактировании + меняем информацию на привязанных страницах
	function save_profile_fields_edit( $user_id ) {
		
			//if (get_user_role( $user_id )=="psychologist"){
			
			$post_id = esc_attr(get_the_author_meta('id_page',$user_id));
			
			if (isset($_POST['phone'])) {
				update_user_meta( $user_id, 'phone', clearPhone($_POST['phone']));
				update_field( 'photo', $_POST['photo'], $post_id );
			}
			
			if (isset($_POST['wg_yclients'])) {
				update_user_meta( $user_id, 'wg_yclients', $_POST['wg_yclients']);
				update_field( 'wg_yclients', $_POST['wg_yclients'], $post_id );
			}	
			
			if (isset($_POST['bot'])) {	
				update_user_meta( $user_id, 'bot', $_POST['bot']);
			}
			
			if (isset($_POST['url_name'])) {
				update_user_meta( $user_id, 'url_name', $_POST['url_name']);
					wp_update_post( array(
					  'ID' => $post_id,
					  'post_name' => $_POST['url_name']
					));
			}
			
			if (isset($_POST['id_yclients'])) {	
				update_user_meta( $user_id, 'id_yclients', $_POST['id_yclients'] ); 
			}
			if (isset($_POST['id_service_base_yclients'])) {	
				update_user_meta( $user_id, 'id_service_base_yclients', $_POST['id_service_base_yclients'] ); 
			}
			if (isset($_POST['id_service_psy_yclients'])) {	
				update_user_meta( $user_id, 'id_service_psy_yclients', $_POST['id_service_psy_yclients'] ); 
			}	
			
			if (isset($_POST['id_service_pa_yclients'])) {	
				update_user_meta( $user_id, 'id_service_pa_yclients', $_POST['id_service_pa_yclients'] ); 
			}	
			if (isset($_POST['id_service_vi_yclients'])) {	
				update_user_meta( $user_id, 'id_service_vi_yclients', $_POST['id_service_vi_yclients'] ); 
			}	
			if (isset($_POST['id_service_in_yclients'])) {	
				update_user_meta( $user_id, 'id_service_in_yclients', $_POST['id_service_in_yclients'] ); 
			}	
			
			
			if (isset($_POST['city'])) {	
				update_user_meta( $user_id, 'city', $_POST['city'] ); 
				update_field( 'city', $_POST['city'], $post_id );
			}		
			if (isset($_POST['price'])) {	
				update_user_meta( $user_id, 'price', $_POST['price'] ); 
				update_field( 'price', $_POST['price'], $post_id );
			}
			if (isset($_POST['price_violence'])) {	
				update_user_meta( $user_id, 'price_violence', $_POST['price_violence'] ); 
				update_field( 'price_violence', $_POST['price_violence'], $post_id );
			}
			if (isset($_POST['price_panic'])) {	
				update_user_meta( $user_id, 'price_panic', $_POST['price_panic'] ); 
				update_field( 'price_panic', $_POST['price_panic'], $post_id );
			}		
			if (isset($_POST['photo'])) {
				update_user_meta( $user_id, 'photo', $_POST['photo'] ); 
				update_field( 'photo', $_POST['photo'], $post_id );
			}
			if (isset($_POST['biography'])) {	
				update_user_meta( $user_id, 'biography', $_POST['biography'] ); 
				update_field( 'biography', $_POST['biography'], $post_id );
			}
			if (isset($_POST['category'])) {	
				update_user_meta( $user_id, 'category', $_POST['category'] ); 
				update_field( 'category', $_POST['category'], $post_id );
			}
		
		
		
	}
	 
	add_action('profile_update', 'save_profile_fields_edit');
	
	//Сохраняем поля пользователя при добавлении
	function save_profile_fields_add( $user_id ) {
		
			update_user_meta( $user_id, 'phone', $_POST['phone'] );
			update_user_meta( $user_id, 'bot', $_POST['bot'] );
			update_user_meta( $user_id, 'url_name', $_POST['url_name'] );
			update_user_meta( $user_id, 'price', $_POST['price'] );
			update_user_meta( $user_id, 'price_violence', $_POST['price_violence'] );
			update_user_meta( $user_id, 'price_panic', $_POST['price_panic'] );
			update_user_meta( $user_id, 'photo', $_POST['photo'] );
			update_user_meta( $user_id, 'biography', $_POST['biography'] );
			update_user_meta( $user_id, 'category', $_POST['category'] );
			update_user_meta( $user_id, 'city', $_POST['city'] );
			update_user_meta( $user_id, 'wg_yclients', $_POST['wg_yclients'] );
			
			update_user_meta( $user_id, 'id_yclients', $_POST['id_yclients'] );
			update_user_meta( $user_id, 'id_service_base_yclients', $_POST['id_service_base_yclients'] );
			update_user_meta( $user_id, 'id_service_psy_yclients', $_POST['id_service_psy_yclients'] );
			
			update_user_meta( $user_id, 'id_service_pa_yclients', $_POST['id_service_pa_yclients'] );
			update_user_meta( $user_id, 'id_service_vi_yclients', $_POST['id_service_vi_yclients'] );
			update_user_meta( $user_id, 'id_service_in_yclients', $_POST['id_service_in_yclients'] );
			
			
			$post_id=add_page($_POST['first_name'],$_POST['last_name'],$_POST['url_name']);
			update_user_meta( $user_id, 'id_page', $post_id );
			
			update_field( 'photo', $_POST['photo'], $post_id );
			update_field( 'fi', $_POST['last_name']." ".$_POST['first_name'], $post_id );
			update_field( 'biography', $_POST['biography'], $post_id );
			update_field( 'price', $_POST['price'], $post_id );
			update_field( 'price_violence', $_POST['price_violence'], $post_id );
			update_field( 'price_panic', $_POST['price_panic'], $post_id );
			update_field( 'wg_yclients', $_POST['wg_yclients'], $post_id );
			
			update_field( 'city', $_POST['city'], $post_id );
			
			update_field( 'category', $_POST['category'], $post_id );
			update_field( 'id_therapist', $user_id, $post_id );
		

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
			$return[$user->user_email]['price_violence']=get_the_author_meta('price_violence',$user->ID);
			$return[$user->user_email]['city']=get_the_author_meta('city',$user->ID);
			$return[$user->user_email]['url']=home_url('/').get_the_author_meta('url_name',$user->ID);
		}
		
		echo json_encode($return,JSON_UNESCAPED_UNICODE);
		wp_die();
    	
	}
	
	