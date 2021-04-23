<?php
/** 
 * Trong Timber file header.php và footer.php gần như sẽ không cần dùng đến
 * Trường hợp sẽ dùng đến là khi các plugin thứ 3 có gọi đến 2 hàm là get_header() và get_footer() như woocommerce, forum...
 */
$GLOBALS['timberContext'] = Timber::context();
ob_start();
