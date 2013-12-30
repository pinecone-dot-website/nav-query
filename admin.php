<?

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
		'default' => serialize( array(
			'paged' => 1,
			'posts_per_page' => 5,
			'post_type' => 'post',
			'tax_query' => array(
				array(
					'taxonomy' => 'artist_status',
					'field' => 'slug',
					'terms' => 'current',
				)
			)
		) )
	);
	
	echo render( 'admin/nav-menus-new', $vars );
}

/*
*
*	@param string
*	@param int
*	@return string
*/
function wp_edit_nav_menu_walker( $walker_class_name, $menu_id ){
	wp_register_style( 'nav-query', plugins_url('/public/admin/nav-menus.css', __FILE__) );
	wp_enqueue_style( 'nav-query' );
	
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
		
	$object = $args['menu-item-object'];
	
	// from update
	if( ($_object = json_decode(stripslashes($object))) && is_object($_object) ){
		$object = $_object;
	} elseif( ($_object = unserialize(stripslashes($object))) ){
		$object = $_object;
	}
	
	// @TODO make this better, handle dynamic stuff
	if( isset($object->tax_query) ){
		foreach( $object->tax_query as &$tax_query )
			$tax_query = (array) $tax_query;
			
		//ddbug($object->tax_query);
	}
	
	$object = serialize( $object );
	
	update_post_meta( $menu_item_db_id, '_menu_item_object', $object );
}
add_action( 'wp_update_nav_menu_item', __NAMESPACE__.'\wp_update_nav_menu_item', 10, 3 );