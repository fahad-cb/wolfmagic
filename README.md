# wolfmagic
Discover, Download, Convert &amp; Edit Videos, Photos &amp; Music

## Introduction
WolfMagic is a helper library designed to allow you to search, download, convert & edit videos, photos & music without getting involved with nitty-gritty of APIs and command line tools. 

## Why Use it
WolfMagic enables you to search videos from over 10 sources including YouTube, DailyMotion, Vimeo, CNN and others. You can download videos 
from over 30 websites, convert videos & audios from all popular formats to other formats, apply dozens of cool effects on videos & photos with one function calls.

Using WolfMagic will free you from hassle of managing code and tools yourself as we take care of that for you plus you will never feel limited again.


## How to use
Installation process is quite simple. Download zip file and extract it. Now include common.php in your file and you are good to go.

## All functions, usage and examples
#### cmd()
Execute an external program and get or skip output

`$cmd`
Command that you would like to execute

`$out`
False by default, return full output of command if true

Ex:

    $cmd  = 'php --version';
    $out = true;
    cmd( $cmd, $out );

### pex()
Pretty print an array

`$array`
Array to be dumped out

`$exit `
False by default, exits right after dumping

Ex:

    $array = array( 
                'Apple' => 'steve_jobs', 
               'tunepk' => 'arslan_hassan',
               'windows' => 'bill_gates' );
    pex( $array, true );

### is_video()
Check if provided URL or path is a video. If video, returns video extension else returns false

`$path`
{ string } { video link or path }

`$msg`
{ boolean } { false by default. if set to true, displays operation messages }

Ex:

    $path = '/var/www/html/sample.html';
    is_video( $path, true );

### is_audio()
Checks if provided link is audio. If audio, returns audio format else returns false

`$url`
{ string } { link / path to audio }

`$msg`
{ boolean } { false by default. if set to true, displays operation messages }

Ex:

    $path = 'sample.mp4';
    is_audio( $path, true );
    got_ffmpeg( false, true );

### get_any_video()
Download any video from internet using YouTube-dl

`$url`
{ string } { link to video to download }

`$output_path`
{ string } { directory where to save file }

`$read_data `
{ boolean } { false by default. Shows output if true }

`$msg` 
{ boolean } { false by default. Shows errors }

Ex:

    $url = 'test.mp4';
    $output_path = __DIR__;
    get_any_video( $url, $output_path, false, true );

### is_photo()
Check if  a filepath or URL is a photo or not

`$filepath`
{ string } { path to file to check }

`$msg` 
{ boolean } { shows errors if true }

Ex:

    $filepath = 'main.jpg';
    is_photo( $filepath, true );

### is_type()
Checks if a provided file matches provided extension

`$filepath`
{ string } { path or link to file }

`$ext `
{ string } { file extension to match against }

Ex:
    $filepath = 'main.py';
    is_photo( $filepath, 'py' );

### count_files()
Counts file with certain extension in given directory

`$path`
{ string } { path of directory with files to count }

`$ext` 
{ string } { extension to count files }

Ex:

    $path = __DIR__;
    $ext = 'php';
    count_files( $path, $ext );

### perm_check()
Checks if a directory has permissions

`$filepath` 
{ string } { file to check }

Ex:
    
    $filepath = __DIR__.'/wolf.png';
    perm_check( $filepath );

### force_perm()
Checks if a file has certain permissions, if not forcefully adds given permissions

`$path`
{ string } { place where file is located }

`$permissions` 
{ integer } { permissions to check and force }

`$msg`
{ boolean } { shows error messages }


Ex:

    $path = __DIR__.'/files';
    $permissions = '0777';
    force_perm( $path, $permissions, true);

### born_perm()
Creates a new file (php, html, css, text etc) and gives it given permissions

`$path`
{ string } { path to create file }

`$name` 
{ string } { name of file to create }

`$content` 
{ mixed } { content to hold inside file }

`$permissions` 
{ integer } { permissions to give to the file }

Ex:

    $path = __DIR__.'/files';
    $name = 'wolf_magic.me';
    $content = 'it works just fine';
    $permissions = '0666';
    born_perm ( $path, $name, $content, $permissions );

### rand_string()
Generates a random string of provided length

`$length` 
{ integer } { 10 by default. length for random string }

Ex:

    rand_string( 5 );

### build_log()
Builds log file for a video after conversion

`$filepath` 
{ string } { log file to be created }

`$logData` 
{ mixed } { log data to be stored inside of file }

`$oright` 
{ boolean } { false by default, replace file if true }

`$msg` 
{ boolean } { false by default, prints error messages }

Ex:

    $filepath = 'logdata.txt';
    $logData = 'this is sample log data here';
    $oright = true;
    $msg = true;
    build_log( $filepath, $logData, $oright, $msg );

