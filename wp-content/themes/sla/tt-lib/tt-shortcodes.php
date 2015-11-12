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
    
    // http://strive-la.org/wp-content/uploads/2014/03/d-copy.png
    // http://dev.strive-la.org/wp-content/uploads/2014/01/middleschool-2x1.png
    
    $gallery = '<ul class="bjqs">
                  <li><img src="http://strive-la.org/wp-content/uploads/2014/03/d-copy.png" title="Automatically generated caption"></li>
                  <li><img src="http://dev.strive-la.org/wp-content/uploads/2014/01/middleschool-2x1.png" title="Headline"></li>
                </ul>';
    
    $gallery_script = '';
    
    $tt_post_content = '<td style="width:320px;height:121px;" colspan="2" rowspan="1">
    <div class="tt-posts-grid-tint">
      <a href="/special-guests/">
        <div class="tt-posts-grid-linkarea tt-slider">'
        . do_shortcode('[metaslider id=2535]') .
          '<span class="tt-posts-grid-linktext">Visitors to Strive</span>
        </div>
      </a>
    </div></td>'
        . $gallery_script;
    
// code
return $tt_post_content;    
}

////////////////////////////////////////////////////////
