<?

namespace navquery;

class Walker_Nav_Menu_Edit extends \Walker_Nav_Menu_Edit{
	/*
	*
	*	@param string
	*	@param object
	*	@param int
	*	@param array
	*	@param int
	*	@return string
	*/
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ){
		if( $item->type != 'wp_query')
			return parent::start_el( $output, $item, $depth, $args, $id );
		
		$vars = (object) array(
			'cancel_href' => esc_url( 
								add_query_arg( 
									array( 
										'edit-menu-item' => $item_id, 
										'cancel' => time() 
									), admin_url( 'nav-menus.php' )
								) 
							 ),
			'delete_href' => wp_nonce_url(
								add_query_arg(
									array(
										'action' => 'delete-menu-item',
										'menu-item' => $item->ID,
									),
									admin_url( 'nav-menus.php' )
								),
								'delete-menu_item_' . $item->ID
							 ),
			'depth' => $depth,
			'item_id' => esc_attr( $item->ID ),
			'menu_item_parent' => $item->menu_item_parent,
			'menu_order' => $item->menu_order,
			'object_id' => $item->object_id,
			'submenu_text' => $depth < 1 ? 'style="display:none;"' : '',
			'title' => trim( $item->title ) ? $item->title : 'WP_Query'
		);
		
		$removed_args = array(
			'action',
			'customlink-tab',
			'edit-menu-item',
			'menu-item',
			'page-tab',
			'_wpnonce',
		);
		
		if( isset($_GET['edit-menu-item']) && $item->ID == $_GET['edit-menu-item'] )
			$vars->control_href = admin_url( 'nav-menus.php' );
		else
			$vars->control_href = add_query_arg( 'edit-menu-item', $item->ID, remove_query_arg($removed_args, admin_url('nav-menus.php#menu-item-settings-' . $item->ID)) );
		
		// @TODO get pretty print to work for < 5.4
		// @see http://stackoverflow.com/questions/6054033/pretty-printing-json-with-php
		$object = unserialize( $item->object );
		
		if( defined('JSON_PRETTY_PRINT') )
			$vars->object = json_encode( $object, JSON_PRETTY_PRINT );
		else
			$vars->object = json_encode( $object );
			
		//$vars->object = urldecode( http_build_query($object) );
		
		$output .= render( 'admin/nav-menus-edit', $vars );
	}
}