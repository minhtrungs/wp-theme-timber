<?php
//Các thông số cố định
define( 'THEME_VERSION', 	'1.0.0' );
define( 'TEXTDOMAIN', 'textdomain' );
define( 'THEME_DIR', 	get_template_directory_uri() );
define( 'THEME_ROOT', 	get_template_directory() );

 /** Require Timber */
$composer_autoload = __DIR__ . '/vendor/autoload.php';
if ( file_exists( $composer_autoload ) ) {
	require_once $composer_autoload;
	$timber = new Timber\Timber();
}

/** Thông báo nếu chưa cài Package */
if ( ! class_exists( 'Timber' ) ) {

	add_action(
		'admin_notices',
		function() {
			echo '<div class="error"><p>Chưa tải package Timber</p></div>';
		}
	);

	add_filter(
		'template_include',
		function( $template ) {
			return get_stylesheet_directory() . '/public/error.html';
		}
	);
	return;
}

/** Thiết lập thư mục chứa file view (twig) */
Timber::$dirname = array( 'views' );

/** Auto Escape */
Timber::$autoescape = false;

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

/** Khởi tạo Cấu hình theme */
new ThemeConfig;