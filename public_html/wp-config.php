<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'cf78864_olly' );

/** Имя пользователя MySQL */
define( 'DB_USER', 'cf78864_olly' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', 'PwuFt4DK!!4' );

/** Имя сервера MySQL */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '%L6]M@Vv]jzB3w:t`QLlJc2Qzll4blrrk:+=sGTua} P&gUk7O(~0&RIIo1=Dnmt' );
define( 'SECURE_AUTH_KEY',  'uWZ|I,(a8|XB<qpQ,hNSgX*_!$T`I8Dc*#ohRIpjwH@8c+]L8O)<`zr$#in2X.U(' );
define( 'LOGGED_IN_KEY',    ']iIX(5l<.vQqZ_`>6ezs9irM04Fe9+lDnDahT7HIIWs0n)j#%4tO(+TP(nM-}}N,' );
define( 'NONCE_KEY',        '%( wrRW3#xCF4fQK5E[Z&6D$=)+33.Km#~CA[2N[N._(J{t|5}qS[ml<s^xe@}lW' );
define( 'AUTH_SALT',        'O`x}U?Kx;j0``=pky-fbDUG6[ABh-51Nd;t:yerHvx#%CRZ%am1^s]DL<.HWbEAr' );
define( 'SECURE_AUTH_SALT', '0?kw#rSyav!FswR,`I<_OJjXM` O3<wr<^{}Zoy8:8q{il1#O=`Un[eH4HG&uZ-1' );
define( 'LOGGED_IN_SALT',   'gVPIaq(S#b1#_[>%i=Nj#%]LZ-5nEX:?m/|Hq;,hsAaS:Dr*; {u9z`EiQKlV@K5' );
define( 'NONCE_SALT',       'eG;mBjrTv6R8=VDETO4mX8Kqb-0UXtZf*+.`meRsM N}<nfi)7s h98JH1FN{IeZ' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
 
define( 'WP_DEBUG', TRUE );
define('WP_DEBUG_DISPLAY', false);
define( 'WP_DEBUG_LOG', TRUE );
define( 'ALLOW_UNFILTERED_UPLOADS', true );
/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
