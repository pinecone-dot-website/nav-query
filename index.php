<?php

namespace navquery;

/*
*
*	@param string
*/
spl_autoload_register( function($class){
	if( strpos($class, __NAMESPACE__) !== 0 )
		return;
		
	$class = str_replace( __NAMESPACE__.'\\', '', $class );
	$class = str_replace( '_', '-', $class );
	$class = strtolower( $class ).'.php';
	
	if( file_exists(__DIR__.'/lib/'.$class) )
		require __DIR__.'/lib/'.$class;
} );

// handy if directory is symlinked. something along the lines of
// define( 'NAV_QUERY_PLUGINS_URL', '/wp-content/plugins/nav-query/public/' );
if( !defined('NAV_QUERY_PLUGINS_URL') )
	define( 'NAV_QUERY_PLUGINS_URL', plugins_url('/public/', __FILE__) );

if( is_admin() )
	require __DIR__.'/admin.php';
	
/*
*	array_walk callback
*	format post object into nav_item compatible
*	@param WP_Post
*	@param int
*	@param array
*/
function menu_objects_format( &$post, $index, $args ){
	$post->menu_item_parent = $args['menu_item_parent'];
	$post->object = 'query';
	$post->object_id = $post->ID;
	$post->title = $post->post_title;
	$post->type = 'post_type';
	$post->url = get_permalink( $post->ID );
}

/*
*
*	@param array
*	@param object
*	@return	array
*/
function wp_nav_menu_objects( $sorted_menu_items, $args ){
	$k = 0;
	
	// for some reason it starts at 1
	$sorted_menu_items = array_values($sorted_menu_items);
	
	// doing a foreach here does not work, because of adding and removing items from $sorted_menu_items
	do{
		$item = $sorted_menu_items[$k];
		$k++;
		
		if( $item->type != 'wp_query' )
			continue;
			
		$args = unserialize( $item->object );
		
		$sub_query = new \WP_Query( $args );
		
		$start = array_slice( $sorted_menu_items, 0, $k - 1 );
		$end = array_slice( $sorted_menu_items, $k );
		
		if( $sub_query->posts ){
			array_walk( $sub_query->posts, __NAMESPACE__.'\menu_objects_format', 
									  array('menu_item_parent' => $item->menu_item_parent) );
		
		
			_wp_menu_item_classes_by_context( $sub_query->posts );
			
			$sorted_menu_items = ( array_merge($start, $sub_query->posts, $end) );
		}
	} while( isset($sorted_menu_items[$k]) );
	
	return $sorted_menu_items;
}
add_filter( 'wp_nav_menu_objects', __NAMESPACE__.'\wp_nav_menu_objects', 10, 2 );

/*
*
*/
function plugins_loaded() {
    load_plugin_textdomain( 'nav-query', FALSE, __DIR__.'/lang/' );
}
add_action( 'plugins_loaded', __NAMESPACE__.'\plugins_loaded' );

/*
*
*	@param string
*	@param array
*	@return string
*/
function render( $file, $vars = array() ){
	extract( (array) $vars );
	
	ob_start();
	
	require __DIR__.'/views/'.$file.'.php';
	$html = ob_get_contents();
	
	ob_end_clean();
	
	return $html;
}