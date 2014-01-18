<?php
/*
Plugin Name: NAV QUERY
Plugin URI: 
Description: create dynamic nav menus using wp_query
Author: pinecone-dot-io
Version: 0.4
Author URI: http://pinecone.io/
*/

register_activation_hook( __FILE__, create_function("", '$ver = "5.3"; if( version_compare(phpversion(), $ver, "<") ) die( "This plugin requires PHP version $ver or greater be installed." );') );

require __DIR__.'/index.php';