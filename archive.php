<?php
/**
 * File này xử lý cho các trang taxonomy, category, ngày tháng, index...
 * Nếu là custom taxonomy nó sẽ load theo thứ tự ưu tiên sau: taxonomy.php -> taxonomy_taxname.php -> archive.php
 * Nếu taxonomy là category hoặc tag sẽ load ưu tiên theo file category.php hoặc tag.php
 */

$templates = array( 'archive.html', 'index.html' );

$context = Timber::context();

$context['title'] = 'Archive';
if ( is_day() ) {
	$context['title'] = 'Archive: ' . get_the_date( 'D M Y' );
} elseif ( is_month() ) {
	$context['title'] = 'Archive: ' . get_the_date( 'M Y' );
} elseif ( is_year() ) {
	$context['title'] = 'Archive: ' . get_the_date( 'Y' );
} elseif ( is_tag() ) {
	$context['title'] = single_tag_title( '', false );
} elseif ( is_category() ) {
	$context['title'] = single_cat_title( '', false );
	array_unshift( $templates, 'archive-' . get_query_var( 'cat' ) . '.html' );
} elseif ( is_post_type_archive() ) {
	$context['title'] = post_type_archive_title( '', false );
	array_unshift( $templates, 'archive-' . get_post_type() . '.html' );
}

$context['posts'] = new Timber\PostQuery();

Timber::render( $templates, $context );