### get_video_size()
Gets size of provided video

`$video_path`
{ string } { directory path of video }

`$msg` 
{ boolean } { false by default. if set to true, displays operation messages }

Ex:

    $video_path = 'sample.mp4';
    get_video_size( $video_path, true);

### media_detailer()
Gets all possible details of a media file (video, audio, photo)

`$media`
{ string } { path to file to extract details of }

`$oneOnly` 
{ boolean } { boolean } { false by default, get one specific detail }

`$json` 
{ boolean } { false by default, returns json data }

 `$msg `
{ boolean } { false by default, prints error messages }

Ex:

    $media = 'test.mp4'l;
    $oneOnly = false;
    $json = false;
    $msg = true;
    media_detailer( $media, $oneOnly, $json, $msg );

Ex 2 [ get duration only ]:
$media = 'test.mp4'l;
$oneOnly = false;
$json = false;
$msg = true;
media_detailer( $media, $oneOnly, $json, $msg );

Other possible single things you can extract are:
width = width of media file
height = height of media file
res = resolution of video file
dur = duration of media file
size = file size of media file
bit_rate = bitrate of media file 
created = creation date of media file (not all files have this info built in)
codec_name = codec name of media file

### can_convert()
Check what is max resolution possible conversion for a video

`$height` 
{ integer } { Height of video to be checked }

Ex:

    can_convert(510);

convert_video()
Convert a video from one format to another

$video_path
{ string } { Path to your video or direct URL to video }

$out_path
{ string } { Directory to save output file }

$out_format
{ string } { Format to convert your video to }

$msg 
{ boolean } { False by default,  displays error messages if true }

Ex: 
$video_path = 'sample.mp4';
$out_path = '/var/www/html';
$out_format = 'mp4';
convert_video( $video_path, $out_path, $out_format, true );

merge_videos()
Merge two videos together and make one video 

$vid1
{ string } { First video }

$vid2
{ string } { Second video }

$output_path
{ string } { Directory to save converted file to }

$format 
{ string } { Format to convert output file to }

$msg
{ boolean } { False by default, displays error messages if true }

Ex:
$vid1 = 'sample.mp4';
$vid2 = 'test.mp4';
$output_path = '/var/www/html';
$format = 'mp4';
merge_videos( $vid1, $vid2, $output_path, $format, true );

multi_vmerge()
Combines two videos using FFMPEG

$videos_array
{ array } { array of videos to be merged }

$output_path
{ string } { where to save converted file }

$format
{ string } { file format to save as (Must be video) }

Ex:
$videos_array = array(
                                   'small.mp4',
                                   'sample.mp4',
                                   'test.mp4'     
                              );
$output_path = __DIR__.'/files';
$format = 'wmv';
$msg = true;
multi_vmerge( $videos_array, $output_path, $format, $msg );

split_video()
Cuts a part of video as given parameters by user

 $video
 { string } { link or path of video }

$start
 { integer } { point to start cutting }

$length
 { integer } { time from start point to end point }

$output_path
 { string } { where to save output video }

$msg
 { boolean } { false by default. if set to true, displays operation messages }

multi_splits()
xSplits()
xSecSplit()
get_audio_only()
Extracts audio from a video without downloading or converting that it

$video_path
{ string } { link to video }

$output_path
{ string } { directory path to save output audio }

$audio_format
{ string } { format to store extracted audio }

$bitrate
{ integer } { 128 by default. Effects audio quality }

$msg
{ boolean } { false by default. if set to true, displays operation messages }

Ex:
$video_path = 'test.mp4';
$output_path = '/var/www/html';
$audio_format = 'mp3';
$bitrate = '128';
get_audio_only( $video_path, $output_path, $audio_format = '.mp3', $bitrate = 128, true );

get_video_only()
Extracts video from a video while muting its audio completely

$video_path 
{ string } { link to video }

 $output_path 
{ string } { place to save output video [dir path only] }

$msg
{ boolean } { false by default. if set to true, displays operation messages }

Ex:
$video_path = 'test.mp4';
$output_path = '/var/www/html';
get_video_only( $video_path, $output_path, false);

resize_video()
Resizez a video according to parameters provided by users

$video_path
{ string } { Path to your video or direct URL to video }

$out_path
{ string } { Directory to save output file }

$out_format
{ string } { Format to convert your video to }

$resize_to
{ string } { resizing size e.g (640x480) }

$msg 
{ boolean } { False by default,  displays error messages if true }


Ex:
$video_path = 'sample.mp4';
$output_path= '/var/www/html';
$output_format= 'mp4';
resize_video( $video_path, $output_path, $resize_to = '320x240', $output_format, true);

conv_1080()
Converts a video to 1080p video quality

