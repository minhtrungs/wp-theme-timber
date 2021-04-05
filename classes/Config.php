<?php
class ThemeConfig extends Timber\Site {
	/** Add timber support. */
	public function __construct() {
		new Config\Enqueue;
		new Config\PostType;
		new Config\Taxonomy;
		parent::__construct();
		add_action( 'after_setup_theme', array( $this, 'theme_supports' ) );
		add_filter( 'timber/context', array( $this, 'add_to_context' ) );
		add_filter( 'timber/twig', array( $this, 'add_to_twig' ) );
	}

	/**
	 * Thiết lập các giá trị sẽ truyền vào mảng context
	 * Sử dụng các giá trị này bằng phương thức Timber::context()
	 */
	public function add_to_context( $context ) {
		/** Sẽ sử dụng menu mặc định nếu không truyền tên menu vào đối số */
		$context['menu']  = new Timber\Menu();
		/**  */
		$context['site']  = $this;
		return $context;
	}

	/** Theme support, khởi tạo các tính năng thường dùng trong cms */
	public function theme_supports() {
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/** Cho phép hiển thị tiêu đề trên tab trình duyệt. */
		add_theme_support( 'title-tag' );

		/** Cho phép chọn thumbnail trong trang soạn thảo */
		add_theme_support( 'post-thumbnails' );

		/** Khai báo các thẻ html5 sẽ được sử dụng */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/** Định dạng post */
		add_theme_support(
			'post-formats',
			array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
				'gallery',
				'audio',
			)
		);

		/** Khởi tạo menu cho website, tên của menu mặc định luôn luôn là 'menus' */
		add_theme_support( 'menus' );
	}

	/** This is where you can add your own functions to twig. */
	public function add_to_twig( $twig ) {
		$twig->addExtension( new Twig\Extension\StringLoaderExtension() );
		/**
		 * Tạo custom filter để sử dụng trong twig 
		 * Ví dụ như filter chuyển tất cả các ký tự sau khoảng trống thành chữ in hoa
		*/
		$twig->addFilter( new Twig\TwigFilter( 'filter_key', array( $this, 'filter_method' ) ) );
		/**
		 * Khai báo hàm sẽ được gọi trong twig 
		 * Cú pháp gọi hàm trong twig {% fn('callback_function') %}
		 */
		$twig->addFunction( new Timber\Twig_Function( 'callback_function' ) );

		return $twig;
	}

	/** Phương thức xử lý giá trị được filter gửi đến */
	public function filter_method( $text ) {
		$text .= ' test!';
		return $text;
	}
}