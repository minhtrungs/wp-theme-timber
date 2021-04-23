<?php
/** File này xử lý dữ liệu cho trang tìm kiếm */
$context          = Timber::context();
$context['title'] = 'Kết quả tìm kiếm của từ khóa" '. get_search_query().'"';
$context['posts'] = new Timber\PostQuery();

Timber::render( 'search.html', $context );