$video_path 
{ string } { Link or path to video }

$output_path 
{ string } { Direcotry path where file is to be saved }

$output_format 
{ string } { Format to convert videos in }

$msg
{ boolean } { false by default. Shows errors }

Ex:
$video_path = 'sample.mp4';
$output_path= '/var/www/html';
$output_format= 'mp4';
conv_1080( $video_path, $output_path, $output_format, true );

conv_720()
Converts a video to 720p video quality

$video_path 
{ string } { Link or path to video }

$output_path 
{ string } { Direcotry path where file is to be saved }

$output_format 
{ string } { Format to convert videos in }

$msg
{ boolean } { false by default. Shows errors }

Ex:
$video_path = 'sample.mp4';
$output_path= '/var/www/html';
$output_format= 'mp4';
conv_720( $video_path, $output_path, $output_format, true );

conv_480()
Converts a video to 480p video quality

$video_path 
{ string } { Link or path to video }

$output_path 
{ string } { Direcotry path where file is to be saved }

$output_format 
{ string } { Format to convert videos in }

$msg
{ boolean } { false by default. Shows errors }

Ex:
$video_path = 'sample.mp4';
$output_path= '/var/www/html';
$output_format= 'mp4';
conv_480( $video_path, $output_path, $output_format, true );

conv_360()
Converts a video to 360p video quality

$video_path 
{ string } { Link or path to video }

$output_path 
{ string } { Direcotry path where file is to be saved }

$output_format 
{ string } { Format to convert videos in }

$msg
{ boolean } { false by default. Shows errors }

Ex:
$video_path = 'sample.mp4';
$output_path= '/var/www/html';
$output_format= 'mp4';
conv_360( $video_path, $output_path, $output_format, true );

conv_240()
Converts a video to 240p video quality

$video_path 
{ string } { Link or path to video }

$output_path 
{ string } { Direcotry path where file is to be saved }

$output_format 
{ string } { Format to convert videos in }

$msg
{ boolean } { false by default. Shows errors }

Ex:
$video_path = 'sample.mp4';
$output_path= '/var/www/html';
$output_format= 'mp4';
conv_240( $video_path, $output_path, $output_format, true );

conv_all()
Converts a video to all video qualities

$video_path 
{ string } { Link or path to video }

$output_path 
{ string } { Direcotry path where file is to be saved }

$output_format 
{ string } { Format to convert videos in }

$msg
{ boolean } { false by default. Shows errors }

Ex:
$video_path = 'sample.mp4';
$output_path= '/var/www/html';
$output_format= 'mp4';
conv_all( $video_path, $output_path, $output_format, true );


throw_thumb()
xSecThumbs()
xThumbs()
flip()
flip_horizental()
flip_vertical()
flip_both()
grayscale()
grayscale_at()
split_screen()
speedup_video()
slowdown_video()
video_speed()
add_watermark()
watermark_topleft()
watermark_topright()
watermark_bottomleft()
watermark_bottomright()
watermark_center()
mute_at()
add_preroll()
add_midroll()
add_postroll()
add_postpre_roll()
add_allrolls()
reverse_video()
multi_vreverse()
grid_four()
extract_waveform()
hardcode_subtitles()
conv_iconia()
audiox_merge()
convert_mp4()
convert_mov()
convert_wmv()
conv_ipad()
conv_ipad3()
conv_kindle_fire()
add_magic()
convert_photo()
add_text()
text_image()
rotate_photo()
flip_photo()
flip_photo_vertical()
flip_photo_horizental()
grayscale_photo()
navy()
fire()
green_fire()
pink_fire()
orange_fire()
black_fire()
hex_fire()
rgba()
sepia()
invert()
blur_image()
oil_paint()
charcoal()
emboss()
add_toaster()
add_gotham()
add_kelvin()
add_lomo()
add_nashville()
edge_detect()
shade()
double_channel()
make_circled()
is_youtube()
youtube_search()
youtube_search_process()
youtube_channel_search()
youtube_related()
youtube_play()
youtube_content_details()
youtube_duration()
youtube_views()
youtube_likes()
youtube_detailer()
youtube_chan_byname()
youtube_chan_byvideo()
youtube_quality()
youtube_thumbs()
is_youtube_hd()
get_youtube_id()
conv_youtube_time()
youtube_channel()
youtube_channel_process()
youtube_cat_vids()
dailymotion_search()
dailymotion_play()
dailymotion_search_process()
dailymotion_video_details()
vimeo_search()
vimeo_search_process()
vimeo_process_play()
vimeo_play()
yahoo_search()
yahoo_process_search()
valid_yahoo_site()
yahoo_valid_dur()
yahoo_valid_quality()
yahoo_mold_thumb()
scld_search()
scld_track_details()
scld_process_search()
