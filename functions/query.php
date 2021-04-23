<?php
function get_posts_by_category($cat_id, $number){
    $posts = new Timber\PostQuery([
        'category__in'  => $cat_id, 
        'numberposts'   => $number
    ]);
    return $posts;
}

function get_posts_by_term($term_id, $post_type, $taxonomy, $number){
    $posts = new Timber\PostQuery([
        'post_type' => $post_type,
        'tax_query' => array(
            array(
                'taxonomy'      =>  $taxonomy,
                'field'         =>  'term_id',
                'terms'         =>  $term_id,
            ),
        ),
        'numberposts' => $number
    ]);
    return $posts;
}

function get_cats($post_id){
    $terms = wp_get_post_terms($post_id, 'category');
    return $terms;
}

function get_new_posts($number){
    $posts = new Timber\PostQuery([
        'post_type'   => array('post'),
        'numberposts' => $number
    ]);
    return $posts;
}