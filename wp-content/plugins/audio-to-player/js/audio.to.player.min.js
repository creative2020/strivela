/*
 * Audio To Player
 * http://www.mattvarone.com
 *
 * By Matt Varone
 * @sksmatt
 *
 */
var mv_audio_to_player_js_params;(function($,js_params){var $audio=$('a[href$=".mp3"], a[href$=".m4a"], a[href$=".mp4"]');if($audio.length>0&&$.isFunction($.fn.jPlayer)){var template='<div class="jp-audio-container"><div class="jp-audio"><div class="jp-type-single"><div class="jp-interface"><div class="jp-controls"><a href="#" class="jp-play" tabindex="1">'+js_params.in_play+'</a> <a href="#" class="jp-pause" tabindex="1">'+js_params.in_pause+'</a> <a href="#" class="jp-mute" tabindex="1">'+js_params.in_mute+'</a> <a href="#" class="jp-unmute" tabindex="1">'+js_params.in_unmute+'</a></div><div class="jp-progress-container"><div class="jp-progress"><div class="jp-seek-bar"><div class="jp-play-bar"></div></div></div></div><div class="jp-volume-bar-container"><div class="jp-volume-bar"><div class="jp-volume-bar-value"></div></div></div></div></div></div></div>',c=0;$audio.each(function(index,player){var $player=$(player),id='jquery_jplayer_'+c++,bef=$('<div/>').attr('id',id).addClass('audio-file jp-jplayer'),aft=$(template).find('.jp-interface').attr('id',id).end();$player.before(bef).after(aft).hide().prev().jPlayer({ready:function(){$(this).jPlayer("setMedia",{mp3:player.href});},cssSelectorAncestor:'#'+id,swfPath:js_params.uri+'/js',supplied:"mp3"});});}})(jQuery,mv_audio_to_player_js_params);