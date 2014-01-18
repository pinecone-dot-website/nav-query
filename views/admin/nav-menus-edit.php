<li id="menu-item-<?php echo $item_id; ?>" class="menu-item menu-item-page menu-item-edit-inactive menu-item-depth-<?php echo $depth; ?>">
	<dl class="menu-item-bar">
		<dt class="menu-item-handle">
			<span class="item-title">
				<span class="menu-item-title"><?php echo esc_html( $title ); ?></span>
				<span class="is-submenu" <?php echo $submenu_text; ?>><?php _e( 'sub item' ); ?></span>
			</span>
			
			<span class="item-controls">
				<span class="item-type">WP Query</span>
				<span class="item-order hide-if-js">
				
				</span>
				
				<a class="item-edit" id="edit-<?php echo $item_id; ?>" title="<?php esc_attr_e( 'Edit Menu Item' ); ?>" href="<?php echo $control_href; ?>">Edit WP_Query</a>
			</span>
		</dt>
	</dl>
	
	<div class="menu-item-settings nav-query" id="menu-item-settings-<?php echo $item_id; ?>">
		<p class="description description-thin">
			<label for="">
				Navigation Label<br/>
				<input type="text" class="menu-item-data-title" name="menu-item-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $title ); ?>" />
			</label>
		</p>
		
		<textarea name="menu-item-object[<?php echo $item_id; ?>]"><?php echo esc_attr( $object ); ?></textarea>
		
		<div class="menu-item-actions description-wide submitbox">
			<a class="item-delete submitdelete deletion" id="delete-<?php echo $item_id; ?>" href="<?php echo $delete_href; ?>"><?php _e( 'Remove' ); ?></a>
						
			<span class="meta-sep hide-if-no-js"> | </span>
			
			<a class="item-cancel submitcancel hide-if-no-js" id="cancel-<?php echo $item_id; ?>" href="<?php echo $cancek_href; ?>#menu-item-settings-<?php echo $item_id; ?>"><?php _e( 'Cancel' ); ?></a>
		</div>
	
		<input type="hidden" class="menu-item-data-db-id" name="menu-item-db-id[<?php echo $item_id; ?>]" value="<?php echo $item_id; ?>" />
		<input type="hidden" class="menu-item-data-object-id" name="menu-item-object-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $object_id ); ?>" />
		
		<input type="hidden" class="menu-item-data-parent-id" name="menu-item-parent-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $menu_item_parent ); ?>" />
		<input type="hidden" class="menu-item-data-position" name="menu-item-position[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $menu_order ); ?>" />
		<input type="hidden" class="menu-item-data-type" name="menu-item-type[<?php echo $item_id; ?>]" value="wp_query" />
	</div>		
	
	
</li>