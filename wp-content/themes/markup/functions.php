<?php 
	
	//Include Styles
	function enqueue_styles() {
		wp_enqueue_style( 'style', get_stylesheet_uri());
		//wp_enqueue_style('zerif_fontawesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), 'v1');
		//wp_enqueue_style('zerif_bootstrap_style', get_template_directory_uri() . '/css/bootstrap.css');
	}
	add_action('wp_enqueue_scripts', 'enqueue_styles');

	//Include jQuery
	function jquery_init() {
	    if (!is_admin()) {
	        wp_enqueue_script('jquery');
	    }
	}
	add_action('wp_enqueue_scripts', 'jquery_init');

	//Include Scripts
	function enqueue_scripts () {
		wp_register_script('html5-shim', 'http://html5shim.googlecode.com/svn/trunk/html5.js');
		wp_enqueue_script('html5-shim');
		wp_enqueue_script('sameheight', get_template_directory_uri() . '/js/sameheight.js', array(), '20120206', true);
		wp_enqueue_script('hammer', get_template_directory_uri() . '/js/hammer-2.0.4.js', array(), '20120206', true);
		wp_enqueue_script('mobilenav', get_template_directory_uri() . '/js/mobileNav.js', array(), '20120206', true);
		wp_enqueue_script('main', get_template_directory_uri() . '/js/main.js', array(), '20120206', true);
	}
	add_action('wp_enqueue_scripts', 'enqueue_scripts');

	//Activate Menu
	if (function_exists('add_theme_support')) {
		add_theme_support('menus');
	}

	//Activate Post thumbnails
	add_theme_support( 'post-thumbnails', array( 'post' ) ); // для всех типов постов

	//Register Menu Position
	// function register_menus(){
	// 	register_nav_menus(array(
	// 		'main_nav' => 'Main header menu'
	// 	));
	// }

	// if (function_exists('register_menus')){
	// 	add_action( 'init', 'register_menus' );
	// }

	//Remove autoupdates tags content
	remove_filter('the_content', 'wpautop');

	//Настройки панели администрирования
	//Регистрация функции настроек
	function theme_settings_init(){
		register_setting( 'theme_settings', 'theme_settings' );
	}

	// Добавление настроек в меню страницы
	function add_settings_page() {
		add_menu_page( __( 'Theme Settings' ), __( 'Theme Settings' ), 'manage_options', 'settings', 'theme_settings_page');
	}

	//Добавление действий
	add_action( 'admin_init', 'theme_settings_init' );
	add_action( 'admin_menu', 'add_settings_page' );

	//Начало страницы настроек
	function theme_settings_page() {

		if ( !isset( $_REQUEST['updated'] ) )
			$_REQUEST['updated'] = false;
		?>

		<div>

			<div id="icon-options-general"></div>
			<h2 id="title"><?php _e( 'Theme Settings', 'markup' ) ?></h2>

		<?php
			//вывод сообщения о том, что значение опции сохранено
			if ( false !== $_REQUEST['updated'] ) : ?>
				<div><p><strong><?php _e( 'Options saved' ); ?></strong></p></div>
			<?php endif; ?>

			<form method="post" action="options.php">

				<?php settings_fields( 'theme_settings' ); ?>
				<?php $options = get_option( 'theme_settings' ); ?>

				<table class="form-table">

					<tbody>

						<!-- Пользовательский логотип -->
						<tr valign="top">
							<th scope="row"><?php _e( 'Custom Logo', 'markup' ); ?></th>
							<td><input id="theme_settings[custom_logo]" type="text" size="40" name="theme_settings[custom_logo]" value="<?php esc_attr_e( $options['custom_logo'] ); ?>" class="regular-text code" />
							</td>
						</tr>

						<!-- Phone -->
						<tr valign="top">
							<th scope="row"><?php _e( 'Phone number', 'markup' ); ?></th>
							<td><input id="theme_settings[phone_num]" type="text" name="theme_settings[phone_num]"  class="regular-text code" value="<?php esc_attr_e( $options['phone_num'] ); ?>" />
							</td>
						</tr>

						<!-- Email -->
						<tr valign="top">
							<th scope="row"><?php _e( 'Email', 'markup' ); ?></th>
							<td><input id="theme_settings[Email]" type="email" name="theme_settings[Email]" class="regular-text code" value="<?php esc_attr_e( $options['Email'] ); ?>" />
							</td>
						</tr>

						<!-- Skype -->
						<tr valign="top">
							<th scope="row"><?php _e( 'Skype', 'markup' ); ?></th>
							<td><input id="theme_settings[Skype]" type="text" size="40" name="theme_settings[Skype]" value="<?php esc_attr_e( $options['Skype'] ); ?>"  class="regular-text code" />
							</td>
						</tr>

					</tbody>

				</table>

				<p class="submit"><input name="submit" id="submit" value="Save Changes" type="submit" class="button button-primary"></p>
			</form>

		</div>

		<?php
	}
	//валидация
	function options_validate( $input ) {
		global $select_options, $radio_options;
		if ( ! isset( $input['option1'] ) )
	    	$input['option1'] = null;
		$input['option1'] = ( $input['option1'] == 1 ? 1 : 0 );
		$input['sometext'] = wp_filter_nohtml_kses( $input['sometext'] );
		if ( ! isset( $input['radioinput'] ) )
	    	$input['radioinput'] = null;
		if ( ! array_key_exists( $input['radioinput'], $radio_options ) )
	    	$input['radioinput'] = null;
		$input['sometextarea'] = wp_filter_post_kses( $input['sometextarea'] );
		return $input;
	}

?>