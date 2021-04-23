<?php
/** File này xử lý dữ liệu cho các trang chi tiết bài viết (post hoặc custom post type) */
$context  			= 	Timber::context();
$post				= 	Timber::get_post();
$context['post'] 	= 	$post;

if( post_password_required( $post->ID ) ) {
	//** Sử dụng template password.html nếu bài viết có đặt mật khẩu */
	Timber::render( 'single/password.html', $context );
}else {
	//** Nếu là bài viết bình thường thì sử dụng template content.html */
	Timber::render( 'single/content.html', $context );
}