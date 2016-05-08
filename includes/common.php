<?php
	
	define("LIBS_DIR", 'C:\xamppPHP7\htdocs\wolf_magic\libs');
	define("TEMP_DIR", 'C:\xamppPHP7\htdocs\wolf_magic\temp');
	define("YOUTUBE_API_KEY","AIzaSyBogFebSbF04DJ2sGtlqbtlowpj8YnHHAg");
	define("SOUND_KEY", "772bcb36142a394736dfa0001e608150");
	define('FFMPEG', LIBS_DIR.'/ffmpeg.exe');
	define('FFPROBE', LIBS_DIR.'/ffprobe.exe');
	define('MP4BOX', '"C:\Program Files\GPAC\mp4box.exe"');
	define('YOUTUBEDL', LIBS_DIR.'/youtube-dl.exe');

	require 'classes/helper.class.php';
	require 'classes/convert.class.php';
	require 'classes/download.class.php';
	require 'classes/photo_filt.php';
	require 'classes/photo.class.php';

	require 'classes/youtube.api.php';
	require 'classes/dailymotion.api.php';
	require 'classes/bing.api.php';
	require 'classes/vimeo.api.php';
	require 'classes/yahoo.api.php';
	require 'classes/soundcloud.api.php';

	$wolfMagic = new wolfMagic();
	$down = new download();
	$imageWolf = new ImageWolf();
	$youtube = new youtube();
	$dailymotion = new dailymotion();
	$bing = new bingVid();
	$vimeo = new vimeo();
	$yahoo = new yahoo();
	$sound = new soundcloud();

	require 'functions.php';
?>