<?php
/**
 * Plugin Name: modal Forms for Elementor
 * Description: pluginCreated by TiMur. Free. Get and use.
 * Plugin URI:  http://t6767.kz/
 * Version:     1.0.0
 * Author:      Timur
 * Author URI:  http://t6767.kz/
 * Text Domain: elementor-test-extension
 */

function wpbootstrap_enqueue_styles() {
    wp_enqueue_style( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' );
    wp_enqueue_style( 'my-style', get_template_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'wpbootstrap_enqueue_styles');

function my_theme_scripts() {
    wp_enqueue_script( 'ajax311', "https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js", '3.1.1', true );
    wp_enqueue_script( 'bootstrap337', "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js", '3.3.7', true );
}
add_action( 'wp_enqueue_scripts', 'my_theme_scripts' );

final class Timur_Extension {
    // Блок констант
	const VERSION = '1.0.0';
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';
	const MINIMUM_PHP_VERSION = '7.0';

	private static $_instance = null;
	
	// Инициализация класса
	public static function instance() {
		if ( is_null( self::$_instance ) ) { self::$_instance = new self(); }
		return self::$_instance;
	}

	public function __construct() {
		add_action( 'init', [ $this, 'i18n' ] );
		add_action( 'plugins_loaded', [ $this, 'init' ] );
	}
	
	public function i18n() {
		load_plugin_textdomain( 'elementor-test-extension' );
	}
	
	
	public function init() {
		// Проверка активирован ли элементор
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}
		// Проверка версии Elementor
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}
		// Проверка версии PHP
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}
		// После проверок добавляем модуле элементора
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
		add_action( 'elementor/controls/controls_registered', [ $this, 'init_controls' ] );
	}
	
	public function includes() {}
	
	/****Инициализация виджитов****/
	public function init_widgets() {
		// Include Widget files
		require_once( __DIR__ . '/widgets/timur-widget.php' );
		// Register widget
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Timur_Widget() );

        // Include Widget files
        require_once( __DIR__ . '/widgets/tabs-widget.php' );
        // Register widget
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Tabs_Widget() );
    }

	public function init_controls() {
		// Include Control files
		require_once( __DIR__ . '/controls/timurControl.php' );
		// Register control
		\Elementor\Plugin::$instance->controls_manager->register_control( 'control-type-', new \TimurControl() );
	}
	
	/****Проверки****/
	// Вывод соощения. Если элементор не активирован говорит чтобы сначала активировали элементор
	public function admin_notice_missing_main_plugin() {
		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'elementor-test-extension' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'elementor-test-extension' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'elementor-test-extension' ) . '</strong>'
		);
		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}
	
	// Вывод сообщения. Если версия элементора не совпадает
	public function admin_notice_minimum_elementor_version() {
		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-test-extension' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'elementor-test-extension' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'elementor-test-extension' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);
		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}
	
	// Вывод сообщения. Если версия php не совпадает
	public function admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-test-extension' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'elementor-test-extension' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'elementor-test-extension' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);
		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

}
// Вызов инициализации
Timur_Extension::instance();
