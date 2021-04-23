<?php
/** 
* Khi không chọn trang bất kỳ làm trang chủ thì file này sẽ được load
* Hầu như không bao giờ dùng đến, vì vậy không cần viết template cho nó cũng được. 
*/
$context          = Timber::context();
$context['posts'] = new Timber\PostQuery();
$templates        = array( 'index.html' );
if ( is_home() ) {
	$templates    = array( 'home.html' );
}
Timber::render( $templates, $context );
