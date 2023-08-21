<?
add_action( 'register_form', 'true_show_fields' );
 
function true_show_fields() {
 
	$first_name = ! empty( $_POST[ 'first_name' ] ) ? $_POST[ 'first_name' ] : '';
	$last_name = ! empty( $_POST[ 'last_name' ] ) ? $_POST[ 'last_name' ] : '';
	$birthday = ! empty( $_POST[ 'birthday' ] ) ? $_POST[ 'birthday' ] : '';
	$phone = ! empty( $_POST[ 'phone' ] ) ? $_POST[ 'phone' ] : '';
	?>
	<p>
		<label for="city">Ваше имя</label>
		<input type="text" id="first_name" name="first_name" class="input" required value="<?php echo esc_attr( $first_name ) ?>" size="25" />
	</p>
	<p>
		<label for="city">Ваша фамилия</label>
		<input type="text" id="last_name" name="last_name" class="input" required value="<?php echo esc_attr( $last_name ) ?>" size="25" />
	</p>
	<p>
		<label for="city">День рождения</label>
		<input type="text" id="birthday" name="birthday" class="input" required value="<?php echo esc_attr( $birthday ) ?>" size="25" />
	</p>
	<p>
		<label for="city">Ваш телефон</label>
		<input type="text" id="phone" name="phone" class="input" required value="<?php echo esc_attr( $phone ) ?>" size="25" />
	</p>		
	<?php
}

add_filter( 'registration_errors', 'true_check_fields', 25, 3 );
 
function true_check_fields( $errors, $sanitized_user_login, $user_email ) {
 
	if( empty( $_POST[ 'first_name' ] ) ) {
		$errors->add( 'empty_first_name', '<strong>ОШИБКА:</strong> Заполните ваше имя.' );
	}
 
	if( empty( $_POST[ 'last_name' ] ) ) {
		$errors->add( 'empty_last_name', '<strong>ОШИБКА:</strong> Заполните вашу фамилию.' );
	}
	
	if( empty( $_POST[ 'birthday' ] ) ) {
		$errors->add( 'empty_birthday', '<strong>ОШИБКА:</strong> Введите дату вашего рождения.' );
	}
	
	if( empty( $_POST[ 'phone' ] ) ) {
		$errors->add( 'empty_phone', '<strong>ОШИБКА:</strong> Введите ваш телефон.' );
	} 
	return $errors;
 
}

add_action( 'user_register', 'true_register_fields' );
 
function true_register_fields( $user_id ) {
 
	update_user_meta( $user_id, 'first_name', sanitize_text_field( $_POST[ 'first_name' ] ) );
	update_user_meta( $user_id, 'last_name', sanitize_text_field( $_POST[ 'last_name' ] ) );
	update_user_meta( $user_id, 'birthday', sanitize_text_field( $_POST[ 'birthday' ] ) );
	update_user_meta( $user_id, 'phone', sanitize_text_field( $_POST[ 'phone' ] ) );
 
}