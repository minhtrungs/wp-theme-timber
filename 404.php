<?php
/** File này xử lý cho trang 404 */

$context = Timber::context();
Timber::render( '404.html', $context );
