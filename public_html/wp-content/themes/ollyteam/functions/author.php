<?
	// Удаляем роль Психолог при деактивации нашей темы
	add_action( 'switch_theme', 'deactivate_my_theme' );
	function deactivate_my_theme() {
		remove_role( 'psychologist' );
		remove_role( 'manager' );
	}
	
	// Добавляем роль Психолог при активации нашей темы
	add_action( 'after_switch_theme', 'activate_my_theme' );
	function activate_my_theme() {

		$author = get_role( 'author' );
		$admin = get_role( 'administrator' );

		add_role( 'psychologist', 'Психолог', $author->capabilities );
		add_role( 'manager', 'Менеджер', $admin->capabilities );
	}
	