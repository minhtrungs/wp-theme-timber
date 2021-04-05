<?php
namespace Config;
class Enqueue
{
    public function __construct(){
        add_action( 'wp_enqueue_scripts', array( $this, 'guest_styles' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'guest_scripts' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_styles' ));
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ));
    }
    public function guest_styles(){
        wp_enqueue_style( 'bvpnt-bootstrap', THEME_DIR . '/public/css/bootstrap.css', array(), THEME_VERSION );
    }
    public function guest_scripts(){
        // wp_enqueue_script( 'bvpnt-jquery', THEME_DIR . '/public/js/jquery.js', array(), THEME_VERSION, false );
    }

    public function admin_styles(){
        // wp_enqueue_script( 'bvpnt-jquery', THEME_DIR . '/public/js/jquery.js', array(), THEME_VERSION, false );
    }

    public function admin_scripts(){
        // wp_enqueue_script( 'bvpnt-jquery', THEME_DIR . '/public/js/jquery.js', array(), THEME_VERSION, false );
    }
}