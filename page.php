<?php
/** File này xử lý dữ liệu cho những trang có template mặc định */
$context            =   Timber::context();
$post               =   new Timber\Post();
$context['post']    =   $post;
/** Page hay post type bất kỳ thì bản chất vẫn đều là post */

Timber::render( 'page.html', $context );
