<?php
	/**
	* 
	*/

	class download extends HuntHelp
	{
		function readJson($url) {
			if (!empty($url)) {
				$command = YOUTUBEDL.' -j '.$url;
				$data = $this->cmd($command);
				if (!empty($data)) {
					return $data;
				} else {
					return false;
				}
			}
		}

		function download($url, $location = 'default') {
			global $youtube;
			if (!empty($url)) {
				if ($location == 'default') {
					$location = __DIR__;
				}
				$video_id = $youtube->get_youtube_id($url);
				$to_download = $location.'/'.$video_id;
				$command = YOUTUBEDL." -o \"$location/%(id)s\" $url";
				$data = $this->cmd($command);
				if (file_exists($to_download)) {
					return $to_download;
				} else {
					return false;
				}
			}
		}
	}
		
?>