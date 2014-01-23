<?php
/*
Plugin Name:	NAV QUERY
Plugin URI:		http://wordpress.org/plugins/nav-query/
Description:	create dynamic nav menus using wp_query
Author:			postpostmodern, pinecone-dot-io
Version:		0.41
Author URI:		http://pinecone.io/
*/

register_activation_hook( __FILE__, create_function("", '$ver = "5.3"; if( version_compare(phpversion(), $ver, "<") ) die( "This plugin requires PHP version $ver or greater be installed." );') );

require __DIR__.'/index.php';