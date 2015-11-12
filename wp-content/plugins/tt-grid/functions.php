<?php
/**
 * Plugin Name: 2020 Grid
 * Description: Shortcodes for constructing a very specific grid
 * Author: Derek Potts
 * Author URI: mailto:derek@helloworld.sh
 */

add_action( 'wp_enqueue_scripts', 'register_plugin_styles' );
function register_plugin_styles() {
	wp_register_style('tt-grid', plugins_url('tt-grid/style.css'));
	wp_enqueue_style('tt-grid');
}

add_shortcode('tt_cell_pagename', 'tt_cell_pagename_func');
function tt_cell_pagename_func($atts) {

$td_template = <<<'EOR'
<td class="tt-posts-grid-pagename" style="%s" colspan="%d" rowspan="%d">%s</td>
EOR;

	$a = shortcode_atts(array('w'=>1, 'h'=>1), $atts);

	$width = 160 * $a['w'];
	$height = 121 * $a['h'];

	$style = "width:{$width}px;height:{$height}px;";

	return sprintf($td_template, $style, $a['w'], $a['h'],
		get_the_title());
}

add_shortcode('tt_cell', 'tt_cell_func');
function tt_cell_func($atts) {

	$a = shortcode_atts(array('w'=>1, 'h'=>1, 'post'=>null), $atts);
	$post = get_post($a['post']);
    $link = get_permalink($a['post']);

	$width = 160 * $a['w'];
	$height = 121 * $a['h'];

	$has_image = has_post_thumbnail($a['post']);

	$style = "width:{$width}px;height:{$height}px;";
	$style .= $has_image ? set_background($a['post']) : random_background();

    $class = 'tt-posts-grid-linkarea' .
        ($has_image ? ' tt-posts-has-image' : '');

$td_template = <<<EOR
<td style="{$style}" colspan="{$a['w']}" rowspan="{$a['h']}">
  <div class="tt-posts-grid-tint" style="height:{$height}px;">
    <a href="{$link}">
      <div class="{$class}" style="height:{$height}px;">
        <span class="tt-posts-grid-linktext">{$post->post_title}</span>
      </div>
    </a>
  </div>
</td>
EOR;
 
	return $td_template;
}

function set_background($post_id) {
	$img_id = get_post_thumbnail_id($post_id);
	$url = wp_get_attachment_url($img_id);
	return "background-image:url({$url});";

}

function random_gradient() {
	$color = array(
		'green' => array('light'=>'5c7247', 'dark'=>'485938'),
		'blue' => array('light'=>'0082C8', 'dark'=>'0069A1'),
		'orange' => array('light'=>'F7941D', 'dark'=>'C47517'),
	);
	return $color[array_rand($color)];
}

function random_background() {
	$grad = random_gradient();
	$style = "background-image:radial-gradient(".
		"#{$grad['light']}, #{$grad['dark']});";
	/* guess i'll do something for ie9, but nothing great. */
	$style .= "background-color:#{$grad['dark']};";
	return $style;
}
