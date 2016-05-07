<?php

	/**
	* 
	*/

	class soundcloud extends HuntHelp
	{
		
		function search($q, $max = false) {
			if (!empty($q)) {
				# offset=4&limit=50
				$q  = str_replace(' ', '+', $q);
				$call = 'http://api.soundcloud.com/tracks.json?client_id='.SOUND_KEY.'&q='.$q;
				#exit($call);
				$raw_data = file_get_contents($call);
				$readable = json_decode($raw_data,true);
				#pex($readable,true);
				$cleaned = $this->process_search($readable);
				return $cleaned;
			}
		}

		function track_details($id) {
			if (is_numeric($id)) {
				$call = 'http://api.soundcloud.com/tracks/'.$id.'?client_id='.SOUND_KEY;
				$raw_data = file_get_contents($call);
				$readable = json_decode($raw_data,true);
				#pex($readable,true);
				$cleaned = $this->process_search($readable,true);
				return $cleaned;
			}
		}

		function process_search($readable, $single = false) {
			if (is_array($readable)) {
				$cleaned = array();
				if (!$single) {
					foreach ($readable as $key => $value) {
						$cleaned['aud_meta'][$key]['audid'] = $value['id'];
						$cleaned['aud_meta'][$key]['title'] = $value['title'];
						$cleaned['aud_meta'][$key]['description'] = $value['description'];
						$cleaned['aud_meta'][$key]['published'] = $value['created_at'];
						$cleaned['aud_meta'][$key]['link'] = $value['permalink'];
						$cleaned['aud_meta'][$key]['uri'] = $value['uri'];
						$cleaned['aud_meta'][$key]['duration'] = $value['duration'];
						$cleaned['aud_meta'][$key]['likes'] = $value['likes_count'];
						$cleaned['aud_meta'][$key]['views'] = $value['playback_count'];
						$cleaned['aud_meta'][$key]['comments_count']  = $value['comment_count'];
						$cleaned['aud_meta'][$key]['reposts'] = $value['reposts_count'];
						$cleaned['aud_meta'][$key]['chan_title'] = $value['user']['username'];
						$cleaned['aud_meta'][$key]['thumb'] = $value['user']['avatar_url'];
					}
				} else {
					$theuser = $readable['user']['username'];
					$theuser = strtolower(str_replace(' ', '-', $theuser));
					$cleaned['aud_meta']['audid'] = $readable['id'];
					$cleaned['aud_meta']['title'] = $readable['title'];
					$cleaned['aud_meta']['description'] = $readable['description'];
					$cleaned['aud_meta']['published'] = $readable['created_at'];
					$cleaned['aud_meta']['link'] = $readable['permalink'];
					$cleaned['aud_meta']['uri'] = $readable['uri'];
					$cleaned['aud_meta']['duration'] = $readable['duration'];
					$cleaned['aud_meta']['likes'] = $readable['likes_count'];
					$cleaned['aud_meta']['views'] = $readable['playback_count'];
					$cleaned['aud_meta']['comments_count']  = $readable['comment_count'];
					$cleaned['aud_meta']['reposts'] = $readable['reposts_count'];
					$cleaned['aud_meta']['chan_title'] = $readable['user']['username'];
					$cleaned['aud_meta']['dl_link'] = 'http://soundcloud.com/'.$theuser.'/'.$readable['permalink'];
				}
				
				return $cleaned;
			}
		}
	}

?>