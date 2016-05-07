<?php
	/**
	* 
	*/

	class dailymotion extends HuntHelp
	{
		
		function search($query, $max_vids = false, $page = false, $sort = false) {
			$q_strt = 'https://api.dailymotion.com/videos?search=';

			$q = str_replace(" ", "+", $query);
			$q_strt .= $q;
			if ($max_vids) {
				$q_end = '&limit='.$max_vids;
			}

			if ($sort) {
				switch ($sort) {
					case 'views':
						$q_end .= '&sort=visited';
						break;
					case 'published_desc':
						$q_end .= '&sort=recent';
						break;
					
					default:
						$q_end .= '&sort=relevance';
						break;
				}
			}

			if ($page) {
				$q_end .= '&page='.$page;
			}

			if (is_numeric($page)) {
				$q_end .= '&page='.$page;
			}

			$request = $q_strt.$q_end;
			$raw_data = file_get_contents($request);
			if (!is_array($raw_data)) {
				$raw_data = file_get_contents($request);
			}
			$readable = json_decode($raw_data,true);
			return $this->search_process($readable); 
		}

		function play($id) {
			if(!empty($id)) {
				$content = $this->video_details($id,true);
				#pex($content,true);
				return $content;
			} else {
				return false;
			}
		}

		function search_process($array) {
			if (is_array($array)) {
				$cleaned = array();
				$cleaned['page'] = $array['page'];
				$cleaned['website'] = 'DailyMotion';
				$cleaned['total'] = $array['total'];
				foreach ($array['list'] as $key => $value) {
					$id = $value['id'];
					$chan_title = $value['channel'];
					unset($value['id']);
					unset($value['channel']);
					$value['chan_title'] = $chan_title;
					$value['vidid'] = $id;
					$meta = $this->video_details($id);
					$merged = array_merge($value, $meta);
					$cleaned['vid_meta'][] = $merged;
				}
				#pex($cleaned,true);
				return $cleaned;
			}
		}

		function video_details($vid, $play = false) {
			if (!$play) {
				$flds = 'description,duration,url,created_time,thumbnail_360_url,thumbnail_240_url,views_total';
			} else {
				$flds = 'id,title,description,duration,url,created_time,thumbnail_360_url,views_total';
			}
			$request = 'https://api.dailymotion.com/video/'.$vid.'?fields='.$flds;
			$cleaned = array();
			$raw_data = file_get_contents($request);
			$readable = json_decode($raw_data,true);
			#pex($readable,true);
			if ($play) {
				$cleaned['vidid'] = $readable['id'];
				$cleaned['title'] = str_replace(array('\n', "'", "’"), ' ', $readable['title']);
			}
			$created = date("Y-m-d\TH:i:s\Z",$readable['created_time']);
		    $published = substr($created, 0, strpos($created, "T"));
			$published = $this->clean_time($published);

			$cleaned['description'] = str_replace(array("'", "’"), ' ', $readable['description']);
			$cleaned['duration'] = $readable['duration'];
			$cleaned['published'] = $published;
			$cleaned['thumb'] = $readable['thumbnail_360_url'];
			$cleaned['views'] = number_format($readable['views_total']);
			$cleaned['url'] = $readable['url'];
			return $cleaned;
		}
	}
?>