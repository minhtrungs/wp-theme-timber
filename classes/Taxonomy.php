<?php
namespace Config;
class Taxonomy
{
    public function __construct() {
		// add_action( 'init', array( $this, 'product_category_taxonomy' ) );
	}
    
	public function product_category_taxonomy() {
		$labels = array(
			'name'                       => _x( 'Danh mục sản phẩm', 'Taxonomy General Name', TEXTDOMAIN ),
			'singular_name'              => _x( 'Danh mục sản phẩm', 'Taxonomy Singular Name', TEXTDOMAIN ),
			'menu_name'                  => __( 'Danh mục sản phẩm', TEXTDOMAIN ),
			'all_items'                  => __( 'Tất cả danh mục', TEXTDOMAIN ),
			'new_item_name'              => __( 'Thêm danh mục', TEXTDOMAIN ),
			'add_new_item'               => __( 'Thêm danh mục', TEXTDOMAIN ),
			'edit_item'                  => __( 'Sửa danh mục', TEXTDOMAIN ),
			'update_item'                => __( 'Sửa danh mục', TEXTDOMAIN ),
			'view_item'                  => __( 'Xem danh mục', TEXTDOMAIN )
		);
		$rewrite = array(
			'slug' => 'product-category', 
			'with_front' => true 
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'rewrite'                    => $rewrite
		);
		register_taxonomy( 'product_category', array( 'product' ), $args );
	}
}