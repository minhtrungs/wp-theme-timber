<?php
/** 
 * Trong Timber file header.php và footer.php gần như sẽ không cần dùng đến
 * Trường hợp sẽ dùng đến là khi các plugin thứ 3 có gọi đến 2 hàm là get_header() và get_footer() như woocommerce, forum...
 */

$timberContext = $GLOBALS['timberContext'];
if ( ! isset( $timberContext ) ) {
	throw new \Exception( 'Chưa gọi context.' );
}
$timberContext['content'] = ob_get_contents();
ob_end_clean();

/** Template page-plugin.html sẽ được sử dụng khi các plugin có sử dụng get_header() và get_footer() */
Timber::render( 'page-plugin.html', $timberContext );
