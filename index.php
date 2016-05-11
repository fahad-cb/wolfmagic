<?php
/*
ffmpeg.exe -i small.mp4 -filter_complex "[0:v]crop=200:200:60:30,boxblur=10[fg]; [0:v][fg]overlay=300:500[v]" -map "[v]" -map 0:a -c:v libx264 -c:a copy -movflags +faststart derpdogblur.mp4 // blur certain part





ffmpeg -i small.mp4 -i http://zdenek-malkus.cz/ramecky/ram33.png -filter_complex "[0:v][1:v] overlay=1:600:enable='between(t,3,6)'" FRAMED.mp4*/
	require 'includes/common.php';
	global $wolfMagic, $imageWolf;
	$maindir = 'C:\xamppPHP7\htdocs\wolf_magic';
	$video = __DIR__.'/lumia.mp4';
	$v1 = __DIR__.'/witch_hd_main.mp4';
	$v2 = __DIR__.'/monster.mp4';
	$v3 = __DIR__.'/small_witch.mp4';
	$out = __DIR__.'/outout';
	$coins = __DIR__.'/samples/coins.mp4';
	$cut_lumia = __DIR__.'/10sec.mp4';
	$audio = 'sample.wav';
	$aud2 = 'sample.mp3';
	$curdir = __DIR__;
	$logo = $curdir.'/logo_new.png';
	$bitcha = $out.'/bitch1.mp4';
	$bitchb = $out.'/bitch2.mp4';
	$bitchc = $out.'/bitch3.mp4';
	$bitchd = $out.'/bitch4.mp4';
	$bitche = $out.'/bitch5.mp4';
	#$wolfMagic->get_video_only($video, $out,true);
	#s$wolfMagic->get_audio_only($video, $out);
	#$wolfMagic->split_video($v1, '35', '10', $out, true);
	#$wolfMagic->pex($wolfMagic->media_detailer($video, 'width'));
	#$wolfMagic->conv_240($video, $out, 'mp4', true);
	#$wolfMagic->merge_videos($video, $v2, $out, 'mp4', true);
	#$wolfMagic->convert_video($video, $out, 'wav', true);
	#$wolfMagic->convert_audio($audio, $out, 'mp3', true);
	#$wolfMagic->merge_audios($audio, $audio, $out, 'mp3', true);
	#$wolfMagic->conv_all($v3, $out, 'mp4', true);
	#$wolfMagic->throw_thumb($v3, $out.'/main.png', '00:00:02');
	#$wolfMagic->xSecThumbs($v1, $out, 'bitch', '10');
	#$wolfMagic->xThumbs($v3, $out, 'bitch_', 12);
	#$wolfMagic->merge_videos($video, $video, $out, 'mp4', true);
	#$wolfMagic->merge_audios($aud2, $aud2, $out, 'mp3', true);
	#$wolfMagic->flip($video, $out.'/flipped.mp4', 'h', true);
	#$wolfMagic->flip_vertical($video, $out.'/verticaled.mp4');
	#$wolfMagic->flip_horizental($video, $out.'/horizened.mp4');
	#$wolfMagic->flip_both($video, $out);
	#$wolfMagic->greyscale($v3, $out.'/blacked.mp4');
	#$wolfMagic->split_screen($v3, $v3, $out.'/splitscreen.mp4');
	#$faster = $wolfMagic->speedup_video($v3, $out.'/fast.mp4');
	#$wolfMagic->add_watermark($v3, )
	$points = array('5,10', '20,25', '30,33');
	#$wolfMagic->mute_at($v1, $out.'/complex_one.mp4', $points);
	#$wolfMagic->greyscale_at($v1, $out.'/bitchat.mp4', $points);
	#$wolfMagic->add_preroll($video, $out, $v3);
	#$wolfMagic->add_postroll($video, $out, $v3);
	#$vids = array($v2, $video, $v3);
	#$wolfMagic->multi_vmerge($vids, $out, 'mp4');
	#$wolfMagic->split_video($video, '0', '20', $out, true);
	#$wolfMagic->add_midroll($video, $out, $cut_lumia);
	#$wolfMagic->postpre_roll($video, $out, $v3, $coins);
	#$wolfMagic->allrolls($video, $out, $v3, $cut_lumia, $coins);
	#$wolfMagic->reverse_video($video, $out.'/puthi.mp4', true);
	#$videos = array($video, $v3, $cut_lumia);
	#$wolfMagic->multi_vreverse($videos, $out);
	#$wolfMagic->pex(shell_exec(FFMPEG.' -filters'));
	/*$wolfMagic->watermark_topleft($v3, $out.'/topleft.mp4', $logo);
	$wolfMagic->watermark_topright($v3, $out.'/topright.mp4', $logo);
	$wolfMagic->watermark_bottomleft($v3, $out.'/bottomleft.mp4', $logo);
	$wolfMagic->watermark_bottomright($v3, $out.'/bottomright.mp4', $logo);
	$wolfMagic->watermark_center($v3, $out.'/center.mp4', $logo);*/
	#$wolfMagic->watermark_corners($v3, $out.'/corners.mp4', $logo);

	$videos = array($bitchc, $bitchb, $bitcha, $bitchd);

	#$wolfMagic->grid_two($videos, $out.'/two_mano.mp4');
	#$wolfMagic->multi_splits($video, $out, $points);
	#$wolfMagic->xSecSplit($v1, $out, '5', '10');
	#$wolfMagic->xSplits($v1, $out, 10);
	#$wolfMagic->extract_waveform($v3, $out.'/twave.jpg');
	$boys = $maindir."/boys.jpg";

	#$imageWolf->grayscale($boys, $maindir.'/ninja.png');
	$params = array('photo_path' => $boys, 'output' => $maindir.'/texted.jpg', 'text' => 'TheNinja');
	#$imageWolf->add_text($params);
	#$imageWolf->hex_fire($boys, $maindir.'/hexed.jpg', 'ff7400');
	#$imageWolf->add_toaster($boys, $maindir.'/toasted.jpg');
	#$imageWolf->add_gotham($boys, $maindir.'/gotham.jpg');
	#$imageWolf->add_kelvin($boys, $maindir.'/kelvin.jpg');
	#$imageWolf->add_lomo($boys, $maindir.'/lomo.jpg');
	#$imageWolf->add_nashville($boys, $maindir.'/add_nashville.jpg');

	#pex(youtube_search('bitch', 2));
	#$paramsa = array('text' => "Amna Mano Bili", 'output' => $maindir.'/mano.jpg', 'color' => 'red', 'font_size' => 30);

	#$imageWolf->text_image($paramsa)
	#$wolfMagic->audiox_merge($v1, __DIR__.'/black.mp3', $out);
	#$wolfMagic->poster_audio(__DIR__.'/black.mp3', __DIR__.'/punk.jpg', __DIR__.'/punked.mp4');
	#$down->download('https://www.youtube.com/watch?v=vDiETeBC9W8');
	$youtube->video_exists('Xvbfv378SYo');
?>