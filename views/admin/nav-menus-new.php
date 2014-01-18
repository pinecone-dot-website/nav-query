<div id="nav-query-post" class="posttypediv">
	<div class="tabs-panel-active">
		<div class="categorychecklist">
			<ul>
				<li>
					<label><input type="checkbox" name="menu-item[-1][menu-item-nav-query]" value="where-is-this" checked="checked"/></label>
					
					<input type="text" value="WP_Query" name="menu-item[-1][menu-item-object-id]" class="menu-item-nav-query">
					
					<input type="text" value="<?= esc_html( $default ); ?>" name="menu-item[-1][menu-item-object]" class="menu-item-nav-query">
					<input type="text" value="WP_Query" name="menu-item[-1][menu-item-type]" class="menu-item-nav-query">
				</li>
			</ul>
		</div>
		<input type="submit" id="submit-nav-query-post" name="add-nav-query-menu-item" class="button-secondary submit-add-to-menu right" value="Add WP_Query"/>
	</div>
</div>