<?php

/*
Plugin Name: Advanced Custom Fields: GeoJSON
Plugin URI: https://github.com/tomablan/acf-geojson
Description: This plugins adds a new type of field into Advanced Custom Field. It displays an OpenStreetMap as input and output data as GeoJSON format.
Version: 1.0.0
Author: Thomas BLANC
Author URI: https://twitter.com/tomablan
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

// exit if accessed directly
if( ! defined( 'ABSPATH' ) ) exit;


// check if class already exists
if( !class_exists('agj_acf_plugin_geojson') ) :

class agj_acf_plugin_geojson {
	
	// vars
	var $settings;
	
	
	/*
	*  __construct
	*
	*  This function will setup the class functionality
	*
	*  @type	function
	*  @date	17/02/2016
	*  @since	1.0.0
	*
	*  @param	void
	*  @return	void
	*/
	
	function __construct() {
		
		// settings
		// - these will be passed into the field class.
		$this->settings = array(
			'version'	=> '1.0.0',
			'url'		=> plugin_dir_url( __FILE__ ),
			'path'		=> plugin_dir_path( __FILE__ )
		);
		
		
		// include field
		add_action('acf/include_field_types', 	array($this, 'include_field')); // v5
		add_action('acf/register_fields', 		array($this, 'include_field')); // v4
	}
	
	
	/*
	*  include_field
	*
	*  This function will include the field type class
	*
	*  @type	function
	*  @date	17/02/2016
	*  @since	1.0.0
	*
	*  @param	$version (int) major ACF version. Defaults to false
	*  @return	void
	*/
	
	function include_field( $version = false ) {
		
		// support empty $version
		if( !$version ) $version = 4;
		
		
		// load acf-geojson
		load_plugin_textdomain( 'acf-geojson', false, plugin_basename( dirname( __FILE__ ) ) . '/lang' ); 
		
		
		// include
		include_once('fields/class-agj-acf-field-geojson-v' . $version . '.php');
	}
	
}


// initialize
new agj_acf_plugin_geojson();


// class_exists check
endif;
	
?>