<?php
/*
Author: 2020 Creative
URL: htp://2020creative.com
*/
//////////////////////////////////////////////////////////////////////////////////////////////////////////////// 2020 Shortcodes


//////////////////////////////////////////////////////// TT Post Content

add_shortcode( 'post_info', 'post_info' );
function post_info ( $atts ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'name' => '',
            'id' => '',
		), $atts )
	);
    
    $tt_post_content = get_post_field( 'post_content', $id );
    
// code
return $tt_post_content;    
}

////////////////////////////////////////////////////////

//////////////////////////////////////////////////////// TT Slider

add_shortcode( 'tt_slider_1', 'tt_slider_1' );
function tt_slider_1 ( $atts ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'name' => '',
            'id' => '',
		), $atts )
	);
    
    $tt_post_content = '<td style="width:320px;height:121px;" colspan="2" rowspan="1">
                        <div>
                          <a href="/special-guests/">
                            <div class="tt-slider">'
                            . do_shortcode('[metaslider id=2535]') .
                              '
                            </div>
                          </a>
                        </div></td>';
    
// code
return $tt_post_content;    
}

////////////////////////////////////////////////////////
