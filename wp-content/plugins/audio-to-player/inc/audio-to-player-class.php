<?php
/**
* Audio Player
*
* @package  Audio Player
* @author   Matt Varone
*/

if ( ! class_exists( 'MV_Audio_To_Player' ) )
{   
    
    class MV_Audio_To_Player
    {
        
        private $has_audio = false;
        
        /** 
        * Audio Player
        * 
        * Construct class. Fires init action.
        *
        * @package Audio Player
        */
        
        function __construct()
        {   
            add_action( 'init', array( &$this, 'init' ) );
        }
    
        /** 
        * Init 
        * 
        * Loads internationalization and sets the necessary action
        *
        * @return   void
        * @since    1.0
        */
    
        function init() 
        {
            load_plugin_textdomain( 'mv-audio-to-player', false, plugin_dir_path( dirname( __FILE__ ) ) . '/lan' );         
            add_action( 'the_posts', array( &$this, 'have_audio' ), 1, 1 );
        }
        
        /** 
        * Have Audio 
        * 
        * Checks if the content haves audio.
        *
        * @return   array
        * @since    1.0        
        */
        
        function have_audio( $posts ) {
            if ( empty( $posts ) || $this->has_audio )
                return $posts;
            
            foreach ( $posts as $post ) {
                if ( preg_match('/\.(mp3|mp4|m4a)/i', $post->post_content) ) {
                    $this->has_audio = true;
                    break;
                }
            }
    
            if ( $this->has_audio == true )
                add_action( 'wp_enqueue_scripts', array( &$this, 'enqueue_assets' ), 10 );
                    
            return $posts;
        
        }
        
        /** 
        * Enqueue Assets 
        * 
        * Adds JS and CSS assets
        *
        * @return   void
        * @since    1.0
        */
                
        function enqueue_assets() {
            
            // Style
            $css = 'audio-to-player.css';            
            $on_theme =  get_stylesheet_directory() . '/' . $css;
            $on_plugin = plugin_dir_url( dirname( __FILE__ ) ) . 'css/audio-to-player.css';
            $stylesheet = ( file_exists( $on_theme ) ) ? get_stylesheet_directory_uri() . '/' . $css : $on_plugin;
            $stylesheet = apply_filters( 'mv_audio_to_player_enqueue_style', $stylesheet );
            if ( $stylesheet ) wp_enqueue_style( 'audio-to-player', $stylesheet , false, MV_AUDIO_TO_PLAYER_VERSION, 'all' );
            
            // Script
            $env = ( WP_DEBUG ) ? 'dev' : 'min';
            wp_register_script( 'jquery-jplayer', plugin_dir_url( dirname( __FILE__ ) ) . 'js/jquery.jplayer.min.js' , array( 'jquery' ), '2.1.0' , true );
            wp_enqueue_script( 'audio-to-player', plugin_dir_url( dirname( __FILE__ ) ) . 'js/audio.to.player.' . $env . '.js' , array( 'jquery-jplayer' ), MV_AUDIO_TO_PLAYER_VERSION , true );
            $params = array( 
                'uri'       => plugin_dir_url( dirname( __FILE__ ) ),
                'in_play'   => __( 'Play', 'audio-to-player' ), 
                'in_pause'  => __( 'Pause', 'audio-to-player' ),
                'in_mute'   => __( 'Mute', 'audio-to-player' ), 
                'in_unmute' => __( 'Unmute', 'audio-to-player' ),
            );
            wp_localize_script( 'audio-to-player', 'mv_audio_to_player_js_params', apply_filters( 'mv_audio_to_player_js_params', $params ) );
            
        }
        
    }
    
    new MV_Audio_To_Player();
}