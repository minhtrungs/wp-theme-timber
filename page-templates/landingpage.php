<?php 
/** Template Name: Landing Page
 *  Description: Dùng để cấu hình trang chủ và các trang giới thiệu, liên hệ...
*/

$context            =   Timber::context();
$post               =   new Timber\Post();
$context['post']    =   $post;

Timber::render( 'page-templates/landingpage.html', $context );
