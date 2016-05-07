<?php

	/**
	* File: functions
	* Description: This file contains wrappers for all class functions
	* the main purpose is to make the use easier by removing the part of
	* declaring and accessing classes separately. Functions names here are 
	* mostly exactly the same as the original function
	* @since : 30th April, 2016
	* @author : Saqib Razzaq < saqi.cb@gmail.com , facebook.com/saqi316 >
	* @github : https://github.com/user/saqirzzq
	* @total_functions : 141
	* @last_modified : 30th April, 2016 [Saqib Razzaq] [ Added file documentation ]
	* @notice : If you want to write a new function, add in this file
	*/

	#========================================================#
	###################### HELPER START ######################
	#========================================================#

	/**
	* Section is for Helper functions. Helper functions are used for making
	* certain jobs easy to perform for developers and they have an important
	* role in WolfMagic.
	* @class : HuntHelp
	* @functions : various
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	*/

	/**
	* Execute an external command 
	* @param : { string } { $cmd } { command that you want to execute }
	* @param : { boolean } { $out } { true by default, returns output of command }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { mixed } { $data } { data returned by executing the command }
	*/

	function cmd($cmd, $out = true) {
		global $wolfMagic;
		return $wolfMagic->cmd($cmd, $out);
	}

	/**
	* Pretty print an array 
	* @param : { array } { $array } { array to pretty print }
	* @param : { boolean } { $exit } { true by default, exits right after printing }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { none }
	*/

	function pex($array, $exit = true) {
		global $wolfMagic;
		$wolfMagic->pex($array, $exit);
	}

	/**
	* Check if a given file is a valid video or not
	* @param : { string }  { $path } { path to file to be checked }
	* @param : { boolean } { $msg } { false by default, prints messages if true }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $video_format } { format of video [mp4 etc] }
	*/

	function is_video( $path, $msg = false ) {
		global $wolfMagic;
		return $wolfMagic->is_video( $path, $msg);
	}

	/**
	* Check if a given file is a valid audio or not
	* @param : { string }  { $path } { path to file to be checked }
	* @param : { boolean } { $msg } { false by default, prints messages if true }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $video_format } { format of audio [mp3 etc] }
	*/

	function is_audio($url, $msg = false) {
		global $wolfMagic;
		return $wolfMagic->is_audio($url, $msg);
	}

	/**
	* Check if FFMPEG is installed on given server
	* @param : { string } { $path } { false by default, ffmpeg path }
	* @param : { boolean } { $msg } { false by default, displays error messages if true }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $ffmpeg } { ffmpeg confirmation path }
	*/

	function got_ffmpeg( $path = false, $msg = false ) {
		global $wolfMagic;
		return $wolfMagic->got_ffmpeg( $path, $msg);
	}

	/**
	* Downloads a video from provided URL
	* @param : { string } { $url } { url of the video to be downloaded }
	* @param : { string } { $output_path } { path where to save video }
	* @param : { boolean } { $read_data } { false by default, returns data only }
	* @param : { boolean } { $msg } { false by default, displays error messages }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $title } { title of downloaded video }
	*/

	function get_any_video( $url, $output_path, $read_data = false, $msg = false ) {
		global $wolfMagic;
		return $wolfMagic->get_any_video( $url, $output_path, $read_data, $msg);
	}

	/**
	* Check if a given file is a valid photo or not
	* @param : { string }  { $path } { path to file to be checked }
	* @param : { boolean } { $msg } { false by default, prints messages if true }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $path_format } { format of audio [jpg etc] }
	*/

	function is_photo( $filepath, $msg = false ) {
		global $wolfMagic;
		return $wolfMagic->is_photo( $filepath, $msg);
	}

	/**
	* Check if a given file is of given type or not
	* @param : { string }  { $filepath } { path to file to be checked }
	* @param : { string } { $ext } { extension to match against }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { boolean } { true if extensions match, else fasle }
	*/

	function is_type( $filepath, $ext ) {
		global $wolfMagic;
		return $wolfMagic->is_type( $filepath, $ext );
	}

	/**
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function count_files( $path, $ext ) {
		global $wolfMagic;
		return $wolfMagic->count_files( $path, $ext );
	}

	/**
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function perm_check( $filepath ) {
		global $wolfMagic;
		return $wolfMagic->perm_check( $filepath );
	}

	/**
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function force_perm($path, $permission, $msg = false) {
		global $wolfMagic;
		return $wolfMagic->force_perm($path, $permission, $msg);
	}
	
	/**
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function born_perm( $path, $name, $content, $permissions ) {
		global $wolfMagic;
		return $wolfMagic->born_perm( $path, $name, $content, $permissions );
	}

	/**
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function rand_string($length = 10) {
		global $wolfMagic;
		return $wolfMagic->rand_string($length);
	}
	
	/**
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function build_log( $filepath, $logData, $oright = false, $msg = false ) {
		global $wolfMagic;
		return $wolfMagic->build_log( $filepath, $logData, $oright, $msg);
	}

	/**
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function get_video_size( $video_path, $msg = false) {
		global $wolfMagic;
		return $wolfMagic->get_video_size( $video_path, $msg);
	}

	/**
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function media_detailer( $media, $oneOnly = false, $json = false, $msg = false ) {
		global $wolfMagic;
		return $wolfMagic->media_detailer( $media, $oneOnly, $json, $msg);
	}

	/**
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function can_convert($height) {
		global $wolfMagic;
		return $wolfMagic->can_convert($height);
	}

	#========================================================#
	###################### HELPER END ########################
	#========================================================#

	#========================================================#
	###################### VIDEOS START ######################
	#========================================================#

	/**
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function convert_video( $video_path, $out_path, $out_format, $msg = false ) {
		global $wolfMagic;
		return $wolfMagic->convert_video( $video_path, $out_path, $out_format, $msg);
	}

	/**
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function merge_videos( $vid1, $vid2, $output_path, $format, $msg = false ) {
		global $wolfMagic;
		return $wolfMagic->merge_videos( $vid1, $vid2, $output_path, $format, $msg);
	}

	/**
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function multi_vmerge( $videos_array, $output_path, $format, $msg = false ) {
		global $wolfMagic;
		return $wolfMagic->multi_vmerge( $videos_array, $output_path, $format, $msg);
	}

	/**
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function split_video($video, $start, $length, $output_path, $msg = false) {
		global $wolfMagic;
		return $wolfMagic->split_video($video, $start, $length, $output_path, $msg);
	}

	/**
	* Splits a video in multiple parts
	* @param : { string } { $video_path } { main video file to work with }
	* @param : { string } { $output_dir } { dir to save output file to }
	* @param : { array } { $points } { array of points to split at e.g array('$vAstart, $length','$vbstart, $length') }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 1st May, 2016
	*
	* @return : { array } { $carved_pieces } { an array with paths to splitted pieces }
	*/

	function multi_splits($video_path, $output_dir, $points) {
		global $wolfMagic;
		return $wolfMagic->multi_splits($video_path, $output_dir, $points);
	}

	/**
	* Splits a video into given amount of pieces
	*
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/
 
	function xSplits($video_path, $output_dir, $slices = 5) {
		global $wolfMagic;
		return $wolfMagic->xSplits($video_path, $output_dir, $slices);
	}

	/**
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function xSecSplit($video_path, $output_dir, $split_dur, $sleep = '10') {
		global $wolfMagic;
		return $wolfMagic->xSecSplit($video_path, $output_dir, $split_dur, $sleep);
	}

	/**
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function get_audio_only($video_path, $output_path, $audio_format = '.mp3', $bitrate = 128, $msg = false) {
		global $wolfMagic;
		return $wolfMagic->get_audio_only($video_path, $output_path, $audio_format, $bitrate, $msg);
	}

	/**
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function get_video_only( $video_path, $output_path, $msg = false ) {
		global $wolfMagic;
		return $wolfMagic->get_video_only( $video_path, $output_path, $msg);
	}

	/**
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function resize_video( $video_path, $output_path, $resize_to = '320x240', $output_format, $msg = false ) {
		global $wolfMagic;
		return $wolfMagic->resize_video( $video_path, $output_path, $resize_to = '320x240', $output_format, $msg);
	}

	/**
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function conv_1080( $video_path, $output_path, $output_format, $msg = false ) {
		global $wolfMagic;
		return $wolfMagic->conv_1080( $video_path, $output_path, $output_format, $msg);
	}

	/**
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function conv_720( $video_path, $output_path, $output_format, $msg = false ) {
		global $wolfMagic;
		return $wolfMagic->conv_720( $video_path, $output_path, $output_format, $msg);
	}

	/**
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function conv_480( $video_path, $output_path, $output_format, $msg = false ) {
		global $wolfMagic;
		return $wolfMagic->conv_480( $video_path, $output_path, $output_format, $msg);
	}

	/**
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function conv_360( $video_path, $output_path, $output_format, $msg = false ) {
		global $wolfMagic;
		return $wolfMagic->conv_360( $video_path, $output_path, $output_format, $msg);
	}

	/**
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function conv_240( $video_path, $output_path, $output_format, $msg = false ) {
		global $wolfMagic;
		return $wolfMagic->conv_240( $video_path, $output_path, $output_format, $msg);
	}

	/**
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function conv_all( $video_path, $output_path, $output_format, $msg = false ) {
		global $wolfMagic;
		return $wolfMagic->conv_all( $video_path, $output_path, $output_format, $msg);
	}

	/**
	* Generates a thumb of video at given position
	* @param : { string } { $video_path } { path to video to get thumb from }
	* @param : { string } { $thumb_path } { path of thumb to be saved }
	* @param : { string } { $position } { point to capture screenshot at e.g '00:00:02' }
	* @param : { string } { $size } { false by default, size of thumb }
	* @param : { boolean } { $msg } { false by default, prints error messages }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $thumb_path } { path to generated thumb }
	*/

	function throw_thumb($video_path, $thumb_path, $position, $size = false, $msg = false) {
		global $wolfMagic;
		return $wolfMagic->throw_thumb($video_path, $thumb_path, $position, $size, $msg);
	}

	/**
	* Generates a thumb from video after each given seconds
	* @param : { string } { $video_path } { path to video to get thumb from }
	* @param : { string } { $thumbs_dir } { directory to save thumbs in }
	* @param : { mixed } { $prefix } { prefix to add in thumb name }
	* @param : { integer } { $xsec } { seconds to generate thumb after }
	* @param : { string } { $ext } { png by default, exentsion of thumbs }
	* @param : { string } { $size } { false by default, size of generated thumbs }
	* @param : { boolean } { $msg } { false by default, prints error messages }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $thumbs_dir } { directory where thumbs are saved }
	*/

	function xSecThumbs($video_path, $thumbs_dir, $prefix, $xsec, $ext = 'png', $size = false, $msg = false) {
		global $wolfMagic;
		return $wolfMagic->xSecThumbs($video_path, $thumbs_dir, $prefix, $xsec, $ext, $size, $msg);
	}

	/**
	* Generates given number of thumbs by automatically calculating video duration
	* @param : { string } { $video_path } { path to video to get thumb from }
	* @param : { string } { $thumbs_dir } { directory to save thumbs in }
	* @param : { mixed } { $prefix } { prefix to add in thumb name }
	* @param : { integer } { $thumbs } { 5 by default, number of thumbs to generate from video }
	* @param : { boolean } { $msg } { false by default, prints error messages }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $thumbs_dir } { directory where thumbs are stored }
	*/

	function xThumbs($video_path, $thumbs_dir, $prefix, $thumbs = '5', $msg = false) {
		global $wolfMagic;
		return $wolfMagic->xThumbs($video_path, $thumbs_dir, $prefix, $thumbs, $msg);
	}

	/**
	* Flip a video in vertical or horizental way
	* @param : { string } { $video_path } { path of video to be flipped }
	* @param : { string } { $output_path } { path of flipped video to save }
	* @param : { string } { $mode } { v by default, direction to flip video } { options: v,h }
	* @param : { boolean } { $msg } { false by default, displays messages }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $output_path } { path to flipped video }
	*/

	function flip($video_path, $output_path, $mode = 'v', $msg = false) {
		global $wolfMagic;
		return $wolfMagic->flip($video_path, $output_path, $mode, $msg);
	}

	/**
	* Flip a video horizentally
	* @param : { string } { $video_path } { path of video to be flipped }
	* @param : { string } { $output_path } { path of flipped video to save }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $output_path } { path to flipped video }
	*/

	function flip_horizental($video_path, $output_path) {
		global $wolfMagic;
		return $wolfMagic->flip_horizental($video_path, $output_path);
	}

	/**
	* Flip a video vertically
	* @param : { string } { $video_path } { path of video to be flipped }
	* @param : { string } { $output_path } { path of flipped video to save }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $output_path } { path to flipped video }
	*/

	function flip_vertical($video_path, $output_path) {
		global $wolfMagic;
		return $wolfMagic->flip_vertical($video_path, $output_path);
	}

	/**
	* Flip a video both vertically and horizentally and create separate output files
	* @param : { string } { $video_path } { path of video to be flipped }
	* @param : { string } { $output_dir } { directory to save flipped videos }
	* @param : { string } { $ext } { mp4 by default, extension of output video }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { array } { $flipped } { array with paths to flipped videos }
	*/

	function flip_both($video_path, $output_dir, $ext = 'mp4') {
		global $wolfMagic;
		return $wolfMagic->flip_both($video_path, $output_dir, $ext);
	}

	/**
	* Add grayscale effect (make black & white) to a video
	* @param : { string } { $video_path } { path to video to add grayscale to }
	* @param : { string } { $output_path } { path of ouput to be saved }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $output_path } { path to edited video }
	*/

	function grayscale($video_path, $output_path) {
		global $wolfMagic;
		return $wolfMagic->grayscale($video_path, $output_path);
	}

	/**
	* Add grayscale effect at one or multiple points in video
	* @param : { string } { $video_path } { path to video to add grayscale to }
	* @param : { string } { $output_path } { path of ouput to be saved }
	* @param : { array } { $grey_points } { points to add greyscale effect to }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $output_path } { path to edited video }
	*/

	function grayscale_at($video_path, $output_path, $grey_points) {
		global $wolfMagic;
		return $wolfMagic->grayscale_at($video_path, $output_path, $grey_points);
	}

	/**
	* Show two videos side by side in one video
	* @param : { string } { $vid1 } { path to first video }
	* @param : { string } { $vid2 } { path to second video }
	* @param : { string } { $output_path } { path to output video to be saved }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $output_path } { path to output video to be saved }
	*/

	function split_screen($vid1, $vid2, $output_path) {
		global $wolfMagic;
		return $wolfMagic->split_screen($vid1, $vid2, $output_path);
	}

	/**
	* Increases playback speed of video
	* @param : { string } { $video_path } { Video to increase speed of }
	* @param : { string } { $output_path } { $output_path } { path of output video to save }
	* @param : { integer } { $increase } { number to increase speed, points between 0 and 1 }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $output_path } { $output_path } { path of output saved }
	*/

	function speedup_video($video_path, $output_path, $increase = '0.5') {
		global $wolfMagic;
		return $wolfMagic->speedup_video($video_path, $output_path, $increase);
	}

	/**
	* Decrease playback speed of video
	* @param : { string } { $video_path } { Video to decrease speed of }
	* @param : { string } { $output_path } { $output_path } { path of output video to save }
	* @param : { integer } { $decrease } { number to decrease speed, points between 0 and 1 }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $output_path } { $output_path } { path of output saved }
	*/

	function slowdown_video($video_path, $output_path, $decrease = '2.0') {
		global $wolfMagic;
		return $wolfMagic->slowdown_video($video_path, $output_path, $decrease);
	}

	/**
	* Changes playback speed of video
	* @param : { string } { $video_path } { Video to change speed of }
	* @param : { string } { $output_path } { $output_path } { path of output video to save }
	* @param : { string } { $mode } { i to increase and d to decrease }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $output_path } { $output_path } { path of output saved }
	*/

	function video_speed($video_path, $output_path, $mode = 'i') {
		global $wolfMagic;
		return $wolfMagic->video_speed($video_path, $output_path, $mode);
	}

	/**
	* Adds water to a video at given position
	* @param : { string } { $video_path } { Video to add watermark to }
	* @param : { $output_path } { $output_path } { path of output video to save }
	* @param : { string } { $img } { watermark image to be added }
	* @param : { string } { $position } { position to add watermark  @ options { tl, tr }}
	* @param : { boolean } { $msg } { false by default, displays messages }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { $output_path } { $output_path } { path of saved video }
	*/

	function add_watermark($video_path, $output_path, $img, $position = 'tl', $msg = false) {
		global $wolfMagic;
		return $wolfMagic->add_watermark($video_path, $output_path, $img, $position, $msg);
	}

	/**
	* Adds watermakr at top left corner of video
	* @param : { string } { $video_path } { Video to add watermark to }
	* @param : { string } { $output_path } { $output_path } { path of output video to save }
	* @param : { string } { $img } { image to be added as watermark }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { $output_path } { $output_path } { path of saved video }
	*/

	function watermark_topleft($video_path, $output_path, $img) {
		global $wolfMagic;
		return $wolfMagic->watermark_topleft($video_path, $output_path, $img);
	}

	/**
	* Adds watermakr at top right corner of video
	* @param : { string } { $video_path } { Video to add watermark to }
	* @param : { string } { $output_path } { $output_path } { path of output video to save }
	* @param : { string } { $img } { image to be added as watermark }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { $output_path } { $output_path } { path of saved video }
	*/

	function watermark_topright($video_path, $output_path, $img) {
		global $wolfMagic;
		return $wolfMagic->watermark_topright($video_path, $output_path, $img);
	}

	/**
	* Adds watermakr at bottom left corner of video
	* @param : { string } { $video_path } { Video to add watermark to }
	* @param : { string } { $output_path } { $output_path } { path of output video to save }
	* @param : { string } { $img } { image to be added as watermark }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { $output_path } { $output_path } { path of saved video }
	*/

	function watermark_bottomleft($video_path, $output_path, $img) {
		global $wolfMagic;
		return $wolfMagic->watermark_bottomleft($video_path, $output_path, $img);
	}

	/**
	* Adds watermakr at bottom right corner of video
	* @param : { string } { $video_path } { Video to add watermark to }
	* @param : { string } { $output_path } { $output_path } { path of output video to save }
	* @param : { string } { $img } { image to be added as watermark }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { $output_path } { $output_path } { path of saved video }
	*/

	function watermark_bottomright($video_path, $output_path, $img) {
		global $wolfMagic;
		return $wolfMagic->watermark_bottomright($video_path, $output_path, $img);
	}

	/**
	* Adds watermakr at center of video
	* @param : { string } { $video_path } { Video to add watermark to }
	* @param : { string } { $output_path } { $output_path } { path of output video to save }
	* @param : { string } { $img } { image to be added as watermark }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { $output_path } { $output_path } { path of saved video }
	*/

	function watermark_center($video_path, $output_path, $img) {
		global $wolfMagic;
		return $wolfMagic->watermark_center($video_path, $output_path, $img);
	}

	/**
	* Mutes a video at a given position
	* @param : { string } { $video_path } { Video to mute at certain point }
	* @param : { string } { $output_path } { $output_path } { path of output video to save }
	* @param : { array } { $mute_points } { points to mute video at eg. 10,20} 
	* @param : { boolean } { $msg } { false by default, displays messages }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function mute_at($video_path, $output_path, $mute_points, $msg = false) {
		global $wolfMagic;
		return $wolfMagic->mute_at($video_path, $output_path, $mute_points, $msg);
	}

	/**
	* Add preroll before a video
	* @param : { string } { $video_path } { Video to add preroll to }
	* @param : { string } { $output_path } { $output_path } { path of output video to save }
	* @param : { string } { $preroll_path } { path of preroll to be added }
	* @param : { boolean } { $msg } { false by default, displays messages }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $prerolled } { saved video with preroll }
	*/

	function add_preroll($video_path, $output_path, $preroll_path, $msg = false) {
		global $wolfMagic;
		return $wolfMagic->add_preroll($video_path, $output_path, $preroll_path, $msg);
	}

	/**
	* Add midroll in video
	* @param : { string } { $video_path } { Video to add midroll to }
	* @param : { string } { $output_path } { $output_path } { path of output video to save }
	* @param : { string } { $midroll_path } { path of midroll_path to be added }
	* @param : { boolean } { $msg } { false by default, displays messages }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $new_video; } { saved video with midroll }
	*/

	function add_midroll($video_path, $output_path, $midroll_path, $msg = false) {
		global $wolfMagic;
		return $wolfMagic->add_midroll($video_path, $output_path, $midroll_path, $msg);
	}

	/**
	* Add postroll in a video
	* @param : { string } { $video_path } { Video to add postroll to }
	* @param : { string } { $output_path } { $output_path } { path of output video to save }
	* @param : { string } { $postroll_path } { path of postroll to be added }
	* @param : { boolean } { $msg } { false by default, displays messages }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $postrolled } { saved video with postroll }
	*/

	function add_postroll($video_path, $output_path, $postroll_path, $msg = false) {
		global $wolfMagic;
		return $wolfMagic->add_postroll($video_path, $output_path, $postroll_path, $msg);
	}

	/**
	* Add preroll and postroll in a video
	* @param : { string } { $video_path } { Video to add post and pre roll to }
	* @param : { string } { $output_path } { $output_path } { path of output video to save }
	* @param : { string } { $preroll_path } { path of preroll to be added }
	* @param : { string } { $postroll_path } { path of postroll to be added }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $converted } { converted video path }
	*/

	function add_postpre_roll($video_path, $output_path, $preroll_path, $postroll_path) {
		global $wolfMagic;
		return $wolfMagic->add_postpre_roll($video_path, $output_path, $preroll_path, $postroll_path);
	}

	/**
	* Adds post, mid and preroll to a video
	* @param : { string } { $video_path } { Video to increase speed of }
	* @param : { $output_path } { $output_path } { path of output video to save }
	* @param : { string } { $preroll_path } { path of preroll to be added }
	* @param : { string } { $midroll_path } { path of midroll_path to be added }
	* @param : { string } { $postroll_path } { path of postroll to be added }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $allrolls } { path to saved video with all rolls added }
	*/

	function add_allrolls($video_path, $output_path, $preroll_path, $midroll_path, $postroll_path) {
		global $wolfMagic;
		return $wolfMagic->add_allrolls($video_path, $output_path, $preroll_path, $midroll_path, $postroll_path);
	}


	/**
	* Converts a video so that it plays in reverse
	* @param : { string } { $video_path } { path to video to be reversed }
	* @param : { string } { $output_path } { path of ouput to be saved }
	* @param : { string } { $audio_reverse } { fasle by default, reverse audio }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $output_path } { path of ouput to be saved }
	*/

	function reverse_video($video_path, $output_path, $audio_reverse = false) {
		global $wolfMagic;
		return $wolfMagic->reverse_video($video_path, $output_path, $audio_reverse);
	}

	/**
	* Converts multiple videos so that they all play in reverse
	* @param : { array } { $videos_array } { array of video paths }
	* @param : { string } { $output_dir } { directory where to save files }
	* @param : { string } { $audio_reverse } { fasle by default, reverse audio }
	* @param : { string } { $format } { mp4 by default, output format of videos }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { array } { $rev_vids } { array with paths to output videos }
	*/

	function multi_vreverse($videos_array, $output_dir, $audio_reverse = false, $format = 'mp4') {
		global $wolfMagic;
		return $wolfMagic->multi_vreverse($videos_array, $output_dir, $audio_reverse, $format);
	}

	/**
	* Display 4 videos in one video as grid
	* @param : { array } { $videos } { paths to 4 videos }
	* @param : { string } { $output_path } { path to save video }
	* @param : { integer } { $width } { 1280 by default, width to give to output video }
	* @param : { integer } { $height } { 720 by default, height to give to output video }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $output_path } { path to save video }
	*/

	function grid_four($videos, $output_path, $width = 1280, $height = 720) {
		global $wolfMagic;
		return $wolfMagic->grid_four($videos, $output_path, $width, $height);
	}

	/**
	* Extracts waveform from video
	* @param : { string } { $video_path } { video to extract waveform from }
	* @param : { string } { $output_img } { path to save waveform }
	* @param : { string } { $imgsize } { size of output image }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	* 
	* @return : { string } { $output_img } { path of waveform created }
	*/

	function extract_waveform($video_path, $output_img, $imgsize = '640x120') {
		global $wolfMagic;
		return $wolfMagic->extract_waveform($video_path, $output_img, $imgsize);
	}

	/**
	* Burn subtitles to video
	* @param : { string } { $video_path } { path to video to add subtitles to }
	* @param : { string } { $output_path } { path of ouput to be saved }
	* @param : { string } { $sub_file } { path to subtitles file to be burned to video }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $output_path } { path of ouput }
	*/

	function hardcode_subtitles($video_path, $output_path, $sub_file) {
		global $wolfMagic;
		return $wolfMagic->hardcode_subtitles($video_path, $output_path, $sub_file);
	}

	/**
	* Extract audio from video and merge audio with another audio
	* @param : { string } { $video_path } { path to video to extract audio from }
	* @param : { string } { $audio } { path of already available audio }
	* @param : { string } { $output_path } { path of ouput to be saved }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $merged } { path to newly merged audio file }
	*/

	function audiox_merge($video, $audio, $output_path) {
		global $wolfMagic;
		return $wolfMagic->audiox_merge($video, $audio, $output_path);
	}

	/**
	* Convert a video to mp4
	* @param : { string } { $video_path } { path to video to convert }
	* @param : { string } { $output_path } { path of ouput to be saved }
	* @param : { boolean } { $msg } { false by default, displays messages }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function convert_mp4($video_path, $out_path, $msg = false) {
		global $wolfMagic;
		return $wolfMagic->convert_mp4($video_path, $out_path, $msg);
	}

	/**
	* Convert a video to mov
	* @param : { string } { $video_path } { path to video to convert }
	* @param : { string } { $output_path } { path of ouput to be saved }
	* @param : { boolean } { $msg } { false by default, displays messages }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function convert_mov($video_path, $out_path, $msg = false) {
		global $wolfMagic;
		return $wolfMagic->convert_mp4($video_path, $out_path, $msg);
	}

	/**
	* Convert a video to wmv
	* @param : { string } { $video_path } { path to video to convert }
	* @param : { string } { $output_path } { path of ouput to be saved }
	* @param : { boolean } { $msg } { false by default, displays messages }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function convert_wmv($video_path, $out_path, $msg = false) {
		global $wolfMagic;
		return $wolfMagic->convert_wmv($video_path, $out_path, $msg);
	}

	/**
	* Converts a video for Accer Iconia Tab, ASUS Transformer TF101 & Transformer Prime TF201 
	* @param : { string } { $video_path } { path to video to convert }
	* @param : { string } { $output_path } { path of ouput to be saved }
	* @param : { string } { $output_format } { format of video to be converted }
	* @param : { boolean } { $msg } { false by default, displays error messages }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $converted } { path of converted video file }
	*/

	function conv_iconia( $video_path, $output_path, $output_format, $msg = false ) {
		global $wolfMagic;
		return $wolfMagic->conv_iconia( $video_path, $output_path, $output_format, $msg);
	}

	/**
	* Converts a video for ipad & ipad 2
	* @param : { string } { $video_path } { path to video to convert }
	* @param : { string } { $output_path } { path of ouput to be saved }
	* @param : { string } { $output_format } { format of video to be converted }
	* @param : { boolean } { $msg } { false by default, displays error messages }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $converted } { path of converted video file }
	*/

	function conv_ipad( $video_path, $output_path, $output_format, $msg = false ) {
		global $wolfMagic;
		return $wolfMagic->conv_ipad( $video_path, $output_path, $output_format, $msg);
	}

	/**
	* Converts a video for ipad3
	* @param : { string } { $video_path } { path to video to convert }
	* @param : { string } { $output_path } { path of ouput to be saved }
	* @param : { string } { $output_format } { format of video to be converted }
	* @param : { boolean } { $msg } { false by default, displays error messages }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $converted } { path of converted video file }
	*/

	function conv_ipad3( $video_path, $output_path, $output_format, $msg = false ) {
		global $wolfMagic;
		return $wolfMagic->conv_ipad3( $video_path, $output_path, $output_format, $msg);
	}

	/**
	* Converts a video for Amazon Kindle Fire & Barnes & Noble's NOOK
	* @param : { string } { $video_path } { path to video to convert }
	* @param : { string } { $output_path } { path of ouput to be saved }
	* @param : { string } { $output_format } { format of video to be converted }
	* @param : { boolean } { $msg } { false by default, displays error messages }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $converted } { path of converted video file }
	*/

	function conv_kindle_fire( $video_path, $output_path, $output_format, $msg = false ) {
		global $wolfMagic;
		return $wolfMagic->conv_kindle_fire( $video_path, $output_path, $output_format, $msg);
	}

	#========================================================#
	###################### VIDEOS END ########################
	#========================================================#

	#========================================================#
	###################### PHOTOS START ######################
	#========================================================#
	
	/**
	* Adds specified filter to an image file and is used as primary function
	* for adding various kind of filters on photos
	* @param : { string } { $photo_path } { photo to be edited }
	* @param : { string } { $output } { path to save output photo }
	* @param : { string } { $magic } { filter to add on image }
	* @param : { string } { $extra } { false by default, extra paramters for command }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $output } { path of edited photo }
	*/

	function add_magic($photo_path, $output, $magic, $extra = false) {
		global $imageWolf;
		return $imageWolf->add_magic($photo_path, $output, $magic, $extra);
	}

	/**
	* Converts a photo from one type to another
	* @param : { string } { $photo_path } { path of photo to be converted }
	* @param : { string } { $output } { path to save output photo }
	* @param : { string } { $resize } { false by default, size to be given to photo }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $output } { path of edited photo }
	*/

	function convert_photo($photo_path, $output, $resize = false) {
		global $imageWolf;
		return $imageWolf->convert($photo_path, $output, $resize);
	}

	/**
	* Adds text to an image
	* @param : { array } { $params } { an array with all parameters }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $output } { path of edited photo }
	*/

	function add_text($params) {
		global $imageWolf;
		return $imageWolf->add_text($params);
	}	

	/**
	* Creates a new image with specified text
	* @param : { array } { $params } { an array of paramters }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $output } { path of edited photo }
	*/

	function text_image($params) {
		global $imageWolf;
		return $imageWolf->text_image($params);
	}

	/**
	* Rotates a photo to specified degrees
	* @param : { string } { $photo_path } { path of photo to be rotated }
	* @param : { string } { $output } { path to save output photo }
	* @param : { integer } { $rotate } { degress to rotate }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $output } { path of edited photo }
	*/

	function rotate_photo($photo_path, $output, $rotate = 45) {
		global $imageWolf;
		return $imageWolf->rotate($photo_path, $output, $rotate);
	}

	/**
	* Flips a photo in vertical or horizental way
	* @param : { string } { $photo_path } { path of photo to be flipped }
	* @param : { string } { $output } { path to save output photo }
	* @param : { string } { $flipto } { h by default, diection to flip in }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $output } { path of edited photo }
	*/

	function flip_photo($photo_path, $output, $flipto = 'h') {
		global $imageWolf;
		return $imageWolf->flip($photo_path, $output, $flipto);
	}

	/**
	* Flips a photo vertically
	* @param : { string } { $photo_path } { path of photo to be flipped }
	* @param : { string } { $output } { path to save output photo }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $output } { path of edited photo }
	*/

	function flip_photo_vertical($photo_path, $output) {
		global $imageWolf;
		return $imageWolf->flip_vertical($photo_path, $output);
	}

	/**
	* Flips a photo horizentally
	* @param : { string } { $photo_path } { path of photo to be flipped }
	* @param : { string } { $output } { path to save output photo }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $output } { path of edited photo }
	*/

	function flip_photo_horizental($photo_path, $output) {
		global $imageWolf;
		return $imageWolf->flip_horizental($photo_path, $output);
	}

	/**
	* Adds grayscale effect to a photo
	* @param : { string } { $photo_path } { path of photo to be flipped }
	* @param : { string } { $output } { path to save output photo }
	* @param : { boolean } { $unlink } { false by default, deletes original file}
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $output } { path of edited photo }
	*/

	function grayscale_photo($photo_path, $output, $unlink = false) {
		global $imageWolf;
		return $imageWolf->grayscale($photo_path, $output, $unlink);
	}

	/**
	* Adds navy effect to a photo
	* @param : { string } { $photo_path } { path of photo to be flipped }
	* @param : { string } { $output } { path to save output photo }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $output } { path of edited photo }
	*/

	function navy($photo_path, $output) {
		global $imageWolf;
		return $imageWolf->navy($photo_path, $output);
	}
	
	/**
	* Adds fire effect to photo in given color
	* @param : { string } { $photo_path } { path of photo to be flipped }
	* @param : { string } { $output } { path to save output photo }
	* @param : { stirng } { $color } { yellow by default, color of fire effect }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $output } { path of edited photo }
	*/

	function fire($photo_path, $output, $color = 'yellow') {
		global $imageWolf;
		return $imageWolf->fire($photo_path, $output, $color);
	}

	/**
	* Adds green fire effect to photo
	* @param : { string } { $photo_path } { path of photo to be flipped }
	* @param : { string } { $output } { path to save output photo }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $output } { path of edited photo }
	*/

	function green_fire($photo_path, $output) {
		global $imageWolf;
		return $imageWolf->green_fire($photo_path, $output);
	}

	/**
	* Adds pink fire effect to photo
	* @param : { string } { $photo_path } { path of photo to be flipped }
	* @param : { string } { $output } { path to save output photo }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $output } { path of edited photo }
	*/

	function pink_fire($photo_path, $output) {
		global $imageWolf;
		return $imageWolf->pink_fire($photo_path, $output);
	}

	/**
	* Adds orange fire effect to photo
	* @param : { string } { $photo_path } { path of photo to be flipped }
	* @param : { string } { $output } { path to save output photo }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $output } { path of edited photo }
	*/

	function orange_fire($photo_path, $output) {
		global $imageWolf;
		return $imageWolf->orange_fire($photo_path, $output);
	}

	/**
	* Adds black fire effect to photo
	* @param : { string } { $photo_path } { path of photo to be flipped }
	* @param : { string } { $output } { path to save output photo }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $output } { path of edited photo }
	*/

	function black_fire($photo_path, $output) {
		global $imageWolf;
		return $imageWolf->black_fire($photo_path, $output);
	}

	/**
	* Adds hex code fire effect to photo
	* @param : { string } { $photo_path } { path of photo to be flipped }
	* @param : { string } { $output } { path to save output photo }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $output } { path of edited photo }
	*/

	function hex_fire($photo_path, $output, $hex) {
		global $imageWolf;
		return $imageWolf->hex_fire($photo_path, $output, $hex);
	}

	/**
	* Adds rgba colors to photo
	* @param : { string } { $photo_path } { path of photo to be flipped }
	* @param : { string } { $output } { path to save output photo }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $output } { path of edited photo }
	*/

	function rgba($photo_path, $output, $rgba_code) {
		global $imageWolf;
		return $imageWolf->rgba($photo_path, $output, $rgba_code);
	}

	/**
	* Adds sepia effect to photo
	* @param : { string } { $photo_path } { path of photo to be flipped }
	* @param : { string } { $output } { path to save output photo }
	* @param : { string } { $tone } { 80 by default, tone of sepia effect }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $output } { path of edited photo }
	*/

	function sepia($photo_path, $output, $tone = '80%') {
		global $imageWolf;
		return $imageWolf->sepia($photo_path, $output, $tone);
	}

	/**
	* Invert an image
	* @param : { string } { $photo_path } { path of photo to be flipped }
	* @param : { string } { $output } { path to save output photo }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $output } { path of edited photo }
	*/

	function invert($photo_path, $output) {
		global $imageWolf;
		return $imageWolf->invert($photo_path, $output);
	}

	/**
	* Blurs an image
	* @param : { string } { $photo_path } { path of photo to be flipped }
	* @param : { string } { $output } { path to save output photo }
	* @param : { string } { $border_color } { white by default, color of border }
	* @param : { string } { $border } { 20x10 by default, size of border }
	* @param : { string } { $blurness } { 5x3 by default, blurness of photo }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $output } { path of edited photo }
	*/

	function blur_image($photo_path, $output, $border_color = 'white', $border = '20x10', $blurness = '5x3') {
		global $imageWolf;
		return $imageWolf->blur_image($photo_path, $output, $border_color, $border, $blurness);
	}

	/**
	* Adds oil paint effect to photo
	* @param : { string } { $photo_path } { path of photo to be flipped }
	* @param : { string } { $output } { path to save output photo }
	* @param : { string } { $oil } { amount of oil to be added }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $output } { path of edited photo }
	*/

	function oil_paint($photo_path, $output, $oil) {
		global $imageWolf;
		return $imageWolf->oil_paint($photo_path, $output, $oil);
	}

	/**
	* Adds charcoal to a photo
	* @param : { string } { $photo_path } { path of photo to be flipped }
	* @param : { string } { $output } { path to save output photo }
	* @param : { string } { $charcoal } { amount of charcoal to be added }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $output } { path of edited photo }
	*/

	function charcoal($photo_path, $output, $charcoal) {
		global $imageWolf;
		return $imageWolf->charcoal($photo_path, $output, $charcoal);
	}

	/**
	* Adds emboss effect to a photo
	* @param : { string } { $photo_path } { path of photo to be flipped }
	* @param : { string } { $output } { path to save output photo }
	* @param : { string } { $emboss } { ebossness to add }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $output } { path of edited photo }
	*/

	function emboss($photo_path, $output, $emboss) {
		global $imageWolf;
		return $imageWolf->emboss($photo_path, $output, $emboss);
	}

	/**
	* Adds toaster effect to an image
	* @param : { string } { $photo_path } { path of photo to be flipped }
	* @param : { string } { $output } { path to save output photo }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function add_toaster($photo_path, $output) {
		global $imageWolf;
		return $imageWolf->add_toaster($photo_path, $output);
	}

	/**
	* Adds gotham effect to a photo
	* @param : { string } { $photo_path } { path of photo to be flipped }
	* @param : { string } { $output } { path to save output photo }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function add_gotham($photo_path, $output) {
		global $imageWolf;
		return $imageWolf->add_gotham($photo_path, $output);
	}

	/**
	* Adds Kelvin effect to a photo
	* @param : { string } { $photo_path } { path of photo to be flipped }
	* @param : { string } { $output } { path to save output photo }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function add_kelvin($photo_path, $output) {
		global $imageWolf;
		return $imageWolf->add_kelvin($photo_path, $output);
	}

	/**
	* Adds lomo effect to a photo
	* @param : { string } { $photo_path } { path of photo to be flipped }
	* @param : { string } { $output } { path to save output photo }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function add_lomo($photo_path, $output) {
		global $imageWolf;
		return $imageWolf->add_lomo($photo_path, $output);
	}

	/**
	* Adds nashville effect to a photo
	* @param : { string } { $photo_path } { path of photo to be flipped }
	* @param : { string } { $output } { path to save output photo }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function add_nashville($photo_path, $output) {
		global $imageWolf;
		return $imageWolf->add_nashville($photo_path, $output);
	}

	/**
	* Detects edges of a photo
	* @param : { string } { $photo_path } { path of photo to be flipped }
	* @param : { string } { $output } { path to save output photo }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $output } { path of edited photo }
	*/

	function edge_detect($photo_path, $output, $edge) {
		global $imageWolf;
		return $imageWolf->edge_detect($photo_path, $output, $edge);
	}

	/**
	* Adds shade to a photo
	* @param : { string } { $photo_path } { path of photo to be flipped }
	* @param : { string } { $output } { path to save output photo }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $output } { path of edited photo }
	*/

	function shade($photo_path, $output, $shade) {
		global $imageWolf;
		return $imageWolf->shade($photo_path, $output, $shade);
	}
	
	/**
	* Double channels photo
	* @param : { string } { $photo_path } { path of photo to be flipped }
	* @param : { string } { $second_photo } { second photo }
	* @param : { string } { $output } { path to save output photo }
	* @param : { string } { $channel } { red by default, channel to add to photo }
	* @param : { string } { $size } { 100% by default, size of output photo }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $output } { path of edited photo }
	*/

	function double_channel($photo_path, $second_photo, $output, $channel = 'red', $size = '100%') {
		global $imageWolf;
		return $imageWolf->double_channel($photo_path, $second_photo, $output, $channel, $size);
	}

	/**
	* Makes an image circled
	* @param : { string } { $photo_path } { path of photo to be flipped }
	* @param : { string } { $output } { path to save output photo }
	* @param : { string } { $circle } { 64,64,64,0 by default, position and size of circl }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { string } { $output } { path of edited photo }
	*/

	function make_circled($photo_path, $output, $circle = '64,64 64,0') {
		global $imageWolf;
		return $imageWolf->make_circled($photo_path, $output, $circle);
	}

	#========================================================#
	###################### PHOTOS END ########################
	#========================================================#

	#========================================================#
	###################### YOUTUBE START #####################
	#========================================================#


	/**
	* Checks if given URL is of youtube
	* @param : { string } { $url } { url to be checked }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function is_youtube($url) {
		return $youtube->is_youtube($url);
	}
	

	/**
	* Searches YouTube videos against given query
	* @param : { string } { $query } { search term to be used }
	* @param : { integer } { $max_vids } { max videos to fetch }
	* @param : { string } { $token } { token to fetch next page vids }
	* @param : { string } { $sort } { sorting of vidds }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { array } { an array with required details }
	*/

	function youtube_search($query, $max_vids = false, $token = false, $sort = false) {
		global $youtube;
		return $youtube->search($query, $max_vids, $token, $sort);
	}

	/**
	* Cleans raw data and returns req fields only
	* @param : { array } { $data } { array of raw api data }
	* @param : { boolean } { $more } { pass true when cleaning next page vids }
	* @param : { boolean } { $related } { pass true when cleaning related vids }
	* @return : { array } { array of cleaned data }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function youtube_search_process($data, $more = false, $related = false, $vidlist = false ) {
		global $youtube;
		return $youtube->search_process($data, $more, $related, $vidlist);
	}

	/**
	* Search youtube channels
	* @param : { string } { $query } { search term to be used }
	* @param : { integer } { $max_vids } { max videos to fetch }
	* @param : { string } { $token } { token to fetch next page vids }
	* @param : { string } { $sort } { sorting of vidds }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function youtube_channel_search($query, $max_vids = false, $token = false, $sort = false) {
		global $youtube;
		return $youtube->search_channel($query, $max_vids, $token, $sort);
	}

	/**
	* Fetch related vids using id of video
	* @param : { string } { $id } { id of youtube video }
	* @param : { integer } { $max_vids } { number of max vids }
	* @param : { string } { $token } { token to get more vids }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { array } { cleaned array with only needed details }
	*/

	function youtube_related($id, $max_vids = 8, $token = false) {
		global $youtube;
		return $youtube->related($id, $max_vids, $token);
	}

	/**
	* Return data for playing a YouTube video
	* @param : { string } { $id } { id of video to play }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*
	* @return : { array } { $data } { array with req fields }
	*/

	function youtube_play($id, $dl = false) {
		global $youtube;
		return $youtube->play_youtube($id, $dl);
	}

	/**
	* Gets content details of youtube video
	* @param : { string } { $id } { id of youtube video }
	* @param : { string } { $type } { false by default, get specific detail only }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function youtube_content_details($id, $type = false) {
		global $youtube;
		return $youtube->get_content_details($id, $type);
	}

	/**
	* Get duration of a youtube video
	* @param : { string } { $id } { id of youtube video }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function youtube_duration($id) {
		global $youtube;
		return $youtube->get_duration($id);
	}

	/**
	* Get views of youtube video
	* @param : { string } { $id } { id of youtube video }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function youtube_views($id) {
		global $youtube;
		return $youtube->get_views($id);
	}

	/**
	* Get likes of youtube video
	* @param : { string } { $id } { id of youtube video }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function youtube_likes($id) {
		global $youtube;
		return $youtube->get_likes($id);
	}


	/**
	* Extracts all kinds of info about provided YouTube video
	* @param : { string } { $youtube_url } { Link to video }
	* @param : { boolean } { $raw } { false by default, returns raw data }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function youtube_detailer($youtube_url, $raw = false) {
		global $youtube;
		return $youtube->youtube_detailer($youtube_url, $raw);
	}

	/**
	* Get id of channel using channel name
	* @param : { string } { $channel_name } { name of channel to get id of }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function youtube_chan_byname( $channel_name ) {
		global $youtube;
		return $youtube->yt_chan_byName( $channel_name );
	}

	/**
	* Get channel id by video url
	* @param : { string } { $url } { url of video }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function youtube_chan_byvideo( $url ) {
		global $youtube;
		return $youtube->yt_chan_byVideo( $url );
	}

	/**
	* Get quality of a video
	* @param : { string } { $url } { url of video }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function youtube_quality( $url ) {
		global $youtube;
		return $youtube->youtube_quality( $url );
	}

	/**
	* Get thumbs of a youtube video
	* @param : { string } { $url } { url of video }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function youtube_thumbs( $url ) {
		global $youtube;
		return $youtube->youtube_thumbs( $url );
	}

	/**
	* Check if youtube video is HD
	* @param : { string } { $url } { url of video }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function is_youtube_hd($url) {
		global $youtube;
		return $youtube->is_youtube_hd($url);
	}

	/**
	* Get ID of youtube video using url
	* @param : { string } { $url } { url of video }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function get_youtube_id($url) {
		global $youtube;
		return $youtube->get_youtube_id($url);
	}

	/**
	* Convert youtube timestamp to seconds
	* @param : { string } { $defaultTime } { default youtube timestamp }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function conv_youtube_time($defaultTime) {
		global $youtube;
		return $youtube->conv_youtube_time($defaultTime);
	}

	/**
	* Fetch youtube channel data
	* @param { string } { $id } { id of channel to be fetched }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function youtube_channel($id) {
		global $youtube;
		return $youtube->channel($id);
	}


	/**
	* Clean raw data of a youtube channel
	* @param : { array } { $readable } { array of raw data }
	* @param : { string } { $id } { id of youtube channel }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function youtube_channel_process($readable, $id) {
		global $youtube;
		return $youtube->process_channel($readable, $id);
	}

	/**
	* Get videos of specific youtube category
	* @param : { integer } { $catid } { id of youtube category }
	* @param : { integer } { $max } { max videos to be fetched }
	* @param : { string } { $more } { false by default, token to get next videos }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function youtube_cat_vids($catid, $max, $more = false) {
		global $youtube;
		return $youtube->cat_vids($catid, $max, $more);
	}

	#========================================================#
	###################### YOUTUBE END   #####################
	#========================================================#

	#========================================================#
	###################### DAILYMOTION START #################
	#========================================================#

	/**
	* Searches Dailmotion videos against given query
	* @param : { string } { $query } { search term to be used }
	* @param : { integer } { $max_vids } { max videos to fetch }
	* @param : { string } { $page } { num of next page }
	* @param : { string } { $sort } { sorting of vidds }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	* 
	* @return : { array } { an array with required details }
	*/

	function dailymotion_search($query, $max_vids = false, $page = false, $sort = false) {
		global $dailymotion;
		return $dailymotion->search($query, $max_vids, $page, $sort);
	}

	/**
	* Fetches required data to play dailymotion video
	* @param : { string } { $id } { id of video to play }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function dailymotion_play($id) {
		global $dailymotion;
		return $dailymotion->play($id);
	}

	/**
	* Cleans raw api data and returns only the most needed items
	* @param : { array } { $array } { array of raw data }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function dailymotion_search_process($array) {
		global $dailymotion;
		return $dailymotion->search_process($array);
	}

	/**
	* Fetches detao;s of single dailymotion video
	* @param : { string } { $vid } { id of video to fetch details for }
	* @param : { boolean } { $play } { false by default, returns play details }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function dailymotion_video_details($vid, $play = false) {
		global $dailymotion;
		return $dailymotion->video_details($vid, $play);
	}

	#========================================================#	
	###################### DAILYMOTION END ###################
	#========================================================#

	#========================================================#	
	###################### VIMEO START #######################
	#========================================================#

	/**
	* Searches Viemo videos against given query
	* @param : { string } { $query } { search term to be used }
	* @param : { integer } { $max_vids } { max videos to fetch }
	* @param : { string } { $page } { num of next page }
	* @param : { string } { $sort } { sorting of vidds }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	* 
	* @return : { array } { an array with required details }
	*/

	function vimeo_search($query, $max_vids = false, $more = false, $sort = false) {
		global $vimeo;
		return $vimeo->search($query, $max_vids, $more, $sort);
	}

	/**
	* Cleans raw api data and returns only the most needed items
	* @param : { array } { $array } { array of raw data }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function vimeo_search_process($data, $more = false) {
		global $vimeo;
		return $vimeo->search_process($data, $more);
	}

	/**
	* Prepares a viemo video to be played
	* @param : { array } { $data } { raw data of video }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function vimeo_process_play($data) {
		global $vimeo;
		return $vimeo->process_play($data);
	}

	/**
	* Fetches data of a single vimeo video to play
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function vimeo_play($id) {
		global $vimeo;
		return $vimeo->play($id);
	}

	#========================================================#	
	###################### VIMEO END #########################
	#========================================================#

	#========================================================#	
	###################### Yahoo Start #######################
	#========================================================#

	/**
	* Searches Viemo videos against given query
	* @param : { string } { $query } { search term to be used }
	* @param : { integer } { $max_vids } { max videos to fetch }
	* @param : { string } { $page } { num of next page }
	* @param : { string } { $sort } { sorting of vidds }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	* 
	* @return : { array } { an array with required details }
	*/

	function yahoo_search($query, $max_vids, $page = false, $sort = false, $site = false) {
		return $yahoo->search($query, $max_vids, $page, $sort, $site);
	}

	/**
	* Cleans raw api data and returns only the most needed items
	* @param : { array } { $array } { array of raw data }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function yahoo_process_search($readable, $site = false) {
		return $yahoo->process_search($readable, $site);
	}

	/**
	* Checks if given website is a valid yahoo website
	* @param : { string } { $site } { url to be checked }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function valid_yahoo_site($site) {
		return $yahoo->valid_yahoo_site($site);
	}

	/**
	* Checks if given is a valid yahoo duration
	* @param : { integer } { $dur } { checks if given is valid duration }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function yahoo_valid_dur($dur) {
		return $yahoo->is_valid_dur($dur);
	}

	/**
	* Checks if given is a valid yahoo quality
	* @param : { string } { $quality } { quality to check for validation }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function yahoo_valid_quality($quality) {
		return $yahoo->is_valid_quality($quality);
	}

	/**
	* Fetches thumb of given yahoo video
	* @param : { string } { $url } { url of video }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function yahoo_mold_thumb($url) {
		return $yahoo->mold_thumb($url);
	}

	#========================================================#	
	###################### Yahoo END #########################
	#========================================================#

	#========================================================#	
	#################### SoundCloud Start ####################
	#========================================================#

	/**
	* Search soundcloud for music
	* @param : { string } { $q } { query to search songs for }
	* @param : { integer } { $max } { false by default, max number of songs to fetch }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function scld_search($q, $max = false) {
		return $sound->search($q, $max);
	}

	/**
	* Fetch complete details of single track of soundcloud
	* @param : { integer } { $id } { id of soundcloud track }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function scld_track_details($id) {
		return $sound->track_details($id);
	}

	/**
	* Cleans up raw search data and returns needed items
	* @param : { array } { $readable } { array of raw data to clean } 
	* @param : { boolean } { $single } { false by default, cleans up data of single track }
	* @since : 30th April, 2016
	* @author : Saqib Razzaq
	* @modified : 30th April, 2016
	*/

	function scld_process_search($readable, $single = false) {
		return $sound->process_search($readable, $single);
	}

	#========================================================#	
	###################### SoundCloud END ####################
	#========================================================#



?> 