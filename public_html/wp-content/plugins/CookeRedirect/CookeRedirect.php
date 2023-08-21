<?php
/**
 * Plugin Name: CookeRedirect
 * Description: Редирект с поддоменов на основной сайт
 */

function CookeRedirect() {
	$cookieName='_domain';
	$redirectDomain='mm.ollyteam.ru';
	$cookieValue=$_COOKIE[$cookieName] ?? '';

	if ($_SERVER['HTTP_HOST']==$redirectDomain) {
		setcookie($cookieName, $redirectDomain, time()+3600*24*365, '/', '.ollyteam.ru');
	}

	if ($cookieValue==$redirectDomain && $_SERVER['HTTP_HOST']!=$redirectDomain) {
		$currentURL=(isset($_SERVER['HTTPS']) ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		header('Location: '.str_replace('ollyteam.ru', $redirectDomain, $currentURL));
		exit;
	}
}

add_action('template_redirect', 'CookeRedirect');
