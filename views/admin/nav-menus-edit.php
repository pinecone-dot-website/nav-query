<li>
	<dl class="menu-item-bar">
		<dt class="menu-item-handle">
			<span class="item-title">
				<span class="menu-item-title"><?= esc_html( $title ); ?></span>
				<span class="is-submenu" <?= $submenu_text; ?>><? _e( 'sub item' ); ?></span>
			</span>
		</dt>
	</dl>
	
	<div class="menu-item-settings" id="menu-item-settings-<?= $item_id; ?>">
		<textarea class="full" name="menu-item-object[<?= $item_id; ?>]"><?= esc_attr( $object ); ?></textarea>
		
		<input type="text" class="menu-item-data-db-id" name="menu-item-db-id[<?= $item_id; ?>]" value="<?= $item_id; ?>" />
		<input type="text" class="menu-item-data-object-id" name="menu-item-object-id[<?= $item_id; ?>]" value="<?= esc_attr( $object_id ); ?>" />
		
		<input type="text" class="menu-item-data-parent-id" name="menu-item-parent-id[<?= $item_id; ?>]" value="<?= esc_attr( $menu_item_parent ); ?>" />
		<input type="text" class="menu-item-data-position" name="menu-item-position[<?= $item_id; ?>]" value="<?= esc_attr( $menu_order ); ?>" />
		<input type="text" class="menu-item-data-title" name="menu-item-title[<?= $item_id; ?>]" value="<?= esc_attr( $title ); ?>" />
		<input type="text" class="menu-item-data-type" name="menu-item-type[<?= $item_id; ?>]" value="<?= esc_attr( $type ); ?>" />
	</div>		
</li>