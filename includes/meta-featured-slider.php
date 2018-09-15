<?php
$prefix = 'tj_';
$meta_box_slide = array(
	'id' => 'tj-meta-box-slide',
	'title' =>  __('Slide Settings', 'themejunkie'),
	'page' => 'slide',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
	array(
			'name' =>  __('Slide Image ', 'themejunkie'),
			'desc' => __('Upload an image or enter an URL to your slide image', 'themejunkie'),
			'id' => $prefix.'slide_image',
			'type' => 'text',
			'std' => ''
		),
	array(
			'name' => '',
			'desc' => '',
			'id' => $prefix.'slide_image_button',
			'type' => 'button',
			'std' => 'Browse'
		),
    array( 'name' => __('Short Description','themejunkie'),
				'desc' => __('Enter a short description to the slide ','themejunkie'),
				'id' => $prefix.'slide_desc',
				'type' => 'text',
				'std' => 'Short description...'
		),

    array( 'name' => __('URL','themejunkie'),
				'desc' => __('Enter URL if you want to add a link to the uploaded image and title. (optional) ','themejunkie'),
				'id' => $prefix.'slide_url',
				'type' => 'text'
		)		
	),


);
add_action('admin_menu', 'tj_add_box_slide');
/*-----------------------------------------------------------------------------------*/
/*	Add metabox to edit page
/*-----------------------------------------------------------------------------------*/

function tj_add_box_slide() {
	global $meta_box_slide;

	add_meta_box($meta_box_slide['id'], $meta_box_slide['title'], 'tj_show_box_slide', $meta_box_slide['page'], $meta_box_slide['context'], $meta_box_slide['priority']);

}
/*-----------------------------------------------------------------------------------*/
/*	Callback function to show fields in meta box
/*-----------------------------------------------------------------------------------*/
function tj_show_box_slide() {
	global $meta_box_slide, $post;

    echo '<p style="padding:10px 0 0 0;"></p>';
    // Use nonce for verification
    echo '<input type="hidden" name="tj_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

    echo '<table class="form-table">';

    foreach ($meta_box_slide['fields'] as $field) {
        // get current post meta data
        $meta = get_post_meta($post->ID, $field['id'], true);
        switch ($field['type']) {


            //If Text
            case 'text':

            echo '<tr style="border-top:1px solid #eeeeee;">',
                '<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="line-height:20px; display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
                '<td>';
            echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'],'" size="30" style="width:75%; margin-right: 20px; float:left;" />';

            break;

            //If textarea
            case 'textarea':

            echo '<tr style="border-top:1px solid #eeeeee;">',
                '<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="line-height:18px; display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
                '<td>';
            echo '<textarea name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" rows="8" cols="5" style="width:100%; margin-right: 20px; float:left;">', $meta ? $meta : $field['std'], '</textarea>';

            break;

            //If Button
            case 'button':
                echo '<input style="float: left;" type="button" class="button" name="', $field['id'], '" id="', $field['id'], '"value="', $meta ? $meta : $field['std'], '" />';
                echo 	'</td>',
            '</tr>';

            break;
        }
    }

    echo '</table>';

}

add_action('save_post', 'tj_save_data_slide');
/*-----------------------------------------------------------------------------------*/
/*	Save data when post is edited
/*-----------------------------------------------------------------------------------*/

function tj_save_data_slide($post_id) {
	global $meta_box_slide;

	// verify nonce
	if (!wp_verify_nonce($_POST['tj_meta_box_nonce'], basename(__FILE__))) {
		return $post_id;
	}

	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}

	// check permissions
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}

	foreach ($meta_box_slide['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];

		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
}
 
