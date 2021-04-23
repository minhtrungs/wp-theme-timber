<?php
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$term = get_queried_object();
$taxonomy =  $term->taxonomy;
$context = Timber::context();
$context['term'] = $term;

if($taxonomy === 'album_category'):
    $postype = 'album';
    $template = array('taxonomy/album-category.twig');
elseif($taxonomy === 'pack_category'):
    $postype = 'pack';
    $template = array('taxonomy/album-category.twig');
elseif($taxonomy === 'service_category'):
    $postype = 'service';
    $template = array('taxonomy/album-category.twig');
endif;
$context['posts'] = new Timber\PostQuery([
    'post_type' => $postype,
    'tax_query' => array(
        array(
            'taxonomy'      =>  $taxonomy,
            'field'         =>  'term_id',
            'terms'         =>  $term->term_id,
        ),
    ),
    'paged'                 =>  $paged,
    'posts_per_page'        =>  3
]);
Timber::render($template, $context);