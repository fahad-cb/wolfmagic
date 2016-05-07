<?php
	/**
	* 
	*/

	define("VIM_KEY", "d0b4a83fc5c12570e9270fc54ef6ecabb8675fcf");

	class vimeo extends HuntHelp
	{
		
		function search($query, $max_vids = false, $more = false, $sort = false) {
			if (!empty($query)) {
				$q_strt = 'https://api.vimeo.com/videos?query=';

				$q = $q_strt.$query.'&client_id='.VIM_KEY;
				if ($more) {
					$q .= '&page='.$more;
				}
				$q = str_replace(" ", "+", $q);
				if ($max_vids) {
					$q .= '&per_page='.$max_vids;
				}

				if ($sort) {
					switch ($sort) {
						case 'views':
							$q .= '&sort=plays';
							break;
						case 'published_desc':
							$q .= '&sort=date';
							break;
						
						default:
							$q .= '&sort=relevant';
							break;
					}
				}
				#$query = 'http://localhost/pull_it_off/api/samples/yt_search';
				#exit($q);
				$raw_data = file_get_contents($q);
				$readable = json_decode($raw_data,true);
				#pex($readable,true);
				if ($token)  {
					return $this->search_process($readable,true);
				} else {
					return $this->search_process($readable);
				}
			}
		}

		function search_process($data, $more = false) {
				#pex($data,true);
			if (is_array($data)) {
				$cleaned = array();
				$cleaned['website'] = 'Vimeo';
				$cleaned['total'] = $data['total'];
				$cleaned['current_page'] = $data['page'];
				$cleaned['next_page'] = $data['paging']['next'];
				foreach ($data['data'] as $key => $value) {
					preg_match_all('!\d+!', $value['uri'], $vidid);
					$vidid = $vidid[0][0];
					$created = $value['created_time'];
				    $published = substr($created, 0, strpos($created, "T"));
					$published = $this->clean_time($published);
					$cleaned['vid_meta'][$key]['vidid'] = $vidid;
					$cleaned['vid_meta'][$key]['title'] = $value['name'];
					$cleaned['vid_meta'][$key]['description'] = $value['description'];
					$cleaned['vid_meta'][$key]['url'] = $value['link'];
					$cleaned['vid_meta'][$key]['duration'] = $value['duration'];
					$cleaned['vid_meta'][$key]['published'] = $published;
					$cleaned['vid_meta'][$key]['thumb'] = $value['pictures'][2]['link'];
					$cleaned['vid_meta'][$key]['chan_title'] = $value['user']['name'];
					$cleaned['vid_meta'][$key]['views'] = number_format($value['stats']['plays']);
					$cleaned['vid_meta'][$key]['likes'] = $value['stats']['likes'];
					$cleaned['vid_meta'][$key]['comments'] = $value['stats']['comments'];
				}
				#pex($cleaned,true);
				return $cleaned;
			}
		}

		function process_play($data) {
			$cleaned = array();
			preg_match_all('!\d+!', $data['uri'], $id);
			$cleaned['vidid'] = $id[0][0];
			$cleaned['title'] = $data['name'];
			$cleaned['description'] = $data['description'];
			$cleaned['duration'] = $data['duration'];
			#$cleaned['embed_code'] = $data['embed'];
			$cleaned['date_added'] = $data['created_time'];
			$cleaned['thumb'] = $data['pictures'][2]['link'];
			$cleaned['views'] = $data['stats']['plays'];
			$cleaned['likes'] = $data['likes'];
			$cleaned['username'] = $data['user']['name'];
			
			return $cleaned;
		}

		function play($id) {
			if (is_numeric($id)) {
				$request = 'https://api.vimeo.com/videos/'.$id.'?client_id='.VIM_KEY;
				$raw_data = file_get_contents($request);
				$readable = json_decode($raw_data,true);
				$cleaned = $this->process_play($readable);
				return $cleaned;
			}
		}
	}
?>