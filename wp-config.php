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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'wp_wp');

/** Имя пользователя MySQL */
define('DB_USER', 'root');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', '');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '1XVq%C>HoR(6|fN#A .re`7Ps6iZ+3J7g_=@tTlE=,9>}qEIHNBI]6K{WY!QBH/Q');
define('SECURE_AUTH_KEY',  '-_%[; [P/bY [K1-]96n).V)nC_^47& ~]5ksO`@fzVYUL?[v~.u*$tCpHAt0(c@');
define('LOGGED_IN_KEY',    '`yVSpR|w7(yIe^~NF05P{:P#N?p|&{?<=ngv$DSLF+C|UCA%,@a_8J5xE*Cmz$;#');
define('NONCE_KEY',        '8u&R/Dd?Q7O]17|b *w6G2x@Zp?T/`^x<W735xbU|5b9#fdszGRv5B<R_0m-y3[i');
define('AUTH_SALT',        '#nk4VAB;A|jNs*o-#+]7I+ AN.377N|s%g2s~~DOnjLH_{pc}>/JZ^hDn_+nA$`S');
define('SECURE_AUTH_SALT', 'RQh!{6z,Tame$.cyC<_BY?1~kpg+j^>E7B_CHyb5gpwBG(ZKihO,+^^IWsY@=xpe');
define('LOGGED_IN_SALT',   '%oWD!oB;C$&y<%^q:_:E8DHi#D20nHLr%xR37KU<fuU%ZooH[Xdn3$wgtuYm+^0T');
define('NONCE_SALT',       'a,_^P@O>^L)QC76!tQ!BQ!(CRsSh* >-c=p/;7L#k.Kimlip05$7htNmFLyS;-I8');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 * 
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
