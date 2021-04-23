<?php
//** Thay đổi content editor */
$editor = get_field('default_editor', 'option') ?: 'classic';
if($editor==='classic'){
	add_filter('use_block_editor_for_post', '__return_false');
}

//** Gỡ trang option mặc định do ACF tạo */
add_action('admin_init', 'remove_acf_options_page', 99);
function remove_acf_options_page() {
   remove_menu_page('acf-options');
}

//** Ẩn/hiện trang cài đặt ACF dựa vào hằng WP_DEBUG trong wp-config.php */
add_filter('acf/settings/show_admin', 'my_acf_show_admin');
function my_acf_show_admin($show) {
   return WP_DEBUG;
}
