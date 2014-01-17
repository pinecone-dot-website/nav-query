<?php

namespace navquery;

/*
*
*	attached to `load-nav-menus.php` action
*/
function add_meta_boxes_navmenu(){
	add_meta_box( 'add-nav-query', 'WP Query', __NAMESPACE__.'\add_meta_boxes_navmenu_render', 
				  'nav-menus', 'side' );
}				  
add_action( 'load-nav-menus.php', __NAMESPACE__.'\add_meta_boxes_navmenu', 10 );

/*
*
*	@param unknown
*	@param array
*/
function add_meta_boxes_navmenu_render( $null, $args ){
	$vars = array(
		'default' => json_encode( array(
			'paged' => 1,
			'posts_per_page' => 5,
			'post_type' => 'post'
		) )
	);
	
	echo render( 'admin/nav-menus-new', $vars );
}

/*
*	recursively change all stdclass into arrays
*/
function make_arrays_r( &$r ){
	if( is_object($r) )
		$r = (array) $r;
		
	if( is_array($r) || is_object($r) )
		foreach( $r as &$sub )
			make_arrays_r( $sub );
}

/*
*
*	@param string
*	@param int
*	@return string
*/
function wp_edit_nav_menu_walker( $walker_class_name, $menu_id ){
	wp_register_style( 'nav-query', NAV_QUERY_PLUGINS_URL.'admin/nav-menus.css' );
	wp_enqueue_style( 'nav-query' );
	
	wp_register_script( 'nav-query', NAV_QUERY_PLUGINS_URL.'admin/nav-menus.js', array('jquery') );
	wp_enqueue_script( 'nav-query' );
	
	require __DIR__.'/lib/walker-nav-menu-edit.php';
	return __NAMESPACE__.'\Walker_Nav_Menu_Edit';
}
add_filter( 'wp_edit_nav_menu_walker', __NAMESPACE__.'\wp_edit_nav_menu_walker', 10, 2 );

/*
*
*	@param int
*	@param int
*	@param array
*/
function wp_update_nav_menu_item( $menu_id, $menu_item_db_id, $args ){
	if( $args['menu-item-type'] != 'wp_query' )
		return;
		
	$object = stripslashes( $args['menu-item-object'] );
	
	// from update
	if( ($_object = json_decode($object)) && is_object($_object) ){
		// json syntax
		$object = $_object;
	} elseif( ($_object = unserialize($object)) ){
		// serialized php
		$object = $_object;
	} elseif( parse_str($object, $_object) || count( array_filter($_object)) ){
		// query string
		$object = $_object;
	/*
	} elseif( trim($object) ){
		// using native php array syntax - probably a bad idea 
		$tokens = token_get_all( '<?php '.$object.' ?>' ); 
		
		foreach( $tokens as $token ){
			//dbug( $token, token_name($token[0]) );
		}
	*/
	} else {
		$object = '';
	}
	
	make_arrays_r( $object );
	//
	
	$object = serialize( $object );
	
	update_post_meta( $menu_item_db_id, '_menu_item_object', $object );
}
add_action( 'wp_update_nav_menu_item', __NAMESPACE__.'\wp_update_nav_menu_item', 10, 3 );