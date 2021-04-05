<?php
namespace Config;
class Taxonomy
{
    public function __construct() {
		add_action( 'init', array( $this, 'register_taxonomies' ) );
	}
    
	public function register_taxonomies() {

	}
}