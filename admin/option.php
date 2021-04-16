<?php
//** Khai báo Option Page của ACF */
if( function_exists('acf_add_options_page') ) {

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Cài đặt chung',
        'menu_title'	=> 'Cài đặt chung',
        'parent_slug'	=> 'themes.php',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Cài đặt header',
        'menu_title'	=> 'Cài đặt header',
        'parent_slug'	=> 'themes.php',
    ));
    
    acf_add_options_sub_page(array(
        'page_title' 	=> 'Cài đặt footer',
        'menu_title'	=> 'Cài đặt footer',
        'parent_slug'	=> 'themes.php',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Cài đặt sidebar',
        'menu_title'	=> 'Cài đặt sidebar',
        'parent_slug'	=> 'themes.php',
    ));
}