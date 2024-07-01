<div class="wrap">
	<h1 class="wp-heading-inline">Customized Posts</h1>

	<div class="tablenav top">
		<form method="get" action="<?php echo admin_url('admin.php'); ?>">
			<input type="hidden" name="page" value="academy_wp_plugin">
			<div class="alignleft actions bulkactions">
				<?php
					$selected_category = isset( $_GET['customized_category'] ) ? $_GET['customized_category'] : '-1';
				?>
				<select name="customized_category" id="bulk-action-selector-top">
					<option value="-1" <?php selected( '-1', $selected_category ); ?> >All Categories</option>
					<?php foreach( $terms as $term ) : ?>
					<option value="<?php echo esc_attr($term->term_id); ?>" <?php selected( $term->term_id, $selected_category ); ?>>
						<?php echo $term->name; ?>
					</option>
					<?php endforeach; ?>
				</select>
				<?php //print_r( $terms ); ?>
				<?php
					$selected_tag = isset($_GET['filter_by_tag']) ? $_GET['filter_by_tag'] : '';
				?>
				<select name="filter_by_tag" id="customized_tag">
					<option value="" <?php selected( '', $selected_tag ); ?> >All Tags</option>
					<?php

					$tags = get_tags(array(
						'hide_empty' => false,
					));

					foreach( $tags as $tag ) :

					?>
					<option value="<?php echo esc_attr($tag->term_id);?>" <?php selected( $tag->term_id, $selected_tag ); ?>>
						<?php echo $tag->name; ?>
					</option>
					<?php endforeach; ?>
				</select>
				<input type="submit" name="filter_action" id="post-query-submit" class="button" value="Filter">
			</div>
		</form>
	</div>

	<table class="wp-list-table widefat fixed striped table-view-list posts">
		<thead>
			<tr>
				<th>Title</th>
				<th>Author</th>
				<th>Categories</th>
				<th>Tags</th>
			</tr>
		</thead>
		<tbody>
			<?php

				foreach( $posts as $post ) :
					$author = get_user_by( 'id', $post->post_author );
					$post_categories = wp_get_post_categories( $post->ID , array( 'fields' => 'names' ) );
					$post_tags = wp_get_post_tags( $post->ID , array( 'fields' => 'names' ) );
			?>
			<tr>
				<td><?php echo $post->post_title; ?></td>
				<td><?php echo $author->data->display_name; ?></td>
				<?php
					if( $post_categories ){
						foreach($post_categories as $name){
				?>
				<td><?php echo $name; ?></td>
				<?php } } ?>
				<td>
					<?php
					if( $post_tags ){
						foreach($post_tags as $name){
					?>
					<?php echo $name . ','; ?>
					<?php } } ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
