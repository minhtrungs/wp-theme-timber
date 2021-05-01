<?php
namespace Config;
class PostType
{
    public function __construct() {
		// add_action( 'init', array( $this, 'product_post_type' ) );
	}

    public function product_post_type(){
        $labels = array(
            'name'                  => _x( 'Sản phẩm', 'Post Type General Name', TEXTDOMAIN ),
            'singular_name'         => _x( 'Sản phẩm', 'Post Type Singular Name', TEXTDOMAIN ),
            'menu_name'             => __( 'Sản phẩm', TEXTDOMAIN ),
            'name_admin_bar'        => __( 'Sản phẩm', TEXTDOMAIN ),
            'archives'              => __( 'Sản phẩm', TEXTDOMAIN ),
            'attributes'            => __( 'Sản phẩm', TEXTDOMAIN ),
            'parent_item_colon'     => __( 'Sản phẩm', TEXTDOMAIN ),
            'all_items'             => __( 'Danh sách sản phẩm', TEXTDOMAIN ),
            'add_new_item'          => __( 'Thêm sản phẩm', TEXTDOMAIN ),
            'add_new'               => __( 'Thêm sản phẩm', TEXTDOMAIN ),
		    'new_item'              => __( 'Thêm sản phẩm', TEXTDOMAIN ),
        );
        $rewrite = array(
            'slug'                  => 'product',
            'with_front'            => true,
            'pages'                 => true,
            'feeds'                 => true,
        );
        $args = array(
            'label'                 => __( 'Sản phẩm', TEXTDOMAIN ),
            'description'           => __( 'Sản phẩm', TEXTDOMAIN ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'thumbnail', 'editor'),
            'taxonomies'            => array( 'product-category' ),
            'hierarchical'          => true,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 6,
            'menu_icon' 			=> 'dashicons-store',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => true,
            'publicly_queryable'    => true,
            'capability_type'       => 'post',
            'show_in_rest' 			=> false,
            'rewrite'               => $rewrite
        );
        register_post_type( 'product', $args );
    }
}