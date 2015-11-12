<?php
/*
Author: 2020 Creative
URL: htp://2020creative.com
Requirements: php5.5.*
*/
/////////////////////////////////////////////////////////////////////////////////////////////// 2020 ACF Fields

if(function_exists('acf_add_options_page')) { 
 
	acf_add_options_page();
	acf_add_options_sub_page('Homepage');
	acf_add_options_sub_page('Footer');
 
}

////////////////////////////////////////////////////////

if( function_exists('register_field_group') ):

register_field_group(array (
	'key' => 'tt_homepage',
	'title' => 'Homepage',
	'fields' => array (
		array (
			'key' => 'tt_slide_1',
			'label' => 'Slide 1',
			'name' => 'tt_slide_1',
			'prefix' => '',
			'type' => 'image',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'preview_size' => 'thumbnail',
			'library' => 'all',
			'return_format' => 'url',
       
	),
),        
	'location' => array (
		array (
			array (
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'acf-options-homepage',
			),
		),
	),
	'menu_order' => 1,
	'position' => 'normal',
	'style' => 'seamless',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
));

endif;