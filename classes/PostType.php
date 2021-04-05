<?php
namespace Config;
class PostType
{
    public function __construct() {
		add_action( 'init', array( $this, 'register_post_types' ) );
	}

    public function register_post_types() {

	}
}