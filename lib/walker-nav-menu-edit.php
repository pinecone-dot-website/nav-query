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
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ){
		if( $item->type != 'wp_query')
			return parent::start_el( $output, $item, $depth, $args, $id );
		
		$vars = (object) array(
			'item_id' => esc_attr( $item->ID ),
			'menu_item_parent' => $item->menu_item_parent,
			'menu_order' => $item->menu_order,
			'object_id' => $item->object_id,
			'submenu_text' => 'sub text',
			'title' => $item->title,
			'type' => $item->type
		);
		
		// @TODO get pretty print to work for < 5.4
		// @see http://stackoverflow.com/questions/6054033/pretty-printing-json-with-php
		$object = unserialize( $item->object );
		$vars->object = json_encode( $object, JSON_PRETTY_PRINT );
		
		//$vars->object = $item->object;
		
		$output .= render( 'admin/nav-menus-edit', $vars );
	}
}