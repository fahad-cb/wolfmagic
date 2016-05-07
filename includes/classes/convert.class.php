<?php
	/**
	* 
	*/

	class WolfMagic extends HuntHelp
	{

		/**
		* Converts video from one format to other using FFMPEG
		* @param : { string } { $video_path } { link to video }
		* @param : { string } { $out_path } { where converted video is to be downlaoded }
		* @param : { string } { $out_format } { output format of video }
		* @param : { boolean } { $msg } { false by default. if set to true, displays operation messages }
		*			
		*/

		function convert_video( $video_path, $out_path, $out_format, $msg = false ) {	

			# check if FFMPEG is installed as it is required for conversion
			$ffmpeg = $this->got_ffmpeg();

			# if FFMPEG is installed, proceed
			if ( $ffmpeg ) {

				# check if current file is video, if yes, extract extension
				$video_ext = $this->is_video( $video_path );

				# if we have video extension meaning file is video, proceed
				if ( $video_ext ) {

					# check if output directory is writeable
					if ( !$this->perm_check($out_path) ) {

						if ( $msg ) {
							echo 'Unable to write into output directory.';
						}

						/*
						* Return false and close function if output directory is not
						* writeable
						*/
						return false;

					} else {

						# start preparation for video conversion

						$output_format = $out_format;

						# store output directory path 
						$video_name = $out_path;

						# generate random string to rename video
						$video_name .= $this->rand_string();

						# finally add video extesnion after name
						$video_name .= '.'.$output_format;

						# prepare conversion command
						$command = FFMPEG.' -i '.$video_path.' '.$video_name;

						# run conversion process and conver video
						$covnert = shell_exec($command);

						# check if output file is video is converted
						if ( file_exists($video_name) ) {

							if ( $msg ) {
								echo 'File converted successfuly : '.strtoupper($video_name);
							}

							# video is converted now return full path to it
							return $video_name;

						} else {

							if ( $msg ) {
								echo 'Something went wrong trying to convert video';
							}

							# video couldn't be converted so return false and close 
							# function

							return false;
						}
					}

				} else {

					if ( $msg ) {
						echo 'Invalid file format provided';
					}

					# return false if provided file is not a valid video
					return false;
				}

			} else {

				if ( $msg ) {
					echo 'Failed to convert video because FFMPEG was not found.';
				}

				# return false if FFMPEG is not found
				return false;
			}
		}

		/**
		* Converts audio from one format to other using FFMPEG
		* @param : { string } { $file_path } { link to audio }
		* @param : { string } { $output_format } { audio to be converted to }
		* @param : { string } { $msg } { false by default. if set to true, displays operation messages }
		*/

		function convert_audio( $audio_path, $out_path, $out_format, $msg = false ) {	

			# check if FFMPEG is installed before proceeding
			$ffmpeg = $this->got_ffmpeg();

			# if FFMPEG installed, proceed
			if ( $ffmpeg ) {

				# check if file is valid audio, if yes, extract extension
				$audio_ext = $this->is_audio( $audio_path );

				# if file is audio, proceed
				if ( $audio_ext ) {

					# check if output directory is writeable
					if ( !$this->perm_check($out_path) ) {

						if ( $msg ) {
							echo 'Unable to write into output directory.';
						}

						# directory is not writeable so return false
						return false;

					} else {

						# start preparation for audio conversion
						$output_format = $out;
						$audio_name = $out_path;

						# assign random string as audio file name
						$audio_name .= $this->rand_string();

						# add output audio extension to audio name
						$audio_name .= '.'.$out_format;

						# prepare the final command to be run
						$command = FFMPEG.' -i '.$audio_path.' '.$audio_name;

						# run conversion process to convert audio
						$covnert = shell_exec($command);

						# check if file has been converted successfuly
						if ( file_exists($audio_name) ) {

							if ( $msg ) {
								echo 'File converted successfuly : '.strtoupper($audio_name);
							}

							# file is converted so now return full path 
							return $audio_name;

						} else {

							if ( $msg ) {
								echo 'Something went wrong trying to convert audio';
							}

							# return false because file couldn't be converted
							return false;
						}
					}

				} else {

					if ( $msg ) {
						echo 'Invalid file format provided';
					}

					# return false because file provided is invalid audio
					return false;
				}

			} else {

				if ( $msg ) {
					echo 'Failed to convert audio because FFMPEG was not found.';
				}

				# return false because FFMPEG is not installed
				return false;
			}
		}

		/**
		* Combines two videos using FFMPEG
		* @param : { string } { $vid } { path of first video }
		* @param : { string } { $vid2 } { path of second video }
		* @param : { string } { $output_path } { where to save converted fiel }
		* @param : { string } { $format } { file format to save as (Must be video) }
		*/

		function merge_videos( $vid1, $vid2, $output_path, $format, $msg = false ) {

			# if FFMPEG is installed, proceed
			if ( $this->got_ffmpeg() ) {

				# check if first one is valid video
				if ( !$this->is_video($vid1) ) {

					if ( $msg ) {
						echo 'First video file is invalid.';
					}

					# First file is invalid video so return false
					return false;

				# check if second file is valid video
				} elseif ( !$this->is_video($vid2) ) {

					if ( $msg ) {
						echo 'Second video file is invalid.';
					}

					# second file is invalid video so return false
					return false;

				# check if output directory is writeable
				} elseif ( !$this->perm_check($output_path) ) {

					if ( $msg ) {
						echo 'Unable to write to output directory';	
					}

					# output directory is not writeable so return false
					return false;

				# check if first video is writable
				} elseif ( !$this->perm_check($vid1) ) {

					if ( $msg ) {
						echo 'Unable to write first file';	
					}

					# return false because first video is not writeable
					return false;

				# check if second video is writeable
				} elseif ( !$this->perm_check($vid2) ) {

					if ( $msg ) {
						echo 'Unable to write second file';	
					}

					# return false because second vidoe is not writeable
					return false;

				} else {

					# all good to go. Start preparing for merging videos

					# create a text with with a random name
					$the_file = __DIR__.'/'.$this->rand_string().'.txt';

					# create mockup of converted video names
					$converted_name = $output_path.'/'.$this->rand_string().'.'.$format;

					$command = MP4BOX." -force-cat -cat $vid1 -add $vid2 -new $converted_name";

					# run conversion process to merge videos
					$convert = $this->cmd($command);

					# check if videos were merged
					if ( file_exists($converted_name) ) {

						if ( $msg ) {
							echo "Videos merged succesffully. File is : ".$converted_name;						
						}

						# returned name of merged video
						return $converted_name;
					}
				}

			} else {

				if ( $msg ) {
					echo 'FFMPEG must be instlled before you can perform this operation.';		
				}

				# return false because FFMEPG is not installed
				return false;
			}
		}

		/**
		* Combines two videos using FFMPEG
		* @param : { array } { $videos_array } { array of videos to be merged }
		* @param : { string } { $output_path } { where to save converted fiel }
		* @param : { string } { $format } { file format to save as (Must be video) }
		*/

		function multi_vmerge( $videos_array, $output_path, $format, $msg = false ) {
			# all good to go. Start preparing for merging videos
			# create a text with with a random name

			# create mockup of converted video names
			$converted_name = $output_path.'/'.$this->rand_string().'.'.$format;
			$count = 0;
			$command = MP4BOX." -force-cat ";
			foreach ($videos_array as $video) {
				if ($count < 1) {
					$command .= " -cat $video ";
				} else {
					$command .= " -add $video ";
				}
			}
			$command .= " -new $converted_name";

			# run conversion process to merge videos
			$convert = $this->cmd($command);

			# check if videos were merged
			if ( file_exists($converted_name) ) {

				if ( $msg ) {
					echo "Videos merged succesffully. File is : ".$converted_name;						
				}

				# returned name of merged video
				return $converted_name;
			}
		}

		/**
		* Combines two or more audios using FFMPEG
		* @param : { string } { $aud1 } { path of first audio }
		* @param : { string } { $aud2 } { path of second audio }
		* @param : { string } { $output_path } { where to save converted file }
		* @param : { string } { $format } { file format to save as (Must be audio) }
		*/

		function merge_audios($aud1, $aud2, $output_path, $format, $msg = false) {
			# check if FFMPEG is installed then proceed
			if ( $this->got_ffmpeg() ) {

				# check if first file is valid audio
				if ( !$this->is_audio($aud1) ) {

					if ( $mgs ) {
						echo 'First audio file is invalid.';
					}				

					# first file is invalid audio so return false
					return false;

				# check if second file is valid audio
				} elseif ( !$this->is_audio($aud2) ) {

					if ( $mgs ) {
						echo 'Second audio file is invalid.';
					}

					# second file is invalid audio so return false
					return false;

				# check if output directory is writeable
				} elseif ( !$this->perm_check($output_path) ) {

					if ( $mgs ) {
						echo 'Unable to write to output directory';
					}				

					# output directory is not writable so return false
					return false;

				# check if first audio is writable
				} elseif ( !$this->perm_check($aud1) ) {

					if ( $mgs ) {
						echo 'Unable to write first file';
					}				

					# first video is not writeable so return false
					return false;

				# check if second audio is writebale
				} elseif ( !$this->perm_check($aud2) ) {

					if ( $mgs ) {
						echo 'Unable to write second file';	
					}

					# second video is not writeable so return false
					return false;

				} else {

					# all good to go so prepare for audio merging

					# create a text file with random name
					$the_file = $this->rand_string().'.txt';
					$converted_name = $output_path.'/'.$this->rand_string().'.'.$format;
					$command = MP4BOX." -force-cat -cat $aud1 -add $aud2 -new $converted_name";
					echo $command;
					# run conversion process and merge audios
					$convert = shell_exec($command);

					# check if audios were merfed successfuly
					if ( file_exists($converted_name) ) {

						if ( $msg ) {
							echo "Audios merged succesffully. File is : ".$converted_name;
						}

						# return path to merged audio file
						return $converted_name;
					}
				}

			} else {

				if ( $mgs ) {
					echo 'FFMPEG must be instlled before you can perform this operation.';					
				}

				# FFMPEG is not installed so return false
				return false;
			}
		}


		/**
		* Cuts a part of video as given parameters by user
		* @param : { string } { $video }  { link or path of video }
		* @param : { integer } { $start } { point to start cutting }
		* @param : { integer } { $length } { time from start point to end point }
		* @param : { string } { $output_path } { where to save output video }
		* @param : { boolean } { $msg } { false by default. if set to true, displays operation messages }
		*/

		function split_video($video, $start, $length, $output_path, $msg = false) {

			# check if FFMPEG is installed
			$ffmpeg = $this->got_ffmpeg();

			# proceed if FFMPEG is installed
			if ( $ffmpeg ) {

				# check if provided file is valid video
				$video_ext = $this->is_video( $video );

				# if file is video, proceed
				if ( $video_ext ) {

					# check if output directory is writeable
					if ( !$this->perm_check($output_path) ) {

						if ( $msg ) {
							echo 'Unable to write into output directory.';
						}

						# output directory is not writeable so return false
						return false;

					} else {

						# all good to go so prepare for conversion
						$video_name = $output_path.'/';

						# assign random name to output file
						$video_name .= $this->rand_string();
						$video_name .= '.'.$video_ext;

						# length that we are going to split
						$total_len = $length - $start;

						# final FFMPEG command
						$command = FFMPEG.' -i '.$video.' -ss '.$start.' -codec copy -t '.$length.' '.$video_name;
						
						# run conversion process and split video
						$covnert = shell_exec($command);

						# check if file was splitted succesfuly
						if ( file_exists( $video_name) ) {

							if ( $msg ) {
								echo 'File splitted successfuly from '.$start.' to '.$length.' (total second : '.$total_len.') : '.strtoupper($video_name);
							}

							# return full path to splitted video
							return $video_name;

						} else {

							if ( $msg ) {
								echo 'Something went wrong trying to split your video';
							}

							# return false because vidoe couldn't be converted
							return false;
						}
					}

				} else {

					if ( $msg ) {
						echo 'Invalid file format provided';
					}

					# invalid video format was provided so return false
					return false;
				}

			} else {

				if ( $msg ) {
					echo 'Failed to split video because FFMPEG was not found.';
				}

				# FFMPEG is not installed so return false
				return false;
			}
		}
		
		function multi_splits($video_path, $output_dir, $points) {
			$points = array_filter($points);
			$total_points = count($points);
			$count = 1;
			if (is_array($points)) {
				$carved_pieces = array();
				foreach ($points as $tosplit) {
					$start_end = explode(',', $tosplit);
					$start = $start_end[0];
					$end = $start_end[1];
					$splitted = $this->split_video($video_path, $start, $end, $output_dir);
					if ($splitted) {
						$carved_pieces[] = $splitted;
						if ($count >= $total_points) {
							return $carved_pieces;
						}
					} else {
						return false;
					}
					$count = $count + 1;
				}
			}
		}

		function xSplits($video_path, $output_dir, $slices = 5) {
			if ($this->is_video($video_path)) {
				$duration = $this->media_detailer($video_path, 'dur');
				$pieces = $duration / $slices;
				$start = 0;
				$end = $pieces;
				$split_points = array();
				while ($start < $duration) {
					$split_points[] = "$start,$pieces";
					$start = $end;
					$end = $end + $pieces;
				}
				$splitted = $this->multi_splits($video_path, $output_dir, $split_points);
				if (is_array($splitted)) {
					$this->pex($splitted);
					return $splitted;
				} else {
					return false;
				}
			}
		}

		function xSecSplit($video_path, $output_dir, $split_dur, $sleep = '10') {
			if ($this->is_video($video_path)) {
				if ($this->got_ffmpeg()) {
					$duration = $this->media_detailer($video_path, 'dur');
					$current_pos = 0;
					$split_points = array();
					while ($current_pos < $duration) {
						$split_points[] = "$current_pos,$split_dur";
						$current_pos = $current_pos + $sleep;
					}
					$splitted = $this->multi_splits($video_path, $output_dir, $split_points);
					if (is_array($splitted)) {
						$this->pex($splitted);
						return $splitted;
					} else {
						return false;
					}
				}
			}
		}

		/**
		* Extracts audio from a video without downloading or converting that it
		* @param : { string } { $video_path } { link to video }
		* @param : { string } { $audio_format } { format to store extracted audio }
		* @param : { integer } { $bitrate } { 128 by default. Effects audio quality }
		* @param : { boolean } { $msg } { false by default. if set to true, displays operation messages }
		*/

		function get_audio_only($video_path, $output_path, $audio_format = '.mp3', $bitrate = 128, $msg = false) {

			# check iff FFMPEG is installed
			if (PHP_OS == 'WINNT') {
				$ffmpeg = $this->got_ffmpeg(FFMPEG);
			} else {
				$ffmpeg = $this->got_ffmpeg();
			}

			# proceed if FFMPEG is installed
			if ( $ffmpeg ) {

				# check if provided file is valid video
				$video_ext = $this->is_video( $video_path );

				# if file is valid video, proceed
				if ( $video_ext ) {

					# check if output directory is writeable
					if ( !$this->perm_check($output_path) ) {

						if ( $msg ) {
							echo 'Unable to write into output directory.';
						}

						# output directory is not writeable so return false
						return false;

					} else {

						# all good to go so perpare conversion process
						$audio_name = $output_path;
						# assign random name to output file
						$audio_name .= "/".$this->rand_string().".".$audio_format;

						# prepare final conversion commmand
						$command = FFMPEG.' -i '.$video_path.' -vn -ab '.$bitrate.' '.$audio_name;
						# run conversion process			
						$covnert = shell_exec($command);
						echo $command;
						# check if file was converted
						if ( file_exists( $audio_name) ) {

							if ( $msg ) {
								echo 'Audio extracted successfuly: '.$audio_name;
							}

							# return full audio path
							return $audio_name;

						} else {

							if ( $msg ) {
								echo 'Something went wrong trying to extract audio from your video';
							}

							# couldn't convert so return false
							return false;
						}
					}

				} else {

					if ( $msg ) {
						echo 'Invalid file format provided';
					}

					# video file was invalid so return false
					return false;
				}

			} else {

				if ( $msg ) {
					echo 'Failed to extract audio from video because FFMPEG was not found.';
				}

				# FFMPEG is not installed so return false
				return false;
			}
		}

		/**
		* Extracts video from a video while muting its audio completely
		* @param : { string } { $video_path } { link to video }
		* @param : { string } { $output_path } { place to save output video [dir path only] }
		* @param : { boolean } { $msg } { false by default. if set to true, displays operation messages }
		*/

		function get_video_only( $video_path, $output_path, $msg = false ) {

			# check if FFMPEg is installed
			$ffmpeg = $this->got_ffmpeg(FFMPEG); // no parameters if linux

			# proceed if FFMPEG is installed
			if ( $ffmpeg ) {
				# check if provided video is valid format
				$video_ext = $this->is_video( $video_path );

				# if video is valid, proceed
				if ( $video_ext ) {

					# check if output director is writeable
					if ( !$this->perm_check($output_path) ) {

						if ( $msg ) {
							echo 'Unable to write into output directory.';
						}

						# output directory is not writeable so return false
						return false;

					} else {

						# all good to go so prepare for conersion

						$output_format = $video_ext;
						$video_name = $output_path;

						# give random name to output file
						$video_name .= $this->rand_string();
						$video_name .= '.'.$output_format;

						# final FFMPEG command to be run
						$command = FFMPEG.' -i '.$video_path.' -an '.$video_name;

						# run conversion process to get video only
						$covnert = shell_exec($command);

						# check if file was converted
						if ( file_exists($video_name) ) {

							if ( $msg ) {
								echo 'Video muted successfuly : '.$video_name;
							}

							# return full path to video
							return $video_name;

						} else {

							if ( $msg ) {
								echo 'Something went wrong trying to convert video';
							}

							# could not convert so return false
							return false;
						}
					}

				} else {

					if ( $msg ) {
						echo 'Invalid file format provided';
					}

					# video provided was invalid so return false
					return false;
				}

			} else {

				if ( $msg ) {
					echo 'Failed to convert video because FFMPEG was not found.';
				}

				# FFMPEG installation was not found so return false
				return false;
			}
		}

		/**
		* Resizez a video according to parameters provided by users
		* @param : { string } { $video_path } { link or path to video }
		* @param : { string } { $resize_to } { resizing size e.g (640x480) }
		* @param : { boolean } { $msg } { false by default. if set to true, displays operation messages }
		*/

		function resize_video( $video_path, $output_path, $resize_to = '320x240', $output_format, $msg = false ) {

			# check if FFMPEG is installed
			$ffmpeg = $this->got_ffmpeg();

			# proceed if FFMPEG is isntalled
			if ( $ffmpeg ) {

				# check if provided file is valid video
				$video_ext = $this->is_video( $video_path );

				# if video is valid, proceed
				if ( $video_ext ) {

					# check if output directory is writeable
					if ( !$this->perm_check($output_path) ) {

						if ( $msg ) {
							echo 'Unable to write into output directory.';
						}

						# Output directory is not writeable so return false
						return false;

					} else {

						# all good to go so perpare for actual conversion
						$video_name = $output_path;

						# assign random name to output file
						$video_name .= $this->rand_string();
						$video_name .= '.'.$output_format;

						# prepare final command for FFMPEG
						$command = FFMPEG.' -i '.$video_path.' -s '.$resize_to.' '.$video_name;

						# run conversion process by passing command to FFMPEG
						$covnert = shell_exec($command);

						# check if video was converted sucessfuly
						if ( file_exists($video_name) ) {

							if ( $msg ) {
								echo 'Video resized successfuly to '.$resize_to.' : '.$video_name;
							}

							# return full path to conerted video
							return $video_name;

						} else {

							if ( $msg ) {
								echo 'Something went wrong trying to convert video';
							}

							# failed to conert video so return false
							return false;
						}
					}

				} else {

					if ( $msg ) {
						echo 'Invalid file format provided';
					}

					# file was invalid video so return fasle
					return false;
				}

			} else {

				if ( $msg ) {
					echo 'Failed to convert video because FFMPEG was not found.';
				}

				# return false because FFMPEG is not installed
				return false;
			}
		}

		/**
		* Converts a video to 1080p video quality
		* @param: { string } { $video_path } { Link or path to video }
		* @param: { string } { $output_path } { Direcotry path where file is to be saved }
		* @param: { string } { $output_format } { Format to convert videos in }
		* @param: { boolean } { $msg } { false by default. Shows errors }
		*/
		
		function conv_1080( $video_path, $output_path, $output_format, $msg = false ) {

			# call resize video function and it will do all the job
			$converted = $this->resize_video( $video_path, $output_path, '1920x1080', $output_format );
		}


		/**
		* Convert a video to 720p video quality
		* @param: { string } { $video_path } { Link or path to video }
		* @param: { string } { $output_path } { Direcotry path where file is to be saved }
		* @param: { string } { $output_format } { Format to convert videos in }
		* @param: { boolean } { $msg } { false by default. Shows errors }
		*/

		function conv_720( $video_path, $output_path, $output_format, $msg = false ) {

			# # call resize video function and it will do all the job
			$converted = $this->resize_video( $video_path, $output_path, '1280x720', $output_format );
		}

		/**
		* Convert a video to 480p video quality
		* @param: { string } { $video_path } { Link or path to video }
		* @param: { string } { $output_path } { Direcotry path where file is to be saved }
		* @param: { string } { $output_format } { Format to convert videos in }
		* @param: { boolean } { $msg } { false by default. Shows errors }
		*/

		function conv_480( $video_path, $output_path, $output_format, $msg = false ) {

			# # call resize video function and it will do all the job
			$converted = $this->resize_video( $video_path, $output_path, '858x480', $output_format );
		}

		/**
		* Convert a video to 360p video quality
		* @param: { string } { $video_path } { Link or path to video }
		* @param: { string } { $output_path } { Direcotry path where file is to be saved }
		* @param: { string } { $output_format } { Format to convert videos in }
		* @param: { boolean } { $msg } { false by default. Shows errors }
		*/

		function conv_360( $video_path, $output_path, $output_format, $msg = false ) {

			# # call resize video function and it will do all the job
			$converted = $this->resize_video( $video_path, $output_path, '480x360', $output_format );
		}


		/**
		* Convert a video to 240p video quality
		* @param: { string } { $video_path } { Link or path to video }
		* @param: { string } { $output_path } { Direcotry path where file is to be saved }
		* @param: { string } { $output_format } { Format to convert videos in }
		* @param: { boolean } { $msg } { false by default. Shows errors }
		*/

		function conv_240( $video_path, $output_path, $output_format, $msg = false ) {

			# # call resize video function and it will do all the job
			$converted = $this->resize_video( $video_path, $output_path, '352x240', $output_format );
		}

		/**
		* Convert a video to all video qualities
		* @param: {string} { $video_path } { Link or path to video }
		* @param: { string } { $output_path } { Direcotry path where file is to be saved }
		* @param: { string } { $output_format } { Format to convert videos in }
		* @param: { boolean } { $msg } { false by default. Shows errors }
		*/


		function conv_all( $video_path, $output_path, $output_format, $msg = false ) {

			# check if ffmpeg is installed
			$ffmpeg = $this->got_ffmpeg();

			# if FFMPEG is installed, proceed
			if ( $ffmpeg ) {

				# check if provided is valid video
				$video_ext = $this->is_video( $video_path );

				# if video is valid, proceed
				if ( $video_ext ) {
					$vheight = $this->media_detailer($video_path, 'height');
					$maxconv = $this->can_convert($vheight);
					# check if output directory is writebale
					if ( !$this->perm_check($output_path) ) {

						if ( $msg ) {
							echo 'Unable to write into output directory.';
						}

						# output directory is not writeable so return false
						return false;

					} else {

						# all good to go so now prepare for conversion
						$video_name = $output_path;

						# assign random name for converted file
						$video_name .= $this->rand_string();

						# create an array with commands as we need more than one commands
						$command = [];

						# create 240p conversion command
						if ($vheight >= 240) {
							$command['240'] = FFMPEG.' -i '.$video_path.' -s 352x240 '.$video_name.'-240.'.$output_format;
						}

						# create 360p conversion command
						if ($vheight >= 360) {
							$command['360'] = FFMPEG.' -i '.$video_path.' -s 480x360 '.$video_name.'-360.'.$output_format;
						}

						# create 480p conversion command
						if ($vheight >= 480) {
						$command['480'] = FFMPEG.' -i '.$video_path.' -s 858x480 '.$video_name.'-480.'.$output_format;
						}

						# create 720p conversion command
						if ($vheight >= 720) {
							$command['720'] = FFMPEG.' -i '.$video_path.' -s 1280x720 '.$video_name.'-720.'.$output_format;
						}

						# convert 1080p conversion command
						if ($vheight >= 1080) {
							$command['1080'] = FFMPEG.' -i '.$video_path.' -s 1920x1080 '.$video_name.'-1080.'.$output_format;
						}

						# run all commands one by one and convert videos
						foreach ($command as $convert) {
							$this->cmd($convert);
						}
						
						# check if video converted
						$maxfile = $video_name."-$maxconv.$output_format";
						if ( file_exists($maxfile) ) {

							if ( $msg ) {
								echo 'Video resized successfuly : '.$video_name;
							}

							# video converted so return full path to it
							return $video_name;

						} else {

							if ( $msg ) {
								echo 'Something went wrong trying to convert video';
							}

							# Failed to convert video so return false
							return false;
						}
					}

				} else {

					if ( $msg ) {
						echo 'Invalid file format provided';
					}

					# video is invalid format so return false
					return false;
				}

			} else {

				if ( $msg ) {
					echo 'Failed to convert video because FFMPEG was not found.';
				}

				# FFMPEG not installed so return false
				return false;
			}
		}

		function throw_thumb($video_path, $thumb_path, $position, $size = false, $msg = false) {
			$command = FFMPEG." -i $video_path -ss $position -vframes 12 $thumb_path";
			$this->cmd($command);
			if (file_exists($thumb_path)) {
				if ($msg) {
					echo "Thumb generated @: $thumb_path";
				}
				return $thumb_path;
			} else {
				if ($msg) {
					echo "Something went wrong trying to generate thumb";
				}
				return false;
			}
		}

		function xSecThumbs($video_path, $thumbs_dir, $prefix, $xsec, $ext = 'png', $size = false, $msg = false) {
			$command = FFMPEG." -i $video_path -vf fps=1/$xsec $thumbs_dir/$prefix%d.$ext";
			$this->cmd($command);
			$first_thumb = "$thumbs_dir/$prefix.1.$ext";
			if (file_exists($first_thumb)) {
				if ($msg) {
					echo "Thumbs generated @: $thumbs_dir";
				}
				return $thumbs_dir;
			} else {
				if ($msg) {
					echo "Something went wrong trying to generate thumb";
				}
				return false;
			}
		}

		function xThumbs($video_path, $thumbs_dir, $prefix, $thumbs = '5', $msg = false) {
			if (file_exists($video_path)) {
				$duration = $this->media_detailer($video_path, 'dur');
				if ($duration <= $thumbs) {
					$this->xSecThumbs($video_path, $thumbs_dir, $prefix, '1');
				} else {
					$position = $duration/$thumbs;
					if (is_numeric($position)) {
						$this->xSecThumbs($video_path, $thumbs_dir, $prefix, $position);
					}
				}
			}
		}

		function flip($video_path, $output_path, $mode = 'v', $msg = false) {
			if (file_exists($video_path)) {
				if ($mode == 'v') {
					$flipto = 'vflip';
				} else {
					$flipto = 'hflip';
				}
				$command = FFMPEG." -i $video_path -vf '$flipto' $output_path";
				$this->cmd($command);
				if (file_exists($output_path)) {
					if ($msg) {
						echo "File flipped and saved @: $output_path";
					}
					return $output_path;
				} else {
					if ($msg) {
						echo "Unable to flip video";
					}
					return false;
				}
			}
		}

		function flip_horizental($video_path, $output_path) {
			$this->flip($video_path, $output_path, $mode = 'h');
		}

		function flip_vertical($video_path, $output_path) {
			$this->flip($video_path, $output_path, $mode = 'v');
		}

		function flip_both($video_path, $output_dir, $ext = 'mp4') {
			$vflip_name = $output_dir.'/vertical_'.$this->rand_string(4).'.'.$ext;
			$hflip_name = $output_dir.'/horizental_'.$this->rand_string(4).'.'.$ext;
			$vertical = $this->flip_vertical($video_path, $vflip_name);
			$horizental = $this->flip_horizental($video_path, $hflip_name);
			$flipped = array('v' => $vertical, 'h' => $horizental);
			return $flipped;
		}

		function grayscale($video_path, $output_path) {
			$command = FFMPEG.' -i '.$video_path.' -vf "hue=s=0" '.$output_path;
			$this->cmd($command);
			if (file_exists($output_path)) {
				return $output_path;
			} else {
				return false;
			}
		}

		function grayscale_at($video_path, $output_path, $grey_points) {
			$command = FFMPEG.' -i '.$video_path.' -vf "hue=s=0:enable=\'between(t,3,5)\'" '.$output_path;
			$command = FFMPEG." -i $video_path -vf ";
			$count = 0;
			foreach ($grey_points as $point) {
			 	$start_end = explode(',', $point);
			 	$start = $start_end[0];
			 	$end = $start_end[1];
			 	if ($count > 0) {
			 		$command .= "\",hue=s=0:enable='between(t,$start,$end)'";
			 	} else {
			 		$command .= "\"hue=s=0:enable='between(t,$start,$end)'";
			 	}
			 	$count = $count + 1;
			 } 
			 $command .= "\" $output_path";
			$this->cmd($command);
			if (file_exists($output_path)) {
				return $output_path;
			} else {
				return false;
			}			
		}

		function split_screen($vid1, $vid2, $output_path) {
			$command = FFMPEG.' -i '.$vid1.' -vf "[in] scale=iw/3:ih/3, pad=2*iw:ih [left];movie='.$vid2.', scale=iw/3:ih/3, fade=out:300:30:alpha=1 [right]; [left][right] overlay=main_w/2:0 [out]" -b:v 768k '.$output_path;
			echo $command;
			$this->cmd($command);
			if (file_exists($output_path)) {
				return $output_path;
			} else {
				return false;
			}
		}

		function speedup_video($video_path, $output_path, $increase = '0.5') {
			if (file_exists($video_path)) {
				$command = FFMPEG.' -i '.$video_path.' -filter:v "setpts='.$increase.'*PTS" '.$output_path;
				$this->cmd($command);
				if (file_exists($output_path)) {
					return $output_path;
				} else {
					return false;
				}
			} else {
				return false;
			}
		}

		function slowdown_video($video_path, $output_path, $decrease = '2.0') {
			if (file_exists($video_path)) {
				$command = FFMPEG.' -i '.$video_path.' -filter:v "setpts='.$decrease.'*PTS" '.$output_path;
				$this->cmd($command);
				if (file_exists($output_path)) {
					return $output_path;
				} else {
					return false;
				}
			} else {
				return false;
			}
		}

		function video_speed($video_path, $output_path, $mode = 'i') {
			if ($mode == 'i') { // i =  incremenet
				$this->speedup_video($video_path, $output_path);
			} else {
				$this->slowdown_video($video_path, $output_path);
			}
		}

		function add_watermark($video_path, $output_path, $img, $position = 'tl', $msg = false) {
			if (file_exists($video_path) && file_exists($img)) {
				switch ($position) {
					case 'tl':
						$position = 'overlay=10:10';
						break;
					case 'tr':
						$position = 'overlay=main_w-overlay_w-10:10';
						break;
					case 'bl':
						$position = 'overlay=10:main_h-overlay_h-10';
						break;
					case 'br':
						$position = 'overlay=main_w-overlay_w-10:main_h-overlay_h-10';
						break;
					case 'cnt':
						$position = 'overlay=x=(main_w-overlay_w)/2:y=(main_h-overlay_h)/2';
						break;
					
					default:
						$position = 'overlay=10:10';
						break;
				}
				$command = FFMPEG.' -i '.$video_path.' -i '.$img.' -filter_complex "'.$position.'" '.$output_path;
				echo $command;
				$this->cmd($command);
				if (file_exists($output_path)) {
					return $output_path;
				} else {
					return false;
				}
			} else {
				return false;
			}
		}

		function watermark_topleft($video_path, $output_path, $img) {
			$added = $this->add_watermark($video_path, $output_path, $img);
			if ($added) {
				return $added;
			} else {
				return false;
			}
		}

		function watermark_topright($video_path, $output_path, $img) {
			$added = $this->add_watermark($video_path, $output_path, $img, 'tr');
			if ($added) {
				return $added;
			} else {
				return false;
			}
		}

		function watermark_bottomleft($video_path, $output_path, $img) {
			$added = $this->add_watermark($video_path, $output_path, $img, 'bl');
			if ($added) {
				return $added;
			} else {
				return false;
			}
		}

		function watermark_bottomright($video_path, $output_path, $img) {
			$added = $this->add_watermark($video_path, $output_path, $img, 'br');
			if ($added) {
				return $added;
			} else {
				return false;
			}
		}

		function watermark_center($video_path, $output_path, $img) {
			$added = $this->add_watermark($video_path, $output_path, $img, 'cnt');
			if ($added) {
				return $added;
			} else {
				return false;
			}
		}

		function mute_at($video_path, $output_path, $mute_points, $msg = false) {
			if (file_exists($video_path)) {
				$ext = $this->is_video($video_path);
				if ($ext) {
					if ($this->got_ffmpeg()) {
						$command = FFMPEG." -i $video_path -af ";
						$count = 0;
						foreach ($mute_points as $point) {
						 	$start_end = explode(',', $point);
						 	$start = $start_end[0];
						 	$end = $start_end[1];
						 	if ($count > 0) {
						 		$command .= "\",volume=enable='between(t,$start,$end)':volume=0";
						 	} else {
						 		$command .= "\"volume=enable='between(t,$start,$end)':volume=0";
						 	}
						 	$count = $count + 1;
						 } 
						 $command .= "\" $output_path";
						$this->cmd($command);
					} else {
						return false;
					}
				} else {
					return false;
				}
			} else {
				return false;
			}
		}

		function add_preroll($video_path, $output_path, $preroll_path, $msg = false) {
			if ($this->is_video($preroll_path)) {
				$prerolled = $this->merge_videos($video_path, $preroll_path, $output_path, 'mp4', true);
				if ($prerolled) {
					return $prerolled;
				}
			}
		}

		function add_midroll($video_path, $output_path, $midroll_path, $msg = false) {
			if ($this->is_video($video_path)) {
				if ($this->is_video($midroll_path)) {
					if ($this->perm_check($output_path)) {
						if ($this->got_ffmpeg()) {
							$vduration = $this->media_detailer($video_path, 'dur');
							$vmid = $vduration / 2;
							$split_first = $this->split_video($video_path, '0', $vmid, $output_path, true);
							$split_second = $this->split_video($video_path, $vmid, $vduration, $output_path, true);
							$videos = array($split_first, $midroll_path, $split_second);
							$new_video = $this->multi_vmerge($videos, $output_path, 'mp4');
							if (file_exists($new_video)) {
								unlink($split_first);
								unlink($split_second);
								return $new_video;
							} else {
								if ($msg) {
									echo "Something went wrong trying to add midroll";
								}
								return false;
							}
							
						} else {
							if ($msg) {
								echo "Failed to add midroll because FFMPEG was not found";
							}
							return false;
						}
					} else {
						if ($msg) {
							echo "Unable to write into output directory";
						}
						return false;
					}
				} else {
					if ($msg) {
						echo "Invalid midroll video format provided";
					}
					return false;
				}
			} else {
				if ($msg) {
					echo "Invalid input video format provided";
				}
				return false;
			}
		}

		function add_postroll($video_path, $output_path, $postroll_path, $msg = false) {
			if ($this->is_video($postroll_path)) {
				$postrolled = $this->merge_videos($postroll_path, $video_path, $output_path, 'mp4', true);
				if ($postrolled) {
					return $postrolled;
				}
			}
		}

		function add_postpre_roll($video_path, $output_path, $preroll_path, $postroll_path) {
			if ($this->is_video($video_path)) {
				if ($this->is_video($preroll_path) && $this->is_video($postroll_path)) {
					if ($this->got_ffmpeg()) {
						$videos = array($preroll_path, $video_path, $postroll_path);
						$this->multi_vmerge($videos, $output_path, 'mp4');
					}
				}
			}
		}

		function add_allrolls($video_path, $output_path, $preroll_path, $midroll_path, $postroll_path) {
			if ($this->is_video($video_path)) {
				if ($this->is_video($preroll_path) && $this->is_video($midroll_path) && $this->is_video($postroll_path)) {
					if ($this->got_ffmpeg()) {
						$vduration = $this->media_detailer($video_path, 'dur');
						$vmid = $vduration / 2;
						$split_first = $this->split_video($video_path, '0', $vmid, $output_path);
						$split_second = $this->split_video($video_path, $vmid, $vduration, $output_path);

						$videos = array($preroll_path, $split_first, $midroll_path, $split_second, $postroll_path);
						$allrolls = $this->multi_vmerge($videos, $output_path, 'mp4');
						if (file_exists($allrolls)) {
							unlink($split_first);
							unlink($split_second);
							return $allrolls;
						}
					}
				}
			}
		}

		function reverse_video($video_path, $output_path, $audio_reverse = false) {
			if ($this->is_video($video_path)) {
				if ($this->got_ffmpeg()) {
					$command = FFMPEG." -i $video_path -vf 'reverse' ";
					if ($audio_reverse) {
						$command .= " -af 'areverse' ";
					}
					$command .= " $output_path ";
					exit($command);
					$this->cmd($command);
					if (file_exists($output_path)) {
						return $output_path;
					}
				}
			}
		}

		function multi_vreverse($videos_array, $output_dir, $audio_reverse = false, $format = 'mp4') {
			if (is_array($videos_array)) {
				$rev_vids = array();
				foreach ($videos_array as $video) {
					$name = $output_dir.'/'.$this->rand_string(5).'.'.$format;
					$path = $this->reverse_video($video, $name, $audio_reverse);
					$rev_vids[] = $path;
				}
				return $rev_vids;
			}
		}

		function grid_four($videos, $output_path, $width = 1280, $height = 720) {
			$command = FFMPEG;
			foreach ($videos as $video) {
				$command .= " -i $video ";
			}

			$half_width = $width / 2;
			$half_height = $height / 2; 

			$scale = $half_width;
			$scale .= "x".$half_height;

			$command .= ' -filter_complex "nullsrc=size='.$width.'x'.$height.' [base]; [0:v] setpts=PTS-STARTPTS, scale='.$scale.' [upperleft]; [1:v] setpts=PTS-STARTPTS, scale='.$scale.' [upperright]; [2:v] setpts=PTS-STARTPTS, scale='.$scale.' [lowerleft]; [3:v] setpts=PTS-STARTPTS, scale='.$scale.' [lowerright]; [base][upperleft] overlay=shortest=1 [tmp1]; [tmp1][upperright] overlay=shortest=1:x='.$half_width.' [tmp2]; [tmp2][lowerleft] overlay=shortest=1:y='.$half_height.' [tmp3]; [tmp3][lowerright] overlay=shortest=1:x='.$half_width.':y='.$half_height.'" -c:v libx264 '.$output_path;
			$this->cmd($command);
			if (file_exists($output_path)) {
				return $output_path;
			} else {
				return false;
			} 
		}

		function extract_waveform($video_path, $output_img, $imgsize = '640x120') {
			if ($this->is_video($video_path)) {
				if ($this->got_ffmpeg()) {
					$command = FFMPEG.' -i '.$video_path.' -filter_complex "compand,showwavespic=s='.$imgsize.'" -frames:v 1 '.$output_img;
					$this->cmd($command);
					if (file_exists($output_img)) {
						return $output_img;
					} else {
						return false;
					}
				}
			}
		}

		function hardcode_subtitles($video_path, $output_path, $sub_file) {
			if ($this->is_video($video_path)) {
				if ($this->got_ffmpeg()) {
					$command = FFMPEG.' -i '.$video_path.' -vf subtitles='.$sub_file.' '.$output_path;
					$this->cmd($command);
					if (file_exists($output_path)) {
						return $output_path;
					} else {
						return false;
					}
				}
			}
		}

		// Accer Iconia Tab, ASUS Transformer TF101 & Transformer Prime TF201 
		function conv_iconia( $video_path, $output_path, $output_format, $msg = false ) {

			# call resize video function and it will do all the job
			$converted = $this->resize_video( $video_path, $output_path, '1280x800', $output_format );
			return $converted;
		}
		
		// for ipad & ipad 2
		function conv_ipad( $video_path, $output_path, $output_format, $msg = false ) {

			# call resize video function and it will do all the job
			$converted = $this->resize_video( $video_path, $output_path, '1024×768', $output_format );
			return $converted;
		}

		function conv_ipad3( $video_path, $output_path, $output_format, $msg = false ) {

			# call resize video function and it will do all the job
			$converted = $this->resize_video( $video_path, $output_path, '2048x1536', $output_format );
			return $converted;
		}

		# Amazon Kindle Fire & Barnes & Noble's NOOK
		function conv_kindle_fire( $video_path, $output_path, $output_format, $msg = false ) {

			# call resize video function and it will do all the job
			$converted = $this->resize_video( $video_path, $output_path, '1024×600', $output_format );
			return $converted;
		}

		function audiox_merge($video, $audio, $output_path) {
			if ($this->is_video($video)) {
				if ($this->is_audio($audio)) {
					if ($this->got_ffmpeg()) {
						$extracted_audio = $this->get_audio_only($video, TEMP_DIR, 'mp3');
						if ($extracted_audio) {
							$merged = $this->merge_audios($audio, $extracted_audio, TEMP_DIR, 'mp3');
							if (file_exists($merged)) {
								return $merged;
							}
						}
					}
				}
			}
		}

		function convert_mp4($video_path, $out_path, $msg = false) {
			return $this->convert($video_path, $out_path, $out_format = 'mp4', $msg);
		}

		function convert_mov($video_path, $out_path, $msg = false) {
			return $this->convert($video_path, $out_path, $out_format = 'mov', $msg);
		}

		function convert_wmv($video_path, $out_path, $msg = false) {
			return $this->convert($video_path, $out_path, $out_format = 'wmv', $msg);
		}
	}
?>