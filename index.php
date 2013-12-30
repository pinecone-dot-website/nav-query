<?
/*
Plugin Name: NAV QUERY
Plugin URI: 
Description: 
Author: 
Version: 0.0.1
Author URI: 
*/

namespace navquery;

if( is_admin() )
	require __DIR__.'/admin.php';

/*
*	format post object into nav_item compatible
*/
function menu_objects_format( &$post, $index, $args ){
	$post->menu_item_parent = $args['menu_item_parent'];
	$post->title = $post->post_title;
	$post->url = get_permalink( $post->ID );
}

/*
*
*	@param array
*	@param object
*	@return	array
*/
function wp_nav_menu_objects( $sorted_menu_items, $args ){
	
	foreach( $sorted_menu_items as $k => $item ){
		//dbug( (array) $item );
		
		if( $item->type != 'wp_query' )
			continue;
		
		$args = unserialize( $item->object );
		//ddbug($args);
		
		$sub_query = new \WP_Query( $args );
		//ddbug($sub_query->request);
		
		$start = array_slice( $sorted_menu_items, 0, $k - 1 );
		$end = array_slice( $sorted_menu_items, $k );
		
		$menu_items = array_walk( $sub_query->posts, __NAMESPACE__.'\menu_objects_format', 
								  array('menu_item_parent' => $item->menu_item_parent) );
		
		$sorted_menu_items = array_merge( $start, $sub_query->posts, $end );
		//ddbug( (array) $item );
	}
	
	return $sorted_menu_items;
}
add_filter( 'wp_nav_menu_objects', __NAMESPACE__.'\wp_nav_menu_objects', 10, 2 );

function render( $file, $vars = array() ){
	extract( (array) $vars );
	
	ob_start();
	
	require __DIR__.'/views/'.$file.'.php';
	$html = ob_get_contents();
	
	ob_end_clean();
	
	return $html;
}