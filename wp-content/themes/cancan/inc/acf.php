<?php

/**

 * Name: pd_acf_flexible_content_layout_title();
 * Allows you to have the section display the name when in wp-admin page edit.
 * @since  1.0.0
 * @param $title, $field, $layout, $i
 * @return string $title
 **/
if
( function_exists('acf_add_options_page') )
{

	acf_add_options_page();

}

function acf_load_pm_field_choices( $field )
{

	// reset choices
	$field['choices'] = array();

	// get the textarea value from options page without any formatting
	$choices = get_field('my_select_values', 'option', false);

	// explode the value so that each line is a new array piece
	$choices = explode("\n", $choices);

	// remove any unwanted white space
	$choices = array_map('trim', $choices);


	// loop through array and add to field 'choices'
	if
	( is_array($choices) )
	{

		foreach
		( $choices as $choice )
		{

			$field['choices'][ $choice ] = $choice;

		}

	}

	// return the field
	return $field;

}

add_filter('acf/load_field/name=product_mgr', 'acf_load_pm_field_choices');



if ( ! function_exists( 'acf_flexible_content_layout_title' ) )
{
	function acf_flexible_content_layout_title( $title, $field, $layout, $i )
	{

		if ( null !== (get_sub_field('layout_name')))
		{

			if
			(!empty(get_sub_field('layout_name'))) {
				$title = '<span>' . get_sub_field('layout_name') . '</span>';
			} else {
				$title = '<span>' . get_sub_field('section_title') . '</span>';
			}

		} else {
			$title = '';
		}
		return $title;
	}
}
add_filter('acf/fields/flexible_content/layout_title', 'acf_flexible_content_layout_title', 10, 4);


/**

 * Name: add_default_value_to_image_field();
 * Adds a Default option to ACF Image fields, and config WP to display it:
 * https://acfextras.com/default-image-for-image-field/
 * @since  1.0.0
 * @param $field,
 * @return admin option
 **/

function add_default_value_to_image_field($field) {
	acf_render_field_setting( $field, array(
			'label'   => 'Default Image',
			'instructions'  => 'Appears when creating a new post',
			'type'   => 'image',
			'name'   => 'default_value',
		));
}
add_action('acf/render_field_settings/type=image', 'add_default_value_to_image_field');


function enqueue_uploader_for_image_default() {
	$screen = get_current_screen();
	if ($screen && $screen->id && ($screen->id == 'acf-field-group')) {
		acf_enqueue_uploader();
	}
}
add_action('admin_enqueue_scripts', 'enqueue_uploader_for_image_default');


function reset_default_image($value, $post_id, $field) {
	if (!$value) {
		$value = isset($field['default_value']) ? $field['default_value'] : '';
	}
	return $value;
}
add_filter('acf/load_value/type=image', 'reset_default_image', 10, 3);

function my_acf_enqueue_scripts() {

	wp_enqueue_script( 'acf-custom-js', get_stylesheet_directory_uri() . '/assets/js/acf-custom.min.js', array(), '1.0.0', true );

}

add_action('acf/input/admin_enqueue_scripts', 'my_acf_enqueue_scripts');

/*
function my_admin_enqueue_styles() {

	wp_enqueue_script( 'acf-custom-js', get_template_directory_uri() . '/assets/js/acf-custom.min.js', array(), '1.0.0', true );


}
*/
//add_action( 'admin_enqueue_scripts', 'my_admin_enqueue_styles', 100 );
//add_action('acf/input/admin_enqueue_scripts', 'my_admin_enqueue_styles');

function cancan_acf_admin_head()
{
	wp_enqueue_style( 'acf-custom-css', get_stylesheet_directory_uri() . '/assets/css/admin/acf-custom.min.css', array(), '1.0.0', '' );
}

add_action('acf/input/admin_enqueue_scripts', 'cancan_acf_admin_head');

function ar_responsive_image($image_id, $image_size, $max_width){
	if($max_width == ''){
		$max_width = '100%';
	}
	// check the image ID is not blank
	if($image_id != '') {

		// set the default src image size
		$image_src = wp_get_attachment_image_url( $image_id, $image_size );

		// set the srcset with various image sizes
		$image_srcset = wp_get_attachment_image_srcset( $image_id, $image_size );

		// generate the markup for the responsive image
		echo 'src="'.$image_src.'" srcset="'.$image_srcset.'" sizes="(max-width: '.$max_width.') 100vw, '.$max_width.'"';

	}
}

?>