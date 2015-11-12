/*
 * Audio To Player
 * http://www.mattvarone.com
 *
 * By Matt Varone
 * @sksmatt
 *
 */
// WP Variable
var mv_audio_to_player_js_params;
(function ($, js_params) {
    //  Get audio links
    var $audio = $('a[href$=".mp3"], a[href$=".m4a"], a[href$=".mp4"]');
    // Check if there's any link and jPlayer is active
    if ($audio.length > 0 && $.isFunction($.fn.jPlayer)) {
        // set the template
        var template = '<div class="jp-audio-container"><div class="jp-audio"><div class="jp-type-single"><div class="jp-interface"><div class="jp-controls"><a href="#" class="jp-play" tabindex="1">'+js_params.in_play+'</a> <a href="#" class="jp-pause" tabindex="1">'+js_params.in_pause+'</a> <a href="#" class="jp-mute" tabindex="1">'+js_params.in_mute+'</a> <a href="#" class="jp-unmute" tabindex="1">'+js_params.in_unmute+'</a></div><div class="jp-progress-container"><div class="jp-progress"><div class="jp-seek-bar"><div class="jp-play-bar"></div></div></div></div><div class="jp-volume-bar-container"><div class="jp-volume-bar"><div class="jp-volume-bar-value"></div></div></div></div></div></div></div>',
            c = 0; // player's counter
        // loop trough the audio links
        $audio.each(function (index, player) {
            var $player = $(player), // asign element to a variable
                id  = 'jquery_jplayer_' + c++, // generate an ID
                bef = $('<div/>').attr('id', id).addClass('audio-file jp-jplayer'), // generate before element
                aft = $(template).find('.jp-interface').attr('id', id).end(); // generate player template
            // run jPlayer
            $player.before(bef).after(aft).hide().prev().jPlayer({
                ready: function () {
                    $(this).jPlayer("setMedia", {
                        mp3: player.href
                    });
                },
                cssSelectorAncestor: '#' + id, // element ID
                swfPath: js_params.uri + '/js', // path to swf fallback
                supplied: "mp3" // type supplied (mp3 seems to work for all)
            });
        });
    }
})(jQuery, mv_audio_to_player_js_params);