<?php
//Các thông số cố định
define( 'THEME_VERSION', 	'1.0.0' );
define( 'TEXTDOMAIN', 'textdomain' );
define( 'THEME_DIR', 	get_template_directory_uri() );
define( 'THEME_ROOT', 	get_template_directory() );

 /** Require Timber */
$composer_autoload = THEME_ROOT . '/vendor/autoload.php';
if ( file_exists( $composer_autoload ) ) {
	require_once $composer_autoload;
	$timber = new Timber\Timber();
}

//** Load template lỗi nếu chưa kích hoạt các plugin cần thiết  */
function template_error_filter( $template ) {
	return get_stylesheet_directory() . '/public/error.html';
}

/** Thông báo nếu chưa cài Package */
if ( ! class_exists( 'Timber' ) ) {
	add_action( 'admin_notices', function() { echo '<div class="error"><p>Chưa tải package Timber</p></div>'; } );
	add_filter( 'template_include','template_error_filter' );
	return;
}

/** Thông báo nếu chưa cài bộ ACF */
if( ! class_exists('ACF') ) {
	add_action( 'admin_notices', function() { echo '<div class="error"><p>Chưa cài plugin <a href="'.admin_url('plugin-install.php?s=Advanced+Custom+Fields&tab=search&type=term').'">ACF</p></div>'; } );
	add_filter( 'template_include','template_error_filter' );
	return;
}

if( !class_exists('acf_plugin_flexible_content') ){
	add_action( 'admin_notices', function() { echo '<div class="error"><p>Plugin ACF Flexible Content đã bị tắt, website có thể sẽ không hoạt động!</p></div>'; } );
	add_filter( 'template_include','template_error_filter' );
	return;
}

if( !class_exists('acf_plugin_repeater') ){
	add_action( 'admin_notices', function() { echo '<div class="error"><p>Plugin ACF Repeater đã bị tắt, website có thể sẽ không hoạt động!</p></div>'; } );
	add_filter( 'template_include','template_error_filter' );
	return;
}

if( !class_exists('acf_plugin_options_page') ){
	add_action( 'admin_notices', function() { echo '<div class="error"><p>Plugin ACF Options Page đã bị tắt, website có thể sẽ không hoạt động!</p></div>'; } );
	add_filter( 'template_include','template_error_filter' );
	return;
}

if( !class_exists('acf_plugin_gallery') ){
	add_action( 'admin_notices', function() { echo '<div class="error"><p>Plugin ACF Gallery đã bị tắt, website có thể sẽ không hoạt động!</p></div>'; } );
	add_filter( 'template_include','template_error_filter' );
	return;
}


//Function require files
if (! function_exists( 'require_files' ) ){
	function require_files($folder, $files_require){
		foreach ( $files_require as $file ) {
			$path = THEME_ROOT . $folder . '/' . $file . '.php';
			if( file_exists( $path ) ) {
				require $path;
			}
		}
	}
}

/** Khai báo file sẽ load trong thư mục functions */
$admin = [
	'option',
	'hook'
];
require_files('/admin', $admin);


/** Khai báo file sẽ load trong thư mục admin */
$functions = [
	
];
require_files('/functions', $functions);


/** Khai báo file sẽ load trong thư mục classes */
$classes = [
	'Enqueue',
	'PostType',
	'Taxonomy',
	'Config'
];
require_files('/classes', $classes);


/** Thiết lập thư mục chứa file view (twig) */
Timber::$dirname = array( 'views' );

/** Auto Escape */
Timber::$autoescape = false;

/** Khởi tạo Cấu hình theme */
new ThemeConfig;