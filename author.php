<?php
/**
 * File này xử lý dữ liệu cho trang tác giả
 */
global $wp_query;

$context          = Timber::context();
$context['posts'] = new Timber\PostQuery();
if ( isset( $wp_query->query_vars['author'] ) ) {
	$author            = new Timber\User( $wp_query->query_vars['author'] );
	$context['author'] = $author;
	$context['title']  = 'Tác giả: ' . $author->name();
}

/** Nếu có template author.html thì template author.html sẽ được ưu tiên load trước */
Timber::render( array( 'author.html', 'archive.html' ), $context );
