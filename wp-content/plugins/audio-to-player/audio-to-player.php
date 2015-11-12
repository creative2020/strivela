<?php
/*
Plugin Name: Audio To Player
Version: 1.1
Plugin URI: mattvarone.com
Description: Converts MP3, MP4 and M4A links to a skineable HTML5 audio player with fallback support.
Author: Matt Varone
Author URI: http://www.mattvarone.com

Copyright 2012  (email: contact@mattvarone.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

/**
* Audio To Player
*
* @package Audio To Player
* @author Matt Varone
*/

/*
|--------------------------------------------------------------------------
| AUDIO TO PLAYER CONSTANTS
|--------------------------------------------------------------------------
*/

define( 'MV_AUDIO_TO_PLAYER_VERSION', '1.1' );

/*
|--------------------------------------------------------------------------
| AUDIO TO PLAYER INCLUDES
|--------------------------------------------------------------------------
*/

/**
* Audio To Player Initialize
*
* @package Audio To Player
* @since    1.0
*/

if ( ! function_exists( 'mv_audio_to_player_init' ) ) {    
    function mv_audio_to_player_init() {
        if ( ! is_admin() )
        require_once( plugin_dir_path( __FILE__ ) . 'inc/audio-to-player-class.php' );
    }
}
add_action( 'plugins_loaded', 'mv_audio_to_player_init' );


/*
|--------------------------------------------------------------------------
| AUDIO TO PLAYER ACTIVATION
|--------------------------------------------------------------------------
*/

/** 
* Audio To Player Activation
*
* @package  Audio To Player
* @since    1.0
*/

if ( ! function_exists( 'mv_audio_to_player_activation' ) ) {	
	function mv_audio_to_player_activation() {
		// check compatibility
		if ( version_compare( get_bloginfo( 'version' ), '3.0' ) >= 0 )
		deactivate_plugins( basename( __FILE__ ) );
	}	
}
register_activation_hook( __FILE__, 'mv_audio_to_player_activation' );