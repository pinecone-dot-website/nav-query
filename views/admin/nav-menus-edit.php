<li id="menu-item-<?= $item_id; ?>" class="menu-item menu-item-page menu-item-edit-inactive menu-item-depth-<?= $depth; ?>">
	<dl class="menu-item-bar">
		<dt class="menu-item-handle">
			<span class="item-title">
				<span class="menu-item-title"><?= esc_html( $title ); ?></span>
				<span class="is-submenu" <?= $submenu_text; ?>><? _e( 'sub item' ); ?></span>
			</span>
			
			<span class="item-controls">
				<span class="item-type">WP Query</span>
				<span class="item-order hide-if-js">
				
				</span>
				
				<a class="item-edit" id="edit-<?= $item_id; ?>" title="<? esc_attr_e( 'Edit Menu Item' ); ?>" href="<?= $control_href; ?>">Edit WP_Query</a>
			</span>
		</dt>
	</dl>
	
	<div class="menu-item-settings" id="menu-item-settings-<?= $item_id; ?>">
		<input type="text" class="menu-item-data-title" name="menu-item-title[<?= $item_id; ?>]" value="<?= esc_attr( $title ); ?>" />
		
		<textarea class="full js" name="menu-item-object[<?= $item_id; ?>]"><?= esc_attr( $object ); ?></textarea>
		
		<div class="menu-item-actions description-wide submitbox">
			<a class="item-delete submitdelete deletion" id="delete-<?= $item_id; ?>" href="<?= $delete_href; ?>"><? _e( 'Remove' ); ?></a>
						
			<span class="meta-sep hide-if-no-js"> | </span>
			
			<a class="item-cancel submitcancel hide-if-no-js" id="cancel-<?= $item_id; ?>" href="<?= $cancek_href; ?>#menu-item-settings-<?= $item_id; ?>"><? _e( 'Cancel' ); ?></a>
		</div>
	
		<input type="hidden" class="menu-item-data-db-id" name="menu-item-db-id[<?= $item_id; ?>]" value="<?= $item_id; ?>" />
		<input type="hidden" class="menu-item-data-object-id" name="menu-item-object-id[<?= $item_id; ?>]" value="<?= esc_attr( $object_id ); ?>" />
		
		<input type="hidden" class="menu-item-data-parent-id" name="menu-item-parent-id[<?= $item_id; ?>]" value="<?= esc_attr( $menu_item_parent ); ?>" />
		<input type="hidden" class="menu-item-data-position" name="menu-item-position[<?= $item_id; ?>]" value="<?= esc_attr( $menu_order ); ?>" />
		<input type="hidden" class="menu-item-data-type" name="menu-item-type[<?= $item_id; ?>]" value="wp_query" />
	</div>		
	
	
</li>