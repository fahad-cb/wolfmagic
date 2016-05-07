<?php
	/**
	* 
	*/



	class HuntHelp
	{

		function cmd($cmd, $out = true) {
			if ($out) {
				#exit($cmd);
				$data = shell_exec($cmd);
			} else {
				$data = exec($cmd);
			}
			return $data;
		}

		function pex($array, $exit = true) {
			echo "<pre>";
			print_r($array);
			echo "</pre>";
			if ($exit) {
				exit("PEX Ran");
			}
		}

		/**
		* Check if provided URL or path is a video. If video,
		* returns video extension else returns false.
		* @param : { string } { $path } { video link or path }
		* @param :  { boolean } { $msg } { false by default. if set to true, displays operation messages }
		*/

		function is_video( $path, $msg = false ) {

			# create an array of standard video formats
			$formats = array('mp4','MP4', 'wmv', 'webm', 'ogv', 'mov', '3gp',
							'flv', 'MPEG', 'mpeg', 'mpeg4'
				);

			# exract extension of provided (mp4, mpeg etc)
			$video_format = pathinfo($path, PATHINFO_EXTENSION);
			# check if video extension is available in standard video formats array
			if ( in_array($video_format, $formats) ) {

				if ( $msg ) {
					echo 'Provided file is '.strtoupper($video_format).' video';
				}

				# return video extension if video is found in $formats array
				return $video_format;

			} else {

				if ( $msg ) {
					echo 'File is invalid video format : '.strtoupper($video_format);
				}

				# if video doesn't exist in array, 
				# return false and close function

				return false;
			}
		}

		/**
		* Checks if provided link is audio. If audio, returns audio format else returns false
		* @param : { string } { $url } { link to audio }
		* @param : { boolean } { $msg } { false by default. if set to true, displays operation messages }	
		*/

		function is_audio($url, $msg = false) {

			# create an array of standard audio formats
			$formats = array('mp3', 'wav', 'aac', 'ogg', 'oga', 'wav', 'wma', 'webm');

			# check current audio file's extension
			$audio_format = pathinfo($url, PATHINFO_EXTENSION);

			# check if current audio's extension is in audio's array
			if ( in_array($audio_format, $formats) ) {

				if ( $msg ) {
					echo 'Provided file is '.strtoupper($audio_format).' audio';
				}

				# return video extension if it is in $formats array
				return $audio_format;

			} else {

				if ( $msg ) {
					echo 'File is invalid audio format : '.$audio_format;
				}

				# return false if video is not standard audio
				return false;
			}
		}

		/**
		* Check if FFMPEG is installed on server
		* @param: { boolean } { $msg } { false by default. shows errors if true }
		*/

		function got_ffmpeg( $path = false, $msg = false ) {
			if (PHP_OS == 'WINNT') {
				$path = FFMPEG;
			}
			if (!$path) {
				$ffmpeg = shell_exec('which ffmpeg');
			} else {
				$ffmpeg = file_exists($path);
			}
			if ( $ffmpeg ) {
				if ( $msg ) {
					echo 'FFMPEG is installed at '.$ffmpeg;
				}
				return $ffmpeg;
			} else {
				if ( $msg ) {
					echo 'FFMPEG installation not found.';
				}
				return false;
			}
		}

		/**
		* Download any video from internet using YouTube-dl
		* @param: { string } { $url } { link to video to download }
		* @param: { string } { $output_path } { directory where to save file }
		* @param: { boolean } { $read_data } { false by default. Shows output if true }
		* @param: { boolean } { $msg } { false by default. Shows errors }
		*/

		function get_any_video( $url, $output_path, $read_data = false, $msg = false ) {

			# check if YouTube-dl is installed 
			$the_dl = $this->got_youtubedl();

			# if youtubedl is installed, proceed
			if ( $the_dl ) {

				# check if provided is valid url
				if ( $this->is_url($url) ) {

					// below var to be used instead of title to get original name
					#  $video_name = '"'.$output_path.'/%(title)s"';

					# assign video a random name
					$title = $output_path.$this->rand_string();

					# prepare command to be run by FFMPEG
					$command = 'youtube-dl -o '.$title.' '.$url;

					# run the command and download video
					$download = shell_exec($command);

					# check if video was downloaded
					if ( file_exists($title) ) {

						if ( $msg ) {
							echo 'Video downloaded successfuly. path: '.$title;
						}

						# check if user wants to read output
						if ( $read_data ) {

							# print all the output to screen
							$this->pr($download);
						}

						# video was downloaded so return its title
						return $title;

					} else {

						if ( $msg ) {
							echo 'Error occured trying to download video';
						}

						# video was not downloaded so return false
						return false;
					}
				}
			}
	    }

	   	/**
	    * Check if  a filepath or URL is a photo or not
	    * @param : { string } { $filepath } { path to file to check }
	    * @param : { boolean } { $msg } { shows errors if true }
	    */

	    function is_photo( $filepath, $msg = false ) {

	    	# extract photo extesnion
	        $path_format = pathinfo($filepath, PATHINFO_EXTENSION);

	        # create standard photo formats arrauy
	        $formats = array(
	            'jpg', 'JPG', 'JPEG', 'png', 'PNG', 'bmp', 'BMP', 'ICO'
	            );

	        # check if extesnion exists inside standard array
	        if ( in_array($path_format, $formats) ) {

	        	if ( $msg ) {
	        		echo 'Given path is image and format is: '.$path_format;
	        	}

	        		# extension exists so return it
	                return $path_format;

	        } else {

	        	if ( $msg ) {
	        		echo 'File is not valid image format';
	        	}

	        	# extension doesn't exist so return false
	            return false;
	        }
	    }

        /**
	    * Checks if a provided file matches provided extension
	    * @param : { string } { $filepath } { path or link to file }
	    * @param : { string } { $ext } { file extension to match against }
	    * @return : { boolean }
	    */

	    function is_type( $filepath, $ext ) {

	    	# extract file extension
	        $file_format = pathinfo($filepath, PATHINFO_EXTENSION);

	        # check if extesnon is empty
	        if ( empty($filepath) ) {

	        	# extension is empty so return false
	            return false;

	          # check extension == extension given by user
	        } elseif ( $file_format == $ext ) {

	        	# extensions match so return true
	        	return true;

	        } else {

	        	# extesnions don't match or something else went wrong so return false
	            return false;
	        }
	    }

	    /**
	    * Counts file with certain extension in given directory
	    * @param : { string } { $path } { path of directory with files to count }
	    * @param : { string } { $ext } { extension to count files }
	    */

	    function count_files( $path, $ext ) {
	        $directory = $path;

	        # select all files in directory
	        $files = glob($directory . '*.'.$ext.'');

	        # count files if directory is not empty
	        if ( $files !== false ) {
	            $filecount = count( $files );

	            # return count of files
	            return $filecount;

	        } else {

	        	# directory seems empty so return false
	            return false;
	        }
	    }

		/**
	    * Checks if a directory has permissions
	    * @param : { string } { $filepath } { file to check }
	    */

	    function perm_check( $filepath ) {

	    	# check if file allows writing
	        if ( is_writable($filepath) ) {

	        	# it allows so return its path
	            return $filepath;

	        } else {

	        	# it doesn't allow so return false
	            return false;
	        }
	    }

	    /**
	    * Checks if a file has certain permissions, if not forcefully adds given permissiosn
	    * @param : { string } { $path } { place where file is located }
	    * @param : { integer } { $permissions } { permissions to check and force }
	    * @param : { boolean } { $msg } { shows error messages }
	    */

	    function force_perm($path, $permission, $msg = false) {

	    	# check if file is writeable or not
	        if ( $this->perm_check($path) ) {
	            if ( $msg ) {
	                echo "File ".$path." is already writeable";
	            }

	            # file is writeable so return true
	            # no need to process further
	            return true;

	        } elseif ( !$this->perm_check($path) ) {

	        	# file is not writeable so give it permissions
	            chmod($path, $permission);

	            if ( $msg ) {
	                echo "File ".$path." now has permissions ".$permissions;
	            }

	            return true;

	        } else {

	            if ( $msg ) {
	                echo "Couldn't force permissions on file".$path;
	            }

	            # something went wrong so return false
	            return false;
	        }
	    }


	    /**
	    * Creates a new file (php, html, css, text etc) and gives it given permissions
	    * @param : { string } { $path } { path to create file }
	    * @param : { string } { $name } { name of file to create }
	    * @param : { mixed } { $content } { content to hold inside file }
	    * @param : { integer } { $permissions } { permissions to give to the file }
	    */

	    function born_perm( $path, $name, $content, $permissions ) {

	    	# create a file with given details
	        $file = file_put_contents($path.$name, $content);

	        # check if file has appropriate permissions
	        if ( is_writable($file) ) {

	        	# it has permissions so return true
	            return true;

	        } elseif ( !is_writable($file) ) {

	        	# it doesn't have permissions so add forcefully
	            $this->force_perm($file, $permissions);
	            return true;

	        } else {

	        	# something went wrong so return false
	            return false;
	        }
	    }

	   	/**
		* Generates a random string of provided length
		* @param : { integer } { $length  } { 10 by default. length for random string }
		*/

		function rand_string($length = 10) {
		    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		    $charactersLength = strlen($characters);
		    $randomString = '';
		    for ($i = 0; $i < $length; $i++) {
		        $randomString .= $characters[rand(0, $charactersLength - 1)];
		    }
		    return $randomString;
		}

		/**
		* Builds log file for a video after conversion
		* @param : { string } { $filepath } { log file to be created }
		* @param : { mixed } { $logData } { log data to be stored inside of file }
		* @param : { boolean } { $oright } { false by default, replace file if true }
		* @param : { boolean } { $msg } { false by default, prints error messages }
		*/

		function build_log( $filepath, $logData, $oright = false, $msg = false ) {
			if ( file_exists( $filepath ) && !$oright ) {
				if ( $msg ) {
					echo 'File already exists. Pass second paramter true to override';
				}
				return false;
			} else {
				file_put_contents( $filepath, $logData );
				if ( file_exists( $filepath ) ) {
					if ( $msg ) {
						echo "Log file ".$filepath." created";
					}
					return $filepath;
				} else {
					if ( $msg ) {
						echo "Something went wrong trying to create log file";
					}
					return false;
				}
			}
		}

		/**
		* Gets size of provided video
		* @param : { string } { $video_path } { directory path of video }
		* @param : { boolean } { $msg } { false by default. if set to true, displays operation messages }
		*/

		function get_video_size( $video_path, $msg = false ) {

			# check if provided file is valid video
			if ( $this->is_video($video_path) ) {

				# get size of video
				$video_size = filesize($video_path);

				# check if file size was returned
				if ( !empty($video_size) ) {

					if ( $msg ) {
						echo 'Video size is : '.$video_size. 'bytes';
					}

					# return video size to be used
					return $video_size;

				} else {

					if ( $msg ) {
						echo 'Video size could not be determined.';
					}

					# Failed to get video size so return false
					return false;
				}

			} else {

				if ( $msg ) {
					echo 'Invalid video provided';
				}

				# video format provided was invalid so return false
				return false;
			}
		}

		/**
		* Gets all possible details of a media file (video, audio, photo)
		* @param : { string } { $media } { path to file to extract details of }
		* @param : { boolean } { $oneOnly } { boolean } { false by default, get one specific detail }
		* @param : { boolean } { $json } { false by default, returns json data }
		* @param : { boolean } { $msg } { false by default, prints error messages }
		*/

		function media_detailer( $media, $oneOnly = false, $json = false, $msg = false ) {
			if ( file_exists( $media ) ) {
				$command = FFPROBE.' -v quiet -print_format json -show_format -show_streams '.$media;
				$data = $this->cmd($command);
				if ( !$oneOnly ) {
					if ( $json ) {
						return $data;
					} else {
						return json_decode( $data, true );
					}
				} else {
					$readable = json_decode( $data, true );
					$streams = $readable['streams'];
					$format = $readable['format'];
					switch ($oneOnly) {
						case 'width':
							return $streams[0]['width'];
							break;

						case 'height':
							return $streams[0]['height'];
							break;

						case 'res':
							$height = $streams[0]['height'];
							$width = $streams[0]['width'];
							$res = $width.'x'.$height;
							return $res;
							break;

						case 'dur':
							return $format['duration'];
							break;

						case 'size':
							return $format['size'];
							break;

						case 'bit_rate':
							return $format['bit_rate'];
							break;

						case 'created':
							return $format['tags']['creation_time'];
							break;

						case 'codec_name':
							return $streams[0]['codec_name'];
							break;
						
						default:
							$height = $streams[0]['height'];
							$width = $streams[0]['width'];
							$res = $width.'x'.$height;
							return $res;
							break;
					}
				}
			} else {
				if ( $msg ) {
					echo "File not found";
				}
				return false;
			}
		}


		/**
		* Check what is max resolotion possible conversion for a video
		* @param : { integer } { $height } { Height of video to be checked }
		*/

		function can_convert($height) {
			$standard_quals = array('240','360','480','720','1080');
			$maxres = false;
			foreach ($standard_quals as $quality) {
				if ($height >= $quality) {
					$maxres = $quality;
				} else {
					return $maxres;
				}
			}
		}
	}
?>